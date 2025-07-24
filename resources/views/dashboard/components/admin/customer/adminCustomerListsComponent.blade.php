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
                            <th>Added By</th>
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
                        <th scope="col">Added By</th>
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
            let addedBy = ""
            if (customers.length > 0) {
                customers.forEach((cus, index) => {
                    if(cus.admin_id){
                        addedBy = `<span class="badge bg-primary">ADMIN</span>`;
                    }else if(cus.agent_id){
                        addedBy = `<span class="badge bg-success">AGENT</span>`;
                    }
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
                                <td>${addedBy}</td>
                                <td><span class="badge bg-info">${cus.medical_result || 'Pending'}</span></td>
                                <td><span class="badge bg-warning">${cus.e_vissa || 'Pending'}</span></td>
                                <td><span class="badge bg-success">${cus.payment || 'Pending'}</span></td>
                                <td><span class="badge bg-secondary">${cus.approval || 'Pending'}</span></td>
                                <td><img src="${imgSrc}" width="60" height="60" class="rounded-circle" /></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-warning customer_view_btn" data-id="${cus.id}">View</button>
                                        <button class="btn btn-sm btn-success customer_edit_btn" data-id="${cus.id}">Edit</button>
                                        <button class="btn btn-sm btn-danger customer_delete_btn" data-id="${cus.id}">Trash</button>
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

    // Delete Customer
    $(document).off('click', '.customer_delete_btn').on('click', '.customer_delete_btn', async function () {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to undo this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const token = localStorage.getItem('token'); 
                    const res = await axios.post('/admin/customer/delete-by-id', { id: id }, {
                        headers: { Authorization: `Bearer ${token}` }
                    });

                    if (res.data.status === 'success') {
                        Swal.fire('Deleted!', res.data.message, 'success');
                        await adminCustomerListLoad(); 
                        await adminTrashCustomerListLoad();
                    } else {
                        Swal.fire('Failed!', res.data.message || 'Failed to delete.', 'error');
                    }
                } catch (error) {
                    Swal.fire('Error!', 'Something went wrong!', 'error');
                }
            }
        });
    });

}



adminTrashCustomerListLoad();
async function adminTrashCustomerListLoad() {
    let token = localStorage.getItem('token');
    let selector = $('.trashOnlyAdminCustomerListDataTable');
    let tableBody = $('#tashOnlyAdminCustomerListTableBody');

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
            let customers = res.data.trashedCustomers ;
            //console.log(customers);
            //document.querySelector('.total_customer').textContent = customers.length?customers.length:0;
            let addedBy = ""
            if (customers.length > 0) {
                customers.forEach((cus, index) => {
                    if(cus.admin_id){
                        addedBy = `<span class="badge bg-primary">ADMIN</span>`;
                    }else if(cus.agent_id){
                        addedBy = `<span class="badge bg-success">AGENT</span>`;
                    }
                    console.log(cus);
                        const imgSrc = cus.image
                            ? `/upload/dashboard/images/customers/${cus.image}`
                            : `/upload/dashboard/images/customers/default.jpg`;

                        const tr = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${cus.name}</td>
                                <td>${cus.email}</td>
                                <td>${addedBy}</td>
                                <td><span class="badge bg-secondary">${cus.approval || 'Pending'}</span></td>
                                <td><img src="${imgSrc}" width="60" height="60" class="rounded-circle" /></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-danger customer_permanent_delete" data-id="${cus.id}">Per Delete</button>
                                        <button class="btn btn-sm btn-success customer_restore_btn" data-id="${cus.id}">Restore</button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tableBody.append(tr);
                    
                });
            }

            $(selector).DataTable();
        }
    } catch (error) {
        console.error("Customer list load error", error);
    }

    // Restore Customer
    $(document).off('click', '.customer_restore_btn').on('click', '.customer_restore_btn', async function () {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to restore this customer?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!',
            cancelButtonText: 'Cancel'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const token = localStorage.getItem('token');
                    const res = await axios.post('/admin/customer/restore-by-id', { id: id }, {
                        headers: { Authorization: `Bearer ${token}` }
                    });

                    if (res.data.status === 'success') {
                        Swal.fire('Restored!', res.data.message, 'success');
                        await adminCustomerListLoad(); 
                        await adminTrashCustomerListLoad();
                    } else {
                        Swal.fire('Failed!', res.data.message || 'Failed to restore.', 'error');
                    }
                } catch (error) {
                    console.error('error',error);
                    Swal.fire('Error!', 'Something went wrong!', 'error');
                }
            }
        });
    });


    // Permanent Delete Customer
    $(document).off('click', '.customer_permanent_delete').on('click', '.customer_permanent_delete', async function () {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This customer will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete permanently!',
            cancelButtonText: 'Cancel'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const token = localStorage.getItem('token');
                    const res = await axios.post('/admin/customer/permanent-delete', { id: id }, {
                        headers: { Authorization: `Bearer ${token}` }
                    });

                    if (res.data.status === 'success') {
                        Swal.fire('Deleted!', res.data.message, 'success');
                        await adminTrashCustomerListLoad(); // শুধু trash list reload করুন
                    } else {
                        Swal.fire('Failed!', res.data.message || 'Failed to delete.', 'error');
                    }
                } catch (error) {
                    console.error('error', error);
                    Swal.fire('Error!', 'Something went wrong!', 'error');
                }
            }
        });
    });



}
</script>