<template>
    <div>
        <modal-edit-user :id="id"
                         :user="user"
                         :route="store"
                         @saved="refreshTable"
        >
        </modal-edit-user>
        <v-server-table ref="table" :columns="columns" :url="url" :options="options">
            <div slot="edit" slot-scope="props">
                <button type="button" @click="editUser(props.row.id)"
                        class="btn btn-primary btn-block">
                    Editar
                </button>
                <button type="button" v-if="props.row.status && props.row.status.status == '3'"
                        @click="unblockUser(props.row.id)"
                        class="btn btn-success btn-block">
                    Desbloquear
                </button>
                <button type="button" v-else-if="sessionId != props.row.id" @click="blockUser(props.row.id)"
                        class="btn btn-danger btn-block">
                    Bloquear
                </button>
            </div>

            <div slot="birthday" slot-scope="props">
                {{formaDate(props.row.birthday)}}
            </div>

            <div slot="status" slot-scope="props">
                <div v-if="props.row.status && props.row.status.status == '3'" class="text-danger">Bloqueado</div>
                <div v-else class="text-success">Activo</div>
            </div>
        </v-server-table>
    </div>
</template>

<script>
    import {Event} from "vue-tables-2";
    import modalEditUser from "./ModalEditUser";
    import moment from "moment";

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
        data() {
            return {
                url: this.route,
                id: 0,
                columns: ['id', 'name', 'surname', 'email', 'birthday', 'phone', 'status', 'edit'],
                user: {},
                store: '',
                saved: false,
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
                        }).catch(function (e) {
                            console.log(e);
                        }.bind(this))
                    }
                },
            }
        },
        components: {
            modalEditUser
        },
        methods: {
            formaDate(date) {
                return moment(date).format("DD-MM-YYYY");
            },
            blockUser(id) {
                let url = "/admin/user/" + id + "/block";
                axios.post(url).then(
                    response => {
                        if (response.data.msg == 'ok') {
                            this.$refs.table.refresh();
                        }
                    }
                ).catch(function (e) {
                    console.log(e);
                })
            },
            unblockUser(id) {
                let url = "/admin/user/" + id + "/unblock";
                axios.post(url).then(
                    response => {
                        if (response.data.msg == 'ok') {
                            this.$refs.table.refresh();
                        }
                    }
                ).catch(function (e) {
                    console.log(e);
                })

            },
            editUser(id) {
                this.$bvModal.show('userEdit');
                this.id = id;
                this.store = "/admin/user/" + id + "/store";
                let url = "/admin/user/" + id + "/get";
                axios.get(url).then(response => {
                    this.user = response.data;
                }).catch(e => {
                    console.log(e);
                })
            },
            refreshTable(saved) {
                if (saved) {
                    this.$refs.table.refresh();
                }
            }
        }
    }
</script>

<style scoped>

</style>