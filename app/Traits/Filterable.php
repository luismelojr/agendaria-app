<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Aplica filtros a uma consulta.
     *
     * @param Builder $query
     * @param  array  $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters)
    {
        foreach ($filters as $filter) {
            [$field, $operator, $value] = explode(':', $filter);

            // Verificação de relacionamento
            if (strpos($field, '.') !== false) {
                $this->applyNestedRelationshipFilter($query, $field, $operator, $value);
            } else {
                // Aplicar filtro para a tabela principal
                $this->applyFilter($query, $this->getQualifiedField($field), $operator, $value);
            }
        }

        return $query;
    }

    /**
     * Retorna o nome qualificado da tabela ou do relacionamento.
     *
     * @param  string  $field
     * @return string
     */
    private function getQualifiedField(string $field)
    {
        // Verificar se o campo é um relacionamento
        if (method_exists($this, $field)) {
            // Se for relacionamento, obter o nome da tabela relacionada
            $relation = $this->$field();
            if (method_exists($relation, 'getRelated')) {
                return $relation->getRelated()->getTable() . ".{$field}";
            }
        }

        // Retornar o campo da tabela principal se não for relacionamento
        return "{$this->getTable()}.{$field}";
    }

    /**
     * Aplica filtro em relacionamentos aninhados.
     *
     * @param Builder $query
     * @param  string  $field
     * @param  string  $operator
     * @param  string  $value
     * @return void
     */
    protected function applyNestedRelationshipFilter(Builder $query, string $field, string $operator, string $value)
    {
        // Separar os relacionamentos
        $relations = explode('.', $field);

        // Retira o último item como o campo a ser filtrado
        $relationField = array_pop($relations);

        // Concatena os relacionamentos restantes
        $relation = implode('.', $relations);

        // Aplica o filtro usando whereHas, passando pelos relacionamentos aninhados
        $query->whereHas($relation, function ($q) use ($relationField, $operator, $value) {
            // Obter a tabela relacionada
            $relatedTable = $q->getModel()->getTable();

            // Prefixar a tabela relacionada no filtro
            $this->applyFilter($q, "{$relatedTable}.{$relationField}", $operator, $value);
        });
    }

    /**
     * Aplica o filtro de acordo com o operador e valor especificados.
     *
     * @param Builder $query
     * @param  string  $field
     * @param  string  $operator
     * @param  string  $value
     * @return void
     */
    private function applyFilter(Builder $query, $field, $operator, $value)
    {
        // Verificação e transformação do $value para campos 'status' ou 'approved'
        [$relation, $relationField] = explode('.', $field);
        if (in_array($relationField, ['status', 'approved', 'enable_advertiser'])) {
            $value = filter_var($value, FILTER_VALIDATE_BOOLEAN) ? true : false;
        }

        // Tratamento do operador para campos data
        match($operator) {
            'dateBefore' => $value = date('Y-m-d 23:59:59', strtotime($value)),
            'dateAfter' => $value = date('Y-m-d 00:00:00', strtotime($value)),
            default => null,
        };

        // Tratamento do operador
        match ($operator) {
            'equals' => $query->where($field, $value),
            'contains' => $query->where($field, 'like', "%{$value}%"),
            'notContains' => $query->where($field, 'not like', "%{$value}%"),
            'lt' => $query->where($field, '<', $value),
            'lte' => $query->where($field, '<=', $value),
            'gt' => $query->where($field, '>', $value),
            'gte' => $query->where($field, '>=', $value),
            'dateBefore' => $query->where($field, '<=', $value),
            'dateAfter' => $query->where($field, '>=', $value),
            'in' => $query->whereIn($field, explode('|', $value)),
            default => null,
        };
    }
}
