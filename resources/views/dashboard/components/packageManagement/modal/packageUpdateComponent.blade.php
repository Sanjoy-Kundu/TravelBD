<!-- Add New Package Modal -->
<div class="modal fade" id="updatePackageFormModal" tabindex="-1" aria-labelledby="packageCategoryFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Package Update</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="number" name="id" id="update_package_id">
                <form id="update_package_form" enctype="multipart/form-data">

                    <!-- Category Select -->
                    <div class="mb-3">
                        <label for="update_package_category_select" class="form-label">Category <span class="text-danger">*</span></label>
                        <select id="update_package_category_select" name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                        </select>
                        <div id="update_package_category_select_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label">Package Title <span class="text-danger">*</span></label>
                        <input type="text" id="update_package_title" name="title" class="form-control" placeholder="Enter Package Title" required>
                        <div id="update_package_title_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Short Description -->
                    <div class="mb-3">
                        <label class="form-label">Short Description</label>
                        <input type="text" id="update_package_short_description" name="short_description" class="form-control" placeholder="Short description">
                        <div id="update_package_short_description_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Long Description -->
                    <div class="mb-3">
                        <label class="form-label">Long Description</label>
                        <textarea id="update_package_long_description" name="long_description" rows="4" class="form-control" placeholder="Detailed description"></textarea>
                        <div id="update_package_long_description_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" id="update_package_price" name="price" class="form-control" placeholder="Package Price">
                        <div id="update_package_price_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Currency -->
                    <div class="mb-3">
                        <label class="form-label">Currency(BDT/USD)</label>
                        <input type="text" id="update_package_currency" name="currency" class="form-control" value="USD" placeholder="Currency">
                        <div id="update_package_currency_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Duration -->
                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" id="update_package_duration" name="duration" class="form-control" placeholder="Example: 7 Days, 1 Month">
                        <div id="update_package_duration_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Inclusions -->
                    <div class="mb-3">
                        <label class="form-label">Inclusions</label>
                        <textarea id="update_package_inclusions" name="inclusions" rows="3" class="form-control" placeholder="What is included?"></textarea>
                        <div id="update_package_inclusions_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Exclusions -->
                    <div class="mb-3">
                        <label class="form-label">Exclusions</label>
                        <textarea id="update_package_exclusions" name="exclusions" rows="3" class="form-control" placeholder="What is excluded?"></textarea>
                        <div id="update_package_exclusions_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Visa Processing Time -->
                    <div class="mb-3">
                        <label class="form-label">Visa Processing Time</label>
                        <input type="text" id="update_package_visa_processing_time" name="visa_processing_time" class="form-control" placeholder="Example: 10 Days">
                        <div id="update_package_visa_processing_time_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Documents Required -->
                    <div class="mb-3">
                        <label class="form-label">Documents Required</label>
                        <textarea id="update_package_documents_required" name="documents_required" rows="3" class="form-control" placeholder="List required documents"></textarea>
                        <div id="update_package_documents_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Seat Availability -->
                    <div class="mb-3">
                        <label class="form-label">Seat Availability</label>
                        <input type="number" id="update_package_seat_availability" name="seat_availability" class="form-control" placeholder="Number of available seats">
                        <div id="update_package_seat_availability_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" id="update_package_image" name="image" class="form-control" onchange="updatepackageImagePreview(event)">
                        <img id="update_package_image_previewer" src="#" alt="Image Preview"
                            style="display:none; max-width:340px; margin-top:10px; border-radius:4px; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
                        <div id="update_package_image_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select id="update_package_status" name="status" class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div id="update_package_status_error" class="text-danger mt-1"></div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4" onclick="updatePackage(event)">Update Package</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
    // Load category list
    async function loadPackageCategories(category_id) {
        const token = localStorage.getItem('token');
        if (!token) return;

        try {
            const res = await axios.get('/admin/package-category/lists', {
                headers: { Authorization: `Bearer ${token}` }
            });

            if (res.data.status === 'success') {
                const select = document.getElementById('update_package_category_select');
                select.innerHTML = '<option value="">Select Category</option>';

                res.data.PackageCategories.forEach(category => {
                    const selected = category.id == category_id ? 'selected' : '';
                    select.innerHTML += `<option value="${category.id}" ${selected}>${category.name}</option>`;
                });
            }
        } catch (error) {
            console.error('Category load failed:', error);
        }
    }

    // Fill update modal form
    async function fillPackaUpdateModal(id) {
        const token = localStorage.getItem('token');
        document.getElementById('update_package_id').value = id;

        try {
            const res = await axios.post('/admin/package/details', { id }, {
                headers: { Authorization: `Bearer ${token}` }
            });

            if (res.data.status === 'success') {
                const package = res.data.package;
                const category_id = package.package_category?.id || '';
                await loadPackageCategories(category_id);

                // Fill form fields
                document.getElementById('update_package_title').value = package.title || '';
                document.getElementById('update_package_short_description').value = package.short_description || '';
                document.getElementById('update_package_long_description').value = package.long_description || '';
                document.getElementById('update_package_price').value = package.price || '';
                document.getElementById('update_package_currency').value = package.currency || '';
                document.getElementById('update_package_duration').value = package.duration || '';
                document.getElementById('update_package_inclusions').value = package.inclusions || '';
                document.getElementById('update_package_exclusions').value = package.exclusions || '';
                document.getElementById('update_package_visa_processing_time').value = package.visa_processing_time || '';
                document.getElementById('update_package_documents_required').value = package.documents_required || '';
                document.getElementById('update_package_seat_availability').value = package.seat_availability || '';
                document.getElementById('update_package_status').value = package.status === 'active' ? 'active' : 'inactive';

                // Image preview set
                const preview = document.getElementById('update_package_image_previewer');
                preview.src = package.image ? `/${package.image}` : '/upload/dashboard/images/packages/default.png';
                preview.style.display = 'block';
            }

        } catch (error) {
            console.error('Package load failed:', error);
        }
    }

    // Preview image on file select
    function updatepackageImagePreview(event) {
        const input = event.target;
        const preview = document.getElementById('update_package_image_previewer');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }






    //update package
 async function updatePackage(event) {
    event.preventDefault();
    let token = localStorage.getItem('token');

    if (!token) {
        alert("Please login first.");
        window.location.href = "/login/admin";
        return;
    }

    // Clear previous errors
    document.getElementById('update_package_category_select_error').textContent = '';
    document.getElementById('update_package_title_error').textContent = '';
    document.getElementById('update_package_short_description_error').textContent = '';
    document.getElementById('update_package_long_description_error').textContent = '';
    document.getElementById('update_package_price_error').textContent = '';
    document.getElementById('update_package_currency_error').textContent = '';
    document.getElementById('update_package_duration_error').textContent = '';
    document.getElementById('update_package_inclusions_error').textContent = '';
    document.getElementById('update_package_exclusions_error').textContent = '';
    document.getElementById('update_package_visa_processing_time_error').textContent = '';
    document.getElementById('update_package_documents_error').textContent = '';
    document.getElementById('update_package_seat_availability_error').textContent = '';
    document.getElementById('update_package_image_error').textContent = '';
    document.getElementById('update_package_status_error').textContent = '';

    const id = document.getElementById('update_package_id').value;
    const title = document.getElementById('update_package_title').value.trim();
    const category_id = document.getElementById('update_package_category_select').value;
    const short_description = document.getElementById('update_package_short_description').value.trim();
    const long_description = document.getElementById('update_package_long_description').value.trim();
    const price = document.getElementById('update_package_price').value.trim();
    const currency = document.getElementById('update_package_currency').value;
    const duration = document.getElementById('update_package_duration').value.trim();
    const inclusions = document.getElementById('update_package_inclusions').value.trim();
    const exclusions = document.getElementById('update_package_exclusions').value.trim();
    const visa_processing_time = document.getElementById('update_package_visa_processing_time').value.trim();
    const documents_required = document.getElementById('update_package_documents_required').value.trim();
    const seat_availability = document.getElementById('update_package_seat_availability').value.trim();
    const image = document.getElementById('update_package_image').files[0];
    const status = document.getElementById('update_package_status').value;

    let hasError = false;

    if (!title) {
        document.getElementById('update_package_title_error').textContent = 'Title is required';
        hasError = true;
    }

    if (!category_id) {
        document.getElementById('update_package_category_select_error').textContent = 'Category is required';
        hasError = true;
    }

    if (hasError) return;

    const formData = new FormData();
    formData.append('id', id);
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
        const res = await axios.post('/admin/package/update', formData, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'multipart/form-data',
            }
        });

        if (res.data.status === 'success') {
            Swal.fire('Success!', res.data.message || 'Package updated successfully', 'success');

            // Reset form and preview image
            document.getElementById('update_package_form').reset();
            document.getElementById('update_package_image_previewer').style.display = 'none';

            // refresh list
            await packageListLoadData();

            // Hide modal
            const modalEl = document.getElementById('updatePackageFormModal');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            modalInstance.hide();


            document.body.classList.remove('modal-open'); 
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(el => el.remove());

        } else {
            Swal.fire('Oops!', res.data.message || 'Something went wrong!', 'warning');
        }
    } catch (error) {
        console.log(error.response?.data);
        Swal.fire('Error!', error.response?.data?.message || 'Something went wrong', 'error');
    }
}


</script>
