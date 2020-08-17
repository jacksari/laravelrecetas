<template>
    <span v-text="formatearFecha"></span>
</template>

<script>
export default {
    props:['fecha'],
    computed: {
        formatearFecha(){
            if(this.fecha){
                return moment(this.fecha).locale('es').format('DD [de] MMM [del] YYYY');
            }else{
                return 'Sin fecha';
            }
        }
    },
}
</script>

<style>

</style>