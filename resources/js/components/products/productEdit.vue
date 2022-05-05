<template>
    <b-form class="form" enctype="multipart/form-data" @submit.prevent="onSubmit">
        <div class="row">
            <b-form-group
                class="col-md-4"
                id="condition-group"
                label="Estado del producto sass"
                label-for="condition">
                <b-form-select id="condition" v-model="form.condition" :options="optionsCondition">

                </b-form-select>
            </b-form-group>
        </div>
        <b-form-group
            id="title-group"
            label="Título"
            label-for="title"
            required
        >
            <b-form-input disabled type="text" v-model="form.title" id="title" required></b-form-input>
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

        <div class="row">
            <div class="col-12 col-md-12">
                <p class="text-danger">Dele click en la foto que desea elminar</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="images row">
                    <div @click="eraseImage(image.id, key)" class="col-3 image-edit" v-for="(image, key) in form.images" v-bind:key="image.id">
                        <b-card-img :src="'/storage/' + image.path" img-bottom>
                        </b-card-img>
                    </div>
                </div>

            </div>
        </div>

        <b-form-group
            id="files"
            label="Imágenes"
            v-if="showImages"
            label-for="files"
            :invalid-feedback="invalidFeedback"
            :valid-feedback="validFeedback"
            :state = "stateEdit"
            :description="'Puedes subir ' + cantImages + ' imágenes'"
        >
            <b-form-file v-model="form.files" :state="stateEdit" multiple accept="image/jpeg, image/png, image/gif"
                         placeholder="Selecione las imágenes o arrastrelas hasta este campo"
                         v-on:change="onImageChange"
            >

            </b-form-file>
        </b-form-group>

        <b-form-group v-if="images" id="preview">
            <div class="row">
                <div v-for="image in images" class="col-md-2">
                    <img class="w-100 h-auto" :src="image"/>
                </div>
            </div>
        </b-form-group>


        <b-form-group>
            <b-button :disabled="boton" type="submit" variant="primary">
                {{ isPosting ? 'Enviando...' : 'Enviar' }}
            </b-button>
        </b-form-group>
    </b-form>
</template>

<script>
export default {
    name: "productEdit",
    props: {
        id: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            cantImages: 5,
            form: {
                files: []
            },
            optionsCondition: [
                {value: null, text: 'Seleccione una opción'},
                {value: 1, text: 'Nuevo'},
                {value: 2, text: 'Usado'},
                {value: 3, text: 'Restaurado'}
            ],
            isPosting: false,
            images: [],
            boton: false,
            showImages: false,
        }
    },
    mounted() {
        window.axios.get('/api/product/detail/' + this.id).then(resp => {
            this.form = resp.data;
            let images = this.form.images.length;
            this.cantImages -= images;
            if(this.cantImages > 0) {
                this.showImages = true;
            }
        })
    },
    computed: {
        stateEdit() {
            if (this.form.files) {
                return this.form.files.length <= this.cantImages;
            }
        },
        invalidFeedback() {
            if(this.form.files) {
                if (this.form.files.length <= this.cantImages) {
                    this.boton = false;
                    return '';
                } else {
                    this.boton = true;
                    return 'No más de cinco archivos por favor (5)';
                }
            }
        },
        validFeedback() {
            return "Puedes subir hasta 5 fotos"
        },

    },
    methods: {

        eraseImage(id, key) {
            if (confirm('¿Desea eliminar la imagen? ' + id)) {
                axios.delete('/api/product/image/' + id)
                    .then(resp => {
                        this.form.images.splice(key, 1);
                        let images = this.form.images.length;
                        this.cantImages = 5 - images;
                        this.showImages = true;
                    })
            }
        },
        onSubmit() {
            this.isPosting = true;

            let formData = new FormData();
            formData.append('id', this.id);
            formData.append('title', this.form.title);
            formData.append('price', this.form.price);
            formData.append('condition', this.form.condition);
            formData.append('description', this.form.description);

            $.each(this.form.files, function (key, image) {
                formData.append(`picture[${key}]`, image);
            });

            axios.post("/api/product/update", formData, {
                headers: {
                    "x-csrf-token": document.head.querySelector("meta[name=csrf-token]").content
                }
            }).then(resp => {
                console.log(resp.data);
                if (resp.data.message == 'updated') {
                    window.location.href = '/posts/list';
                }
            })
        },
        onImageChange(e) {
            this.images = [];
            let files = e.target.files || e.dataTransfer.files;
            if (files.length <= this.cantImages) {
                for (let file of files) {
                    this.createImage(file);
                }
            }
        },
        createImage(file) {
            let reader = new FileReader();

            reader.onload = (e) => {
                this.images.push(e.target.result);
            };

            reader.readAsDataURL(file);
        }
    }
}
</script>

<style scoped>
    .image-edit {
        cursor: pointer;
        padding: 5px;
        border: 1px solid #999;
        margin-right: 10px;
        position: relative;
    }

    .image-edit:hover:after {
        content: ' ';
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        position: absolute;
        top: 0;
        left: 0;
        transition: all 300ms;
    }
</style>
