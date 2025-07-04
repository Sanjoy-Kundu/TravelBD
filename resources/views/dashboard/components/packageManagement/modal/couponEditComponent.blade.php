<!-- Coupon/Discount Edit Modal -->
<div class="modal fade" id="packageCouponEditModal" tabindex="-1" aria-labelledby="packageCouponEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="packageCouponEditModalLabel">Edit Coupon / Discount</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="edit_package_coupon_discount_form" novalidate>
                    <!-- Hidden Package ID -->
                    <input type="hidden" id="edit_package_coupon_id">
                    <input type="hidden" id="edit_package_coupon_package_id">

                    <!-- Discount Mode -->
                    <div class="mb-3">
                        <label class="form-label">Discount Mode <span class="text-danger">*</span></label>
                        <select id="edit_discount_mode_selector" class="form-select" onchange="toggleDiscountModeFields('edit')" required>
                            <option value="">Select Type</option>
                            <option value="coupon">Coupon Based</option>
                            <option value="direct">Direct Discount</option>
                        </select>
                        <div class="text-danger mt-1" id="edit_discount_mode_error"></div>
                    </div>

                    <!-- Coupon Code -->
                    <div class="mb-3 d-none" id="edit_coupon_code_wrapper">
                        <label class="form-label">Coupon Code <span class="text-danger">*</span></label>
                        <input type="text" id="edit_coupon_code" class="form-control" placeholder="e.g., ITALY100">
                        <div class="text-danger mt-1" id="edit_coupon_code_error"></div>
                    </div>

                    <!-- Discount Value -->
                    <div class="mb-3">
                        <label class="form-label">Discount (%) <span class="text-danger">*</span></label>
                        <input type="number" id="edit_discount_value" class="form-control" min="1" max="100">
                        <div class="text-danger mt-1" id="edit_discount_value_error"></div>
                    </div>

                    <!-- Dates -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                            <input type="date" id="edit_start_date" class="form-control">
                            <div class="text-danger mt-1" id="edit_start_date_error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date <span class="text-danger">*</span></label>
                            <input type="date" id="edit_end_date" class="form-control">
                            <div class="text-danger mt-1" id="edit_end_date_error"></div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select id="edit_coupon_status" class="form-select">
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div class="text-danger mt-1" id="edit_status_error"></div>
                    </div>

                    <!-- Submit -->
                    <div class="text-end">
                        <button class="btn btn-success px-4" onclick="couponDiscountUpdate(event)">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

function toggleDiscountModeFields(context = '') {
    let prefix = context === 'edit' ? 'edit_' : '';
    let mode = document.getElementById(`${prefix}discount_mode_selector`).value;
    let couponField = document.getElementById(`${prefix}coupon_code_wrapper`);

    if (mode === 'coupon') {
        couponField.classList.remove('d-none');
    } else {
        couponField.classList.add('d-none');
    }
}

async function packageCouponEditFormFillup(id) {
    let token = localStorage.getItem('token');
    if (!token) return window.location.href = "/admin/login";

    try {
        const res = await axios.post(`/admin/package-coupon-show/}`,{id: id}, {
            headers: { 'Authorization': `Bearer ${token}` }
        });

        const data = res.data.coupon;

        // Fill data
        document.getElementById('edit_package_coupon_id').value = data.id;
        document.getElementById('edit_package_coupon_package_id').value = data.package_id;
        document.getElementById('edit_discount_mode_selector').value = data.discount_mode;
        document.getElementById('edit_discount_value').value = data.discount_value;
        document.getElementById('edit_start_date').value = data.start_date;
        document.getElementById('edit_end_date').value = data.end_date;
        document.getElementById('edit_coupon_status').value = data.status;

        toggleDiscountModeFields('edit');

        if (data.discount_mode === 'coupon') {
            document.getElementById('edit_coupon_code').value = data.coupon_code;
        }

        $('#packageCouponEditModal').modal('show');

    } catch (error) {
        console.error("Edit Load Error:", error);
        Swal.fire("Error", "Failed to load coupon details.", "error");
    }
}

async function couponDiscountUpdate(event) {
    event.preventDefault();
    let token = localStorage.getItem('token');

    // Clear errors
    const fields = ['discount_mode', 'coupon_code', 'discount_value', 'start_date', 'end_date', 'status'];
    fields.forEach(f => document.getElementById(`edit_${f}_error`).innerText = '');

    // Get values
    const id = document.getElementById('edit_package_coupon_id').value;
    const package_id = document.getElementById('edit_package_coupon_package_id').value;
    const discount_mode = document.getElementById('edit_discount_mode_selector').value;
    const coupon_code = document.getElementById('edit_coupon_code').value;
    const discount_value = document.getElementById('edit_discount_value').value;
    const start_date = document.getElementById('edit_start_date').value;
    const end_date = document.getElementById('edit_end_date').value;
    const status = document.getElementById('edit_coupon_status').value;

    let hasError = false;

    if (!discount_mode) {
        document.getElementById('edit_discount_mode_error').innerText = "Required";
        hasError = true;
    }
    if (discount_mode === 'coupon' && !coupon_code) {
        document.getElementById('edit_coupon_code_error').innerText = "Required";
        hasError = true;
    }
    if (!discount_value || discount_value < 1 || discount_value > 100) {
        document.getElementById('edit_discount_value_error').innerText = "Enter 1–100";
        hasError = true;
    }
    if (!start_date) {
        document.getElementById('edit_start_date_error').innerText = "Required";
        hasError = true;
    }
    if (!end_date || end_date < start_date) {
        document.getElementById('edit_end_date_error').innerText = "Invalid end date";
        hasError = true;
    }
    if (!status) {
        document.getElementById('edit_status_error').innerText = "Required";
        hasError = true;
    }

    if (hasError) return;

    const data = {
        id,
        package_id,
        discount_mode,
        coupon_code: discount_mode === 'coupon' ? coupon_code : null,
        discount_value,
        start_date,
        end_date,
        status
    };

    try {
        const res = await axios.post('/admin/package-coupon-update', data, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        if (res.data.status === 'success') {
            Swal.fire("Success", res.data.message, "success");
            $('#packageCouponEditModal').modal('hide');
            await fillCouponLists(package_id); // Refresh list
        } else {
            Swal.fire("Failed", res.data.message || "Update failed.", "error");
        }
    } catch (err) {
        if (err.response?.data?.errors) {
            const errors = err.response.data.errors;
            for (const key in errors) {
                const el = document.getElementById(`edit_${key}_error`);
                if (el) el.innerText = errors[key][0];
            }
        } else {
            console.error("Update Error:", err);
            Swal.fire("Error", "Something went wrong", "error");
        }
    }
}

</script>