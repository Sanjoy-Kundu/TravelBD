<!-- ===============================
✅ CSS Styling Section (Put in <head>)
=============================== -->
<style>
    /* Table Head Design */
    table.table th {
        /* background: linear-gradient(to right, #4f83cc, #e0e7f1); */
        color: #222;
        font-weight: 600;
        font-size: 14px;
    }

    /* Table Hover */
    table.table tbody tr:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }

    /* Image Style */
    .package-image {
        border-radius: 6px;
        border: 1px solid #ddd;
        object-fit: cover;
    }

    /* Badge Styling */
    .badge-status-active {
        background-color: #198754;
        color: #fff;
        padding: 6px 10px;
        font-size: 0.75rem;
        border-radius: 5px;
    }

    .badge-status-pending {
        background-color: #dc3545;
        color: #fff;
        padding: 6px 10px;
        font-size: 0.75rem;
        border-radius: 5px;
    }

    .validity-badge {
        font-size: 0.75rem;
        padding: 4px 6px;
    }

    /* Action Buttons */
    .action-btn-group .btn {
        font-size: 0.75rem;
        padding: 5px 10px;
        margin: 2px;
    }

    /* General Alignment */
    .table th, .table td {
        vertical-align: middle !important;
    }

    h2 {
        margin-top: 40px;
        font-weight: 600;
        font-size: 22px;
        color: #333;
    }
</style>

<!-- ===============================
✅ HTML Section (Put in <body>)
=============================== -->
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Package Lists</li>
    </ol>

    <!-- Add New Package Button -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#packageCategoryFormModal">
            <i class="fas fa-plus"></i> Add New Package
        </button>
    </div>

    <!-- Main Package Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle" id="packageListTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Package</th>
                    <th>Image</th>
                    <th>Validity</th>
                    <th>Price (BDT)</th>
                    <th>Coupon</th>
                    <th>Duration</th>
                    <th>Seat (Total/Sold/Left)</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="package_package_list_body">
                <!-- Data will be injected via JS -->
            </tbody>
        </table>
    </div>

    <!-- Trash Table -->
    <div class="table-responsive">
        <h2>Trash Lists</h2>
        <table class="table table-bordered table-hover text-center align-middle" id="packageTrashListTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Package</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Currency</th>
                    <th>Duration</th>
                    <th>Seat</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="package_trash_list_body">
                <!-- Data will be injected via JS -->
            </tbody>
        </table>
    </div>
</div>


