<div class="modal-body">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="update_id" value="{{ $nft->id }}">
    <div class="form-group">
        <label for="name" class="col-form-label">Name:</label>
        <input type="text" data-validation="required" name="name" class="form-control" id="name"
            value="{{ $nft->name }}">
    </div>
    <div class="form-group">
        <label for="category" class="col-form-label">Select Category:</label>
        <select name="category_id" data-validation="required"
            class="form-select shadow-none select2-hidden-accessible category_id" style="width: 100%; height: 36px">
            <option value="">Select</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $nft->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="subcategory" class="col-form-label">Select Sub Category:</label>
        <select name="sub_category_id" data-validation="required"
            class="form-select shadow-none select2-hidden-accessible subcategory" style="width: 100%; height: 36px">
            <option value="">Select</option>
            @foreach ($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}"
                    {{ $nft->sub_category_id == $subcategory->id ? 'selected' : '' }}>
                    {{ $subcategory->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="image" class="col-form-label">Image:</label>
        <input type="file" data-validation="mime" data-validation-allowing="jpg, png, jpeg , gif" name="image"
            class="form-control" id="image">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary submitBtn">Submit</button>
</div>
