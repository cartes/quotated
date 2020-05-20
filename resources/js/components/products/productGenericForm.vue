<template>
    <div>
        <h2>Agregar producto a {{this.catTitle}}</h2>

        <b-form class="form" @submit.prevent="onSubmit">
            <div class="row">
                <b-form-group
                        class="col-md-4"
                        id="condition-group"
                        label="Estado del producto"
                        label-for="condition">
                    <b-form-select id="condition" v-model="form.condition" :options="optionsCondition"></b-form-select>
                </b-form-group>
            </div>
            <b-form-group
                    id="title-group"
                    label="Título"
                    label-for="title"
                    required
            >
                <b-form-input type="text" v-model="form.title" id="title" required></b-form-input>
            </b-form-group>
            <b-form-group
                    id="description-group"
                    label="Descripción"
                    label-for="description"
                    required
            >
                <b-form-textarea id="description" v-model="form.description"
                                 placeholder="Ingrese una descripción del producto"
                                 rows="10" max-rows="15" required></b-form-textarea>
            </b-form-group>
            <div class="row">
                <b-form-group
                        id="price-group"
                        label="Precio"
                        label-for="price"
                        class="col-md-4"
                        required
                >
                    <b-form-input type="number" v-model="form.price" id="price" required></b-form-input>
                </b-form-group>
            </div>
            <b-form-group
                    id="files-group"
                    label="Imágenes"
                    :invalid-feedback="invalidFeedback"
                    :valid-feedback="validFeedback"
                    :state="state"
                    label-for="files"
                    description="Los avisos con imágenes siempre tienen más visitas"
            >
                <b-form-file v-model="form.files" :state="state" multiple accept="image/jpeg, image/png, image/gif"
                             placeholder="Seleccione una o varias imágenes o arrastrelas a esta ventana"
                             v-on:change="onImageChange"
                ></b-form-file>
            </b-form-group>

            <b-form-group v-if="images">
                <div class="row">
                    <div v-for="image in images" class="col-md-2">
                        <img class="w-100 h-auto" :src="image"/>
                    </div>
                </div>
            </b-form-group>

            <b-form-group>
                <b-button type="submit" v-bind:disabled="this.boton" variant="primary">Enviar</b-button>
            </b-form-group>
        </b-form>
    </div>
</template>

<script>
    export default {
        name: "productGenericForm",
        props: {
            catId: {
                type: Number,
                required: true
            },
        },
        computed: {
            state() {
                return this.form.files.length > 5 ? false : true;
            },
            invalidFeedback() {
                if (this.form.files.length <= 5) {
                    this.boton = false;
                    return '';
                } else {
                    this.boton = true;
                    return 'No más de cinco archivos por favor (5)';
                }
            },
            validFeedback() {
                return "Puedes subir hasta 5 fotos"
            },
        },
        data() {
            return {
                form: {
                    title: '',
                    description: '',
                    price: '',
                    condition: null,
                    files: [],
                },
                optionsCondition: [
                    {value: null, text: 'Seleccione una opción'},
                    {value: 1, text: 'Nuevo'},
                    {value: 2, text: 'Usado'},
                    {value: 3, text: 'Restaurado'}
                ],
                catTitle: '',
                boton: false,
                images: [],
            }
        },
        mounted() {
            this.getCatName();
        },
        methods: {
            getCatName() {
                let url = "/product/category/" + this.catId + "/name";
                axios.get(url).then(res => {
                    this.catTitle = res.data.title;
                });
            },
            onSubmit() {
                console.log(this.images);
            },
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                for (let file of files) {
                    this.createImage(file);
                }
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;

                reader.onload = (e) => {
                    vm.images.push(e.target.result);
                };

                reader.readAsDataURL(file);
            }
        }
    }
</script>

<style scoped>
    .custom-file-input ~ .custom-file-label::after {
        content: 'Elegir' !important;
    }
</style>