
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

$(document).ready(function () {
    Ajax.sortItems('.sort-chars');
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
    } else {
        $('.add-chars-values-inner').show();
    }
}

function addChars() {
    $('#add-chars-table').show();
    $('#add-chars-table tbody').append(charTr);
    $('#add-chars-table .lang-area').not('#field_ru').hide();
    Ajax.sortItems('.sort-chars');
}

function addProductPrice() {
    $('#product-prices').show();
    $('#product-prices').append(productPrice);
}