<script>
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

            let selector = '#packageListTable';

            if ($.fn.DataTable.isDataTable(selector)) {
                $(selector).DataTable().clear().destroy();
            }

            let tableBody = $('#package_package_list_body');
            tableBody.empty();

            if (res.data.status === "success") {
                let package_lists = res.data.packages;
                //console.log(package_lists)

                if (package_lists.length > 0) {
                   package_lists.forEach((package, index) => {
                    //console.log(package.image)
                    console.log(package)
                    let tr = `
                            <tr>
                            <th>${index+1}</th>
                            <th>${package.package_category.name}</th>
                            <th>${package.title}</th>
                            <th>
                                ${
                                    package.image
                                    ? `<img src="/${package.image}" alt="package Image" width="150" height="150">`
                                    : `<img src="/upload/dashboard/images/packages/default.png" alt="default Image" width="50" height="50">`
                                }
                            </th>
                           <th>
                             <span class="badge bg-success fs-6">${package.start_date ? package.start_date : 'N/A'}</span>
                             <span class="mx-1">to</span><span class="badge bg-danger fs-6">${package.end_date ? package.end_date : 'N/A'}</span>
                            </th>

                            <th>${package.price}</th>
                            <th>
                                <div class="btn-group" role="group" aria-label="Coupon Actions">
                                    <button type="button" class="btn btn-success add_package_coupon_discount_btn" data-id="${package.id}">
                                        <i class="bi bi-plus-circle"></i> ADD
                                    </button>
                                    <button type="button" class="btn btn-primary package_coupon_list_btn" data-id="${package.id}">
                                        <i class="bi bi-card-list"></i> Lists
                                    </button>
                                </div>

                            </th>
                            <th>${package.duration}</th>
                            <th>${package.seat_availability} / ${package.total_sold} / ${package.seat_availability - package.total_sold}</th>

                            <th>${package.status == 'active' ? `<span class="badge text-bg-success">Active</span>` : `<span class="badge text-bg-danger">Pending</span>`}</th>
                            <th>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-danger package_trash_btn"  data-id='${package.id}'>Trash</button>
                                    <button type="button" class="btn btn-warning package_view_btn" data-id='${package.id}'>View</button>
                                    <button type="button" class="btn btn-success package_edit_btn" data-id='${package.id}'>Edit</button>
                                </div>
                            </th>
                        </tr>
                        `

                    tableBody.append(tr);
                });
                }

             

            } 

            $(selector).DataTable();

        } catch (error) {
            console.error("Package package list load error", error);
            $('#package_package_list_body').append(
                '<tr><td colspan="5" class="text-center">Error loading data</td></tr>');
        }

        //packageView
        $(document).on('click', '.package_view_btn', async function() {
            let id = $(this).data('id');
            await fillPackageViewModal(id);
            // modal show
            const modal = new bootstrap.Modal(document.getElementById('packageView'));
            modal.show();
        });


        //package edit
        $(document).on('click', '.package_edit_btn', async function() {
            let id = $(this).data('id');
            await fillPackaUpdateModal(id);
            // modal show
            const modal = new bootstrap.Modal(document.getElementById('updatePackageFormModal'));
            modal.show();
        });


        //package couple discount button 
        // Modal open on button click
        $(document).on('click', '.add_package_coupon_discount_btn', async function() {
            let id = $(this).data('id');
            await packageCouponDiscountForm(id);

            const modalEl = document.getElementById('packageCouponDiscountFormModal');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        });



        // package coupon view package_coupon_list_btn
        $(document).on('click', '.package_coupon_list_btn', async function() {
            let id = $(this).data('id');
            await fillCouponLists(id);
            //modal show
            const modal = new bootstrap.Modal(document.getElementById('couponListModal'));
            modal.show();
        });


        //package trash
        $(document).on('click', '.package_trash_btn', async function() {
            let id = $(this).data('id');
            let token = localStorage.getItem('token');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this soft delete!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6', // Blue
                cancelButtonColor: '#d33', // Red
                confirmButtonText: 'Yes, move to trash!',
                cancelButtonText: 'Cancel'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const res = await axios.post('/admin/package-category/delete', {
                            id: id
                        }, {
                            headers: {
                                Authorization: `Bearer ${token}`
                            }
                        });

                        if (res.data.status === 'success') {
                            Swal.fire(
                                'Trashed!',
                                res.data.message,
                                'success'
                            );

                            await packageListLoadData();
                            await packageTrashListLoadData()
                        } else {
                            Swal.fire('Failed!', res.data.message || 'Failed to delete.',
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




    packageTrashListLoadData();
    async function packageTrashListLoadData() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
            return;
        }

        try {
            let res = await axios.get("/admin/package-trash/lists", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
            console.log(res.data.packages)
            let selector = '#packageTrashListTable';

            if ($.fn.DataTable.isDataTable(selector)) {
                $(selector).DataTable().clear().destroy();
            }

            let tableBody = $('#package_trash_list_body');
            tableBody.empty();

            if (res.data.status === "success") {
                let package_lists = res.data.packages;
                //console.log(package_lists)

                if (package_lists.length === 0) {
                    //tableBody.append('<tr><td colspan="11" class="text-center">No categories found</td></tr>');
                }

                package_lists.forEach((package, index) => {
                    //console.log(package.image)
                    //console.log(package.package_category)
                    let tr = `
                            <tr>
                            <th>${index+1}</th>
                            <th>${package.package_category.name}</th>
                            <th>${package.title}</th>
                            <th>
                                ${
                                    package.image
                                    ? `<img src="/${package.image}" alt="package Image" width="150" height="150">`
                                    : `<img src="/upload/dashboard/images/packages/default.png" alt="default Image" width="50" height="50">`
                                }
                            </th>
                          
                            <th>${package.price}</th>
                            <th>${package.currency}</th>
                            <th>${package.duration}</th>
                            <th>${package.seat_availability}</th>
                            <th>${package.status == 'active' ? `<span class="badge text-bg-success">Active</span>` : `<span class="badge text-bg-danger">Pending</span>`}</th>
                            <th>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-danger trash_package_permanenet_btn"  data-id='${package.id}'>Permanent Delte</button>
                                    <button type="button" class="btn btn-info trash_package_restore_btn"  data-id='${package.id}'>Restore</button>
                                </div>
                            </th>
                        </tr>
                        `
                    tableBody.append(tr);
                });

            } else {
                tableBody.append('<tr><td colspan="5" class="text-center">Failed to load categories</td></tr>');
                console.log(res.data)
            }

            $(selector).DataTable();

        } catch (error) {
            console.error("Package package list load error", error);
            $('#package_package_list_body').append(
                '<tr><td colspan="5" class="text-center">Error loading data</td></tr>');
        }

        // Restore
        $(document).on('click', '.trash_package_restore_btn', async function() {
            let id = $(this).data('id');
            let token = localStorage.getItem('token');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to restore this package?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!',
                cancelButtonText: 'Cancel'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        let res = await axios.post('/admin/package/restore', {
                            id: id
                        }, {
                            headers: {
                                Authorization: `Bearer ${token}`
                            }
                        });

                        if (res.data.status === 'success') {
                            Swal.fire('Restored!', res.data.message, 'success');
                            await packageTrashListLoadData();
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



        //permanent delete
        $(document).on('click', '.trash_package_permanenet_btn', async function() {
            let id = $(this).data('id');
            let token = localStorage.getItem('token');

            Swal.fire({
                title: 'Are you sure?',
                text: "This package will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete permanently!',
                cancelButtonText: 'Cancel'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        let res = await axios.post('/admin/package/permanent-delete', {
                            id: id
                        }, {
                            headers: {
                                Authorization: `Bearer ${token}`
                            }
                        });

                        if (res.data.status === 'success') {
                            Swal.fire('Deleted!', res.data.message, 'success');
                            await packageTrashListLoadData();
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
</script>
