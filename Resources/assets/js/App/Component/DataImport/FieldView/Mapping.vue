<template>
    <div class="form-row align-items-center">
        <div class="form-group col-auto">
            <label :for="'mapping' + this.entityReflection.namespace + this.field.name">
                Field Mapping in Source
            </label>
            <input :name="getInputName()" type="text"
                   :id="'mapping' + this.entityReflection.namespace + this.field.name" class="form-control mb-2"
                   @input="updateMappingField"/>
        </div>
        <div class="form-group col-auto">
            <div class="form-check mb-2">
                <input :name="this.entityReflection.namespace"
                       type="radio"
                       :id="'mappingId' + this.entityReflection.namespace + this.field.name"
                       class="form-check-input"
                       @change="updateIdentifierField"
                       :value="this.field.name"/>
                <label :for="'mappingId' + this.entityReflection.namespace + this.field.name">
                    Use this field as identifier ?
                </label>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex'

export default {
    props: ['entityReflection', 'field', 'isRelation'],
    name: "Mapping",
    methods: {
        getInputName() {
            return 'entity[' + this.entityReflection.namespace + '][' + this.field.name + ']'
        },
        updateIdentifierField(e) {
            this.updateIdField({
                namespace: this.entityReflection.namespace,
                isRelation: this.isRelation,
                value: e.target.value
            });
        },
        updateMappingField(e) {
            if (this.isRelation) {
                this.updateRelationFieldValue({
                    namespace: this.entityReflection.namespace,
                    field: this.field.name,
                    value: e.target.value
                });
            } else {
                this.updateFieldValue({field: this.field.name, value: e.target.value});
            }
        },
        ...mapActions('dataImport', ['addField', 'addRelation', 'updateFieldValue', 'updateRelationFieldValue', 'updateIdField'])
    },
    mounted() {
        if (this.isRelation) {
            this.addRelation({namespace: this.entityReflection.namespace, field: this.field.name});
        } else {
            this.addField(this.field.name);
        }
    }
}
</script>
