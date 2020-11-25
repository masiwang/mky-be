var _token = document.querySelector("meta[name='_token']").getAttribute('content');
var fundProductsGet = new Vue({
    el: '#fund-product-container',
    data() {
        return {
            loading: true,
            products: [],
            page: 0,
            category: '',
            is_endpage: false
        }
    },
    mounted() {
        this.load()
    },
    methods: {
        load: function () {
            axios.get('/v1/fund', {
                    params: {
                        category: this.category,
                        page: this.page
                    }
                })
                .then(response => {
                    (response.data.length < 6) ? this.is_endpage = true: this.is_endpage = false;
                    response.data.map(data => this.products.push(data))
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
        }
    }
})
