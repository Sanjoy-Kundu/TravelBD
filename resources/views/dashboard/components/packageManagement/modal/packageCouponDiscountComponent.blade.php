<!-- Coupon/Discount Add Modal -->
<div class="modal fade" id="packageCouponDiscountFormModal" tabindex="-1" aria-labelledby="packageCouponDiscountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="packageCouponDiscountModalLabel">Add Coupon / Discount</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="package_coupon_discount_upload_form" enctype="multipart/form-data" novalidate>
                    <!-- Hidden Package ID -->
                    <input type="hidden" id="package_couponDiscount_id" name="package_id">

                    <!-- Discount Mode -->
                    <div class="mb-3">
                        <label for="discount_type_selector" class="form-label">Discount Mode <span
                                class="text-danger">*</span></label>
                        <select name="discount_mode" id="discount_type_selector" class="form-select" onchange="discountMethodToggle()">
                            <option value="">Select Type</option>
                            <option value="coupon">Coupon Based</option>
                            <option value="direct">Direct Discount</option>
                        </select>
                        <div class="text-danger mt-1" id="discount_mode_error"></div>
                    </div>

                    <!-- Coupon Code (Only for coupon mode) -->
                    <div class="mb-3 d-none" id="coupon_code_wrapper">
                        <label for="coupon_code" class="form-label">Coupon Code <span
                                class="text-danger">*</span></label>
                        <input type="text" name="coupon_code" id="coupon_code" class="form-control"
                            placeholder="e.g., ITALY100">
                        <div class="text-danger mt-1" id="coupon_code_error"></div>
                    </div>

                    <!-- Discount Percentage (Always required) -->
                    <div class="mb-3" id="discount_value_wrapper">
                        <label for="discount_value" class="form-label">Discount Percentage(%)<span
                                class="text-danger">*</span></label>
                        <input type="number" name="discount_value" id="discount_value" class="form-control"
                            placeholder="Enter percentage e.g., 10" min="1" max="100">
                        <div class="text-danger mt-1" id="discount_value_error"></div>
                    </div>

                    <!-- Validity Dates -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                            <div class="text-danger mt-1" id="start_date_error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                            <div class="text-danger mt-1" id="end_date_error"></div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="coupon_status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" id="coupon_status" class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div class="text-danger mt-1" id="status_error"></div>
                    </div>

                    <!-- Submit -->
                    <div class="text-end">
                        <button class="btn btn-success px-4" onclick="couponDiscoutCreate(event)">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let CouponToken = localStorage.getItem('token');
    if (!CouponToken) {
        window.location.href = "/admin/login";
    }

    function packageCouponDiscountForm(id) {
        // document.getElementById('package_coupon_discount_upload_form').reset();
        document.getElementById('package_couponDiscount_id').value = id;
        // toggleDiscountModeFields(); // reset visible fields
    }

    function discountMethodToggle() {
        let discountType = document.getElementById('discount_type_selector').value;
        let couponCodeWrapper = document.getElementById('coupon_code_wrapper');

        if (discountType === 'coupon') {
            couponCodeWrapper.classList.remove('d-none');
        } else {
            couponCodeWrapper.classList.add('d-none');
            // Optional: coupon code input ফিল্ড খালি করো যদি direct discount হয়
            document.getElementById('coupon_code').value = '';
        }
    }




        async function couponDiscoutCreate(event) {
        event.preventDefault();

        // Clear errors
        const errorFields = ['discount_mode_error', 'coupon_code_error', 'discount_value_error', 'start_date_error', 'end_date_error', 'status_error'];
        errorFields.forEach(id => document.getElementById(id).innerText = '');

        // Get values
        const package_id = document.getElementById('package_couponDiscount_id').value;
        const discount_mode = document.getElementById('discount_type_selector').value;
        const coupon_code = document.getElementById('coupon_code').value;
        const discount_value = document.getElementById('discount_value').value;
        const start_date = document.getElementById('start_date').value;
        const end_date = document.getElementById('end_date').value;
        const status = document.getElementById('coupon_status').value;

        let isError = false;

        if (!discount_mode) {
            document.getElementById('discount_mode_error').innerText = 'Discount mode is required.';
            isError = true;
        }

        if (discount_mode === 'coupon' && !coupon_code) {
            document.getElementById('coupon_code_error').innerText = 'Coupon code is required.';
            isError = true;
        }

        if (!discount_value || discount_value < 1 || discount_value > 100) {
            document.getElementById('discount_value_error').innerText = 'Enter a valid discount (1–100).';
            isError = true;
        }

        if (!start_date) {
            document.getElementById('start_date_error').innerText = 'Start date is required.';
            isError = true;
        }

        if (!end_date) {
            document.getElementById('end_date_error').innerText = 'End date is required.';
            isError = true;
        } else if (start_date && end_date < start_date) {
            document.getElementById('end_date_error').innerText = 'End date must be after start date.';
            isError = true;
        }

        if (!status) {
            document.getElementById('status_error').innerText = 'Status is required.';
            isError = true;
        }

        if (!package_id) {
            alert("Package ID missing!");
            return;
        }

        if (isError) return;

        const data = {
            package_id,
            discount_mode,
            coupon_code: discount_mode === 'coupon' ? coupon_code : null,
            discount_value,
            start_date,
            end_date,
            status,
        };

        console.log(data); // Remove this in production

        try {
            const res = await axios.post('/admin/package-coupon-discount', data, {
                headers: {
                    'Authorization': `Bearer ${CouponToken}`,
                    'Content-Type': 'application/json',
                }
            });

            if (res.data.status === "success") {
                Swal.fire('Success!', res.data.message, 'success');
                document.getElementById('package_coupon_discount_upload_form').reset();
                $('#packageCouponDiscountFormModal').modal('hide');
                // optionally refresh discount list
            } else {
                alert("Something went wrong!");
            }
        } catch (err) {
             document.getElementById('coupon_code_error').innerText = err.response.data.errors.coupon_code[0]
            //console.error("Server error:", err);
         
        }
    }
</script>
