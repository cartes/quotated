<template>
    <div>
        <div class="alert alert-primary text-center" v-if="processing">
            <i class="fa fa-compass"></i> Procesando información...
        </div>
        <ModalEditCategory :id="id"
                           :category="category">
        </ModalEditCategory>
        <v-server-table ref="table" :columns="columns" :url="url" :options="options">
            <div slot="edit" slot-scope="props">
                <button @click="callEdit(props.row.id)"
                        type="button"
                        class="btn btn-secondary btn-block"
                >Editar {{ props.row.title }}
                </button>
            </div>

        </v-server-table>
    </div>
</template>

<script>
    import {Event} from "vue-tables-2";
    import ModalEditCategory from "./ModalEditCategory";

    export default {
        name: "Categories",
        props: {
            labels: {
                type: Object,
                required: true,
            },
            route: {
                type: String,
                required: true,
            }
        },
        data() {
            return {
                processing: false,
                status: null,
                id: 0,
                category: {},
                url: this.route,
                columns: ['id', 'title', 'cat_parent', 'order', 'edit'],
                options: {
                    filterByColumn: true,
                    perPage: 10,
                    perPageValues: [10, 25, 50, 100, 500],
                    headings: {
                        id: 'ID',
                        title: this.labels.title,
                        cat_parent: this.labels.cat_parent,
                        order: this.labels.order,
                        edit: this.labels.edit,
                    },
                    sorteable: ['id', 'title', 'order'],
                    filterable: ['title'],
                    requestFunction: function (data) {
                        ;
                        return window.axios.get(this.url, {
                            params: data
                        }).catch(function (e) {
                            console.log(e);
                        }.bind(this))
                    }
                },
            }
        },
        components: {
            ModalEditCategory
        },
        methods: {
            callEdit(id) {
                this.id = id;
                let url = "/admin/category/" + id + "/edit";
                axios.get(url)
                    .then(response => {
                    this.category = response.data;
                    this.$bvModal.show('categoryEdit');
                })
                    .catch(e => {
                        console.log(e);
                });
            }
        }
    }
</script>

<style scoped>

</style>
