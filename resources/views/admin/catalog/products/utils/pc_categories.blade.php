@function ( catOptions($categories, $depth=0, $selected_category = null) )
    @foreach ($categories as $item)

        @php
            if (!$item['parent_id']) {
               $depth = 0;
           }
        @endphp

        <option {{ ($selected_category == $item['id']) ? 'selected' : '' }} value="{{ $item['id'] }}" {{ ($item['parent_id'] && empty($item['childs'])) ? '' : 'disabled' }}>
            {{ sepByNum($depth) }}
            {{ $item['name_ru'] }}
        </option>

        @if(!empty($item['childs']))

            @catOptions($item['childs'], $depth+1, $selected_category)
        @endif
    @endforeach
@endfunction

<div class="form-group select pb-2">
    <select name="id_category" class="product-form-control select">
        <option value="0">Выберите категорию товара*</option>
        @catOptions(map_tree($categories->toArray()), 0, @$selected_category)
    </select>
</div>