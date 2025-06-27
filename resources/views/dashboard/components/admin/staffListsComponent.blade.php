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
                        <th scope="col">Image</th>
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
                        <th scope="col">Image</th>
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

            // আগের DataTable destroy করে ফেলো যদি থাকে
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
                        console.log(element)
                        let tr = `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${element.name || ''}</td>
                            <td>${element.email || ''}</td>
                            <td>
                                ${element.is_verified == 1 ? '<h5 class="badge bg-success">Verified</h5>' : '<h5 class="badge bg-danger">Not Verified</h5>'} 
                            </td>
                            <td><button class="btn btn-primary">${(element.role || '').toUpperCase()}</button></td>
                            <td>
                                ${element.profile && element.profile.profile_image
                                    ? `<img src="/upload/dashboard/images/admin/${element.profile.profile_image}" width="80" height="80" style="object-fit:cover; border-radius:50%;">`
                                    : `<img src="/upload/dashboard/images/admin/default.png" width="80" height="80" style="object-fit:cover; border-radius:50%;">`}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-warning staff_view_details" data-id="${element.id}" data-bs-toggle="modal" data-bs-target="#viewAdminDetails">View Details</button>
                                  <button type="button" class="btn btn-danger staff_trash_btn" data-id="${element.id}">TRASH</button>
                                </div>
                            </td>
                        </tr>
                    `;
                        tableBody.append(tr);


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
                                            Swal.fire('Deleted!', res.data.message,
                                                'success');
                                            await staffListLoadData(); // table reload
                                            await trashStaffListLoadData
                                        (); //trash table reload

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





                    });
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
                        console.log(element)
                        // let deleteButton = '';
                        // if (element.is_verified == 0) {
                        //     deleteButton =
                        //         ``;
                        // }else{
                        //     deleteButton =`<button type="button" class="btn btn-danger trash_staff_delete" data-id="${element.id}">DELETE</button>`;

                        // }

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
                                ${element.profile && element.profile.profile_image
                                    ? `<img src="/upload/dashboard/images/admin/${element.profile.profile_image}" width="80" height="80" style="object-fit:cover; border-radius:50%;">`
                                    : `<img src="/upload/dashboard/images/admin/default.png" width="80" height="80" style="object-fit:cover; border-radius:50%;">`}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-warning trash_staff_view_details" data-id="${element.id}" data-bs-toggle="modal" data-bs-target="#viewAdminDetails">View Details</button>
    
                                    <button type="button" class="btn btn-primary trash_staff_restore" data-id="${element.id}">RESTORE</button>
                                    <button type="button" class="btn btn-danger trash_staff_delete" data-id="${element.id}">DELETE</button>
                                </div>
                            </td>
                        </tr>
                    `;
                        tableBody.append(tr);
                    });
                }
            } else {
                tableBody.append('<tr><td colspan="7" class="text-center">No data found</td></tr>');
            }

            // এখন DataTable ইনিশিয়ালাইজ করো
            $(selector).DataTable();

        } catch (error) {
            console.error("Staff list load error", error);
        }
    }
</script>
