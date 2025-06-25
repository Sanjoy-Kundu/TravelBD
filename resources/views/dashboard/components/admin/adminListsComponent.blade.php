<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin Lists</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">All Admin Lists Information</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered adminListDataTable">
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
                <tbody id="adminListTableBody"></tbody>
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
    adminListLoadData()
    async function adminListLoadData() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
        }
        try {
            let res = await axios.get("/admin/lists/all/data", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
            if (res.data.status === "success") {
                //console.log(res.data.admin_lists);
                let tableBody = $('#adminListTableBody')
                tableBody.empty(); // clear previous data
                let admins = res.data.admin_lists

                if (admins.length == 0) {
                    tableBody.append('<tr><td colspan="5" class="text-center">No data found</td></tr>');
                }

                admins.forEach((element, index) => {
                    console.log(element)
                    //console.log("index", index)
                    let deleteButton = '';
                    if (element.is_verified == 0) {
                        deleteButton =
                            `<button type="button" class="btn btn-danger admin_delete_not_verified" data-id="${element.id}">DELETE</button>`;
                    }



                    let tr = `
                        <tr>
                            <th scope="row">${index+1}</th>
                            <td>${element.name}</td>
                            <td>${element.email}</td>
                            <td>
                                ${element.is_verified == 1 ? '<h5 class="badge bg-success">Verified</h5>' : '<h5 class="badge bg-danger">Not Verified</h5>'} OTP - ${element.otp == null ? '<span class="badge bg-success">0</span>' :  element.otp}</td>
                            <td>${element.profile?.profile_image ? 
                                `<img src="/upload/dashboard/images/admin/${element.profile.profile_image}" width="80" height="80" style="object-fit:cover; border-radius:50%;">`
                                : `<img src="/upload/dashboard/images/admin/default.png" width="80" height="80" style="object-fit:cover; border-radius:50%;">`}
                            </td>

                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-warning admin_view_details" data-id="${element.id}" data-bs-toggle="modal" data-bs-target="#viewAdminDetails">View Details</button>
                                ${deleteButton}
                                </div>
                            </td>
                       </tr>
                       `
                    //<button type="button" class="btn btn-danger admin_delete" data-id = ${element.id}>DELETE</button>
                    tableBody.append(tr);
                });
                $('.adminListDataTable').DataTable();





            } else {
                console.log("admin lists error", res.data.message)
            }
        } catch (error) {
            console.error("error", error)
        }




        //admin details view using modal 
        $('.admin_view_details').on('click', async function() {
            let id = $(this).data('id');
            await getViewAdminDetailsModalFillup(id);
            console.log("id", id)
        })


        $(document).on('click', '.admin_delete_not_verified', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This admin account will be permanently deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let token = localStorage.getItem('token');
                    try {
                        const res = await axios.post('/admin/delete-not-verified', {
                            id: id
                        }, {
                            headers: {
                                Authorization: `Bearer ${token}`
                            }
                        });

                        if (res.data.status === 'success') {
                            Swal.fire('Deleted!', res.data.message, 'success');
                            adminListLoadData(); // table reload
                        } else {
                            Swal.fire('Error!', res.data.message || 'Deletion failed.',
                            'error');
                        }
                    } catch (err) {
                        Swal.fire('Error!', 'Server error occurred.', 'error');
                        console.error(err);
                    }
                }
            });
        });


    }
</script>
