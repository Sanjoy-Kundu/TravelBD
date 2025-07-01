<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Package Category Lists</li>
    </ol>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#packageCategoryFormModal">
            <i class="fas fa-plus"></i> Add New Category
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle" id="packageCategoryTable">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="package_category_list_body">

            </tbody>
        </table>
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
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }


    // Load package categories list with axios + DataTable
    packageListLoadData();

    async function packageListLoadData() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
            return;
        }

        try {
            let res = await axios.get("/admin/package-category/lists", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            let selector = '#packageCategoryTable';

            if ($.fn.DataTable.isDataTable(selector)) {
                $(selector).DataTable().clear().destroy();
            }

            let tableBody = $('#package_category_list_body');
            tableBody.empty();

            if (res.data.status === "success") {
                let package_category_lists = res.data.PackageCategories;

                if (package_category_lists.length === 0) {
                    tableBody.append('<tr><td colspan="5" class="text-center">No categories found</td></tr>');
                } else {
                    package_category_lists.forEach((category, index) => {
                        let statusBadge = category.status === 'active' ?
                            '<span class="badge bg-success">Active</span>' :
                            '<span class="badge bg-danger">Inactive</span>';

                        let tr = `
                    <tr>
                        <td>${category.id}</td>
                        <td>${category.name || ''}</td>
                        <td>${category.slug || ''}</td>
                        <td>
                            ${
                            category.image ? `<img src="/upload/dashboard/images/package-category/${category.image}" alt="Category Image" width="50" height="50">` : 
                                             `<img src="/upload/dashboard/images/package-category/default.png" alt="Category Image" width="50" height="50">` 
                            }
                        </td>

                        <td>${
                            (category.description ? category.description.split(' ').slice(0,3).join(' ') : '') + 
                            (category.description && category.description.split(' ').length > 3 ? '...' : '')}
                        </td>
                        <td>${statusBadge}</td>
                        <td>
                            <button class="btn btn-sm btn-warning package_category_edit_btn" data-id="${category.id}">Edit</button>
                            <button class="btn btn-sm btn-danger package_category_delete_btn" data-id="${category.id}">Delete</button>
                        </td>
                    </tr>
                `;
                        tableBody.append(tr);
                    });
                }

                // ✅ Move these outside the forEach and try block
            } else {
                tableBody.append('<tr><td colspan="5" class="text-center">Failed to load categories</td></tr>');
            }

            $(selector).DataTable();

        } catch (error) {
            console.error("Package category list load error", error);
            $('#package_category_list_body').append(
                '<tr><td colspan="5" class="text-center">Error loading data</td></tr>');
        }

        // ✅ Move these outside try-catch
        $(document).on('click', '.package_category_edit_btn', async function() {
            let id = $(this).data('id');
            $('#packageCategoryEditModal').modal('show');
            await packageCategoryEditModalFormFillup(id);
        })

        $(document).on('click', '.package_category_delete_btn', function() {
            let id = $(this).data('id');
            console.log("Delete button clicked for category with id: " + id);
        })

    }

</script>
