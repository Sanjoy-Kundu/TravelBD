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





    <div class="table-responsive">
        <h2>Trash Table</h2>
        <table class="table table-bordered table-hover text-center align-middle" id="packageCategoryTrashTable">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="package_category_trash_list_body">

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

                if(package_category_lists.length> 0){
                    package_category_lists.forEach((category, index) => {
                        let statusBadge = category.status === 'active' ?
                            '<span class="badge bg-success">Active</span>' :
                            '<span class="badge bg-danger">Inactive</span>';

                        let tr = `
                    <tr>
                        <td>${index+1}</td>
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
                            <button class="btn btn-sm btn-danger package_category_delete_btn" data-id="${category.id}">Trash</button>
                        </td>
                    </tr>
                `;
                        tableBody.append(tr);
                    });
                }

                //  Move these outside the forEach and try block
            } 

            $(selector).DataTable();

        } catch (error) {
            console.error("Package category list load error", error);
            $('#package_category_list_body').append(
                '<tr><td colspan="5" class="text-center">Error loading data</td></tr>');
        }

        //  Move these outside try-catch
        $(document).on('click', '.package_category_edit_btn', async function() {
            let id = $(this).data('id');
            $('#packageCategoryEditModal').modal('show');
            await packageCategoryEditModalFormFillup(id);
        })

        //delete
        $(document).on('click', '.package_category_delete_btn', function() {
            let id = $(this).data('id');
            console.log("Delete button clicked for category with id: " + id);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this soft delete!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, soft delete it!',
                cancelButtonText: 'Cancel'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        let token = localStorage.getItem('token');

                        const res = await axios.post("/admin/category/delete", {
                            id: id
                        }, {
                            headers: {
                                'Authorization': `Bearer ${token}`
                            }
                        });

                        if (res.data.status === 'success') {
                            Swal.fire('Deleted!', res.data.message, 'success');
                            // লিস্ট রিফ্রেশ করো
                            await packageListLoadData();
                            await packageTrashLitsData()
                        } else {
                            Swal.fire('Error!', res.data.message || 'Failed to delete',
                                'error');
                        }
                    } catch (error) {
                        console.error(error);
                        Swal.fire('Error!', 'Something went wrong!', 'error');
                    }
                }
            });
        });

    }


    packageTrashLitsData();
    async function packageTrashLitsData() {
            let token = localStorage.getItem('token');
            if (!token) {
                window.location.href = "/admin/login";
                return;
            }

            try {
                let res = await axios.get("/admin/package-category-trash/lists", {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });

                let selector = '#packageCategoryTrashTable';

                if ($.fn.DataTable.isDataTable(selector)) {
                    $(selector).DataTable().clear().destroy();
                }

                let tableBody = $('#package_category_trash_list_body');
                tableBody.empty();

                if (res.data.status === "success") {
                    let trashedCategories = res.data.trashedCategories;
                    console.log(res.data);
                    if (trashedCategories.length === 0) {
                        //tableBody.append('<tr><td colspan="6" class="text-center">No trashed categories found</td></tr>');
                    } 
                        trashedCategories.forEach((category, index) => {
                            let statusBadge = category.status === 'active' ?
                                '<span class="badge bg-success">Active</span>' :
                                '<span class="badge bg-secondary">Inactive</span>';

                            let tr = `
                        <tr>
                            <td>${index+1}</td>
                            <td>${category.name || ''}</td>
                            <td>${category.slug || ''}</td>
                            <td>
                             ${category.image ? `<img src="/upload/dashboard/images/package-category/${category.image}" alt="Category Image" width="50" height="50">` : 
                                             `<img src="/upload/dashboard/images/package-category/default.png" alt="Category Image" width="50" height="50">` 
                            }
                            </td>
                            <td>${statusBadge}</td>
                            <td>
                                <button class="btn btn-sm btn-success package_category_restore_btn" data-id="${category.id}">Restore</button>
                                <button class="btn btn-sm btn-danger package_category_force_delete_btn" data-id="${category.id}">Delete Permanently</button>
                            </td>
                        </tr>
                    `;
                            tableBody.append(tr);
                        });
                    
                } else {
                    tableBody.append(
                        '<tr><td colspan="6" class="text-center">Failed to load trashed categories</td></tr>');
                }

                $(selector).DataTable();

            } catch (error) {
                console.error("Package category trash list load error", error);
                $('#package_category_trash_list_body').append(
                    '<tr><td colspan="6" class="text-center">Error loading data</td></tr>');
            }




            // Restore button handler
            $(document).off('click', '.package_category_restore_btn').on('click', '.package_category_restore_btn',
                async function() {
                    let id = $(this).data('id');
                    let token = localStorage.getItem('token');

                    // SweetAlert Confirm Box
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to restore this category?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, restore it!',
                        cancelButtonText: 'Cancel'
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            try {
                                const res = await axios.post(`/admin/package-category/restore`, {
                                    id: id
                                }, {
                                    headers: {
                                        Authorization: `Bearer ${token}`
                                    }
                                });

                                if (res.data.status === 'success') {
                                    // Success message
                                    await Swal.fire('Restored!', res.data.message, 'success');
                                    await packageTrashLitsData();
                                    await packageListLoadData();
                                } else {
                                    Swal.fire('Failed!', res.data.message || 'Restore failed.',
                                        'error');
                                }
                            } catch (error) {
                                console.error(error);
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        }
                    });
                });

            // Force delete button handler
            $(document).off('click', '.package_category_force_delete_btn').on('click',
                '.package_category_force_delete_btn', async function() {
                    let id = $(this).data('id');
                    let token = localStorage.getItem('token');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This category will be permanently deleted and cannot be recovered!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d', 
                        confirmButtonText: 'Yes, delete permanently!',
                        cancelButtonText: 'Cancel'
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            try {
                                const res = await axios.post("/admin/package-category/permanent-delete",{id:id}, {
                                        headers: {
                                            Authorization: `Bearer ${token}`
                                        }
                                    });

                                if (res.data.status === 'success') {
                                    await Swal.fire('Deleted!', res.data.message, 'success');
                                    await packageTrashLitsData(); // Refresh the trash list
                             
                                } else {
                                    Swal.fire('Failed!', res.data.message || 'Delete failed.',
                                        'error');
                                }
                            } catch (error) {
                                console.error(error);
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        }
                    });
                });

}



            //trash table 
</script>
