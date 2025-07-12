<!-- Coupon List Modal -->
<div class="modal fade" id="couponListModal" data-package-id="" tabindex="-1" aria-labelledby="couponListModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="couponListModalLabel">All Package Coupons</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- Active Coupon Table -->
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

        <!-- Trash Coupon Table -->
        <h4 class="mt-4">Trash Coupon Lists</h4>
        <div class="table-responsive">
          <table class="table table-bordered table-hover text-center align-middle" id="modalPackageTrashCouponListTable">
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
            <tbody id="modal_package_trash_coupon_list_body"></tbody>
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
  $('#couponListModal').attr('data-package-id', id);
  let token = localStorage.getItem('token');
  if (!token) return (window.location.href = "/admin/login");

  try {
    let res = await axios.post("/package-coupon-list", { package_id: id }, {
      headers: { Authorization: `Bearer ${token}` }
    });

    let selector = '#modalPackageCouponListTable';
    if ($.fn.DataTable.isDataTable(selector)) {
      $(selector).DataTable().clear().destroy();
    }

    let tableBody = $('#modal_package_coupon_list_body').empty();
    let lists = res.data.PackageCouponLits;
    if(lists.length > 0){
      lists.forEach((item, index) => {
        let statusBadge = item.status === 'active'
          ? `<span class="badge bg-success">Active</span>`
          : `<span class="badge bg-danger">Inactive</span>`;

        let tr = `
          <tr>
            <td>${index + 1}</td>
            <td>${item.coupon_code ? `<span class="badge bg-warning text-dark">${item.coupon_code}</span>` : `<span class="badge bg-secondary">No Coupon</span>`}</td>
            <td>${item.discount_value ? `<span class="badge bg-success">${item.discount_value}%</span>` : `<span class="badge bg-secondary">No Discount</span>`}</td>
            <td>
              <span class="badge bg-info text-dark">
                ${new Date(item.start_date).toLocaleDateString('en-GB')} to
                ${new Date(item.end_date).toLocaleDateString('en-GB')}
                (${Math.round((new Date(item.end_date) - new Date(item.start_date)) / (1000 * 60 * 60 * 24))} days)
              </span>
            </td>
            <td>${statusBadge}</td>
            <td>
              <button class="btn btn-sm btn-warning package_coupon_edit_btn" data-id="${item.id}">Edit</button>
              <button class="btn btn-sm btn-danger package_coupon_delete_btn" data-id="${item.id}">Delete</button>
            </td>
          </tr>`;
        tableBody.append(tr);
      });
    }

    $(selector).DataTable();
    await getCouponTrashLists(id); // ✅ load trash list too

  } catch (error) {
    console.error("Coupon list error:", error);
    $('#modal_package_coupon_list_body').html(`<tr><td colspan="6" class="text-danger">Error loading data</td></tr>`);
  }

  // Edit
  $(document).off('click', '.package_coupon_edit_btn').on('click', '.package_coupon_edit_btn', async function () {
    let id = $(this).data('id');
    $('#packageCouponEditModal').modal('show');
    await packageCouponEditFormFillup(id);
  });

  // Delete (Soft Delete)
  $(document).off('click', '.package_coupon_delete_btn').on('click', '.package_coupon_delete_btn', function () {
    let id = $(this).data('id');
    let package_id = $('#couponListModal').data('package-id');

    Swal.fire({
      title: 'Are you sure?',
      text: "This will soft delete the coupon.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, delete it!'
    }).then(async (result) => {
      if (result.isConfirmed) {
        try {
          let res = await axios.post('/admin/package-coupon/delete', { id }, {
            headers: { Authorization: `Bearer ${token}` }
          });
          Swal.fire('Deleted!', res.data.message, 'success');
          await fillCouponLists(package_id);
        } catch (error) {
          console.error(error);
          Swal.fire('Error!', 'Delete failed.', 'error');
        }
      }
    });
  });
}

// ✅ Trash Coupon Section Loader
async function getCouponTrashLists(id) {
  let token = localStorage.getItem('token');
  if (!token) return (window.location.href = '/admin/login');

  try {
    let res = await axios.post('/admin/package-coupon/trash-list', { id }, {
      headers: { Authorization: `Bearer ${token}` }
    });

    let selector = '#modalPackageTrashCouponListTable';
    if ($.fn.DataTable.isDataTable(selector)) {
      $(selector).DataTable().clear().destroy();
    }

    let trashBody = $('#modal_package_trash_coupon_list_body').empty();
    let trashCoupons = res.data.trashCoupons;

     if (trashCoupons.length > 0){
      trashCoupons.forEach((item, index) => {
        let statusBadge = item.status === 'active'
          ? `<span class="badge bg-success">Active</span>`
          : `<span class="badge bg-danger">Inactive</span>`;

        let tr = `
          <tr>
            <td>${index + 1}</td>
            <td>${item.coupon_code ? `<span class="badge bg-warning text-dark">${item.coupon_code}</span>` : `<span class="badge bg-secondary">No Coupon</span>`}</td>
            <td>${item.discount_value ? `<span class="badge bg-success">${item.discount_value}%</span>` : `<span class="badge bg-secondary">No Discount</span>`}</td>
            <td>
              <span class="badge bg-info text-dark">
                ${new Date(item.start_date).toLocaleDateString('en-GB')} to
                ${new Date(item.end_date).toLocaleDateString('en-GB')}
                (${Math.round((new Date(item.end_date) - new Date(item.start_date)) / (1000 * 60 * 60 * 24))} days)
              </span>
            </td>
            <td>${statusBadge}</td>
            <td>
              <button class="btn btn-sm btn-success trash_coupon_restore_btn" data-id="${item.id}">Restore</button>
              <button class="btn btn-sm btn-danger trash_coupon_permanent_delete_btn" data-id="${item.id}">Delete Permanently</button>
            </td>
          </tr>`;
        trashBody.append(tr);
      });
    }

    $(selector).DataTable();

    // Restore
    $(document).off('click', '.trash_coupon_restore_btn').on('click', '.trash_coupon_restore_btn', async function () {
      let trashId = $(this).data('id');
      try {
        let res = await axios.post('/admin/package-coupon/restore', { id: trashId }, {
          headers: { Authorization: `Bearer ${token}` }
        });
        Swal.fire('Restored!', res.data.message, 'success');
        await fillCouponLists(id);
      } catch (error) {
        console.error(error);
        Swal.fire('Error!', 'Restore failed.', 'error');
      }
    });

    // Permanent Delete
    $(document).off('click', '.trash_coupon_permanent_delete_btn').on('click', '.trash_coupon_permanent_delete_btn', function () {
      let trashId = $(this).data('id');
      Swal.fire({
        title: 'Are you sure?',
        text: "This will permanently delete the coupon!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete permanently!'
      }).then(async (result) => {
        if (result.isConfirmed) {
          try {
            let res = await axios.post('/admin/package-coupon/permanent-delete', { id: trashId }, {
              headers: { Authorization: `Bearer ${token}` }
            });
            Swal.fire('Deleted!', res.data.message, 'success');
            await fillCouponLists(id);
          } catch (error) {
            console.error(error);
            Swal.fire('Error!', 'Permanent delete failed.', 'error');
          }
        }
      });
    });

  } catch (error) {
    console.error('Trash list error:', error);
    $('#modal_package_trash_coupon_list_body').html(`<tr><td colspan="6" class="text-danger">Error loading trash</td></tr>`);
  }
}
</script>
