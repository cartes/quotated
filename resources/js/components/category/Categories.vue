<template>
    <div>
        <div class="alert alert-primary text-center" v-if="processing">
            <i class="fa fa-compass"></i> Procesando información...
        </div>
        <div class="add-category row">
            <div class="col-3">
                <button class="btn btn-primary" @click="callAdd">
                    <i class="fa fa-plus-circle fa-lg"></i> Agregar Categoría
                </button>
            </div>
        </div>
        <modal-add-category :parentOptions="parentOptions" @saved="refreshTable">

        </modal-add-category>
        <ModalEditCategory :id="id"
                           :category="category"
                           :parentOptions="parentOptions"
                           :route="store"
                           @saved="refreshTable"
        >
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
    import ModalAddCategory from "./ModalAddCategory";

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
                parentOptions: [{value: null, text: "Sin categoría superior"}],
                id: 0,
                store: '',
                category: {
                    category: {
                        title: null,
                    },
                    categories: {
                        title: null,
                        id: null,
                        order: 0,
                    }
                },
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
                    requestFunction: data => {
                        return window.axios.get(this.url, {
                            params: data,
                        }).catch(function (e) {
                            console.log(e);
                        }.bind(this))
                    }
                },
            }
        },
        components: {
            ModalAddCategory,
            ModalEditCategory
        },
        methods: {
            callEdit(id) {
                this.id = id;
                let url = "/admin/category/" + id + "/edit";
                this.store = "/admin/category/" + id + "/store";
                axios.get(url)
                    .then(response => {
                        this.category = response.data;
                        this.parentOptions = [{value: null, text: "Sin categoría superior"}];
                        this.category.categories.forEach((item, index) => {
                            this.parentOptions.push({
                                value: item.id,
                                text: item.title,
                            });
                        });
                        this.$bvModal.show('categoryEdit');
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            callAdd() {
                axios.get("/admin/categories/parent")
                    .then(response => {
                        this.category = response.data;
                        this.parentOptions = [{value: null, text: "Sin categoría superior"}];
                        this.category.category.forEach((item) => {
                            this.parentOptions.push({
                                value: item.id,
                                text: item.title,
                            })
                        });
                        this.$bvModal.show('categoryAdd');
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            refreshTable(saved) {
                console.log(saved);
                this.$refs.table.refresh();
            }
        }
    }
</script>

<style scoped>

</style>
