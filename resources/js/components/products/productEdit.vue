<template>
    <b-form class="form"  @submit.prevent="onSubmit">
        <div class="row">
            <b-form-group
                class="col-md-4"
                id="condition-group"
                label="Estado del producto"
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

        <b-form-group>
            <b-button type="submit" variant="primary">
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
            form: [],
            optionsCondition: [
                {value: null, text: 'Seleccione una opción'},
                {value: 1, text: 'Nuevo'},
                {value: 2, text: 'Usado'},
                {value: 3, text: 'Restaurado'}
            ],
            isPosting: false,

        }
    },
    mounted() {
        window.axios.get('/api/product/detail/' + this.id).then(resp => {
            this.form = resp.data;
        })
    },
    methods: {
        onSubmit() {
            this.isPosting = true;

            let formData = new FormData();
            formData.append('id', this.id);
            formData.append('title', this.form.title);
            formData.append('price', this.form.price);
            formData.append('condition', this.form.condition);
            formData.append('description', this.form.description);

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
        }
    }
}
</script>

<style scoped>

</style>
