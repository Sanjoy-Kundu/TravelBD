<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Agent Lists</li>
    </ol>

    <div class="card mb-5">
        <div class="card-header">
            <h3 class="text-center">All Agent Lists Information</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered agentListDataTable">
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
                <tbody id="agentListTableBody"></tbody>
            </table>
        </div>
    </div>





    <div class="card mb-5">
        <div class="card-header">
            <h3 class="text-center">Trash Agent Lists Information</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered trashagentListDataTable">
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
                <tbody id="trashagentListTableBody"></tbody>
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


    agentListLoadData();
    async function agentListLoadData() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
            return;
        }

        try {
            let res = await axios.get("/all/agents/data", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            let selector = '.agentListDataTable';

            if ($.fn.DataTable.isDataTable(selector)) {
                $(selector).DataTable().clear().destroy();
            }

            let tableBody = $('#agentListTableBody');
            tableBody.empty();

            if (res.data.status === "success") {
                let agent_lists = res.data.agent_lists;

                if (agent_lists.length === 0) {
                    console.log('agent list is empty');
                } else {
                    agent_lists.forEach((element, index) => {
                        console.log(element)
                        let tr = `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${element.name || ''}</td>
                            <td>${element.email || ''}</td>
                            <td>
                                ${element.is_verified == 1 ? '<h5 class="badge bg-success">Verified</h5>' : '<h5 class="badge bg-danger">Not Verified</h5>'} 
                            </td>
                            <td><span class="btn btn-primary">${(element.agent_code || '').toUpperCase()}</span></td>
                            <td>
                                ${element.profile && element.profile.profile_image
                                    ? `<img src="/upload/dashboard/images/admin/${element.profile.profile_image}" width="80" height="80" style="object-fit:cover; border-radius:50%;">`
                                    : `<img src="/upload/dashboard/images/admin/default.png" width="80" height="80" style="object-fit:cover; border-radius:50%;">`}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-warning agent_view_details" data-id="${element.id}" data-bs-toggle="modal" data-bs-target="#viewAgentDetails">View Details</button>
                                  <button type="button" class="btn btn-success agent_trash_btn" data-id="${element.id}">TRASH</button>
                                   ${element.is_verified == 0  ? `<button type="button" class="btn btn-info agent_verified_btn" data-id="${element.id}">Verify Now</button>` 
                                    : `<button class="btn btn-info text-white">VERIFIED</button>`}

                                </div>
                            </td>
                        </tr>
                    `;
                        tableBody.append(tr);
                    });
                     //agent move to trash 
                        $(document).on('click', '.agent_trash_btn', function() {
                            let id = $(this).data('id');
                            console.log("agent id is", id);

                            Swal.fire({
                                title: 'Are you sure?',
                                text: "This agent will be moved to trash.",
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
                                            '/agent/trash', {
                                                id: id
                                            }, {
                                                headers: {
                                                    Authorization: `Bearer ${token}`
                                                }
                                            });

                                        if (res.data.status === 'success') {
                                            Swal.fire('Suspend!', res.data.message,
                                                'success');
                                            await agentListLoadData(); // table reload
                                            await trashagentListLoadData(); //trash table reload

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


                        //agent verify
                        $(document).on('click', '.agent_verified_btn', function() {
                            let id = $(this).data('id');
                            console.log("agent verify id", id);

                            Swal.fire({
                                title: 'Are you sure?',
                                text: "Do you want to verify this agent?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#28a745',
                                cancelButtonColor: '#6c757d',
                                confirmButtonText: 'Yes, verify now'
                            }).then(async (result) => {
                                if (result.isConfirmed) {
                                    let token = localStorage.getItem('token');
                                    try {
                                        const res = await axios.post('/agent/verify', {
                                            id: id
                                        }, {
                                            headers: {
                                                Authorization: `Bearer ${token}`
                                            }
                                        });
                                        if (res.data.status === 'success') {
                                            Swal.fire('Verified!', res.data.message,
                                                'success');
                                            await agentListLoadData(); // table reload
                                            //await trashagentListLoadData();
                                        } else {
                                            Swal.fire('Error!', res.data.message ||
                                                'Verified failed.',
                                                'error');
                                        }
                                    } catch (error) {
                                        Swal.fire('Error!', 'Server error occurred.',
                                            'error');
                                        console.error(err);
                                    }
                                }
                            })

                        })

                        //agent view details 
                        $(document).on('click', '.agent_view_details', async function(){
                            let id = $(this).data('id');
                            await getViewagentDetailsModalFillup(id);

                        })
                }
            } else {
                tableBody.append('<tr><td colspan="7" class="text-center">No data found</td></tr>');
            }


            $(selector).DataTable();

        } catch (error) {
            console.error("agent list load error", error);
        }
    }




    trashagentListLoadData();
    async function trashagentListLoadData() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
            return;
        }

        try {
            let res = await axios.get("/trash/agents/data", {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            let selector = '.trashagentListDataTable';

            //detroy table
            if ($.fn.DataTable.isDataTable(selector)) {
                $(selector).DataTable().clear().destroy();
            }

            let tableBody = $('#trashagentListTableBody');
            tableBody.empty();

            if (res.data.status === "success") {
                let trash_agent_lists = res.data.trashAgentLists;


                if (trash_agent_lists === 0) {
                    console.log('trash agent list is empty');
                } else {
                    trash_agent_lists.forEach((element, index) => {
                        console.log(element);
                        let tr = `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td>${element.name }</td>
                            <td>${element.email }</td>
                            <td>${element.agent_code.toUpperCase()}</td>
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
                                    <button type="button" class="btn btn-primary trash_agent_restore_btn" data-id="${element.id}">RESTORE</button>
                                    <button type="button" class="btn btn-danger trash_agent_delete_btn" data-id="${element.id}">DELETE</button>
                                </div>
                            </td>
                        </tr>
                    `;
                        tableBody.append(tr);
                    });
                    // restore 
                    $(document).on('click', '.trash_agent_restore_btn', function() {
                        let id = $(this).data('id');
                        console.log("agent id is", id);

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "This agent will be restore data.",
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
                                        '/agent/restore', {
                                            id: id
                                        }, {
                                            headers: {
                                                Authorization: `Bearer ${token}`
                                            }
                                        });

                                    if (res.data.status === 'success') {
                                        Swal.fire('agent!', res.data.message,
                                            'success');

                                        await trashagentListLoadData(); //trash table reload
                                        await agentListLoadData(); // table reload


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

                    //trash permanent delte 
                    $(document).on('click', '.trash_agent_delete_btn', function() {
                        let id = $(this).data('id');

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "This agent will be permanently deleted.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, permanently delete'
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                let token = localStorage.getItem('token');
                                try {
                                    const res = await axios.post('/agent/permanent/delete', {
                                        id: id
                                    }, {
                                        headers: {
                                            Authorization: `Bearer ${token}`
                                        }
                                    });

                                    if (res.data.status === 'success') {
                                        Swal.fire('Deleted!', res.data.message, 'success');
                                        await trashagentListLoadData(); // Reload trash
                                        await agentListLoadData();
                                    } else {
                                        Swal.fire('Error!', res.data.message ||
                                            'Deletion failed.', 'error');
                                    }
                                } catch (err) {
                                    Swal.fire('Error!', 'Server error occurred.', 'error');
                                    console.error(err);
                                }
                            }
                        });
                    });


                }
            } else {
                tableBody.append('<tr><td colspan="7" class="text-center">No data found</td></tr>');
            }

            // এখন DataTable ইনিশিয়ালাইজ করো
            $(selector).DataTable();

        } catch (error) {
            console.error("agent list load error", error);
        }
    }
</script>
