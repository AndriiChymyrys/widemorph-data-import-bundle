<template>
    <input :name="getInputName()" class="form-control" @input="updateField"/>
</template>

<script>
import {mapActions} from 'vuex'

export default {
    props: ['namespace', 'fieldName'],
    name: "TextMapping",
    methods: {
        getInputName() {
            return 'entity[' + this.namespace + '][' + this.fieldName + ']'
        },
        updateField(e) {
            this.updateFieldValue({field: this.fieldName, value: e.target.value});
        },
        ...mapActions('dataImport', ['addField', 'updateFieldValue'])
    },
    mounted() {
        this.addField(this.fieldName);
    }
}
</script>
