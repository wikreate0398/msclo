$(document).ready(function(){
    startMaskNewInput();

    fileUploader();
 
    $('a.confirm_link').on('click', function(e){  
        if (!confirm($(this).attr('data-confirm'))) {
            e.preventDefault();
        }
    });

    var ss = $(".basic-select2").select2();

    $('.multiSelect').multiSelect({
        selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Поиск'>",
        selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Поиск'>",
        afterInit: function(ms){
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function(e){
                    if (e.which === 40){
                        that.$selectableUl.focus();
                        return false;
                    }
                });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function(e){
                    if (e.which == 40){
                        that.$selectionUl.focus();
                        return false;
                    }
                });
        },
        afterSelect: function(){
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function(){
            this.qs1.cache();
            this.qs2.cache();
        }
    });

    $(document).find('table.eq-table-cell').each(function(){   
        //console.log($(table).find('thead tr th').length);
        var table = $(this);
        $(table).find('thead tr th').css('width', (100/$(table).find('thead tr th').length) + '%');
        $(table).find('tbody tr td').css('width', (100/$(table).find('thead tr th').length) + '%'); 
    });
    
    $('.open-area-btn').unbind();
    $('.open-area-btn').on('click', function(e){ 
        e.preventDefault();
        $($(this).attr('href')).slideToggle();
    });

    if ($('.ck-editor').length) {
        $('.ck-editor').each(function (i) {
            i++;
            let idEditor   = `editor-${i}`;
            let idToolbar  = `toolbar-container-${i}`;
            let idTextarea = 'textarea-' + idEditor;
            $(this).find('textarea').attr('id', idTextarea);

            if (!$('#' + idEditor).length) {
                $(this).find('.editor').attr('id', idEditor);
                $(this).find('.toolbar-container').attr('id', idToolbar);
                createEditor(idEditor, idToolbar, idTextarea);
                $('.modal').modal( {
                    focus: false,
                    show: false
                } );
            }
        });
    }

    function createEditor(idEditor, idToolbar, idTextarea) {
        return DecoupledEditor
            .create( document.getElementById( idEditor ) )
            .then( editor => {
                const toolbarContainer = document.getElementById( idToolbar );
                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                editors[ idEditor ] = editor;
                editor.setData($('#' + idTextarea).val());
            })
            .catch( error => {
            });
    }

    // if (jQuery().datepicker) {
    //     $('.deadline-picker').datepicker({
    //         rtl: Metronic.isRTL(),
    //         orientation: "left",
    //         autoclose: true,
    //         weekStart: 1,
    //         language: 'ru-RU',
    //         startDate: new Date(),
    //     });
    // }

    $('#change-content a').click(function(){
        $('#change-content a').removeClass('active');
        $(this).addClass('active'); 
        var lang = $(this).attr('data-lang');
 
        //$('form').find('.lang-area').hide();

        $('form').find('.lang-area').each(function(){
            var id = $(this).attr('id');
            if (id !== 'field_'+lang) {
                $(this).hide();
            } else{
                $(this).show();   
            }

            if ($(this).hasClass('field_'+lang)) {
                $(this).show();
            }else{
                $(this).hide();
            }
        }); 
        //$('form').find('#field_'+lang).show();
    }); 
    $('#change-content a:first-child').click();

    // $('.fancybox-button').fancybox();
    // $('.fancybox').fancybox();
    // initSelect2();
    $('.number').keypress(function(event) {
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $("textarea[maxlength]").each(function(){
        $(this).next('.maxlength__label').find('span').text(this.value.length);
    });

    $('#add-new-groupvalues').click(function(){
        $('#group-values table tbody').append($('#addition-geoup-values').html());
    });
      
    $("textarea[maxlength]").on("propertychange input", function() {
        if (this.value.length > this.maxlength) {
            this.value = this.value.substring(0, this.maxlength);
        }  

        $("textarea[maxlength]").next('.maxlength__label').find('span').text(this.value.length);
    });

    // $( ".datepicker" ).datepicker({
    //     dateFormat: "dd-mm-yy",
    //     changeMonth: true,
    //     changeYear: true,
    //     yearRange: '1945:'+(new Date).getFullYear()
    // });

    $('[data-toggle="tooltip"]').tooltip();

    $('input.select_type').change(function(){
        var val              = $(this).val(); 
        var charBlock        = $('#char-display'); 
        if (val=='checkbox') { 
            $(charBlock).show();  
        $('.unit__edit').hide();
        }else if(val=='default'){  
            $(charBlock).hide(); 
            $('.unit__edit').show();
        }
    }); 

    var i = 1;
    $('#tags_1:hidden, #tags_1:visible').each(function() {
        $(this).attr('id', 'tags_1_' + i);
        $('#tags_1_' + i).tagsInput({
           width: 'auto',
           defaultText:'',
           minChars:0,
           'onAddTag': function () { 
           },
       });  
       i = i + 1;
    });
});

function initSelect2(){
    //// $('.select2').select2('destroy');
    $('.select2').each(function(){
        if ($(this).hasClass('select2-hidden-accessible')) {
            $(this).select2('destroy');
        }
        $(this).select2();
    });  
}

function startMaskNewInput(){
    $('.rp').each(function(i){
       $(this).attr('id', 'mask_'+i);
       $("#mask_"+i).inputmask("decimal",{
        alias: 'numeric',
        radixPoint:".", 
            groupSeparator: " ", 
            digits: 2,
            autoGroup: true,
            allowMinus: false 

        });
    });
} 

jQuery(document).ready(function($) {

    var classBlocks = ['.work_experience_container', '.teach_activity_container'];

    $.each(classBlocks, function(k,v){
        var disabledCheckbox  = $(v).closest('.panel').find('input.disable_block'); 
        var disabled          = true;
        if ($(disabledCheckbox).prop('checked') == true) {
            disabled = false;
        } 

        $(v).find('input,select,textarea').not(disabledCheckbox).attr('disabled', disabled); 
        $(v).closest('.panel').find('button.add__more').attr('disabled', disabled); 
    }); 

}); 
function disableBlock(checkbox){ 
    if ($(checkbox).prop('checked') == true) {
        $(checkbox).closest('.panel').find('input,select,textarea').not(checkbox).attr('disabled', false); 
        $(checkbox).closest('.panel').find('button.add__more').attr('disabled', false); 
    }else{
        $(checkbox).closest('.panel').find('input,select,textarea').not(checkbox).attr('disabled', true); 
        $(checkbox).closest('.panel').find('button.add__more').attr('disabled', true); 
    } 
}

function addBlock(blockClass) {
    var first_block = $('.' + blockClass + '.first_block');
    var cloneBlock = $(first_block).clone();
    $(cloneBlock).removeClass('first_block');
    $(cloneBlock).removeClass('error__input');
     
    $(cloneBlock).append('<div class="close__item" onclick="deleteBlock(this);">X</div>');
    $(cloneBlock).find('input').val('');
    $(cloneBlock).find('textarea').val(''); 
    $(cloneBlock).find('select option').prop('selected', false);
    $(cloneBlock).find('select option:first').prop('selected', true);
    $(cloneBlock).find('input.id__block').remove();

    $(cloneBlock).find('select').each(function(){
        $(this).attr('name', $(this).attr('name').replace('edit_', ''))
    });

    $(cloneBlock).find('input').each(function(){
        $(this).attr('name', $(this).attr('name').replace('edit_', ''))
    });

    $(cloneBlock).find('textarea').each(function(){
        $(this).attr('name', $(this).attr('name').replace('edit_', ''))
    }); 
  
    $(cloneBlock).insertAfter('.' + blockClass + ':last');
}

function deleteBlock(item){
    $(item).closest('.row').remove();
}

function institutionCheck(input){
    if ($(input).prop('checked') == true) {
        $('.parent_institution').show();
    }else{
        $('.parent_institution').hide();
    }
}

/* Teacher Subjects */

function teacherSubject(select){
    var value = $(select).val();
    if (value <= 0) return;
    var name  = $(select).find('option[value="'+value+'"]').text(); 
    $(select).find('option[value="'+value+'"]').attr('disabled',true);
    var input = '<input type="hidden" id="teacher_subjects_input_'+value+'" value="'+value+'" name="teacher_subjects[]">';
    $('.selected__teacher_inputs').append(input);
    var tagLabel = '<span data-id="'+value+'" id="teacher_subjects_'+value+'">'+
                   '<div class="subject_tag">'+name+'</div>'+
                   '<div class="delete__subject" onclick="deleteTeacherSubject('+value+');"><i class="fa fa-times" aria-hidden="true"></i></div></span>';
    $('.selected__teacher_subjects').append(tagLabel);
    $('.selected__teacher_subjects').show();
}

function deleteTeacherSubject(id){
    var span = $('span#teacher_subjects_' + id);
    var name = $(span).find('.subject_tag').text(); 
    var id = $(span).attr('data-id'); 
    $('select.teacher_subjects_select option[value="'+id+'"]').attr('disabled',false);
    $('input#teacher_subjects_input_' + id).remove();
    $('span#teacher_subjects_' + id).remove();

    if ($('.selected__teacher_subjects span').length <= 0) {
        $('.selected__teacher_subjects').hide();

        $('select.teacher_subjects_select option[selected="selected"]').each(
            function() {
                $(this).removeAttr('selected');
            }
        );

        $('select.teacher_subjects_select option:first').attr('selected',true);
    }
}

/* Edit profile upload image */
function multipleImages(input, uploaderContainter){
    if (input.files && input.files[0]) {
        $(input.files).each(function(i) { 
            var fileExtension = ["image/gif", "image/jpeg", "image/png", "image/jpg"];
            var fileType = this["type"];
            var fileName = this["name"];
            var fileSize = parseInt(this["size"]) / 1000;
 
            if (jQuery.inArray(fileType, fileExtension) == -1) {
                alert('Ошибка в расширении файла!');
                return;
            }  

            if (fileSize > 2048) {
                alert('Максимальный размер изображения 2МБ');
                return;
            }

            var reader = new FileReader();
            reader.readAsDataURL(this);

            reader.onload = function(e) { 
                
                $(uploaderContainter).show();
                var content = "<div class='col-md-3 load-thumbnail'>"+ 
                              "<div class='uploadedImg' style='background-image:url("+reader.result+")'></div>"+
                              "<div class='actions__upload_img'>"+
                              "<span onclick='deleteUploadImg(this)' class='delete__upload_img'></span> "+
                              "</div>"+
                              "<input type='hidden' name='certificates[]' value='"+reader.result+"'>"+
                              "</div>";
                $('.uploaderContainter .col-md-offset-4').removeClass('col-md-offset-4')             
                $(uploaderContainter).prepend(content);
            } 
        }); 
    } 
}

function deleteUploadImg(item, id, id_user){
    if (!confirm('Вы действительно хотите удалить?')) {
        return false;
    }
    $(item).closest('.load-thumbnail').fadeOut(150, function(){
        $(this).closest('.load-thumbnail').remove();
    });
      
    if (id) {
        $.ajax({
            url: '/admin/users/teachers/deleteCertificate',
            type: 'POST', 
            data: {'id':id, 'id_user':id_user, _token: CSRF_TOKEN}, 
            dataType: 'json',
            beforeSend: function() {},
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                if (XMLHttpRequest.status === 401) document.location.reload(true);
            },
            success: function(jsonResponse, textStatus, request) {},
            complete: function() { }
        });
    }
} 

