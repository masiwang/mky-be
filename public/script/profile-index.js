// $("#datepicker").flatpickr();
var _token = document.querySelector("meta[name='_token']").getAttribute('content');
var profileIndex = new Vue({
    el: '#profileIndexContainer',
    data() {
        return {
            loading: true,
            user: '',
            transactions: [],
            saldo: 0
        }
    },
    mounted() {
        this.load()
        this.transaction()
        this.getSaldo()
    },
    methods: {
        load: function () {
            axios.get('/v1/user')
                .then(response => {
                    this.user = response.data
                })
                .finally(() => {
                    this.loading = false;
                })
        },
        transaction: function(){
            axios.get('/v1/transaction')
                .then(
                    response => response.data.map(
                            data => {
                                this.transactions.push(data)
                            }
                        )
                )
        },
        getSaldo(){
            axios.get('/v1/transaction/saldo')
            .then(response => {
                this.saldo = new Intl.NumberFormat('id-ID').format(response.data)
            })
        }
    }
})