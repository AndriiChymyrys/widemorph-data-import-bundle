const DataImport = {
    namespaced: true,
    state: () => ({
        dataImport: {
            file: null, entity: {fields: {}, namespace: null, relations: {}}
        },
    }),
    mutations: {
        ADD_FIELD: (state, field) => state.dataImport.entity.fields[field] = null,
        ADD_RELATION: (state, namespace) => state.dataImport.entity.relations[namespace] === undefined ? state.dataImport.entity.relations[namespace] = {} : null,
        ADD_RELATION_FIELD: (state, {namespace, field}) => state.dataImport.entity.relations[namespace][field] = null,
        UPDATE_FIELD_VALUE: (state, {field, value}) => state.dataImport.entity.fields[field] = value,
        ADD_FILE: (state, file) => state.dataImport.file = file,
        SET_NAMESPACE: (state, namespace) => state.dataImport.entity.namespace = namespace,
    },
    getters: {
        getDataImport(state) {
            return state.dataImport;
        }
    },
    actions: {
        addField({commit}, field) {
            commit('ADD_FIELD', field)
        },
        addRelation({commit}, {namespace, field}) {
            commit('ADD_RELATION', namespace)
            commit('ADD_RELATION_FIELD', {namespace, field})
        },
        updateFieldValue({commit}, {field, value}) {
            commit('UPDATE_FIELD_VALUE', {field, value})
        },
        addFile({commit}, file) {
            commit('ADD_FILE', file)
        },
        setNamespace({commit}, namespace) {
            commit('SET_NAMESPACE', namespace)
        }
    }
}

export default DataImport;
