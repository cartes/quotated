<template>
    <div>
        <b-modal hide-footer id="categoryAdd">
            <template v-slot:modal-title>
                Agregar Categoría
            </template>
            <b-form class="form" @submit.stop.prevent @submit="createSubmit">
                <b-form-group
                    :state="nameState"
                    label="Nombre de la Categoría"
                    invalid-feedback="Nombre Obligatorio"
                >
                    <b-form-input
                        id="title"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="Categoría Superior"
                >
                    <b-form-select id="cat_parent" v-model="selected" :options="parentOptions"></b-form-select>
                </b-form-group>
                <b-form-group
                    label="Orden"
                    required
                >
                    <b-form-input id="order" v-model="Orden"></b-form-input>
                </b-form-group>
                <b-form-group>
                    <b-button type="submit" variant="primary">Enviar</b-button>
                </b-form-group>
            </b-form>
        </b-modal>
    </div>
</template>

<script>
    import Categories from "./Categories";

    export default {
        name: "ModalAddCategory",
        props: {
            parentOptions: {
                type: Array,
                required: true,
            },

        },
        components: {
            Categories
        },
        data() {
            return {
                nameState: null,
                selected: null,
                Orden: 0,
            }
        },
        methods: {
            createSubmit(e) {
                e.preventDefault();
                axios.post('/admin/create/category',
                    {
                        title: title.value,
                        cat_parent: cat_parent.value,
                        order: order.value,
                    },
                    {
                        headers: {
                            "x-csrf-token": document.head.querySelector("meta[name=csrf-token]").content
                        }
                    }
                ).then(response => {
                    this.$bvModal.hide("categoryAdd");
                    this.$emit('saved', true);
                }).catch(e => {
                    console.log(e);
                });
            }
        }
    }
</script>

<style scoped>

</style>
