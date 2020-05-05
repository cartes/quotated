<template>
    <div>
        <b-modal hide-footer id="categoryEdit">
            <template v-slot:modal-title>
                Editando Categoría: {{category.category.title}} | ID: {{category.category.id}}
            </template>
            <b-form ref="form" class="form" @submit.stop.prevent @submit="handleSubmit">
                <b-form-group
                    :state="nameState"
                    label="Nombre de la Categoría"
                    invalid-feedback="Nombre obligatorio"
                >
                    <b-form-input
                        id="title"
                        v-model="category.category.title"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    :state="nameState"
                    label="Categoría Superior"
                >
                    <b-form-select id="cat_parent" v-model="category.category.cat_parent" :options="parentOptions"></b-form-select>
                </b-form-group>
                <b-form-group
                    :state="nameState"
                    label="Orden"
                    invalid-feedback="Orden es obligatorio"
                >
                    <b-form-input
                        id="order"
                        v-model="category.category.order"
                        :state="nameState"
                        rquired
                    >

                    </b-form-input>
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
            },
            route: {
                type: String,
                required: true
            }
        },
        components: {
            Categories
        },
        data() {
            return {
                selected: null,
                nameState: null,
            }
        },
        methods: {
            handleSubmit(e) {
                e.preventDefault();
                axios.post(this.route,
                    {
                        title: title.value,
                        cat_parent: cat_parent.value,
                        order: order.value,
                    },
                    {
                        headers: {
                            "x-csrf-token": document.head.querySelector('meta[name=csrf-token]').content
                        }
                    }
                ).then(response => {
                    this.$bvModal.hide('categoryEdit');
                    this.$emit('saved', true);
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>

<style scoped>

</style>
