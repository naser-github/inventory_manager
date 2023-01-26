<div class="card card-flush shadow-sm">
    <div class="card-body mb-0 pb-0 py-5">
        <!--begin::Repeater-->
        <div id="consumption_data">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="consumption_data">
                    <div data-repeater-item>
                        <div class="form-group row mb-5">

                            <div class="col-md-3">
                                <label class="form-label required">Select Item</label>
                                <select name="item_id" class="form-select" data-kt-repeater="select2"
                                        data-placeholder="Select an item" oninput="onSelectItem()" required>
                                    <option></option>
                                    @foreach($items as $item)
                                        <option value="{{$item->item->id}}">{{$item->item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label required">Stock</label>
                                <input type="number" step="any" class="form-control form-control-solid"
                                       data-kt-repeater="stock" name="stock" readonly/>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label required">Unit Price</label>
                                <input type="number" step="any" class="form-control form-control-solid"
                                       data-kt-repeater="unit_price" name="unit_price" readonly/>
                            </div>

                            <div class="col-md-2">
                                <label for="item_quantity" class="form-label required">Quantity</label>
                                <input type="number" step="any" class="form-control" data-kt-repeater="quantity"
                                       name="quantity" required/>
                            </div>

                            <div class="col-md-2">
                                <a href="javascript:;" data-repeater-delete
                                   class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                    <i class="la la-trash-o fs-3"></i>Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group mb-5">
                <a href="javascript:;" data-repeater-create class="btn btn-light-info">
                    <i class="la la-plus"></i>Add
                </a>
            </div>
            <!--end::Form group-->
        </div>
        <!--end::Repeater-->
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-info">Submit</button>
        </div>
    </div>
</div>

<script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>

<script>
    $('#consumption_data').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },

        show: function () {
            $(this).slideDown();

            // Re-init select2
            $(this).find('[data-kt-repeater="select2"]').select2();
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },

        ready: function () {
            // Init select2
            $('[data-kt-repeater="select2"]').select2();
        }
    });

    var items = <?php echo json_encode($items); ?>;

    function onSelectItem() {
        var select2 = document.querySelectorAll('[data-kt-repeater="select2"]');
        var stock = document.querySelectorAll('[data-kt-repeater="stock"]');
        var unitPrice = document.querySelectorAll('[data-kt-repeater="unit_price"]');

        for (var i = 0; i < select2.length; i++) {
            var item = items.filter(item => item.item.id === Number(select2[i].value))[0]
            stock[i].value = item?.quantity
            unitPrice[i].value = item?.unit_price
        }
    }
</script>
