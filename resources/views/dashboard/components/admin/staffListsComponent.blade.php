<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Staff Lists</li>
    </ol>

    <div class="card mb-5">
        <div class="card-header">
            <h3 class="text-center">All Staff Lists Information</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered staffListDataTable">
                <thead>
                    <tr>
                        <th scope="col">Sr No:</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="staffListTableBody"></tbody>
            </table>
        </div>
    </div>





    <div class="card mb-5">
        <div class="card-header">
            <h3 class="text-center">Trash Staff Lists Information</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered trashStaffListDataTable">
                <thead>
                    <tr>
                        <th scope="col">Sr No:</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">User Id</th>
                        <th scope="col">Status</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="trashStaffListTableBody"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
    getAuthCheck();

    function getAuthCheck() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
        }
    }


    staffListLoadData();
    async function staffListLoadData() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
            return;
        }

        try {
            let res = await axios.get("/all/staffs/data", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            let selector = '.staffListDataTable';

            if ($.fn.DataTable.isDataTable(selector)) {
                $(selector).DataTable().clear().destroy();
            }

            let tableBody = $('#staffListTableBody');
            tableBody.empty();

            if (res.data.status === "success") {
                let staff_lists = res.data.staff_lists;

                if (staff_lists.length === 0) {
                    console.log('staff list is empty');
                } else {
                    staff_lists.forEach((element, index) => {
                        console.log("staff list element", element)
                        let tr = `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${element.name || ''}</td>
                            <td>${element.email || ''}</td>
                            <td>
                                ${element.is_verified == 1 ? '<h5 class="badge bg-success">Verified</h5>' : '<h5 class="badge bg-danger">Not Verified</h5>'} 
                            </td>
                            <td><span class="btn btn-primary">${(element.role || '').toUpperCase()}</span></td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-warning staff_view_details" data-id="${element.id}" data-bs-toggle="modal" data-bs-target="#viewStaffDetails">View Details</button>
                                  <button type="button" class="btn btn-success staff_trash_btn" data-id="${element.id}">TRASH</button>
                                  <button type="button" class="btn btn-info staff_verified_btn" data-id="${element.id}"></button>
                                   ${element.is_verified == 0  ? `<button type="button" class="btn btn-info staff_verified_btn" data-id="${element.id}">Verify Now</button>` 
                                    : `<button class="btn btn-info text-white">VERIFIED</button>`}

                                </div>
                            </td>
                        </tr>
                    `;
                        tableBody.append(tr);
                    });
                    //staff view details
                    $(document).on('click', '.staff_view_details',async function() {
                        let id = $(this).data('id');
                        //alert(id);
                        await getViewstaffDetailsModalFillup(id)
                    })


                    //staff move to trash 
                    $(document).on('click', '.staff_trash_btn', function() {
                        let id = $(this).data('id');
                        console.log("staff id is", id);

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "This staff will be moved to trash.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, move to Trash'
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                let token = localStorage.getItem('token');
                                try {
                                    const res = await axios.post(
                                        '/staff/trash', {
                                            id: id
                                        }, {
                                            headers: {
                                                Authorization: `Bearer ${token}`
                                            }
                                        });

                                    if (res.data.status === 'success') {
                                        Swal.fire('Suspend!', res.data.message,
                                            'success');
                                        await staffListLoadData(); // table reload
                                        await trashStaffListLoadData(); //trash table reload

                                    } else {
                                        Swal.fire('Error!', res.data.message ||
                                            'Deletion failed.',
                                            'error');
                                    }
                                } catch (err) {
                                    Swal.fire('Error!', 'Server error occurred.',
                                        'error');
                                    console.error(err);
                                }
                            }
                        });
                    });


                    //staff verify
                    $(document).on('click', '.staff_verified_btn', function() {
                        let id = $(this).data('id');
                        console.log("staff verify id", id);

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Do you want to verify this staff?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#28a745',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Yes, verify now'
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                let token = localStorage.getItem('token');
                                try {
                                    const res = await axios.post('/staff/verify', {
                                        id: id
                                    }, {
                                        headers: {
                                            Authorization: `Bearer ${token}`
                                        }
                                    });
                                    if (res.data.status === 'success') {
                                        Swal.fire('Verified!', res.data.message,
                                            'success');
                                        await staffListLoadData(); // table reload
                                        await trashStaffListLoadData();
                                    } else {
                                        Swal.fire('Error!', res.data.message ||
                                            'Verified failed.',
                                            'error');
                                    }
                                } catch (error) {
                                    Swal.fire('Error!', 'Server error occurred.', 'error');
                                    console.error(err);
                                }
                            }
                        })

                    })
                }
            } else {
                tableBody.append('<tr><td colspan="7" class="text-center">No data found</td></tr>');
            }


            $(selector).DataTable();

        } catch (error) {
            console.error("Staff list load error", error);
        }
    }




    trashStaffListLoadData();
    async function trashStaffListLoadData() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
            return;
        }

        try {
            let res = await axios.get("/trash/staffs/data", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            let selector = '.trashStaffListDataTable';

            //আগের DataTable destroy
            if ($.fn.DataTable.isDataTable(selector)) {
                $(selector).DataTable().clear().destroy();
            }

            let tableBody = $('#trashStaffListTableBody');
            tableBody.empty();

            if (res.data.status === "success") {
                let trash_staff_lists = res.data.trashStaffLists;


                if (trash_staff_lists === 0) {
                    console.log('trash staff list is empty');
                } else {
                    trash_staff_lists.forEach((element, index) => {
                        console.log(element);
                        let tr = `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${element.name }</td>
                            <td>${element.email }</td>
                            <td>${element.staff_code.toUpperCase()}</td>
                            <td>
                                ${element.is_verified == 1 ? '<h5 class="badge bg-success">Verified</h5>' : '<h5 class="badge bg-danger">Not Verified</h5>'} 
                            </td>
                            <td><button class="btn btn-primary">${(element.role || '').toUpperCase()}</button></td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-primary trash_staff_restore_btn" data-id="${element.id}">RESTORE</button>
                                    <button type="button" class="btn btn-danger trash_staff_permanent_delete_btn" data-id="${element.id}">PERMANENT DELETE</button>
                                </div>
                            </td>
                        </tr>
                    `;
                        tableBody.append(tr);
                    });



                      // restore 
                        $(document).on('click', '.trash_staff_restore_btn', function() {
                            let id = $(this).data('id');
                            console.log("staff id is", id);

                            Swal.fire({
                                title: 'Are you sure?',
                                text: "This staff will be restore data.",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33  ',
                                confirmButtonText: 'Yes, I want to restore'
                            }).then(async (result) => {
                                if (result.isConfirmed) {
                                    let token = localStorage.getItem('token');
                                    console.log(token);
                                    try {
                                        const res = await axios.post(
                                            '/staff/restore', {
                                                id: id
                                            }, {
                                                headers: {
                                                    Authorization: `Bearer ${token}`
                                                }
                                            });

                                        if (res.data.status === 'success') {
                                            Swal.fire('Staff!', res.data.message,
                                                'success');

                                            await trashStaffListLoadData
                                                (); //trash table reload
                                            await staffListLoadData(); // table reload


                                        } else {
                                            Swal.fire('Error!', res.data.message ||
                                                'Restore failed.',
                                                'error');
                                        }
                                    } catch (err) {
                                        Swal.fire('Error!', 'Server error occurred.',
                                            'error');
                                        console.error(err);
                                    }
                                }
                            });
                        });

                     // permanent delete
                       $(document).on('click', '.trash_staff_permanent_delete_btn', function(){
                        let id = $(this).data('id');
                        //alert(id);
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "Are Your Sure that you want to delete this staff permanently?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33  ',
                                confirmButtonText: 'Confirm Delete'
                            }).then(async (result) => {
                                if (result.isConfirmed) {
                                    let token = localStorage.getItem('token');
                                    console.log(token);
                                    try {
                                        const res = await axios.post(
                                            '/staff/permanent/delete', {
                                                id: id
                                            }, {
                                                headers: {
                                                    Authorization: `Bearer ${token}`
                                                }
                                            });

                                        if (res.data.status === 'success') {
                                            Swal.fire('Staff!', res.data.message,
                                                'success');

                                            await trashStaffListLoadData(); //trash table reload
                                            await staffListLoadData(); // table reload


                                        } else {
                                            Swal.fire('Error!', res.data.message ||
                                                'Restore failed.',
                                                'error');
                                        }
                                    } catch (err) {
                                        Swal.fire('Error!', 'Server error occurred.',
                                            'error');
                                        console.error(err);
                                    }
                                }
                            });
                       })   

                }
            } else {
                tableBody.append('<tr><td colspan="7" class="text-center">No data found</td></tr>');
            }

            // database ninilialize
            $(selector).DataTable();

        } catch (error) {
            console.error("Staff list load error", error);
        }
    }
</script>
