<template>
    <div class="mt-3">
        <section class="row" v-if="this.firstStep" id="step-1">
            <div class="col-md-3" v-for="cat in parentCategories.categories">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="select-product row" v-on:click="selectCat(cat.value)">
                                <div class="col-md-12">
                                    <p class="text-xl-center">
                                        <i :class="cat.iconClass" class="fa-5x py-3"></i>
                                    </p>
                                </div>
                                <div class="col-md-12 mt-4">
                                    {{ cat.text }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <keep-alive>
                    <component :id="id" v-bind:is="currentCat" @childCat="setCategory"></component>
                </keep-alive>
            </div>
        </section>
        <section v-if="this.secondStep" id="step-2">
            <div class="row">
                <div class="col-12">
                    <h5>Paso 2</h5>
                </div>
            </div>
            <div v-if="this.secondStep" class="row">
                <div class="col-md-12 mt-4">
                    <product-form :id="id" :catId="this.productSave.category" v-bind:is="currentForm"></product-form>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import childProductsForm from "./childProductsForm";
    import productGenericForm from "./productGenericForm";

    export default {
        name: "formProducts",
        props: {
            sellerId: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                productSave: {
                    category: null,
                    seller: null,
                    title: '',
                },
                currentCat: "blank",
                currentForm: "blankForm",
                firstStep: true,
                secondStep: false,
                id: '0',
                parentCategories: {
                    categories: [
                        {text: 'Productos', iconClass: 'fas fa-apple-alt', value: '1'},
                        {text: 'Vehículos', iconClass: 'fas fas fa-car-side', value: '2'},
                        {text: 'Inmuebles', iconClass: 'fas fa-igloo', value: '3'},
                        {text: 'Servicios', iconClass: 'fas fa-paint-roller', value: '4'},
                    ]
                },
            }
        },
        mounted() {
            this.setSeller(this.sellerId);
        },
        components: {
            blank: {
                template: "<div><h2 class='text-center'>Seleccione una Categoría</h2></div>"
            },
            blankForm: {
                template: "<div></div>"
            },
            childProductsForm,
            productGenericForm,
        },
        methods: {
            selectCat(id) {
                this.productSave.category = id;
                this.id = id;
                if (id == '1') {
                    this.currentCat = "childProductsForm";
                } else if (id == '2') {
                    this.currentCat = "blank";
                }
            },
            setCategory(cat) {
                this.productSave.category = cat;
                this.firstStep = !this.firstStep;
                this.secondStep = true;
                this.currentForm = "productGenericForm";
            },
            setSeller(seller) {
                this.productSave.seller = seller;
            }
        }
    }
</script>

<style scoped>
    i.fas {
        color: #3e2085;
    }

    .select-product {
        cursor: pointer;
    }

    .card {
        transition: all 300ms;
        box-shadow: 0px 2px 4px #d4d4d5;
    }

    .card:hover {
        box-shadow: 0px 8px 20px #d4d4d5;
    }

    .component-fade-active {
        transition: all 300ms;
    }
</style>