var container = $('#market-product-container');
var category_container = $('#category-container');
var page = $('input[name="market_page"]');
var category = $('input[name="category"]');
var btnMore = $('#market_more');
var btnCat = $('.action-category');

function loading() {
    container.html('');
    var html = '';
    for (let index = 0; index < 6; index++) {
        html += `<div class="col-6 col-md-2 p-2">
                <div class="card card-product h-100 shadow-sm bg-secondary">
                    <div style="height: 160px" class="d-flex justify-content-center align-items-center">
                        <img src="/image/assets/loading.gif" alt="" width="80px">
                    </div>
                    <div class="card-body p-2 d-flex flex-column">
                        <p class="product-title align-self-stretch w-100 bg-white" style="max-height: 44px; overflow: hidden; font-size: .9rem;">
                            <a href="#" class="text-decoration-none">
                                &nbsp;
                            </a>
                        </p>
                        <p class="card-text mb-1 text-success bg-white">&nbsp;</p>
                        <hr>
                        <div class="mb-1 d-flex justify-content-between">
                            <p class="mb-0 btn btn-white w-100 bg-white">
                                &nbsp;
                            </p>
                            <p class="mb-0 btn btn-white w-100 bg-white">
                                &nbsp;
                            </p>
                        </div>
                    </div>
                </div>
            </div>`
    }
    container.html(html);
}

function started(category) {
    loading();
    page.val(1);
    $.ajax({
        type: "get",
        url: "/api/market/product/" + page.val(),
        data: {
            'category': category
        },
        dataType: "json",
        success: function (response) {
            var html = '';
            page.val(parseInt(page.val()) + 1);
            response.map(e => (html +=
                `<div class="col-6 col-md-2 p-2">
                        <div class="card card-product h-100 shadow-sm">
                            <div class="card-product__image-container" style="overflow: hidden">
                                <img src="${e.image}" alt="Avatar" class="card-img-top" style="width: 100%;">
                            </div>
                            <div class="card-body p-2 d-flex flex-column">
                                <p class="product-title align-self-stretch" style="max-height: 44px; overflow: hidden; font-size: .9rem;">
                                    <a href="market/${e.category}/${e.slug}" class="text-decoration-none">${e.name}</a>
                                </p>
                                <p class="card-text mb-1 text-success"><strong>Rp.${e.price}</strong></p>
                                <hr>
                                <div class="mb-1 d-flex justify-content-between">
                                        <button data-product="${e.slug}" data-like="${e.wishlist_id}" class="btn btn-white text-danger w-100 btn-sm btn-action-like">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                            </svg>
                                        </button>
                                        <a href="/market/${e.category}/${e.slug}" class="btn btn-white text-success w-100 btn-sm">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                                <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                                            </svg>
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>`
            ));
            container.html(html);
        }
    });
}

function append(category) {
    $.ajax({
        type: "get",
        url: "/api/market/product/" + page.val(),
        data: {
            'category': category
        },
        dataType: "json",
        success: function (response) {
            var html = container.html();
            console.log(page);
            page.val(parseInt(page.val()) + 1);
            response.map(e => (html +=
                `<div class="col-6 col-md-2 p-2">
                        <div class="card card-product h-100 shadow-sm">
                            <div class="card-product__image-container" style="overflow: hidden">
                                <img src="${e.image}" alt="Avatar" class="card-img-top" style="width: 100%;">
                            </div>
                            <div class="card-body p-2 d-flex flex-column">
                                <p class="product-title align-self-stretch" style="max-height: 44px; overflow: hidden; font-size: .9rem;">
                                    <a href="market/${e.category}/${e.slug}" class="text-decoration-none">${e.name}</a>
                                </p>
                                <p class="card-text mb-1 text-success"><strong>Rp.${e.price}</strong></p>
                                <hr>
                                <div class="mb-1 d-flex justify-content-between">
                                        <button data-product="${e.slug}" data-like="${e.wishlist_id}" class="btn btn-white text-danger w-100 btn-sm btn-action-like">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                            </svg>
                                        </button>
                                        <a href="/market/${e.category}/${e.slug}" class="btn btn-white text-success w-100 btn-sm">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                                <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                                            </svg>
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>`
            ));
            container.html(html);
            btnMore.html('Muat lebih banyak');
        }
    });
}
$().ready(function () {
    started(0);
});
btnMore.on('click', function () {
    btnMore.html('loading...');
    append(category.val());
});
btnCat.click(function () {
    var category_val = $(this).attr('data-category');
    var category_name = $(this).attr('data-name');
    category.val(category_val);
    category_container.html(category_name);
    started(category_val);
});
