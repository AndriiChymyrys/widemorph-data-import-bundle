const DataImport = {
    namespaced: true,
    state: () => ({
        dataImport: {
            file: null, entity: {fields: {}, namespace: null, asIdentifierColumn: null, relations: {}}
        },
    }),
    mutations: {
        ADD_FIELD: (state, field) => state.dataImport.entity.fields[field] = null,
        ADD_RELATION: (state, namespace) => {
            if (!state.dataImport.entity.relations[namespace]) {
                state.dataImport.entity.relations[namespace] = {fields: {}, namespace: null, asIdentifierColumn: null};
                state.dataImport.entity.relations[namespace].namespace = namespace;
            }
        },
        ADD_RELATION_FIELD: (state, {namespace, field}) => {
            state.dataImport.entity.relations[namespace].fields[field] = null
        },
        UPDATE_RELATION_FIELD: (state, {namespace, field, value}) => {
            state.dataImport.entity.relations[namespace].fields[field] = value;
        },
        UPDATE_IDENTIFIER_COLUMN: (state, {namespace, isRelation, value}) => {
            if (isRelation) {
                state.dataImport.entity.relations[namespace].asIdentifierColumn = value;
            } else {
                state.dataImport.entity.asIdentifierColumn = value;
            }
        },
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
        updateRelationFieldValue({commit}, {namespace, field, value}) {
            commit('UPDATE_RELATION_FIELD', {namespace, field, value});
        },
        updateIdField({commit}, {namespace, isRelation, value}) {
            commit('UPDATE_IDENTIFIER_COLUMN', {namespace, isRelation, value});
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
