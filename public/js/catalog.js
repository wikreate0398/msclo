

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
                Notify.setStatus('error').setMessage(jsonData.cause);
            }else{
                if($(item).hasClass('active')){
                    $(`.compare-icon-${id}`).each(function () {
                        $(this).removeClass('active');
                    });
                }else{
                    $(`.compare-icon-${id}`).each(function () {
                        $(this).addClass('active');
                    });
                    Notify.setStatus('success').setMessage('Товар успещно добавлен в сравнение');
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
                Notify.setStatus('error').setMessage(jsonData.cause);
            }else{
                if($(item).hasClass('active')){
                    $(item).removeClass('active');
                    $(`.fav-icon-${id}`).each(function () {
                        $(this).removeClass('active');
                    });
                }else{
                    $(item).addClass('active');
                    $(`.fav-icon-${id}`).each(function () {
                        $(this).addClass('active');
                    });
                    Notify.setStatus('success').setMessage('Товар успещно добавлен в избранное');
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

function addToCart(form) {
    $.ajax({
        url: $(form).attr('action'),
        type: 'POST',
        async: true,
        data: new FormData($(form)[0]),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function(jsonData){
            if (jsonData.msg == false) {
                Notify.setStatus('danger').setMessage(jsonData.message);
            }else{
                Notify.setStatus('success').setMessage(jsonData.message);
            }
        }
    });
}

function changeQty(input, id) {

}