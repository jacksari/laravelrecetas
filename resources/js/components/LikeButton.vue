<template>
    <div>
        <div class="row d-flex justify-content-center">
            <div class="col-4 d-flex justify-content-center align-content-center col-like">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center align-content-center">
                        <span class="like-btn" @click="likeReceta" :class="{ 'like-active' : isActive }"></span>
                    </div>
                    <div class="col-12 d-flex justify-content-center align-content-center">
                        <p v-if="totalLikes !== 0">{{ cantidadLikes }} Les gustó esta receta</p>
                        <p v-if="totalLikes === 0">Sin likes</p>
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-center align-content-center col-like">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center align-content-center">
                        <span class="clap-btn"></span>
                    </div>
                    <div class="col-12 d-flex justify-content-center align-content-center">
                        <!-- <p v-if="totalLikes !== 0">{{ cantidadLikes }} Les gustó esta receta</p>
                        <p v-if="totalLikes === 0">Sin likes</p> -->
                    </div>
                </div>
            </div>

 
        </div>
    </div>

</template>

<script>
export default {
    props: ['recetaId','like','likes'],
    mounted: function (){
        console.log('auth', this.authusuario);
    },
    data: function(){
        return {
            isActive: this.like,
            totalLikes: this.likes | 0,
        }
    },
    methods: {
        likeReceta(){
            axios.post('/recetas/'+this.recetaId)
                        .then(resp => {
                            if(resp.data.attached.length > 0){
                                this.$data.totalLikes++;
                            }else{
                                this.$data.totalLikes--;
                            }
                            this.isActive = !this.isActive;
                        })
                        .catch(error => {
                            if(error.response.status === 401){
                                window.location = '/register';
                            }
                        })
        }
    },
    computed: {
        cantidadLikes: function (){
            return this.totalLikes;
        }
    }
}
</script>