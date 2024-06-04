<div class="modal-body">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="update_id" value="{{ $subCategory->id }}">
    <div class="form-group">
        <label for="category" class="col-form-label">Select Category:</label>
        <select name="category_id" data-validation="required" class="form-select shadow-none select2-hidden-accessible"
            style="width: 100%; height: 36px">
            <option value="">Select</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $subCategory->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="title" class="col-form-label">Title:</label>
        <input type="text" data-validation="required" name="title" value="{{ $subCategory->title }}"
            class="form-control" id="title">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary submitBtn">Submit</button>
</div>
