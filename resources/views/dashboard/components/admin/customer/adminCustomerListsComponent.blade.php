<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Customer Lists: <span class="total_customer">0</span></li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Customer Lists Information</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered onlycustomerListDataTable">
                <thead>
                      <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Passport</th>
                            <th>Medical</th>
                            <th>Visa</th>
                            <th>Payment</th>
                            <th>Approval</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                </thead>
                <tbody class="onlycustomerListTableBody"></tbody>
            </table>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h3 class="text-center">All Admin Lists Trash Information</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered trashOnlyAdminCustomerListDataTable">
                <thead>
                    <tr>
                        <th scope="col">Sr No:</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tashOnlyAdminCustomerListTableBody"></tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
adminCustomerListLoad();

async function adminCustomerListLoad() {
    let token = localStorage.getItem('token');
    let selector = $('.onlycustomerListDataTable');
    let tableBody = $('.onlycustomerListTableBody');

    if (!token) {
        window.location.href = "/admin/login";
        return;
    }

    try {
        const res = await axios.get('/admin/customers/lists', {
            headers: { Authorization: `Bearer ${token}` }
        });

        if ($.fn.DataTable.isDataTable(selector)) {
            $(selector).DataTable().clear().destroy();
        }

        tableBody.empty();

        if (res.data.status === 'success') {
            let customers = res.data.customers;
            //console.log(customers);
            document.querySelector('.total_customer').textContent = customers.length?customers.length:0;
            if (customers.length > 0) {
                customers.forEach((cus, index) => {
                    console.log(cus);
                        const imgSrc = cus.image
                            ? `/upload/dashboard/images/customers/${cus.image}`
                            : `/upload/dashboard/images/customers/default.jpg`;

                        const tr = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${cus.name}</td>
                                <td>${cus.email}</td>
                                <td>${cus.phone}</td>
                                <td>${cus.passport_no}</td>
                                <td><span class="badge bg-info">${cus.medical_result || 'Pending'}</span></td>
                                <td><span class="badge bg-warning">${cus.e_vissa || 'Pending'}</span></td>
                                <td><span class="badge bg-success">${cus.payment || 'Pending'}</span></td>
                                <td><span class="badge bg-secondary">${cus.approval || 'Pending'}</span></td>
                                <td><img src="${imgSrc}" width="60" height="60" class="rounded-circle" /></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-warning customer_view_btn" data-id="${cus.id}">View</button>
                                        <button class="btn btn-sm btn-success customer_edit_btn" data-id="${cus.id}">Edit</button>
                                        <button class="btn btn-sm btn-danger customer_delete_btn" data-id="${cus.id}">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tableBody.append(tr);
                    
                });
            } else {
                tableBody.append(`<tr><td colspan="11" class="text-center">No admin-added customers found</td></tr>`);
            }

            $(selector).DataTable();
        }
    } catch (error) {
        console.error("Customer list load error", error);
        tableBody.append('<tr><td colspan="11" class="text-center text-danger">Error loading data</td></tr>');
    }

    // View Customer
    $(document).off('click', '.customer_view_btn').on('click', '.customer_view_btn', async function () {
        const id = $(this).data('id');
        await fillCustomerViewModal(id);
        $('#customerViewModal').modal('show');
    });

    // Edit Customer
    $(document).off('click', '.customer_edit_btn').on('click', '.customer_edit_btn', async function () {
        const id = $(this).data('id');
        await fillCustomerEditModal(id);
        $('#customerEditModal').modal('show');
    });

    // // Delete Customer
    // $(document).off('click', '.customer_delete_btn').on('click', '.customer_delete_btn', async function () {
    //     const id = $(this).data('id');

    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to undo this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!',
    //         cancelButtonText: 'Cancel'
    //     }).then(async (result) => {
    //         if (result.isConfirmed) {
    //             try {
    //                 const res = await axios.post('/admin/customer/delete', { id }, {
    //                     headers: { Authorization: `Bearer ${token}` }
    //                 });

    //                 if (res.data.status === 'success') {
    //                     Swal.fire('Deleted!', res.data.message, 'success');
    //                     await adminCustomerListLoad();
    //                 } else {
    //                     Swal.fire('Failed!', res.data.message || 'Failed to delete.', 'error');
    //                 }
    //             } catch (error) {
    //                 Swal.fire('Error!', 'Something went wrong!', 'error');
    //             }
    //         }
    //     });
    // });
}

</script>