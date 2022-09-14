const DataImport = {
    namespaced: true,
    state: () => ({
        dataImport: {
            file: null, entity: {fields: {}, namespace: null}
        },
    }),
    mutations: {
        ADD_FIELD: (state, field) => state.dataImport.entity.fields[field] = null,
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
