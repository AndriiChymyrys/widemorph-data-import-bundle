<template>
    <div class="btn-group">
        <a href="javascript:void(0)" class="btn btn-success">Test</a>
        <a href="javascript:void(0)" class="btn btn-warning" @click="handleImport()">Import</a>
    </div>
</template>

<script>
import axios from 'axios';
import {mapGetters} from 'vuex'

export default {
    name: "ImportButtons",
    props: ['importUrl'],
    methods: {
        handleImport() {
            let formData = new FormData();
            formData.append('file', this.getDataImport.file)
            formData.append('entity', JSON.stringify(this.getDataImport.entity))

            axios.post(this.importUrl, formData)
        }
    },
    computed: {
        ...mapGetters('dataImport', ['getDataImport']),
    }
}
</script>
