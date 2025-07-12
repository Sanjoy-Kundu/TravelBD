<!-- Coupon Edit Modal -->
<div class="modal fade" id="packageCouponEditModal" tabindex="-1" aria-labelledby="packageCouponEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="packageCouponEditModalLabel">Edit Coupon / Discount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="package_coupon_discount_edit_form" enctype="multipart/form-data" novalidate>
                    <!-- Hidden Coupon ID & Package ID -->
                    <input type="hidden" id="edit_coupon_id" name="id">
                    <input type="hidden" id="edit_package_id" name="package_id">

                    <!-- Discount Mode -->
                    <div class="mb-3">
                        <label for="edit_discount_type_selector" class="form-label">Discount Mode <span class="text-danger">*</span></label>
                        <select name="discount_mode" id="edit_discount_type_selector" class="form-select" onchange="editDiscountMethodToggle()">
                            <option value="">Select Type</option>
                            <option value="coupon">Coupon Based</option>
                            <option value="direct">Direct Discount</option>
                        </select>
                        <div class="text-danger mt-1" id="edit_discount_mode_error"></div>
                    </div>

                    <!-- Coupon Code (Only for coupon mode) -->
                    <div class="mb-3 d-none" id="edit_coupon_code_wrapper">
                        <label for="edit_coupon_code" class="form-label">Coupon Code <span class="text-danger">*</span></label>
                        <input type="text" name="coupon_code" id="edit_coupon_code" class="form-control" placeholder="e.g., ITALY100">
                        <div class="text-danger mt-1" id="edit_coupon_code_error"></div>
                    </div>

                    <!-- Discount Percentage -->
                    <div class="mb-3" id="edit_discount_value_wrapper">
                        <label for="edit_discount_value" class="form-label">Discount Percentage (%) <span class="text-danger">*</span></label>
                        <input type="number" name="discount_value" id="edit_discount_value" class="form-control" placeholder="Enter percentage e.g., 10" min="1" max="100">
                        <div class="text-danger mt-1" id="edit_discount_value_error"></div>
                    </div>

                    <!-- Validity -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" id="edit_start_date" class="form-control">
                            <div class="text-danger mt-1" id="edit_start_date_error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                            <input type="date" name="end_date" id="edit_end_date" class="form-control">
                            <div class="text-danger mt-1" id="edit_end_date_error"></div>
                        </div>
                    </div>

                    <!--Descriptoin--->
                       <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" name="description" id="edit_coupon_description"></textarea>
                        <label for=edit_coupon_description">Coupon Description</label>
                        <span class="text-danger mt-1" id="edit_coupon_description_error"></span>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="edit_coupon_status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="edit_coupon_status" class="form-select">
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div class="text-danger mt-1" id="edit_status_error"></div>
                    </div>

                    <!-- Submit -->
                    <div class="text-end">
                        <button class="btn btn-success px-4" onclick="updateCouponDiscount(event)">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    function editDiscountMethodToggle() {
    let type = $('#edit_discount_type_selector').val();

    if (type === 'coupon') {
        $('#edit_coupon_code_wrapper').removeClass('d-none');
    } else {
        $('#edit_coupon_code_wrapper').addClass('d-none');
        $('#edit_coupon_code').val('');
    }
}



async function packageCouponEditFormFillup(id) {
    let token = localStorage.getItem('token');
    try {
        let res = await axios.post('/admin/package-coupon/edit-details', {id:id }, {
            headers: { Authorization: `Bearer ${token}` }
        });

        let data = res.data.coupon;

        $('#edit_coupon_id').val(data.id);
        $('#edit_package_id').val(data.package_id);
        $('#edit_discount_type_selector').val(data.discount_mode).trigger('change');
        $('#edit_coupon_code').val(data.coupon_code);
        $('#edit_discount_value').val(data.discount_value);
        $('#edit_start_date').val(data.start_date);
        $('#edit_end_date').val(data.end_date);
        $('#edit_coupon_status').val(data.status);
        $('#edit_coupon_description').val(data.description);

        editDiscountMethodToggle(); // coupon_code wrapper show/hide

    } catch (err) {
        console.error("Edit fillup failed", err);
        Swal.fire('Error', 'Could not load coupon data.', 'error');
    }
}





async function updateCouponDiscount(event){
    event.preventDefault();

    const token = localStorage.getItem('token');
    if (!token) {
        window.location.href = "/admin/login";
        return;
    }


    document.querySelectorAll('#package_coupon_discount_edit_form .text-danger').forEach(el => el.textContent = '');

  
    const data = {
        id: document.getElementById('edit_coupon_id').value,
        package_id: document.getElementById('edit_package_id').value,
        discount_mode: document.getElementById('edit_discount_type_selector').value,
        coupon_code: document.getElementById('edit_coupon_code').value,
        discount_value: document.getElementById('edit_discount_value').value,
        start_date: document.getElementById('edit_start_date').value,
        end_date: document.getElementById('edit_end_date').value,
        description: document.getElementById('edit_coupon_description').value,
        status: document.getElementById('edit_coupon_status').value
    };

    try {
        const res = await axios.post('/admin/package-coupon/update', data, {
            headers: { Authorization: `Bearer ${token}` }
        });

        if(res.data.status === 'success'){
            Swal.fire('Updated!', res.data.message, 'success');

            // modal off
            const modalEl = document.getElementById('packageCouponEditModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();

            // coupon refresh
            await fillCouponLists(data.package_id);

        } else {
            Swal.fire('Failed!', res.data.message || 'Update failed.', 'error');
        }

    } catch(error) {
        console.error('Update error:', error);

        // erro backend
        if(error.response && error.response.status === 422){
            const errors = error.response.data.errors;
            for(const key in errors){
                const errorEl = document.getElementById(`edit_${key}_error`);
                if(errorEl) errorEl.textContent = errors[key][0];
            }
        } else {
            Swal.fire('Error!', 'Something went wrong.', 'error');
        }
    }
}

</script>