<template>
    <table class="table table-hover text-nowrap">
        <thead>
        <tr>
            <th>Entity Field Name</th>
            <th>Field Description</th>
            <th>Mapping</th>
        </tr>
        </thead>
        <tbody>
        <template v-for="field in entityReflection.fields">
            <tr v-if="!field.namespace">
                <td>{{ field.name }}</td>
                <td>
                    <Description :field="field"/>
                </td>
                <td>
                    <Mapping :field="field" :entityReflection="entityReflection" :is-relation="isRelation"/>
                </td>
            </tr>
        </template>
        </tbody>
    </table>
</template>

<script>
import Mapping from "./Mapping";
import Description from "./Description";

export default {
    props: ['entityReflection', 'isRelation'],
    components: {
        Mapping,
        Description
    },
    name: "EntityField"
}
</script>
