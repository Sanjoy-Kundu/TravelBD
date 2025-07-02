<!-- Add New Package Modal -->
<div class="modal fade" id="packageCategoryFormModal" tabindex="-1" aria-labelledby="packageCategoryFormModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="packageCategoryFormModalLabel">Add New Package</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="package_category_add_form" enctype="multipart/form-data" novalidate>
                    <!-- Category Select -->
                    <div class="mb-3">
                        <label for="package_category_select" class="form-label">Category <span
                                class="text-danger">*</span></label>
                        <select id="package_category_select" name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            <!-- Options will be loaded dynamically -->
                        </select>
                        <div id="package_category_select_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="package_title" class="form-label">Package Title <span
                                class="text-danger">*</span></label>
                        <input type="text" id="package_title" name="title" class="form-control"
                            placeholder="Enter Package Title" required>
                        <div id="package_title_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Slug (optional) -->
                    {{-- <div class="mb-3">
                        <label for="package_slug" class="form-label">Slug</label>
                        <input type="text" id="package_slug" name="slug" class="form-control"
                            placeholder="Auto-generated or enter manually">
                        <div id="package_slug_error" class="text-danger mt-1"></div>
                    </div> --}}

                    <!-- Short Description -->
                    <div class="mb-3">
                        <label for="package_short_description" class="form-label">Short Description</label>
                        <input type="text" id="package_short_description" name="short_description"
                            class="form-control" placeholder="Short description">
                        <div id="package_short_description_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Long Description -->
                    <div class="mb-3">
                        <label for="package_long_description" class="form-label">Long Description</label>
                        <textarea id="package_long_description" name="long_description" rows="4" class="form-control"
                            placeholder="Detailed description"></textarea>
                        <div id="package_long_description_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="package_price" class="form-label">Price</label>
                        <input type="number" step="0.01" id="package_price" name="price" class="form-control"
                            placeholder="Package Price">
                        <div id="package_price_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Currency -->
                    <div class="mb-3">
                        <label for="package_currency" class="form-label">Currency</label>
                        <input type="text" id="package_currency" name="currency" class="form-control" value="USD"
                            placeholder="Currency">
                        <div id="package_currency_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Duration -->
                    <div class="mb-3">
                        <label for="package_duration" class="form-label">Duration</label>
                        <input type="text" id="package_duration" name="duration" class="form-control"
                            placeholder="Example: 7 Days, 1 Month">
                        <div id="package_duration_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Inclusions -->
                    <div class="mb-3">
                        <label for="package_inclusions" class="form-label">Inclusions</label>
                        <textarea id="package_inclusions" name="inclusions" rows="3" class="form-control" placeholder="What is included?"></textarea>
                        <div id="package_inclusions_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Exclusions -->
                    <div class="mb-3">
                        <label for="package_exclusions" class="form-label">Exclusions</label>
                        <textarea id="package_exclusions" name="exclusions" rows="3" class="form-control"
                            placeholder="What is excluded?"></textarea>
                        <div id="package_exclusions_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Visa Processing Time -->
                    <div class="mb-3">
                        <label for="package_visa_processing_time" class="form-label">Visa Processing Time</label>
                        <input type="text" id="package_visa_processing_time" name="visa_processing_time"
                            class="form-control" placeholder="Example: 10 Days">
                        <div id="package_visa_processing_time_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Documents Required -->
                    <div class="mb-3">
                        <label for="package_documents_required" class="form-label">Documents Required</label>
                        <textarea id="package_documents_required" name="documents_required" rows="3" class="form-control"
                            placeholder="List required documents"></textarea>
                        <div id="package_documents_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Seat Availability sloat-->
                    <div class="mb-3">
                        <label for="package_seat_availability" class="form-label">Seat Availability</label>
                        <input type="number" id="package_seat_availability" name="seat_availability"
                            class="form-control" placeholder="Number of available seats">
                        <div id="package_seat_availability_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="package_image" class="form-label">Image</label>
                        <input type="file" id="package_image" name="image" class="form-control"
                            accept="image/*" onchange="packageImagePreview(event)">
                        <img id="package_image_previewer" src="#" alt="Image Preview"
                            style="display:none; max-width:200px; margin-top:10px; border-radius:4px; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
                        <div id="package_image_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="package_status" class="form-label">Status <span
                                class="text-danger">*</span></label>
                        <select id="package_status" name="status" class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div id="package_status_error" class="text-danger mt-1"></div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4"onclick="packageCreate(event)">Save
                            Package</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Image preview on select
    function packageImagePreview(event) {
        const input = event.target;
        const preview = document.getElementById('package_image_previewer');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }

    // Load categories to select dropdown
    loadPackageCategoriesForForm();
    async function loadPackageCategoriesForForm() {
        const token = localStorage.getItem('token');
        if (!token) return;

        try {
            const res = await axios.get('/admin/package-category/lists', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
            if (res.data.status === 'success') {
                const categories = res.data.PackageCategories;
                const select = document.getElementById('package_category_select');
                select.innerHTML = '<option value="">Select Category</option>';
                categories.forEach(category => {
                    select.innerHTML += `<option value="${category.id}">${category.name}</option>`;
                });
            }
        } catch (error) {
            console.error('Failed to load categories for form:', error);
        }
    }




    // Package Create Function
    async function packageCreate(event) {
        event.preventDefault();
        let token = localStorage.getItem('token');

        if (!token) {
            alert("Please login first.");
            window.location.href = "/login/admin";
            return;
        }

        // Clear previous errors
        document.getElementById('package_category_select_error').textContent = '';
        document.getElementById('package_title_error').textContent = '';
        //document.getElementById('package_slug_error').textContent = '';
        document.getElementById('package_short_description_error').textContent = '';
        document.getElementById('package_long_description_error').textContent = '';
        document.getElementById('package_price_error').textContent = '';
        document.getElementById('package_currency_error').textContent = '';
        document.getElementById('package_duration_error').textContent = '';
        document.getElementById('package_inclusions_error').textContent = '';
        document.getElementById('package_exclusions_error').textContent = '';
        document.getElementById('package_visa_processing_time_error').textContent = '';
        document.getElementById('package_documents_error').textContent = '';
        document.getElementById('package_seat_availability_error').textContent = '';
        document.getElementById('package_image_error').textContent = '';
        document.getElementById('package_status_error').textContent = '';





        const title = document.getElementById('package_title').value.trim();
        const category_id = document.getElementById('package_category_select').value;
        const short_description = document.getElementById('package_short_description').value.trim();
        const long_description = document.getElementById('package_long_description').value.trim();
        const price = document.getElementById('package_price').value.trim();
        const currency = document.getElementById('package_currency').value;
        const duration = document.getElementById('package_duration').value.trim();
        const inclusions = document.getElementById('package_inclusions').value.trim();
        const exclusions = document.getElementById('package_exclusions').value.trim();
        const visa_processing_time = document.getElementById('package_visa_processing_time').value.trim();
        const documents_required = document.getElementById('package_documents_required').value.trim();
        const seat_availability = document.getElementById('package_seat_availability').value.trim();

        const image = document.getElementById('package_image').files[0];
        const status = document.getElementById('package_status').value;

        let hasError = false;

        if (!title) {
            document.getElementById('package_title_error').textContent = 'Title is required';
            hasError = true;
        }

        if (!category_id) {
            document.getElementById('package_category_select_error').textContent = 'Category is required';
            hasError = true;
        }

        if (hasError) return;

        const formData = new FormData();
        formData.append('title', title);
        formData.append('category_id', category_id);
        formData.append('duration', duration);
        formData.append('price', price);
        formData.append('short_description', short_description);
        formData.append('long_description', long_description);
        formData.append('currency', currency);
        formData.append('inclusions', inclusions);
        formData.append('exclusions', exclusions);
        formData.append('visa_processing_time', visa_processing_time);
        formData.append('documents_required', documents_required);
        formData.append('seat_availability', seat_availability);
        formData.append('status', status);
        if (image) formData.append('image', image);

        try {
            const res = await axios.post('/admin/package/store', formData, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'multipart/form-data',
                }
            });

            if (res.data.status === 'success') {
                Swal.fire('Success!', res.data.message, 'success');
                document.getElementById('package_category_add_form').reset();

                document.getElementById('package_image_previewer').style.display = 'none';

                // refresh list
                //await packageListLoadData();

                // Hide modal
                const modalEl = document.getElementById('packageCategoryFormModal');
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                modalInstance.hide();

            } else {
                Swal.fire('Oops!', res.data.message, 'warning');
            }
        } catch (error) {
            Swal.fire('Error!', error.response?.data?.message || 'Something went wrong', 'error');
        }
    }
</script>
