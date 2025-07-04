<!-- Modal -->
<div class="modal fade" id="couponListModal" tabindex="-1" aria-labelledby="couponListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="couponListModalLabel">All Package Coupons</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Coupon List Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle" id="modalPackageCouponListTable">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Coupon</th>
                                <th>Discount</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="modal_package_coupon_list_body"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
async function fillCouponLists(id) {
    console.log(id);
    let token = localStorage.getItem('token');
    if (!token) {
        window.location.href = "/admin/login";
        return;
    }

    try {
        let res = await axios.post("/package-coupon-list", { package_id: id }, {
            headers: { 'Authorization': `Bearer ${token}` }
        });

        let selector = '#modalPackageCouponListTable';

        // Destroy old DataTable if exists
        if ($.fn.DataTable.isDataTable(selector)) {
            $(selector).DataTable().clear().destroy();
        }

        let tableBody = $('#modal_package_coupon_list_body');
        tableBody.empty();

        let lists = res.data.PackageCouponLits;

        if (!lists || lists.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'No Coupons Found',
                text: 'This package has no coupons.'
            });

            //tableBody.append(`<tr><td colspan="6" class="text-center text-danger">No data found</td></tr>`);
            //$(selector).DataTable(); // still initialize to avoid DataTable error
            return;
        }

        lists.forEach((item, index) => {
            let statusBadge = item.status === 'active'
                ? `<span class="badge bg-success">Active</span>`
                : `<span class="badge bg-danger">Inactive</span>`;

            let tr = `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.coupon_code
                        ? `<span class="badge bg-warning text-dark">${item.coupon_code}</span>`
                        : `<span class="badge bg-secondary">No Coupon</span>`}</td>
                    <td>${item.discount_value
                        ? `<span class="badge bg-success">${item.discount_value}%</span>`
                        : `<span class="badge bg-secondary">No Discount</span>`}</td>
                    <td>
                        <span class="badge bg-info text-dark">
                            ${new Date(item.start_date).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })}
                            to
                            ${new Date(item.end_date).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })}
                            (${Math.round((new Date(item.end_date) - new Date(item.start_date)) / (1000 * 60 * 60 * 24))} days)
                        </span>
                    </td>
                    <td>${statusBadge}</td>
                    <td>
                        <button class="btn btn-sm btn-warning package_coupon_edit_btn" data-id="${item.id}">Edit</button>
                        <button class="btn btn-sm btn-danger package_coupon_delete_btn" data-id="${item.id}">Delete</button>
                    </td>
                </tr>
            `;
            tableBody.append(tr);
        });

        $(selector).DataTable();

    } catch (error) {
        console.error("Coupon list load error", error);
        $('#modal_package_coupon_list_body').html(
            `<tr><td colspan="6" class="text-center text-danger">Error loading data</td></tr>`
        );
        $(selector).DataTable();
    }

    // Edit
    // $(document).on('click', '.package_coupon_edit_btn', async function () {
    //     let id = $(this).data('id');
    //     $('#packageCouponEditModal').modal('show');
    //     await packageCouponEditFormFillup(id); // define this separately
    // });

    // Delete
    // $(document).on('click', '.package_coupon_delete_btn', function () {
    //     let id = $(this).data('id');

    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "This will soft delete the coupon.",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#dc3545',
    //         cancelButtonColor: '#6c757d',
    //         confirmButtonText: 'Yes, delete it!',
    //         cancelButtonText: 'Cancel'
    //     }).then(async (result) => {
    //         if (result.isConfirmed) {
    //             try {
    //                 let res = await axios.post('/admin/package-coupon/delete', {
    //                     id: id
    //                 }, {
    //                     headers: {
    //                         Authorization: `Bearer ${token}`
    //                     }
    //                 });

    //                 if (res.data.status === 'success') {
    //                     Swal.fire('Deleted!', res.data.message, 'success');
    //                     await fillCouponLists(id); // refresh list after delete
    //                 } else {
    //                     Swal.fire('Failed!', res.data.message || 'Delete failed.', 'error');
    //                 }

    //             } catch (error) {
    //                 console.error(error);
    //                 Swal.fire('Error!', 'Something went wrong.', 'error');
    //             }
    //         }
    //     });
    // });
}
</script>
