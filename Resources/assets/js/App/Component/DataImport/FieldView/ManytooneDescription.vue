<template>
    <span>{{ field.annotation.targetEntity }}</span>
</template>

<script>
export default {
    props: ['field'],
    name: "ManytooneDescription"
}
</script>
