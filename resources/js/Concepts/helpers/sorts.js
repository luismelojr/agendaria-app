
const sortPrepareQuery = (sort) => {
    if (sort && hasNotNullValues(sort))
        return `${sort.field}:${sort.order===1?'asc':'desc'}`
}

/**
 * Verifica se pelo menos um item da ordenação é diferente de null.
 *
 * @param {Object} sorts - Um objeto contendo valores da ordenação.
 * @return {Boolean} True se pelo menos um item da ordenação é diferente de null, false caso contrário.
 */
const hasNotNullValues = (sorts) => {
    return Object.values(sorts).some(value => value !== null);
}

const formatQuerySort = (sorts) => {
    if (sorts.length > 0) {
        return sorts.map(item => {
            const newItem = item.replace('=', '').split(':')
            return {
                field: newItem[0],
                order: newItem[1] === 'asc' ? 1 : -1
            }
        })
    }

    return sorts
}

export {
    sortPrepareQuery,
    formatQuerySort
}