function removeItemBlock(item) {
    if ($(item).closest('tbody').find('tr').length > 1) {
        $(item).closest('tr').remove();
    } 
}

function uploadDocuments(input) {

    var input_name = 'project_documents';

    if (input.files && input.files[0]) {

        $(input.files).each(function(i) {
            var fileName = this["name"];
            var content = $(input).closest('.form-group').find('.documents_table');

            var reader = new FileReader();
            reader.readAsDataURL(this);

            reader.onload = function(e) {
                content.show();
                var item = $('#documents-item').html();
                $(content).find("tbody").append(item);
                $(content).find("tbody tr:last").find('.document_filename').html(
                    fileName +
                    ' <input type="hidden" id="hidden_related" name="' + input_name + '[]" value="' + reader.result + '">'
                );

                $(content).closest('table').show();
            }
        });
    }
}

function deleteLoadDocument(item) {

    if (!confirm('Вы действительно хотите удалить?')) {
        return false;
    }

    var parent = $(item).closest('tbody');
    $(item).closest('tr').remove();
    if ($(parent).find('tr').length <= 0) {
        $(parent).closest('table').hide();
    }
}

function mydiff(date1,date2,interval) {
    var second=1000, minute=second*60, hour=minute*60, day=hour*24, week=day*7;
    date1 = new Date(date1);
    date2 = new Date(date2);
    var timediff = date2 - date1;
    if (isNaN(timediff)) return NaN;
    switch (interval) {
        case "years": return date2.getFullYear() - date1.getFullYear();
        case "months": return (
            ( date2.getFullYear() * 12 + date2.getMonth() )
            -
            ( date1.getFullYear() * 12 + date1.getMonth() )
        );
        case "weeks"  : return Math.floor(timediff / week);
        case "days"   : return Math.floor(timediff / day); 
        case "hours"  : return Math.floor(timediff / hour); 
        case "minutes": return Math.floor(timediff / minute);
        case "seconds": return Math.floor(timediff / second);
        default: return undefined;
    }
}

