
const charTr = `
    <tr>
        <td style="width:50px; text-align:center;" class="handle"> </td>
        <td style="width: calc(99% - 50px)">
            <input type="text" name="value[ru][]" class="form-control lang-area" id="field_ru">
        </td>
        <td style="width:1%">
            <a href="javascript:;" onclick="deleteLoadItem(this)" class="btn default btn-sm">
                <i class="fa fa-times"></i> Удалить
            </a>
        </td>
  </tr>
`;

const productPrice = ` 
    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text">Цена/Кол-во</span>
        </div>
        <input type="text" name="prices[price][]" placeholder="Цена руб" class="form-control number">
        <input type="text" name="prices[quantity][]" placeholder="Кол-во " class="form-control number">
        <a href="javascript:;" onclick="deleteLoadItem(this, '.input-group')" class="btn btn-danger btn-delete1 btn-sm">
            <i class="fa fa-times"></i>
        </a>
    </div>
`;

const checkboxSelf = `
    
        <input type="text" name="self_checkbox[]" class="form-control">
        <button class="btn btn-danger btn-sm"
                style="border-bottom-left-radius: 0; border-top-left-radius: 0;"
                type="button"
                onclick="deleteSelfCheckbox(this)">
            <i class="fa fa-times"></i>
        </button>
    
`;

$(document).ready(function () {
    if (typeof Ajax.sortItems == 'function') {
        Ajax.sortItems('.sort-chars');
    }
});

function deleteLoadItem(item, parent) {
    if(parent) {
        $(item).closest(parent).remove();
    } else {
        const parent = $(item).closest('tbody');
        $(item).closest('tr').remove();
        if ($(parent).find('tr').length <= 0) {
            $(parent).closest('table').hide();
        }
    }
}

function selectCharType(input) {
    if($(input).val() == 'input') {
        $('.add-chars-values-inner').hide();
    } else if($(input).val() != 'self_checkbox') {
        $('.add-chars-values-inner').show();
    }
}

function addChars() {
    $('#add-chars-table').show();
    $('#add-chars-table tbody').append(charTr);
    $('#add-chars-table .lang-area').not('#field_ru').hide();
    Ajax.sortItems('.sort-chars');
}

function addSelfCheckbox(id) {
    $div = $('<div/>', {
        'class': 'input-group self-checkbox-item'
    });
    $div.append(checkboxSelf);
    $div.find('input').attr('name', `char[self_checkbox][${id}][]`);
    $(`#self-checkbox-wrapper-${id}`).append($div);
}

function addProductPrice() {
    $('#product-prices').show();
    $('#product-prices').append(productPrice);
}

function deleteSelfCheckbox(item) {
    $(item).closest('.self-checkbox-item').remove();
}

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
                $.fancybox.close();
                Notify.setStatus('success').setMessage(jsonData.message);
                updateCartData(jsonData);
            }
        }
    });
}

function updateCartData({totalQty, totalPrice}) {
    htmlData('.cart-qty', totalQty);

    $('.total-amount').text(priceString(totalPrice))

    if (!totalQty) {
        hideItems('.cart-qty');
    } else {
        showItems('.cart-qty');
    }
}

function removeFromCart(item, id, cartId) {
    $.ajax({
        url: removeCartRoute,
        type: 'POST',
        data: {id: id, cartId: cartId, _token: CSRF_TOKEN},
        dataType: 'json',
        success: function(jsonData){
            if (jsonData.msg == false) {
                Notify.setStatus('danger').setMessage(jsonData.message);
            }else{
                if ($('.cart-table table tbody tr').length == 1) {
                    window.location.reload();
                } else {
                    updateCartData(jsonData);
                    $(item).closest('tr').remove();
                }
            }
        }
    });
}


function htmlData(item, value) {
    $(item).each(function () {
        $(this).html(value);
    });
}

function showItems(item) {
    $(item).each(function () {
        $(this).removeClass('d-none').addClass('d-flex');
    });
}

function hideItems(item) {
    $(item).each(function () {
        $(this).addClass('d-none').removeClass('d-flex');
    });
}

function changePriceByQty(input, id, cart_id = null) {
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
                    if (cart_id != null) {
                        $(input).closest('tr').find(`.product-price-${id}-${cart_id}`).text(`${RUB} ${priceString(jsonData.price)}`);
                    }
                }
            }
        }
    });
}

function changeCartQty(input, id, cart_id) {
    $.ajax({
        url: changeCartQtyRoute,
        type: 'POST',
        data: {qty: $(input).val(), cartId:cart_id, id: id, _token: CSRF_TOKEN},
        dataType: 'json',
        success: function(jsonData){
            if (jsonData.msg == false) {
                Notify.setStatus('danger').setMessage(jsonData.message);
            }else{
                if (jsonData.price) {
                    $(input).closest('tr').find(`.product-price-${id}-${cart_id}`).text(`${RUB} ${priceString(jsonData.price)}`);
                }
                updateCartData(jsonData);
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