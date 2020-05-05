<template>
    <div>
        <b-modal hide-footer id="userEdit">
            <template v-slot:modal-title>
                Editando a usuario ID: {{id}}
            </template>
            <b-form ref="form" class="form" @submi.stop.prevent @submit="handleSubmit">
                <b-form-group
                        label="Nombre de usuario"
                >
                    <b-form-input
                            id="firstName"
                            :state="nameState"
                            v-model="user.name"
                            required></b-form-input>
                </b-form-group>
                <b-form-group
                        label="Apellido"
                >
                    <b-form-input
                            id="surname"
                            :state="nameState"
                            v-model="user.surname"
                            required></b-form-input>
                </b-form-group>
                <b-form-group
                        label="Email"
                >
                    <b-form-input
                            id="email"
                            :state="nameState"
                            v-model="user.email"
                            required></b-form-input>
                </b-form-group>
                <b-form-group
                        label="Fecha de nacimiento"
                >
                    <b-form-datepicker
                            id="birthday"
                            :state="nameState"
                            v-model="user.birthday"
                            @context="onContext"
                            required></b-form-datepicker>
                </b-form-group>
                <b-form-group
                        label="Teléfono"
                >
                    <b-form-input
                            id="phone"
                            :state="nameState"
                            v-model="user.phone"
                            required></b-form-input>
                </b-form-group>
                <b-form-group>
                    <b-button type="submit" variant="primary">Enviar</b-button>
                </b-form-group>

            </b-form>
        </b-modal>
    </div>
</template>

<script>
    import users from "./users";

    export default {
        name: "ModalEditUser",
        props: {
            id: {
                type: Number,
            },
            user: {
                type: Object,
                require: false
            },
            route: {
                type: String,
                required: true
            }
        },
        components: {
            users
        },
        data() {
            return {
                nameState: null,
                birthday: null,
            }
        },
        methods: {
            onContext(ctx) {
                this.birthday = ctx.selectedYMD;
            },
            handleSubmit(e) {
                e.preventDefault();
                console.log(this.birthday);
                axios.post(this.route,
                    {
                        firstName: firstName.value,
                        surname: surname.value,
                        email: email.value,
                        birthday: this.birthday,
                        phone: phone.value,
                    },
                    {
                        headers: {
                            "x-csrf-token": document.head.querySelector("meta[name=csrf-token").content
                        }
                    }
                ).then(response => {
                    this.$emit('saved', true);
                    this.$bvModal.hide('userEdit');
                }).catch(e => {
                    console.log(e);
                })
            }
        }
    }
</script>

<style scoped>

</style>