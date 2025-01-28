<div class="row">
    <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-3">
        <form method="get" class="d-flex justify-content-between align-items-center w-100 sorting">
            <label for="sort" class="me-2 mb-0">Сортировать по:</label>
            <select name="sort" id="sort" class="form-select w-75 w-sm-auto" onchange="this.form.submit()">
                @foreach($sortOptions as $value => $label)
                    <option value="{{ $value }}" {{ request('sort') === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
</div>
