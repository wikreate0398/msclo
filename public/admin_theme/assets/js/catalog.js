
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

$(document).ready(function () {
    Ajax.sortItems('.sort-chars');
});

function deleteLoadItem(item) {
    const parent = $(item).closest('tbody');
    $(item).closest('tr').remove();
    if ($(parent).find('tr').length <= 0) {
        $(parent).closest('table').hide();
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