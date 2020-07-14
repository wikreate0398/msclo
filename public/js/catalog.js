

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

                htmlData('.qty_compare', jsonData.totalCompare);

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

                htmlData('.qty_fav', jsonData.totalFav);

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

function showModalCart(item, id) {
    $.ajax({
        url: showModalCartRoute,
        type: 'GET',
        data: {id: id, _token: CSRF_TOKEN},
        success: function(content){
            $('#cart-popup .popup-content').html(content);
            $.fancybox.open({
                src: '#cart-popup'
            });
            $.HSCore.components.HSSelectPicker.init('.js-select');
            $.HSCore.components.HSQantityCounter.init('.js-quantity');
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
                htmlData('.cart-qty', jsonData.totalQty);
                $('.cart-qty').show();
            }
        }
    });
}

function htmlData(item, value) {
    $(item).each(function () {
        $(this).html(value);
    });
}

function changePriceByQty(input, id) {
    $.ajax({
        url: changePriceByQtyRoute,
        type: 'POST',
        data: {qty: $(input).val(), id: id, _token: CSRF_TOKEN},
        dataType: 'json',
        success: function(jsonData){
            if (jsonData.msg == false) {
                Notify.setStatus('danger').setMessage(jsonData.message);
            }else{
                if (jsonData.price) {
                    $(input).closest('form').find(`.product-price-${id}`).text(priceString(jsonData.price));
                }
            }
        }
    });
}

function number_format(e,n,t,i){e=(e+"").replace(/[^0-9+\-Ee.]/g,"");var r=isFinite(+e)?+e:0,a=isFinite(+n)?Math.abs(n):0,o="undefined"==typeof i?",":i,d="undefined"==typeof t?".":t,u="",f=function(e,n){var t=Math.pow(10,n);return""+(Math.round(e*t)/t).toFixed(n)};return u=(a?f(r,a):""+Math.round(r)).split("."),u[0].length>3&&(u[0]=u[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,o)),(u[1]||"").length<a&&(u[1]=u[1]||"",u[1]+=new Array(a-u[1].length+1).join("0")),u.join(d)}

function priceString(price, a){
    var a = a ? a : 0;
    if (!price) {
        return '0';
    }
    return number_format(price, a, '.', ' ');
}