<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Package Lists</li>
    </ol>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#packageCategoryFormModal">
            <i class="fas fa-plus"></i> Add New Package
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle" id="packageListTable">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Package Name</th>
                    <th>Image</th>
                    <th>Short Description</th>
                    <th>Price</th>
                    <th>Currency</th>
                    <th>Duration</th>
                    <th>Seat Ability</th>
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

                let selector = '#packageListTable';

                if ($.fn.DataTable.isDataTable(selector)) {
                    $(selector).DataTable().clear().destroy();
                }

                let tableBody = $('#package_package_list_body');
                tableBody.empty();

                if (res.data.status === "success") {
                    let package_lists = res.data.packages;
                    //console.log(package_lists)

                    if (package_lists.length === 0) {
                        tableBody.append('<tr><td colspan="11" class="text-center">No categories found</td></tr>');
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
                            <th>${package.short_description}</th>
                            <th>${package.price}</th>
                            <th>${package.currency}</th>
                            <th>${package.duration}</th>
                            <th>${package.seat_availability}</th>
                            <th>${package.status == 'active' ? `<span class="badge text-bg-success">Active</span>` : `<span class="badge text-bg-danger">Pending</span>`}</th>
                            <th>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-danger">Left</button>
                                    <button type="button" class="btn btn-warning">Middle</button>
                                    <button type="button" class="btn btn-success">Right</button>
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
    }


                            
</script>
