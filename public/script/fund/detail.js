var _token = document.querySelector("meta[name='_token']").getAttribute('content');
var fundProductGet = new Vue({
    el: '#fund-product-detail-container',
    data() {
        return {
            loading: true,
            product: '',
            qty: '',
            qtyAlert: false,
            fundWait: false,
            saldo: 0
        }
    },
    mounted() {
        this.load()
        this.getSaldo()
    },
    methods: {
        load: function () {
            axios.get('/v1/fund/'+window.location.pathname.split('/')[3])
                .then(response => {
                    this.product = response.data
                })
                .finally(() => {
                    this.loading = false;
                    this.page = this.page + 1
                })
        },
        more: function () {
            this.loading = true
            this.load()
        },
        setCategory: function (category) {
            this.loading = true
            this.category = category
            this.page = 0
            this.products = []
            this.load()
        },
        fund(){
            this.fundWait = true;
            axios.post('/v1/portofolio', {
                _token: _token,
                product: this.product.slug,
                qty: this.qty,
            })
              .then(function (response) {
                window.location.replace('/portofolio/'+response.data.invoice);
              })
              .catch(function (error) {
                console.log(error);
              });
        },
        getSaldo(){
            axios.get('/v1/transaction/saldo')
            .then(response =>{
                this.saldo = response.data
            })
        }
    },
    computed: {
        qtyConstraint: function(){
            let qty = this.qty;
            if(this.qty <= this.product.stock){
                qty = this.qty;
                this.qtyAlert = false;
            }else{
                qty = this.product.stock;
                this.qtyAlert = true;
            }
            return qty
        },
        priceEstimation: function(){
            return this.qtyConstraint*this.product.price
        },
        returnEstimation: function(){
            if(this.product.return){
                var low = new Intl.NumberFormat('id-ID').format((1+(this.product.return.split('-')[0]/100))*this.qtyConstraint*this.product.price)
                var high = new Intl.NumberFormat('id-ID').format((1+(this.product.return.split('-')[1]/100))*this.qtyConstraint*this.product.price)
                return low+' s/d Rp.'+high;
            }
        },
        thereIsSaldo(){
            if(this.saldo >= this.priceEstimation){
                return true
            }else{
                return false
            }
        }
    }
})
