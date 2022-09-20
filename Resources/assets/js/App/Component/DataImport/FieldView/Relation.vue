<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Import Data For Relation Entity <b>{{ entityReflection.namespace }}</b></h3>
        </div>
        <div class="card-body table-responsive p-0">
            <EntityField :entityReflection="entityReflection" :is-relation="true" />
        </div>
    </div>
</template>

<script>
import EntityField from "./EntityField";

export default {
    props: ['entityReflection'],
    components: {
        EntityField
    },
    name: 'Relation',
}
</script>
