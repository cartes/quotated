<template>
    <div>
        <div class="alert alert-primary text-center" v-if="processing">
            <i class="fa fa-compass"></i> Procesando información...
        </div>
        <v-server-table ref="table" :columns="columns" :url="url" :options="options">
            <div slot="edit" slot-scope="props">
                <!-- v-bind:href="'/admin/category/' + props.row.id + '/edit/'" -->
                <button @click="callModal(props.row.id)"
                    type="button"
                    class="btn btn-secondary btn-block"
                    >Edite {{ props.row.title }}</button>
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
                    requestFunction: function (data) {;
                        return window.axios.get(this.url, {
                            params: data
                        }).catch(function (e) {
                            console.log(e);
                        }.bind(this))
                    }
                },
                components: {
                    ModalEditCategory
                }
            }
        },
        methods: {
            callModal(id) {

            }
        }
    }
</script>

<style scoped>

</style>
