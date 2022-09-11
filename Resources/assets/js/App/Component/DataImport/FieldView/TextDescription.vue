<template>
    <ul class="list-group list-group-horizontal">
        <li class="list-group-item">
            Type: <span class="badge badge-primary">{{ field.annotation.type }}</span>
        </li>
        <li class="list-group-item" v-if="field.annotation.length">
            Max length: <span class="badge badge-primary">{{ field.annotation.length }}</span>
        </li>
        <li class="list-group-item">
            Can be nullable: <span class="badge badge-primary" v-if="field.annotation.nullable">yes</span>
            <span class="badge badge-primary" v-if="!field.annotation.nullable">no</span>
        </li>
    </ul>
</template>

<script>
export default {
    props: ['field'],
    name: "TextDescription"
}
</script>

<style scoped>

</style>