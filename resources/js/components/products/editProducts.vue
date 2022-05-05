<template>
    <section>
        <b-form class="form" enctype="multipart/form-data" @submit.prevent="onSubmit">
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
                <b-button type="submit" v-bind:disabled="this.boton" variant="primary">
                    {{ isPosting ? 'Enviando...' : 'Enviar' }}
                </b-button>
            </b-form-group>
        </b-form>
    </section>
</template>

<script>
export default {
    name: "editProducts",
    props: {
        productID: {
            type: Number,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
