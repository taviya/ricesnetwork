<div class="modal-body">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="update_id" value="{{ $category->id }}">
    <div class="form-group">
        <label for="title" class="col-form-label">Title:</label>
        <input type="text" data-validation="required" name="title" value="{{ $category->title }}" class="form-control" id="title">
    </div>
    <div class="form-group">
        <label for="image" class="col-form-label">Image:</label>
        <input type="file" data-validation="mime" data-validation-allowing="jpg, png, jpeg , gif" name="image"
            class="form-control" id="image">
    </div>
    <div class="form-group">
        <label for="banner" class="col-form-label">Banner:</label>
        <input type="file" data-validation="mime" data-validation-allowing="jpg, png, jpeg , gif" name="banner"
            class="form-control" id="banner">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary submitBtn">Submit</button>
</div>