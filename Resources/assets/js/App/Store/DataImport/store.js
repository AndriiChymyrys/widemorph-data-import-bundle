const DataImport = {
    namespaced: true,
    state: () => ({
        dataImport: {
            file: null, fields: {}
        },
    }),
    mutations: {
        ADD_FIELD: (state, field) => state.dataImport.fields[field] = null,
        UPDATE_FIELD_VALUE: (state, {field, value}) => state.dataImport.fields[field] = value,
        ADD_FILE: (state, file) => state.dataImport.file = file,
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
        }
    }
}

export default DataImport;
