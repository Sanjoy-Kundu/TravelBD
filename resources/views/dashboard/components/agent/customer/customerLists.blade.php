<style>
.loader-overlay {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 10;
  width: 100%;
  height: 100%;
  background: rgba(245, 247, 255, 0.95); /* soft bluish-white for a clean overlay */
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 0.375rem; /* Bootstrap-like rounded corners */
}

.loader {
  width: 50px;
  aspect-ratio: 1;
  display: grid;
}

.loader:before,
.loader:after {
  content: "";
  grid-area: 1/1;
  border-radius: 50%;
  background: #0d6efd; /* Bootstrap Primary Blue - professional look */
  -webkit-mask: repeating-linear-gradient(#ffffff 0 10px, transparent 0 20px);
  mask: repeating-linear-gradient(#ffffff 0 10px, transparent 0 20px);
}

.loader:after {
  -webkit-mask: repeating-linear-gradient(transparent 0 10px, #000 0 20px);
  mask: repeating-linear-gradient(transparent 0 10px, #000 0 20px);
  animation: l36 1.5s infinite ease-in-out;
}

@keyframes l36 {
  0%, 10% {
    transform: rotate(0) translate(0);
  }
  35% {
    transform: rotate(0) translate(100%);
  }
  66% {
    transform: rotate(180deg) translate(100%);
  }
  90%, 100% {
    transform: rotate(180deg) translate(0);
  }
}
</style>

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Total Customers <span>0</span></li>
    </ol>

    <div class="card mb-4 shadow w-100 mx-auto">
        <div class="loader-overlay d-none">
           <div class="loader"></div>
        </div>
        <div class="card-header">
            <i class="fas fa-user-plus"></i>Customer Lists
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="agent_customer_table" width="100%">
                <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Name</th>
                        <th>Passport No</th>
                        <th>Phone</th>
                        <th>Approval</th>
                        <th>Package</th>
                        <th>Payment</th>
                        <th>eVisa</th>
                        <th>Medical</th>
                        <th>Fly</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="agentCustomerListsTableBody">

            </table>

        </div>
    </div>



    
    <div class="card mb-4 shadow w-100 mx-auto mt-5">
        <div class="loader-overlay d-none">
           <div class="loader"></div>
        </div>
        <div class="card-header">
            <i class="fas fa-user-plus"></i>Trash Customer Lists
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="agent_trash_customer_table" width="100%">
                <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Name</th>
                        <th>Passport No</th>
                        <th>Phone</th>
                        <th>Approval</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="agentTrashCustomerListsTableBody">

            </table>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
getCustomerlists();
async function getCustomerlists() {
    let token = localStorage.getItem('token');
    if (!token) {
        window.location.href = '/agent/login';
        return;
    }

    let selector = '#agent_customer_table';
    let tableBody = $('.agentCustomerListsTableBody');

    try {
       // $('#loader').show(); // Show loader
        tableBody.empty(); // Clear body

        let res = await axios.get('/agent/customer/my-lists', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });

        // Destroy existing DataTable if exists
        if ($.fn.DataTable.isDataTable(selector)) {
            $(selector).DataTable().clear().destroy();
        }

        if (res.data.status === "success") {
            let customerLists = res.data.customerLists;

            customerLists.forEach((customer, index) => {
                console.log(customer);
                let tr = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${customer.name ?? 'N/A'}</td>
                        <td>${customer.passport_no ?? 'N/A'}</td>
                        <td>${customer.phone ?? 'N/A'}</td>
                        <td>${customer.approval ?? 'Pending'}</td>
                        <td>${customer.package.title ?? 'N/A'}</td>
                        <td>${customer.payment ?? 'Pending'}</td>
                        <td>${customer.e_vissa ?? 'Pending'}</td>
                        <td>${customer.medical_result ?? 'Pending'}</td>
                        <td>${customer.fly ?? 'Pending'}</td>
                        <td>${formatDate(customer.created_at)}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Actions">
                                <button class="btn btn-info btn-sm agent_customer_view_btn" data-id="${customer.id}">
                                    <i class="bi bi-eye"></i> View
                                </button>
                                <button class="btn btn-success btn-sm agent_customer_edit_btn" data-id="${customer.id}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <button class="btn btn-danger btn-sm agent_customer_delete_btn" data-id="${customer.id}">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                `;

                tableBody.append(tr);
            });
        }

        // Initialize DataTable again
        $(selector).DataTable({
            responsive: true,
            order: [[0, 'asc']],
            pageLength: 10,
            language: {
                searchPlaceholder: "Search customers...",
                search: ""
            }
        });

        //$('#loader').hide(); // Hide loader after done

    } catch (error) {
        console.error('Customer list load error:', error);
        tableBody.html('<tr><td colspan="12" class="text-center text-danger">Failed to load data.</td></tr>');
        $('#loader').hide();
    }

    // View Button
    $(document).on('click', '.agent_customer_view_btn',async function () {
        let id = $(this).data('id');
        //console.log(id);
        await fillCustomerViewModal(id);
        $('#viewCustomerModal').modal('show');
    });


    // Edit Button
    $(document).on('click', '.agent_customer_edit_btn', async function () {
        let id = $(this).data('id');
        await fillCustomerEditModal(id);
        $('#agentCustomerEditModal').modal('show');
    });

    // Delete Button (with confirmation)
    $(document).on('click', '.agent_customer_delete_btn', async function () {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then(async (result) => {
            if (result.isConfirmed) {
                 $('.loader-overlay').removeClass('d-none');
                try {
                    const res = await axios.post('/agent/customer/delete/by/id', { id: id }, {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    });

                    if (res.data.status === 'success') {
                        await getCustomerlists(); // Reload list
                        Swal.fire('Deleted!', res.data.message, 'success');
                        await getCustomerlists(); // Reload list
                        await getTrashCustomerlists(); // Reload list
                    } else {
                        Swal.fire('Failed!', res.data.message || 'Failed to delete.', 'error');
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire('Error!', 'Something went wrong!', 'error');
                }finally{
                    $('.loader-overlay').addClass('d-none');
                }
            }
        });
    });
}

function formatDate(dateStr) {
    let date = new Date(dateStr);
    return date.toLocaleDateString('en-GB'); // format: DD/MM/YYYY
}



//Trash customer lists by agent
getTrashCustomerlists();
async function getTrashCustomerlists() {
    let token = localStorage.getItem('token');
    if (!token) {
        window.location.href = '/agent/login';
        return;
    }

    let selector = '#agent_trash_customer_table';
    let tableBody = $('.agentTrashCustomerListsTableBody');

    try {
       // $('#loader').show(); // Show loader
        tableBody.empty(); // Clear body

        let res = await axios.get('/agent/customer/trash-lists', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });

        // Destroy existing DataTable if exists
        if ($.fn.DataTable.isDataTable(selector)) {
            $(selector).DataTable().clear().destroy();
        }

        if (res.data.status === "success") {
            let customerLists = res.data.trashCustomerLists;

            customerLists.forEach((customer, index) => {
                console.log(customer);
                let tr = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${customer.name ?? 'N/A'}</td>
                        <td>${customer.passport_no ?? 'N/A'}</td>
                        <td>${customer.phone ?? 'N/A'}</td>
                        <td>${customer.approval ?? 'Pending'}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Actions">
                                <button class="btn btn-primary btn-sm agent_customer_restore_btn" data-id="${customer.id}">
                                    <i class="bi bi-arrow-counterclockwise"></i> Restore
                                </button>
                                <button class="btn btn-danger btn-sm agent_customer_permanent_delete_btn" data-id="${customer.id}">
                                    <i class="bi bi-trash"></i> P. Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                `;

                tableBody.append(tr);
            });
        }

        // Initialize DataTable again
        $(selector).DataTable({
            responsive: true,
            order: [[0, 'asc']],
            pageLength: 10,
            language: {
                searchPlaceholder: "Search customers...",
                search: ""
            }
        });

        //$('#loader').hide(); // Hide loader after done

    } catch (error) {
        console.error('Customer list load error:', error);
        tableBody.html('<tr><td colspan="12" class="text-center text-danger">Failed to load data.</td></tr>');
        $('#loader').hide();
    }

    // Restore  Button (with confirmation)
 $(document).on('click', '.agent_customer_restore_btn', async function () {
    let id = $(this).data('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to restore this customer?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restore it!',
        cancelButtonText: 'Cancel'
    }).then(async (result) => {
        if (result.isConfirmed) {
            $('.loader-overlay').removeClass('d-none');
            try {
                const res = await axios.post('/agent/customer/trsh/restore/by/id', { id: id }, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });

                if (res.data.status === 'success') {
                    await getTrashCustomerlists(); // Reload list
                    await getCustomerlists(); // Reload list
                    Swal.fire('Restored!', res.data.message, 'success');
                } else {
                    Swal.fire('Failed!', res.data.message || 'Failed to restore.', 'error');
                }
            } catch (error) {
                console.error(error);
                Swal.fire('Error!', 'Something went wrong!', 'error');
            } finally {
                $('.loader-overlay').addClass('d-none');
            }
        }
    });
});

    // Permanent Delete Button (with confirmation)
    $(document).on('click', '.agent_customer_permanent_delete_btn', async function () {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then(async (result) => {
            if (result.isConfirmed) {
                 $('.loader-overlay').removeClass('d-none');
                try {
                    const res = await axios.post('/agent/customer/permanent/delete/by/id', { id: id }, {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    });

                    if (res.data.status === 'success') {
                         await getTrashCustomerlists(); // Reload list
                         await getCustomerlists(); // Reload list
                        Swal.fire('Deleted!', res.data.message, 'success');
                    } else {
                        Swal.fire('Failed!', res.data.message || 'Failed to delete.', 'error');
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire('Error!', 'Something went wrong!', 'error');
                }finally{
                    $('.loader-overlay').addClass('d-none');
                }
            }
        });
    });
}

</script>
