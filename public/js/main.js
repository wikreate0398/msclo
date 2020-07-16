$(document).ready(function(){
    $(window).scroll(function(e){
        var body = e.target.body, scrollT = $(this).scrollTop(); 
        if (scrollT > 200) {
            $('.navbar').addClass('fixed-header');  
            $('.fixed-header').css({
                'top': "0",
                'opacity': '1'
            }); 
        }else{ 
            $('.navbar').removeClass('fixed-header');
        } 
    });

    $('[data-fancybox]').fancybox({
        buttons: ['close'],
    });

    $('.reg-btn-tabs button.active').click();

    $('.toggle-link').click(function(e){
        e.preventDefault(); 
        scrollToBlock($(this).attr('href')); 
    });

    //inputMask();

    changeByKeyup();

    $('.number').keypress(function(event) {
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });  

    // $('.rating-stars').each(function(){
    //     var currentRating = $(this).data('current-rating');
    //
    //     var itemRating = $(this);
    //     $(this).barrating({
    //         theme: 'fontawesome-stars-o',
    //         showSelectedRating: false,
    //         initialRating: parseFloat(currentRating),
    //         allowEmpty:true,
    //         deselectable:true,
    //         emptyValue: 0,
    //         onSelect:function(value, text, event){
    //             if($('.rating-comment').length){
    //                 $('.rating-comment').show();
    //             }
    //         }
    //     });
    //     var state = ($(this).attr('data-readonly') == 'true') ? true : false;
    //     $(this).barrating('readonly', state);
    // });

    $('.nav').find('a').on('shown.bs.tab', function () {
        fixHeight('.products-group-4-1-4');
    });
});

$(window).load(function () {
    initEqHeight();
});

function initEqHeight() {
    fixHeight('.products-group-4-1-4');
    fixHeight('.catalog-product');
}

function setEqualHeight(columns, parent) {
    if (!$(columns).length ) {
        return false;
    }
    if (parent) {
        var width       = $(parent).width();
        var item_width  = $(columns).closest('.js_list__item').outerWidth();
        var itemInRow = parseInt(width/item_width, 10);
    }else{
        var itemInRow = 3;
    }

    cloudHeight    = 0;
    var totalItems = $(columns).length
    if (totalItems < itemInRow) itemInRow = totalItems;

    $(columns).each(function(index){
        index=index+1;
        currentHeight = $(this).outerHeight();
        if(currentHeight > cloudHeight) {
            cloudHeight = currentHeight;
        }
        rest = 0;
        if (totalItems%itemInRow!=0) rest = totalItems%itemInRow;
        if (index%itemInRow==0) {
            for (var i = index - 1; i >= index-itemInRow; i--) {
                $(columns).eq(i).height(cloudHeight);
            }
            if ((totalItems-index-1) == rest) {
                for (var i = totalItems; i >=  totalItems-rest; i--) {
                    $(columns).eq(i).height(cloudHeight);
                }
            }
            cloudHeight=0;
        }
    });
    return;
}

function fixHeight(item) {
    $(item).height('auto');
    $(item).height($(item).height());
}

function scrollToBlock(id){
    $('html, body').animate({
        scrollTop: $(id).offset().top-75
    }, 1000);
}

function toggleBlocks(from, to){
    $(from).hide();
    $(to).show();
}
 
function inputMask(){
    $("input.code-mask").inputmask("999-9");
    $("input.price-mask, input.home-price-mask").inputmask("decimal",{
        alias: 'numeric',
        radixPoint:".", 
        groupSeparator: "", 
        digits: 2,
        autoGroup: true,
        allowMinus: false, 
        placeholder: '', 
    });
 
    $('#ExpiryDate').inputmask('99/99');
    $('#CreditCardNumber').inputmask('9999 9999 9999 9999');
    $('#SecurityCode').inputmask('999'); 
}

function changeByKeyup(){
    var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
      };
    })();
 
    $('body').find('.change_keyup').each(function(){ 
        var area = $(this);
        $(this).keyup(function() {
            delay(function(){  
                $(area).change()
            }, 200 );
        });
    }); 
} 

function changeRegType(btn, type){
    $('.reg-fields .form-group').each(function(){
        var access = $(this).attr('data-access');
        if (access != '*') { 
            if($.inArray(type, access.split('|')) == -1){
                $(this).hide();
            } else {
                $(this).show();
            }
        }
    });
}

function profilePhoto(fileName){

    var file = fileName.files[0];

    var reader = new FileReader();

    reader.readAsDataURL(file);

    var fileSize = parseInt(file["size"]) / 1000;
    var fileExtension = ["image/gif", "image/jpeg", "image/png", "image/jpg"];
    var fileType = file["type"];

    if (fileSize > 2048) {
        alert('Максимальный размер изображения 2МБ');
        return;
    }

    if (jQuery.inArray(fileType, fileExtension) == -1) {
        alert('Файл не неверного формата');
        return;
    }

    reader.onload = function (e) {
        $.fancybox.open({
            'src': '#profile-avatar'
        });

        $('.cropper__image_content').html('<img src="" id="image__crop">');
        var image = $('img#image__crop');

        $(image).attr('src', reader.result);
        $('input#avatar').val(reader.result);

        var image = document.getElementById('image__crop');
        var button = document.getElementById('crop__btn');

        var croppable = false;
        var cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
            ready: function () {
                croppable = true;
            }
        });

        button.onclick = function () {
            $('.cropper__section, #overlay').fadeOut(150);
            var croppedCanvas;
            var roundedCanvas;
            var roundedImage;

            if (!croppable) {
                return;
            }

            base64 = cropper.getCroppedCanvas().toDataURL();

            $('input#avatar').val(base64);
            $('.profile__img').css('background-image', 'url('+base64+')');
            $('.save__cropped_image').show();
            $('form.profile__image_form').submit();

            $.fancybox.close();
        };
    };
}
//
// function alertModal(text, status = 'success'){
//     $.fancybox.open({
//         src: '#alert_modal'
//     });
//     $('#alert_modal').removeClassPrefix('alert-').addClass('alert-' + status).find('p').html(text);
// }