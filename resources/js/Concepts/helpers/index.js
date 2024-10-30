import {
    filterMatchMode,
    filterMatchModeList,
    filterGetLabel,
    filterIsActive,
    filterPrepareQuery,
    filterRemoveMaskConstraints,
    formatQuery
} from './filters'
import { sortPrepareQuery, formatQuerySort } from './sorts'

export default {
    filters: {
        matchMode: filterMatchMode,
        matchModeList: filterMatchModeList,
        getLabel: filterGetLabel,
        isActive: filterIsActive,
        getQuery: filterPrepareQuery,
        removeMaskConstraints: filterRemoveMaskConstraints,
        formatQuery: formatQuery,
    },
    sorts: {
        getQuery: sortPrepareQuery,
        formatQuery: formatQuerySort,
    },
}
