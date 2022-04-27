<template>
    <div>
        <div class="row">
            <div class="col-12">
                <h3>Lista de productos</h3>
            </div>
        </div>
        <div class="row product_list">
            <div class="col-12">
<!--                <b-card no-body v-for="product in products.list">-->
<!--                    {{ product }}-->
<!--                </b-card>-->
                <b-card class="mb-3" no-body v-for="product in products.list" v-bind:key="product.id">
                    <b-row no-gutters>
                        <b-col cols="2">
                            <b-card-body>
                                <b-card-text>
                                    <b-img thumbnail width="100" height="100" :src="'/storage/' + product.images[0].path"></b-img>
                                </b-card-text>
                            </b-card-body>
                        </b-col>
                        <b-col cols="5">
                            <b-card-body>
                                <b-card-text>
                                    <b-link :href="'/category/' + product.category.slug ">
                                        {{ product.category.title }}<span v-if="product.status != null"> - {{ product.status.status }}</span>
                                    </b-link>
                                    <h3>
                                        {{ product.title }}
                                    </h3>
                                    <div>
                                        {{ product.description }}
                                    </div>
                                    <div>
                                        <small>
                                            {{ product.quantity }} unidades
                                        </small>
                                    </div>
                                </b-card-text>
                            </b-card-body>
                        </b-col>
                        <b-col cols="3">
                            <b-card-body>
                                <b-card-text>
                                    <h4>$ {{ formatPrice(product.price) }}</h4>
                                </b-card-text>
                            </b-card-body>
                        </b-col>

                        <b-col cols="2">
                            <b-card-body>
                                <b-card-text>
                                    <b-badge
                                        v-if="product.status == null || product.status.status != 1"
                                        pill
                                        variant="danger">
                                        En revisión
                                    </b-badge>
                                    <b-badge
                                        v-else
                                        pill
                                        variant="success">
                                        Publicado
                                    </b-badge>
                                    <b-link class="d-block" href="#">
                                        Editar
                                    </b-link>
                                    <b-link href="#" class="d-block text-danger">
                                        Borrar
                                    </b-link>
                                </b-card-text>
                            </b-card-body>
                        </b-col>
                    </b-row>
                </b-card>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "listProducts",
    props: {
        products: {
            type: Object,
            required: false,
        }
    },
    data() {
        return {
            listProducts: []
        }
    },
    mounted() {
        this.products.list.forEach(item => {
            let url = '/api/product/detail/' + item.id;
            window.axios(url).then(resp => {
                this.listProducts.push(resp.data);
            }).catch(error => {
                console.error(error)
            })
        });

        console.log(this.listProducts);
    },
    computed: {
        sortedArray() {
            let arraySorted = this.listProducts;
        }
    },
    methods: {
        formatPrice(value) {
            let val = (value / 1);
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    }
}
</script>

<style scoped>

</style>
