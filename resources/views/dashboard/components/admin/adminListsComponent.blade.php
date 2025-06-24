<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin Lists</li>
    </ol>

    <div class="card mb-4 shadow w-100 mx-auto">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user"></i> Admin Lists
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="adminTable" class="table table-striped table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    getAdminLists();
    function getAdminLists() {
         let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
        }
    }
</script>
