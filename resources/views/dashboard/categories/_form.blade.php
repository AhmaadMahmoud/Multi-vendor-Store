    {{-- @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger mt-3 w-2">
            {{ $error }}
        </div>
        @endforeach
    @endif --}}
<div class="card-body">
    <div class="form-group">
        <label for="exampleInputEmail1">Name Of Category</label>
        <input type="text" name="name" class="form-control @error('name')
            is-invalid
        @enderror" id="exampleInputEmail1"
            placeholder="Enter Name Of Category">
            @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
    </div>
    <div class="form-floating">
        <label for="floatingTextarea2">Description</label>
        <textarea class="form-control" name="description" placeholder="Write Description Here" id="floatingTextarea2"
            style="height: 100px"></textarea>
    </div>

    <select name="parent_id" class="form-select mt-4" aria-label="Default select example">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{ $parent->id }}"> {{ $parent->name }} </option>
        @endforeach
    </select>
                    @error('parent_id')
                <div class="text-danger">
                    {{ $errors->first('parent_id') }}
                </div>
            @enderror

    <div class="form-group mt-4 mb-4">
        <label for="exampleInputEmail1">Image</label>
        <br>
        <input type="file" name="image">
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active" checked>
        <label class="form-check-label" for="exampleRadios1">
            Active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="archived">
        <label class="form-check-label" for="exampleRadios2">
            Archevied
        </label>
    </div>
</div>
<!-- /.card-body -->
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
