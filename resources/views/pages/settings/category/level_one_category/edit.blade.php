<div class="modal-content">
    <div class="modal-header">
        <h3 class="modal-title">Edit Level One Category</h3>

        <!--begin::Close-->
        <div class="btn btn-icon btn-sm btn-active-light-info ms-2" data-bs-dismiss="modal" aria-label="Close">
            <span class="svg-icon svg-icon-1"><i class="fa-solid fa-xmark text-info"></i></span>
        </div>
        <!--end::Close-->
    </div>

    <form role="form" method="POST" action="{{ route('level-one-categories.update', $level_one_category->id) }}">
        @csrf
        @method('Patch')
        <div class="modal-body">

            <div class="row mt-4">
                {{--id--}}
                <input type="hidden" name="id" value="{{ $level_one_category->id }}">

                {{--Name--}}
                <div class="col-12 mb-6">
                    <label for="name" class="required form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required
                           value="{{ $level_one_category->name }}"/>
                    @error('name')
                    <span class="text-danger m-0 p-0" role="alert">{{$errors->first('name')}}</span>
                    @enderror
                </div>

                {{--master category--}}
                <div class="col-sm-12 mb-6">
                    <label for="master_category" class="required form-label">Master Category</label>
                    <select id="master_category" name="master_category" class="form-select"
                            aria-label="Assign master category" required>
                        <option disabled>Assign a Master Category</option>
                        @foreach($master_categories as $master_category)
                            <option
                                @if($level_one_category->master_category_id == $master_category->id) selected @endif
                                value="{{ $master_category->id }}"
                            >
                                {{ $master_category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('master_category')
                    <span class="text-danger m-0 p-0" role="alert">{{$errors->first('master_category')}}</span>
                    @enderror
                </div>

                {{--Status--}}
                <div class="col-sm-12 mb-6">
                    <label for="status" class="required form-label">Select a status</label>
                    <select id="status" name="status" class="form-select" aria-label="Select status" required>
                        <option disabled>Select a Status</option>
                        <option value="1" @if($level_one_category->status == 1) selected @endif>Active</option>
                        <option value="0" @if($level_one_category->status == 0) selected @endif>Inactive</option>
                    </select>
                    @error('status')
                    <span class="text-danger m-0 p-0" role="alert">{{$errors->first('status')}}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-info">Update</button>
        </div>
    </form>
</div>

