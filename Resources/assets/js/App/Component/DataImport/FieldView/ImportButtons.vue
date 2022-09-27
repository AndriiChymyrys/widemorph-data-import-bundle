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
            let entity = Object.assign({}, this.getDataImport.entity);
            formData.append('file', this.getDataImport.file)

            let rel = [];

            for (let key in entity.relations) {
                rel.push(entity.relations[key])
            }

            entity.relations = rel;

            formData.append('entity', JSON.stringify(entity))

            axios.post(this.importUrl, formData)
        }
    },
    computed: {
        ...mapGetters('dataImport', ['getDataImport']),
    }
}
</script>
