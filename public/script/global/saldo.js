var saldo = new Vue({
    el: '#saldo',
    data(){
        return {
            saldo: 0,
        }
    },
    mounted(){
        this.load()
    },
    methods: {
        load(){
            axios.get('/v1/transaction/saldo').
            then(
                response => {
                    this.saldo = new Intl.NumberFormat('id-ID').format(response.data)
                }
            )
        }
    }
});