<template>
    <form class="form" method="post">
        @csrf
        @method("PUT")
    </form>
</template>

<script>
    export default {
        name: "ModalEditCategory",
        props: {
            route: {
                type: String,
                required: true,
            },
            id: {
                type: String,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
