var portofolio = new Vue({
    el: '#portofolio-container',
    data(){
        return{
            loading:true,
            portofolios: [],
            page: 0,
            is_endpage: false,
        }
    },
    mounted(){
        this.load()
    },
    methods:{
        load: function(){
            this.loading = true;
            axios.get('/v1/portofolio', {
                params: {
                    page: this.page
                }
            })
            .then(response => {
                (response.data.length < 6) ? this.is_endpage = true: this.is_endpage = false;
                response.data.map(data => this.portofolios.push(data))
                console.log(this.portofolios)
            })
            .finally(() => {
                this.loading = false;
                this.page = this.page + 1;
            })
        }
    }
});