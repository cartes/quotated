<template>
    <div>
        <v-server-table ref="table" :columns="columns" :url="url" :options="options">
            <div slot="status" slot-scope="props">
                <div v-if="props.row.status">
                    {{displayStatus(props.row.status.status)}}
                </div>
                <div v-else>
                    Inactivo
                </div>
            </div>
            <div slot="activate" slot-scope="props">
                <div v-if="props.row.status">
                    <button type="button" class="btn btn-success btn-block" @click="activateProduct(props.row.id)"
                            v-if="displayStatus(props.row.status.status) === 'Inactivo'">
                        Activar
                    </button>
                    <button v-else class="btn btn-danger btn-block" @click="deactivateProduct(props.row.id)"
                            type="button">
                        Bloquear
                    </button>
                </div>
                <div v-else>
                    <button type="button" class="btn btn-success btn-block" @click="activateProduct(props.row.id)">
                        Activar {{props.row.id}}
                    </button>
                </div>
            </div>
            <div slot="created_at" slot-scope="props">
                {{formatDate(props.row.created_at)}}
            </div>
        </v-server-table>
    </div>
</template>

<script>
    import {Event} from "vue-tables-2";
    import moment from "moment";

    export default {
        name: "ads",
        props: {
            labels: {
                type: Object,
                required: true
            },
            route: {
                type: String,
                required: true,
            }
        },
        data() {
            return {
                url: this.route,
                estate: 'No',
                status: null,
                columns: ['id', 'seller_id', 'title', 'description', 'status', 'created_at', 'activate'],
                options: {
                    filterByColumn: true,
                    filterable: ['title', 'description'],
                    perPage: 25,
                    perPageValues: [25, 50, 50, 100, 500],
                    headings: {
                        id: 'ID',
                        seller_id: this.labels.seller_id,
                        title: this.labels.title,
                        description: this.labels.description,
                        created_at: this.labels.created_at,
                        activate: this.labels.activate,
                        status: this.labels.status
                    },
                    requestFunction: data => {
                        return window.axios.get(this.url, {
                            params: data,
                        }).catch(function (e) {
                            console.log(e);
                        }.bind(this))
                    }
                }
            }
        },
        methods: {
            formatDate(date) {
                return moment(date).format('DD-MM-YYYY');
            },
            displayStatus(status = null) {
                if (status === null || status === "2") {
                    return 'Inactivo';
                }
                if (status === "1") {
                    return "Activo";
                }
                if (status === "4") {
                    return "Denunciado";
                }

                return "Inactivo";
            },
            activateProduct(id) {
                let url = "/admin/ad/" + id + "/activate";
                axios.post(url,
                    {
                        id: id
                    },
                    {
                        headers: {
                            "x-csrf-token": document.head.querySelector('meta[name=csrf-token]').content
                        }
                    }
                ).then(response => {
                    console.log(response.data);
                    if (response.data.msg == 'ok') {
                        this.$refs.table.refresh();
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            deactivateProduct(id) {
                let url = "/admin/ad/" + id + "/deactivate";
                axios.post(url,
                    {
                        id: id
                    },
                    {
                        headers: {
                            "x-csref-token": document.head.querySelector('meta[name=csrf-token')
                        }
                    }
                ).then(response => {
                    if (response.data.msg == 'ok') {
                        this.$refs.table.refresh();
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>