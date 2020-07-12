function addToCompare(item, id, hide = false) {

    const status = $(item).hasClass('active') ? false : true;

    const showQty = () => {
        $('.qty_compare').each(function () {
            $(this).removeClass('d-none').addClass('d-flex');
        });
    };

    const hideQty = () => {
        $('.qty_compare').each(function () {
            $(this).removeClass('d-flex').addClass('d-none');
        });
    };

    $.ajax({
        type: 'POST',
        headers: { "cache-control": "no-cache" },
        url: addToCompareUrl,
        async: true,
        cache: false,
        dataType : "json",
        data: {idProduct:id, _token: CSRF_TOKEN},
        success: function(jsonData){
            if (jsonData.msg == 'error') {
                Cart.alertError(jsonData.cause);
            }else{
                if($(item).hasClass('active')){
                    $(`.list-product-${id}`).each(function () {
                        $(this).find('.compare-icon').removeClass('active');
                    });
                }else{
                    $(`.list-product-${id}`).each(function () {
                        $(this).find('.compare-icon').addClass('active');
                    });
                    //showModal('#alert_modal', _add_compare);
                }
                $('.qty_compare').each(function () {
                    $(this).text(jsonData.totalCompare);
                });

                if(jsonData.totalCompare == 0){
                    hideQty();
                }else{
                    showQty();
                }

                if(hide == true){
                    $(item).closest('.compare_item').fadeOut();
                    location.reload();
                }
            }
        }
    });
}

function addToFav(item, id, canHide = false) {

    const status = $(item).hasClass('active') ? false : true;

    const showQty = () => {
        $('.qty_fav').each(function () {
            $(this).removeClass('d-none').addClass('d-flex');
        });
    };

    const hideQty = () => {
        $('.qty_fav').each(function () {
            $(this).removeClass('d-flex').addClass('d-none');
        });
    };

    $.ajax({
        type: 'POST',
        headers: { "cache-control": "no-cache" },
        url: addToFavUrl,
        async: true,
        cache: false,
        dataType : "json",
        data: {idProduct:id, _token: CSRF_TOKEN},
        success: function(jsonData){
            if (jsonData.msg == 'error') {
                Cart.alertError(jsonData.cause);
            }else{
                if($(item).hasClass('active')){
                    $(item).removeClass('active');
                    $(`.list-product-${id}`).each(function () {
                        $(this).find('.fav-icon').removeClass('active');
                    });
                }else{
                    $(item).addClass('active');
                    $(`.list-product-${id}`).each(function () {
                        $(this).find('.fav-icon').addClass('active');
                    });
                    //showModal('#alert_modal', _add_favorites);
                }

                $('.qty_fav').each(function () {
                    $(this).text(jsonData.totalFav);
                });

                if(jsonData.totalFav == 0){
                    hideQty()
                }else{
                    showQty();
                }

                if (canHide && status == false) {
                    $(item).closest('tr').fadeOut();

                    if (jsonData.totalFav == 0) {
                        window.location.reload();
                    }
                }
            }
        }
    });
}