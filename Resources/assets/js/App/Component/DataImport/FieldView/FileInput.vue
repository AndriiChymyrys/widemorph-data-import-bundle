<template>
    <div class="form-group">
        <label for="entity-import">CSV/XLS File</label>
        <input type="file" @change="onChangeFileUpload" class="form-control-file" id="entity-import">
    </div>
</template>

<script>
import {mapActions} from 'vuex'

export default {
    name: "FileInput",
    methods: {
        onChangeFileUpload(e) {
            this.addFile(e.target.files[0])
        },
        ...mapActions('dataImport', ['addFile'])
    }
}
</script>
