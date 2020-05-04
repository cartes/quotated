<template>
    <div>
        <v-server-table ref="table" :columns="columns" :url="url" :options="options">
            <div slot="edit" slot-scope="props">
                <button type="button"
                        class="btn btn-primary btn-block">
                    Editar
                </button>
                <button type="button" v-if="sessionId != props.row.id" @click="blockUser(props.row.id)"
                        class="btn btn-danger btn-block">
                    Bloquear
                </button>
            </div>
            <div slot="status" slot-scope="props">
                <div>{{props.row.status}}</div>
            </div>
        </v-server-table>
    </div>
</template>

<script>
    import {Event} from "vue-tables-2";

    export default {
        name: "users",
        props: {
            labels: {
                type: Object,
                required: true
            },
            route: {
                type: String,
                required: true
            },
            sessionId: {
                type: String,
            }
        },
        data () {
            return {
                url: this.route,
                columns: ['id', 'name', 'surname', 'email', 'birthday', 'phone', 'status', 'edit'],
                options: {
                    filterByColumn: true,
                    perPage: 10,
                    perPageValues: [10, 25, 50, 100, 500],
                    filterable: ['name', 'email'],
                    headings: {
                        id: 'ID',
                        name: this.labels.name,
                        surname: this.labels.surname,
                        email: this.labels.email,
                        birthday: this.labels.birthday,
                        phone: this.labels.phone,
                        status: this.labels.status,
                        edit: "",
                    },
                    requestFunction: data => {
                        return window.axios.get(this.url, {
                            params: data,
                        }).catch(function(e){
                            console.log(e);
                        }.bind(this))
                    }
                },
            }
        },
        methods: {
            blockUser(id) {
                let url = "/admin/user/"+id+"/block";
                axios.post(url).then(
                    response => {
                        console.log(response);
                    }
                ).catch(function(e) {
                    console.log(e);
                })
            }
        }
    }
</script>

<style scoped>

</style>