<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Package Lists</li>
    </ol>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#packagepackageFormModal">
            <i class="fas fa-plus"></i> Add New Package
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle" id="packageListTable">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="package_package_list_body">

            </tbody>
        </table>
    </div>
</div>

<script>
    function packagepackagePreviewImage(event) {
        const input = event.target;
        const preview = document.getElementById('package_package_image_previewer');

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
            let res = await axios.get("/admin/package/lists", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            let selector = '#packagepackageTable';

            if ($.fn.DataTable.isDataTable(selector)) {
                $(selector).DataTable().clear().destroy();
            }

            let tableBody = $('#package_package_list_body');
            tableBody.empty();

            if (res.data.status === "success") {
                let package__lists = res.data.packages;
                console.log(package__lists)

                // if (package__lists.length === 0) {
                //     tableBody.append('<tr><td colspan="5" class="text-center">No categories found</td></tr>');
                // } else {
                //     package__lists.forEach((package, index) => {
                //         let statusBadge = package.status === 'active' ?
                //             '<span class="badge bg-success">Active</span>' :
                //             '<span class="badge bg-danger">Inactive</span>';

                //         let tr = `
                //     <tr>
                //         <td>${package.id}</td>
                //         <td>${package.package_category.name || ''}</td>
                //         <td>${package.title || ''}</td>
                //         <td>${package.slug || ''}</td>
                //         <td>
                //             ${
                //             package.image ? `<img src="/uploadss/dashboard/images/packages${package.image}" alt="package Image" width="50" height="50">` : 
                //                              `<img src="/uploads/dashboard/images/packages/default.png" alt="package Image" width="50" height="50">` 
                //             }
                //         </td>

                //         <td>${
                //             (package.description ? package.description.split(' ').slice(0,3).join(' ') : '') + 
                //             (package.description && package.description.split(' ').length > 3 ? '...' : '')}
                //         </td>
                //         <td>${statusBadge}</td>
                //         <td>
                //             <button class="btn btn-sm btn-warning package_package_edit_btn" data-id="${package.id}">Edit</button>
                //             <button class="btn btn-sm btn-danger package_package_delete_btn" data-id="${package.id}">Trash</button>
                //         </td>
                //     </tr>
                // `;
                //         tableBody.append(tr);
                //     });
                // }

                //  Move these outside the forEach and try block
            } else {
                tableBody.append('<tr><td colspan="5" class="text-center">Failed to load categories</td></tr>');
            }

            $(selector).DataTable();

        } catch (error) {
            console.error("Package package list load error", error);
            $('#package_package_list_body').append(
                '<tr><td colspan="5" class="text-center">Error loading data</td></tr>');
        }

        //  Move these outside try-catch
        // $(document).on('click', '.package_package_edit_btn', async function() {
        //     let id = $(this).data('id');
        //     $('#packagepackageEditModal').modal('show');
        //     await packagepackageEditModalFormFillup(id);
        // })

        // //delete
        // $(document).on('click', '.package_package_delete_btn', function() {
        //     let id = $(this).data('id');
        //     console.log("Delete button clicked for package with id: " + id);

        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this soft delete!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, soft delete it!',
        //         cancelButtonText: 'Cancel'
        //     }).then(async (result) => {
        //         if (result.isConfirmed) {
        //             try {
        //                 const token = localStorage.getItem('token'); 

        //                 const res = await axios.post("/admin/package-package/delete",{id:id}, {
        //                     headers: {
        //                         'Authorization': `Bearer ${token}`
        //                     }
        //                 });

        //                 if (res.data.status === 'success') {
        //                     Swal.fire('Deleted!', res.data.message, 'success');
        //                     // লিস্ট রিফ্রেশ করো
        //                     packageListLoadData();
        //                 } else {
        //                     Swal.fire('Error!', res.data.message || 'Failed to delete',
        //                     'error');
        //                 }
        //             } catch (error) {
        //                 console.error(error);
        //                 Swal.fire('Error!', 'Something went wrong!', 'error');
        //             }
        //         }
        //     });
        // });



    }
</script>
