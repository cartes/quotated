<template>
    <div class="product-contact text-left">
        <b-button v-if="seeButton" variant="primary" @click="contactInfo">
            Ver Información de contacto
        </b-button>
        <b-table v-if="!seeButton" hover bordered head-variant="light" :items="items" :fields="fields">

        </b-table>
    </div>
</template>

<script>
export default {
    name: 'productContact',
    props: {
        productId: {
            type: Number,
            required: true,
        }
    },
    data() {
        return {
            seeButton: true,
            id: null,
            fields: [
                {key: 'email', label: 'Correo Electrónico'},
                {key: 'telefono', label: 'Teléfono'}
            ],
            items: [],
        }
    },
    mounted() {
        this.id = this.productId;
    },
    methods: {
        contactInfo() {
            let url = '/api/contact/' + this.id;
            window.axios(url)
                .then(resp => {
                    this.seeButton = false;
                    this.items = [
                        {'email': resp.data.seller.email, 'telefono': resp.data.seller.phone},
                    ];
                })
                .catch(error => {
                    console.error(error);
                })
        },
    }
};
</script>

<style scoped>

</style>
