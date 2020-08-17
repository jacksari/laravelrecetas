<template>
    <input type="submit" class="btn btn-danger btn-sm d-block w-100 mt-1" value="Eliminar" v-on:click="eliminarReceta">
</template>

<script>



export default {
    props: ['recetaId'],

    methods: {
        eliminarReceta(){
            // console.log('receta: ', this.recetaId);
            this.$swal({
                title: '¿Deseas eliminar la receta?',
                text: "Una vez eliminada, no es posible recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonColor: 'No'
                }).then((result) => {
                    if (result.value) {
                        const params = {
                            id: this.recetaId
                        }

                        axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'})
                                    .then(resp => {
                                        this.$swal({
                                            title: 'Receta eliminada',
                                            text: "Se eliminó la receta",
                                            icon: 'success',
                                        });

                                        this.$el.parentNode.parentNode.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode.parentNode.parentNode);

                                    })
                                    .catch(error => {
                                        console.log(error);
                                    })

                        
                    }
                })
        }
    }
}
</script>