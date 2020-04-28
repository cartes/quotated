<template>
    <div>
        <b-modal id="categoryEdit">
            <template v-slot:modal-title>
                Editando Categoría: {{category.category.title}} | ID: {{category.category.id}}
            </template>
            <form ref="form" class="form" @submit.stop.prevent="handleSubmit">
                <b-form-group
                    :state="nameState"
                    label="Nombre de la Categoría"
                    invalid-feedback="El nombre de la categoría es obligatorio"
                >
                    <b-form-input
                        id="title"
                        v-model="category.category.title"
                        :state="nameState"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    :state="nameState"
                    label="Categoría Superior"
                >
                    <b-form-select v-model="selected" :options="parentOptions"></b-form-select>
                </b-form-group>
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
            },
            parentOptions: {
                type: Array,
                required: true,
            }
        },
        data() {
            return {
                selected: null,
                nameState: null,
            }
        },
        methods: {
            checkFormValidity() {
                const valid = this.$refs.form.checkFormValidity();
                this.nameState = valid;
                return valid;
            },
            handleSubmit() {
                if (!this.checkFormValidity()) {
                    return
                }
            }
        }
    }
</script>

<style scoped>

</style>
