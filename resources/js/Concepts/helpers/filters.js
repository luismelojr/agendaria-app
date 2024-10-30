import { useDateFormat } from '@vueuse/core'
import ptBR from './../locale/primevue/ptBR.js'

/**
 * Retorna o modo de correspondência traduzido do código do idioma ptBR.
 *
 * @param {string} typeMode – O tipo de modo de correspondência a ser traduzido.
 * @return {string} O modo de correspondência traduzido ou '-' se não for encontrado.
 */
const filterMatchMode = (typeMode) => {
    return ptBR[typeMode] || '-'
}

/**
 * Gera um rótulo/label para um item de filtro.
 */
const filterGetLabel = (key, label, item) => {
    const { constraints, matchMode, value } = item;

    // Se houver constraints, processa o valor e retorna a string correspondente
    if (constraints) {
        const constraintsLabel = constraints
            .filter(({ value }) => value !== null)
            .map(({ matchMode, value }) => `${filterMatchMode(matchMode)}: ${filterGetValue(key, { value })}`)
            .join(' e ');

        return `${label} ${constraintsLabel}`;
    }

    // Caso padrão para outros valores
    return `${label} ${filterMatchMode(matchMode)}: ${filterGetValue(key, item)}`;
};

/**
 * Retorna o valor de um item de filtro, traduzindo os valores de 'status' para 'Sim' ou 'Não' se aplicável.
 *
 * @param {string} key - Nome da chave.
 * @param {object} item - O objeto do item de filtro com propriedades 'chave' e 'valor'.
 * @return {string|*} O valor traduzido ou original do item de filtro.
 */
const filterGetValue = (key, item) => {
    return item.value
}

/**
 * Verifica se pelo menos um filtro está ativo.
 *
 * @param {Object} filters - Um objeto contendo valores de filtro.
 * @return {Boolean} True se pelo menos um filtro estiver ativo, false caso contrário.
 */
const filterIsActive = (filters) => {
    return Object.values(filters).some(item => {
        if (item.constraints && Array.isArray(item.constraints)) {
            return item.constraints.some(constraint => constraint.value !== null)
        } else if (item.value !== null) {
            return true
        }
        return false
    })
}

// const filterIsActive = (filters) => {
//     return Object.values(filters).some(item => item.value !== null)
// }

/**
 * Gera uma string de consulta com base nos filtros ativos.
 *
 * @param {Object} filters - Um objeto que contém os filtros.
 * @return {string|null} - Uma string separada por vírgula de valores de filtro ativo no formato "key:matchMode:value" ou null se não houver filtros ativos.
 */
const filterPrepareQuery = (filters) => {
    if (filterIsActive(filters)) {
        return Object.entries(filters).filter(([key, item]) => {
            return item.value !== null || item.value === 0 || (item.constraints && item.constraints.some(constraint => constraint.value !== null))
        }).map(([key, item]) => {
            if (item.constraints && Array.isArray(item.constraints)) {
                return item.constraints
                    .filter(constraint => constraint.value !== null)
                    .map(constraint => {
                        return `${key}:${constraint.matchMode}:${constraint.value}`
                    }).join(',')
            } else if (item.value !== null) {
                if (item.matchMode === 'in') {
                    return `${key}:${item.matchMode}:${item.value.join('|')}`
                } else {
                    return `${key}:${item.matchMode}:${item.value}`
                }
            }
            return null
        }).filter(Boolean).join(',')
    }
}

/**
 * Remove caracteres não alfanuméricos (máscaras) dos valores de um conjunto de constraints em um filtro.
 *
 * @param {string} constraint - A chave que identifica o conjunto de constraints dentro do filtro.
 * @param {Object} filter - Um objeto que contém os filtros, incluindo as constraints a serem processadas.
 * @return {Array} - Um novo array de constraints, com os valores numéricos desmascarados (apenas dígitos).
 */
const filterRemoveMaskConstraints = (constraint, filter) => {
    return filter[constraint].constraints.map((item) => {
        if (item.value) {
            item.value = item.value.replace(/[\.\-\/_]/g, '')
        }
        return item
    })
}


/**
 * Retorna uma lista de modos de correspondência de filtros com base no tipo fornecido.
 *
 * @param {string} type - O tipo de modos de correspondência de filtro a serem retornados (por exemplo, 'número', 'texto')
 * @return {Array<Object>} Uma lista de modos de correspondência de filtro, onde cada modo é um objeto com propriedades 'rótulo' e 'valor'
 */
const filterMatchModeList = (type) => {
    const FILTER_OPTIONS = {
        number: [
            { label: 'Igual', value: 'equals' },
            { label: 'Menor que', value: 'lt' },
            { label: 'Menor que ou igual a', value: 'lte' },
            { label: 'Maior que', value: 'gt' },
            { label: 'Maior que ou igual a', value: 'gte' },
        ],
        date: [
            { label: 'Menor ou igual que', value: 'dateBefore' },
            { label: 'Maior ou igual que', value: 'dateAfter' },
        ],
        text: [
            { label: 'Contém', value: 'contains' },
            { label: 'Não contém', value: 'notContains' },
            { label: 'Igual', value: 'equals' },
        ],
    }
    return FILTER_OPTIONS[type] || []
}

const formatQuery = (value) => {
    const newValue = value.map((item) => {
        const itemSplit = item.split(':')
        if (itemSplit.length === 3) {
            return {
                key: itemSplit[0],
                matchMode: itemSplit[1],
                value: itemSplit[2]
            }
        }
    })

    if (newValue.length > 0) {
        const constraints = []
        for (const key in newValue) {
            const existsContraints = constraints.find(item => item.field === newValue[key].key)
            if (existsContraints) {
                existsContraints.constraints.push({
                    value: newValue[key].value,
                    matchMode: newValue[key].matchMode
                })
            } else {
                constraints.push({
                    field: newValue[key].key,
                    constraints: [{
                        value: newValue[key].value,
                        matchMode: newValue[key].matchMode
                    }]
                })
            }
        }

        return constraints.length > 0 ? constraints.reduce((acc, item) => {
            acc[item.field] = item
            return acc
        }, {}) : {}
    }
}

export {
    filterGetLabel,
    filterIsActive,
    filterMatchMode,
    filterMatchModeList,
    filterPrepareQuery,
    filterRemoveMaskConstraints,
    formatQuery
}

