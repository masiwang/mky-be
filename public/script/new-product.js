// fetch new product
async function submit() {
    var data = {
        'name': $('#name').val(),
        'description': $('#description').summernote('code'),
        'simulation': $('#simulation').summernote('code'),
        'risk_analysis': $('#risk_analysis').summernote('code'),
        'category_id': $('#category_id').val(),
        'price': $('#price').val(),
        'stock': $('#stock').val(),
        'return': $('#return').val(),
        'opened_at': $('#opened_at').val(),
        'closed_at': $('#closed_at').val(),
        'started_at': $('#started_at').val(),
        'ended_at': $('#ended_at').val(),
        'image': document.querySelector('#image').files[0],
        '_token': $('meta[name="_token"]').attr('content')
    }
    let response = await fetch('/basecamp/fund/product/new', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    });
    console.log(response);
}
$('#submitBtn').on('click', function(){
    submit();
});