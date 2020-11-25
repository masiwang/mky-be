var _token = document.querySelector("meta[name='_token']").getAttribute('content');
var fundProductGet = new Vue({
    el: '#fund-product-container',
    data(){
        return {
            page: 0,
            loading: true,
            products: [],
            is_endpage: false
        }
    },
    mounted(){
        this.load()
    },
    methods: {
        load: function(){
            axios.get('/v1/fund', {
                params: {
                    category: this.category,
                    page: this.page
                }
            })
            .then(response => {
                (response.data.length < 6 ) ? this.is_endpage = true : this.is_endpage = false;
                response.data.map(data => this.products.push(data))
            })
            .finally(() => {
                this.loading = false;
                this.page = this.page + 1
            })
        }
    }
});