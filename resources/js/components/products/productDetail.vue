<template>
    <div>
        <b-carousel
            :id="title"
            controls
            indicators
            img-width="580"
            img-height="580"
        >
            <b-carousel-slide v-for="image in sliderImages" v-bind:key="image">
                <template #img>
                    <b-img block center thumbnail fluid width="580" height="580" :src="image"></b-img>
                </template>
            </b-carousel-slide>
        </b-carousel>
    </div>
</template>

<script>
export default {
    name: "productDetail",
    props: {
        productId: {
            type: Number,
            required: true,
        }
    },
    data() {
        return {
            sliderImages: [],
            id: null,
            title: '',
            seller: null,
        }
    },
    mounted() {
        this.id = this.productId;
        window.axios.get('/api/images/' + this.id)
            .then(resp => {
                this.title = resp.data.slug;

                let images = resp.data.images;
                for (const image in images) {
                    this.sliderImages.push('/storage/' + images[image].path);
                }
            })
            .catch(error => {
                console.error(error)
            })
    }
}
</script>

<style scoped>

</style>
