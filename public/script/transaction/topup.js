var root = new Vue({
    el: '#root',
    data(){
        return{
            loading: false,
            bank: '',
            acc: '',
            nominal: '',
            image: ''
        }
    },
    methods: {
        onFileChange(e){
            this.image = e.target.files[0];
        },
        submitForm(e){
            e.preventDefault();
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="_token"]').content,
                }
            }
            let formData = new FormData;
            formData.append('bank_type', this.bank)
            formData.append('bank_acc', this.acc)
            formData.append('nominal', this.nominal)
            formData.append('image', this.image)
            axios.post('/v1/transaction/topup', formData, config)
            .then(
                response => {
                    if(response.status == 200){
                        window.location.replace('/transaction')
                    }
                }
            )
        }
    }
});