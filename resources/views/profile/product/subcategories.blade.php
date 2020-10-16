@if($subcats->count())
    <div class="form-group cat-select select pb-2" data-depth="{{ $depth }}">
        <select name="id_category[]"
                class="product-form-control select"
                onchange="loadSubCategories(this, {{ $selected_id_category }})" >
            <option value="0">Выберите подкатегорию товара*</option>
            @foreach($subcats->toArray() as $category)
                <option {{ (find_key_value($category, 'id', $selected_id_category) || $category['id'] == $selected_id_category)  ? 'selected' : '' }} value="{{ $category['id'] }}">{{ $category['name_ru'] }}</option>
            @endforeach
        </select>
    </div>
@endif