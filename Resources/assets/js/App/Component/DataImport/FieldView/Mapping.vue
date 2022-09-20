<template>
    <input :name="getInputName()" class="form-control" @input="updateField"/>
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
        updateField(e) {
            this.updateFieldValue({field: this.field.name, value: e.target.value});
        },
        ...mapActions('dataImport', ['addField', 'addRelation', 'updateFieldValue'])
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
