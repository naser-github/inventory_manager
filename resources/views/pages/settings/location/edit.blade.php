<div class="modal-content">
    <div class="modal-header">
        <h3 class="modal-title">Edit Location</h3>

        <!--begin::Close-->
        <div class="btn btn-icon btn-sm btn-active-light-info ms-2" data-bs-dismiss="modal" aria-label="Close">
            <span class="svg-icon svg-icon-1"><i class="fa-solid fa-xmark text-info"></i></span>
        </div>
        <!--end::Close-->
    </div>

    <form role="form" method="POST" action="{{ route('locations.update', $location->id) }}">
        @csrf
        @method('Patch')
        <div class="modal-body">

            <div class="row mt-4">
                {{--id--}}
                <input type="hidden" name="id" value="{{ $location->id }}">

                {{--Name--}}
                <div class="col-12 mb-6">
                    <label for="name" class="required form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required
                           value="{{ $location->name }}"/>
                    @error('name')
                    <span class="text-danger m-0 p-0" role="alert">{{$errors->first('name')}}</span>
                    @enderror
                </div>

                {{--Description--}}
                <div class="col-12 mb-6">
                    <label for="description" class="required form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"
                              placeholder="Description">{{ $location->description }}</textarea>
                    @error('description')
                    <span class="text-danger m-0 p-0" role="alert">{{$errors->first('description')}}</span>
                    @enderror
                </div>

                {{--Status--}}
                <div class="col-sm-12 mb-6">
                    <label for="status" class="required form-label">Select a status</label>
                    <select id="status" name="status" class="form-select" aria-label="Select status" required>
                        <option disabled>Select a Status</option>
                        <option value="1" @if($location->status == 1) selected @endif>Active</option>
                        <option value="0" @if($location->status == 0) selected @endif>Inactive</option>
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
