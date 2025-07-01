<!-- Category Edit Modal -->
<div class="modal fade" id="packageCategoryEditModal" tabindex="-1" aria-labelledby="categoryEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="categoryEditModalLabel">Package Category Edit Form</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="package_category_edit_form" enctype="multipart/form-data" novalidate>
                    <input type="hidden" id="package_category_edit_id" name="id">

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="package_category_edit_name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="package_category_edit_name" class="form-control" placeholder="Enter Category Name" required>
                        <div id="package_category_edit_name_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Slug (Optional) -->
                    <div class="mb-3 d-none">
                        <label for="package_category_edit_slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="package_category_edit_slug" class="form-control" placeholder="Auto-generated slug">
                        <div id="package_category_edit_slug_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="package_category_edit_description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea id="package_category_edit_description" name="description" rows="3" class="form-control" placeholder="Enter description" required></textarea>
                        <div id="package_category_edit_description_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="package_category_edit_image" class="form-label">Image</label>
                        <input type="file" id="package_category_edit_image" name="image" class="form-control" accept="image/*" onchange="packageCategoryEditPreviewImage(event)">
                        <img id="package_category_edit_image_previewer" src="#" alt="Image Preview" style="display:none; max-width:200px; margin-top:10px; border-radius:4px; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
                        <div id="package_category_edit_image_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="package_category_edit_status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select id="package_category_edit_status" name="status" class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div id="package_category_edit_status_error" class="text-danger mt-1"></div>
                    </div>

                    <!-- Submit -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4" onclick="packageCategoryUpdate(event)">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview image for edit
    function packageCategoryEditPreviewImage(event) {
        const input = event.target;
        const preview = document.getElementById('package_category_edit_image_previewer');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }

    // Fill form with existing data
    async function packageCategoryEditModalFormFillup(id) {
        try {
            const token = localStorage.getItem('token');
            const res = await axios.post('/admin/package-category/details', { id: id }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (res.data.status === 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: res.data.message,
                });
                return false;
            }

            let category = res.data.PackageCategory;
            console.log(category);

            document.getElementById('package_category_edit_id').value = category.id;
            document.getElementById('package_category_edit_name').value = category.name || '';
            document.getElementById('package_category_edit_slug').value = category.slug || '';
            document.getElementById('package_category_edit_description').value = category.description || '';
            document.getElementById('package_category_edit_status').value = category.status || '';
            document.getElementById('package_category_edit_image_previewer').src = `/upload/dashboard/images/package-category/${category.image}`;
            document.getElementById('package_category_edit_image_previewer').style.display = 'block';

            // Clear previous errors on form load
            clearEditFormErrors();
        } catch (error) {
            console.error('Error loading category data:', error);
        }
    }

    // Clear form error messages
    function clearEditFormErrors() {
        document.getElementById('package_category_edit_name_error').textContent = '';
        document.getElementById('package_category_edit_description_error').textContent = '';
        document.getElementById('package_category_edit_image_error').textContent = '';
        document.getElementById('package_category_edit_status_error').textContent = '';
        document.getElementById('package_category_edit_slug_error').textContent = '';
    }

    // Submit update form
    async function packageCategoryUpdate(event) {
        event.preventDefault();

        clearEditFormErrors(); // clear errors before submit

        const token = localStorage.getItem('token');
        if (!token) return alert("Unauthorized");

        const formData = new FormData();

        // Get all values
        const id = document.getElementById('package_category_edit_id').value;
        const name = document.getElementById('package_category_edit_name').value.trim();
        const slug = document.getElementById('package_category_edit_slug').value.trim();
        const description = document.getElementById('package_category_edit_description').value.trim();
        const status = document.getElementById('package_category_edit_status').value;

        const imageInput = document.getElementById('package_category_edit_image');
        const image = imageInput.files[0];

        // Append data
        formData.append('id', id);
        formData.append('name', name);
        formData.append('slug', slug);
        formData.append('description', description);
        formData.append('status', status);

        if (image) {
            formData.append('image', image);
        }

        try {
            const res = await axios.post('/admin/package-category/update', formData, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'multipart/form-data'
                }
            });

            if (res.data.status === 'success') {
                Swal.fire(res.data.message, '', 'success');
                document.getElementById('package_category_edit_form').reset();
                document.getElementById('package_category_edit_image_previewer').style.display = 'none';
                bootstrap.Modal.getInstance(document.getElementById('packageCategoryEditModal')).hide();
                await packageListLoadData(); // refresh list
            } else {
                alert(res.data.message || 'Update failed');
            }

            // Show validation errors if any
            if (res.data.errors) {
                document.getElementById('package_category_edit_name_error').textContent = res.data.errors.name ? res.data.errors.name[0] : '';
                document.getElementById('package_category_edit_description_error').textContent = res.data.errors.description ? res.data.errors.description[0] : '';
                document.getElementById('package_category_edit_image_error').textContent = res.data.errors.image ? res.data.errors.image[0] : '';
                document.getElementById('package_category_edit_status_error').textContent = res.data.errors.status ? res.data.errors.status[0] : '';
                document.getElementById('package_category_edit_slug_error').textContent = res.data.errors.slug ? res.data.errors.slug[0] : '';
            }
        } catch (error) {
            console.error('Update error:', error);
            alert('Something went wrong while updating.');
        }
    }
</script>
