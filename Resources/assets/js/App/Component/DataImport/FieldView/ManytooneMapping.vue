<template>
    <input :name="getInputName()" class="form-control"/>
</template>

<script>
import {mapActions} from 'vuex'

export default {
    props: ['namespace', 'fieldName'],
    name: "ManytooneMapping",
    methods: {
        getInputName() {
            return 'entity[' + this.namespace + '][' + this.fieldName + ']'
        },
        ...mapActions('dataImport', ['addField'])
    },
    mounted() {
        this.addField(this.fieldName);
    }
}
</script>
