<template>
    <div class="container w-100">
        <b-carousel
            :interval="5000"
            controls
            indicators
            img-width="620"
            img-height="700"
        >
            <b-carousel-slide img-blank>
            <div class="row pt-5">
                <div class="col col-md-4 mb-2 px-1" v-for="(product, id) in first_products" :key="product.id">
                    <div class='card h-100'>
                        <div v-if="product.images.length >= 1 && id== 'path' && img != '0'" class="img-thumbnail"
                             v-for="(img, id) in product.images[0]">
                            <img :src="'http://clasificados.aqua.cl/storage/' + img"
                                 :alt="product.title"
                                 class='card-img-top embed-responsive-item'/>
                        </div>
                        <div class="card-body">
                            <a :href="'http://clasificados.aqua.cl/storage/' + product.slug" target="_blank">
                                <h3 class="text-left" style='font-size: 1.25em;'>
                                    {{ product.title }}
                                </h3>
                                <h5 class="text-left" style='font-size: 1em; color: #d80000'>
                                    $ {{ formatPrice(product.price) }}
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </b-carousel-slide>
            <b-carousel-slide img-blank>
            <div class="row pt-5">
                <div class="col col-md-4 mb-2 px-1" v-for="(product, id) in second_products" :key="product.id">
                    <div class='card h-100'>
                        <div v-if="product.images.length >= 1 && id== 'path' && img != '0'" class="img-thumbnail"
                             v-for="(img, id) in product.images[0]">
                            <img :src="'http://clasificados.aqua.cl/storage/' + img"
                                 :alt="product.title"
                                 class='card-img-top embed-responsive-item'/>
                        </div>
                        <div class="card-body">
                            <a :href="'http://clasificados.aqua.cl/storage/' + product.slug" target="_blank">
                                <h3 class="text-left" style='font-size: 1.25em;'>
                                    {{ product.title }}
                                </h3>
                                <h5 class="text-left" style='font-size: 1em; color: #d80000'>
                                    $ {{ formatPrice(product.price) }}
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </b-carousel-slide>
        </b-carousel>
    </div>
</template>

<script>
export default {
    name: "IframeView",
    props: {},
    data() {
        return {
            first_products: {},
            second_products: {}
        }
    },
    mounted() {
        console.log('iFrame Montado');
        axios.get('/api/products/').then(resp => {
            this.first_products = resp.data.products.slice(0, 9);
            this.second_products = resp.data.products.slice(9);
            console.log(this.first_products);
            console.log(this.second_products);
        }).catch(error => {
            console.error(error);
        })
    },
    methods: {
        formatPrice(value) {
            let val = (value / 1);
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    }
}
</script>

<style>
.container {
    max-width: 650px;
}
.card-body {
    padding: 0.9rem;
}
.card-img-top {
    max-height: 150px;
    min-height: 150px;
    object-fit: cover;
}
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-image: none;
}

.carousel-control-next-icon:after
{
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\F054";
    font-size: 55px;
    color: red;
}
.carousel-control-prev-icon:after {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    content: "\F053";
    font-size: 55px;
    color: red;
}
</style>
