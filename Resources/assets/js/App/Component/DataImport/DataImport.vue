<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Import Data For Entity <b>{{ entityReflection.namespace }}</b></h3>
        </div>
        <div class="card-body table-responsive p-0">
            <EntityField :entityReflection="entityReflection" :is-relation="false"/>
        </div>
    </div>
    <Relation v-for="relation in relations" :entityReflection="relation"/>
    <div class="card">
        <div class="card-footer text-muted">
            <div class="row">
                <div class="col-6">
                    <file-input/>
                </div>
                <div class="col-6 text-right">
                    <import-buttons :import-url="importUrl"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import EntityField from "./FieldView/EntityField";
import FileInput from "./FieldView/FileInput";
import ImportButtons from "./FieldView/ImportButtons";
import Relation from "./FieldView/Relation";
import {mapActions} from 'vuex'

export default {
    props: ['entityReflection', 'importUrl'],
    name: 'DataImport',
    components: {
        Relation,
        FileInput,
        ImportButtons,
        EntityField,
    },
    mounted() {
        this.setNamespace(this.entityReflection.namespace);
    },
    computed: {
        relations() {
            return this.getRelations(this.entityReflection)
        }
    },
    methods: {
        getRelations(entityReflection, relation) {
            let rel = relation ? relation : [];

            for (let name in entityReflection.fields) {
                let field = entityReflection.fields[name];

                if (field.namespace) {
                    rel.push(field)
                    this.getRelations(field, rel)
                }
            }

            return rel;
        },
        ...mapActions('dataImport', ['setNamespace'])
    }
}
</script>