function number_format(e,n,t,i){e=(e+"").replace(/[^0-9+\-Ee.]/g,"");var r=isFinite(+e)?+e:0,a=isFinite(+n)?Math.abs(n):0,o="undefined"==typeof i?",":i,d="undefined"==typeof t?".":t,u="",f=function(e,n){var t=Math.pow(10,n);return""+(Math.round(e*t)/t).toFixed(n)};return u=(a?f(r,a):""+Math.round(r)).split("."),u[0].length>3&&(u[0]=u[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,o)),(u[1]||"").length<a&&(u[1]=u[1]||"",u[1]+=new Array(a-u[1].length+1).join("0")),u.join(d)}

function priceString(price, a){ 
    var a = a ? a : 2;
    if (!price) {
        return '0';
    } 
    return number_format(price, a, '.', ' ');
} 

function selectUserType(select){
    $('.institution_name').hide();  
    $('.usr_pass').hide();
    if ($(select).val() == 'admin') { 
        $('.institution_name').show(); 
    } 

    $('.usr_pass').show();
}

function fileUploader(){
    if($('input.file_uploader_input').length){

        $('input.file_uploader_input').each(function(){
            //console.log(jQuery.parseJSON(JSON.stringify($(this).data('fileuploader-files'))));
            if(!$(this).closest('.fileuploader').length){
                $(this).fileuploader({
                    extensions: ['image/*'],
                    addMore: true,
                    limit: 5,
                    maxSize:2,
                    enableApi: true,
                    captions: {
                        button: function(options) { return 'Выбрать ' + (options.limit == 1 ? 'file' : 'файлы');},
                        removeConfirmation: 'Подтвердить удаление',
                        feedback: 'Выберите файлы',
                        errors: {
                            filesLimit: 'Вы можете загрузить не более ${limit} файлов.',
                            filesType: 'Вы можете загрузить файлы формата jpg,jpeg,png',
                            fileSize: '${name} is too large! Please choose a file up to ${fileMaxSize}MB.',
                        }
                    },
                    onRemove: function(item, listEl, parentEl, newInputEl, inputEl) {
                        if (!$(inputEl).attr('data-json')) return;
                        var data = JSON.parse($(inputEl).attr('data-json'));
                        jQuery.ajax({
                            url: '/'+ajaxPath+'/deleteImageByField',
                            type: 'POST',
                            data: {
                                table: data.table,
                                field: data.field,
                                value: item.name,
                                _token: CSRF_TOKEN
                            },
                            headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                            dataType: 'json',
                            beforeSend: function() {},
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                if (XMLHttpRequest.status === 401) document.location.reload(true);
                            },
                        });
                    },
                });
            }
        });
    }
}
