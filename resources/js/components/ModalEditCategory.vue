<template>
    <div>
        <form class="form" method="post">
            {{ id }}
        </form>
    </div>
</template>

<script>
    export default {
        name: "ModalEditCategory",
        props: {
            route: {
                type: String,
            },
            id: {
                type: Number,
            }
        },
    }
</script>

<style scoped>

</style>
