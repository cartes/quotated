<template>
    <div class="mt-3">
        <section id="step-2">
            <div v-if="this.firstStep" class="row">
                <div class="col-12">
                    <h5>Seleccione una categoría</h5>
                </div>
            </div>
            <div v-if="this.firstStep" class="row">
                <div class="col-md-12 mt-4">
                    <div>
                        <b-form-select v-model="selected" :options="categories" :select-size="9"
                                       @change="setCategory($event)"></b-form-select>
                    </div>
                </div>
            </div>
            <div v-if="this.secondStep" class="row">
                <div class="col-md-12 mt-4">
                    <product-form :id="id" :catId="this.productSave.category" v-bind:is="currentForm"></product-form>
                </div>
            </div>
<!--            <div class="col-md-12 mt-4">
                <keep-alive>
                    <component :id="id" v-bind:is="currentCat" @childCat="setCategory"></component>
                </keep-alive>
            </div>-->
        </section>

<!--
        <section v-if="this.firstStep" id="formulario_producto">
            <div class="row">
                <div class="col-md-12">
                    <h4>
                        Ingrese los datos de su producto
                    </h4>
                    <b-form>
                        <b-form-group label="Titulo: ">
                            <b-form-input v-model="productSave.title" id="title"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Descripción: ">
                            <b-form-textarea v-model="productSave.description" id="description"></b-form-textarea>
                        </b-form-group>
                        <b-form-group label="Precio: ">
                            <b-form-input v-model="productSave.price" id="price" type="number"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Condición del producto: ">
                            <b-form-select :select="selected" v-model="productSave.condition"
                                           :options="selectCondition"></b-form-select>
                        </b-form-group>

                        <b-form-group label="Imagen del producto: ">
                            &lt;!&ndash; Plain mode &ndash;&gt;
                            <b-form-file v-model="productSave.file" class="mt-3" plain></b-form-file>
                            <div class="mt-3">Archivo Seleccionado: {{
                                    productSave.file ? productSave.file.name : ''
                                }}
                            </div>
                        </b-form-group>

                    </b-form>
                </div>
            </div>
        </section>
-->

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
                description: '',
                price: '',
                condition: null,
                file: null,
            },
            selected: null,
            categories: [],
            selectCondition: [
                {value: null, text: 'Selecciona una opción'},
                {value: 1, text: 'Nuevo'},
                {value: 2, text: 'Usado'},
            ],
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
                ],
            },
        }
    },
    mounted() {
        this.setSeller(this.sellerId);
        window.axios.get('/api/categories').then(resp => {

            for (var i = 0; i < resp.data.length; i++) {
                this.categories.push(
                    {value: resp.data[i].id, text: resp.data[i].title}
                );
            }
        })
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
        catagorySelected() {
            this.secondStep = false;
            this.firstStep = true;
        },
        selectedItem() {
            console.log(this.selected)
        },
        selectCat(id) {
            this.productSave.category = id;
            this.id = id;
            this.currentCat = "productGenericForm";
        },
        setCategory(cat) {
            console.log(cat);
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

º.select-product {
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
