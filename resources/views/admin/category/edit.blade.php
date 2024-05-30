<div class="modal-body">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="update_id" value="{{ $category->id }}">
    <div class="form-group">
        <label for="title" class="col-form-label">Title:</label>
        <input type="text" data-validation="required" name="title" value="{{ $category->title }}"
            class="form-control" id="title">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary submitBtn">Submit</button>
</div>
