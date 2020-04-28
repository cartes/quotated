<template>
    <div>
        <b-modal id="categoryEdit">
            <form class="form" method="post">
                {{ category.category }}
            </form>
        </b-modal>
    </div>
</template>

<script>
    export default {
        name: "ModalEditCategory",
        props: {
            id: {
                type: Number,
            },
            category: {
                type: Object,
                required: false
            }
        },
    }
</script>

<style scoped>

</style>
