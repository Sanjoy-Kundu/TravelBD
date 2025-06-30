<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Package Management / Category</li>
    </ol>

    <div class="card mb-4 shadow w-75 mx-auto">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user"></i> Create Package Category
        </div>
        <div class="card-body">
            <form action="" method="" id="package_category_form" enctype="multipart/form-data">


                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control"
                        placeholder="Enter category name" required>
                    <span class="text-danger" id="name_error"></span>
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug <small class="text-muted">(auto-generated or
                            editable)</small></label>
                    <input type="text" name="slug" id="slug" class="form-control"
                        placeholder="Enter slug or leave blank to auto-generate">
                    <span class="text-danger" id="slug_error"></span>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="3" class="form-control" placeholder="Optional description"></textarea>
                    <span class="text-danger" id="description_error"></span>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Category Image <small
                            class="text-muted">(optional)</small></label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*"
                        onchange="packageCategoryPreviewImage(event)">
                    <span class="text-danger" id="image_error"></span>
                </div>

                <!-- Image Preview -->
                <div class="mb-3">
                    <img id="package_category_image_previewer" src="#" alt="Image Preview"
                        style="max-width: 250px; display: none; border-radius: 5px; box-shadow: 0 0 8px rgba(0,0,0,0.1);" />
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <span class="text-danger" id="status_error"></span>
                </div>

                <!-- Submit & View Buttons -->
                <div class="d-flex justify-content-between mt-3">
                    <!-- View List Button (Left) -->
                    <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal"
                        data-bs-target="#categoryListModal">
                        <i class="fas fa-list"></i> View Category List
                    </button>

                    <!-- Submit Button (Right) -->
                    <button type="submit" class="btn btn-primary px-4">Create Category</button>
                </div>
            </form>

        </div>
    </div>
</div>










<!-- Category List Modal -->
<div class="modal fade" id="categoryListModal" tabindex="-1" aria-labelledby="categoryListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="categoryListModalLabel"><i class="fas fa-list-alt"></i> Package Category List</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Table of Categories -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="category_list_body">
                            <!-- JS বা Blade দিয়ে লোড হবে -->
                            <tr>
                                <td>1</td>
                                <td>Domestic Tours</td>
                                <td>domestic-tours</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>2025-06-30</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>International Tours</td>
                                <td>international-tours</td>
                                <td><span class="badge bg-danger">Inactive</span></td>
                                <td>2025-06-15</td>
                            </tr>
                            <!-- Real data dynamically append korte paro -->
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>





















<script>
    function packageCategoryPreviewImage(event) {
        const input = event.target;
        const preview = document.getElementById('package_category_image_previewer');

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
</script>
