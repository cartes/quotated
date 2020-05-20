<template>
    <div>
        <h2 class="text-center">Selecciona una opción en productos</h2>
        <div class="mt-3">
            <h3>Elige una opción</h3>
            <b-form-select id="childCategory" v-model="selected"
                           :options="catList"
                           :select-size="10"></b-form-select>
        </div>
        <div class="row">
            <div v-if="this.selected !== null" class="mt-3 offset-md-8 col-md-4">
                <button class="btn btn-primary btn-block" @click="emitCategory">Paso siguiente</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "childProductsForm",
        props: {
            id: {
                type: String,
                required: true,
            }
        },
        data() {
            return {
                catList: [],
                selected: null,
            }
        },
        mounted() {
            this.getChildrenCategories(this.id);
        },
        methods: {
            getChildrenCategories(id) {
                let url = "/product/category/" + id + "/children";
                axios.get(url)
                    .then(resp => {
                        if (resp.statusText == 'OK') {
                            resp.data.forEach((item, value) => {
                                this.catList.push({
                                    value: item.id, text: item.title
                                })
                            });
                        }
                    }).catch(error => {
                    console.log(error);
                })
            },
            emitCategory() {
                this.$emit('childCat', this.selected);
            }
        }
    }
</script>

<style scoped>
</style>