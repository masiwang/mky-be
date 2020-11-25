var root = new Vue({
    el:'#root',
    data(){
        return{
            loading: true,
            transactions: [],
            page: 0
        }
    },
    mounted(){
        this.load()
    },
    methods: {
        load: function(){
            this.loading = true
            axios.get('/v1/transaction')
            .then(response => {
                response.data.map(
                    data => {
                        this.transactions.push(data) 
                    }
                )
            })
            .finally(
                () => {
                    this.loading = false
                    console.log(this.transactions)
                }
            )
        }
    }
})