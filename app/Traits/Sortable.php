<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Sortable
{

    /**
     * Aplica a ordenação a uma consulta.
     *
     * @param Builder $query
     * @param  array  $sorts
     * @return Builder
     */
    public function scopeSort(Builder $query, array $sorts)
    {
        foreach ($sorts as $sort) {
            [$field, $direction] = explode(':', $sort);

            // Garantir que a direção é válida
            $direction = strtolower($direction) === 'desc' ? 'desc' : 'asc';

            // Verificação de relacionamento
            if (strpos($field, '.') !== false) {
                $this->applyNestedRelationshipSort($query, $field, $direction);
            } else {
                // Ordenar pelo campo da tabela principal (com prefixo)
                $query->orderBy($this->getQualifiedFieldSortable($field), $direction);
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
    private function getQualifiedFieldSortable(string $field)
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
     * Aplica a ordenação em relacionamentos aninhados.
     *
     * @param Builder $query
     * @param  string  $field
     * @param  string  $direction
     * @return void
     */
    protected function applyNestedRelationshipSort(Builder $query, string $field, string $direction)
    {
        // Separar os relacionamentos
        $relations = explode('.', $field);

        // Retira o último item como o campo a ser ordenado
        $relationField = array_pop($relations);

        // Concatena os relacionamentos restantes
        $relation = implode('.', $relations);

        // Aplica a ordenação usando whereHas, passando pelos relacionamentos aninhados
        $query->whereHas($relation, function ($q) use ($relationField, $direction) {
            // Obter a tabela relacionada
            $relatedTable = $q->getModel()->getTable();

            // Ordenar pelo campo da tabela relacionada
            $q->orderBy("{$relatedTable}.{$relationField}", $direction);
        });
    }

}
