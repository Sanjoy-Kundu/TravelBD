<!-- Customer View Modal -->
<div class="modal fade" id="viewCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="viewCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- larger modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCustomerModalLabel">Customer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="number" name="id" id="id" class="form-control" hidden>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td class="view_name">---</td>
                                <th>Email</th>
                                <td class="view_email">---</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td class="view_phone">---</td>
                                <th>Passport No</th>
                                <td class="view_passport">---</td>
                            </tr>
                            <tr>
                                <th>NID Number</th>
                                <td class="view_nid">---</td>
                                <th>Gender</th>
                                <td class="view_gender">---</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td class="view_dob">---</td>
                                <th>Package ID</th>
                                <td class="view_package_id">---</td>
                            </tr>
                            <tr>
                                <th>Package Category</th>
                                <td class="view_package_category_id">---</td>
                                <th>Created At</th>
                                <td class="view_created_at">---</td>
                            </tr>
                        </tbody>
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
    async function fillCustomerViewModal(id) {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/agent/login';
            return;
        }
        document.getElementById('id').value = id;
        try {
            let res = await axios.post('/agent/customer/details/by/id', {
                id: id
            }, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            });
            if (res.data.status === 'success') {
                let customer = res.data.customer;
                document.querySelector('.view_name').innerText = customer.name ?? '---';
                document.querySelector('.view_email').innerText = customer.email ?? '---';
                document.querySelector('.view_phone').innerText = customer.phone ?? '---';
                document.querySelector('.view_passport').innerText = customer.passport_no ?? '---';
                document.querySelector('.view_nid').innerText = customer.nid_number ?? '---';
                document.querySelector('.view_gender').innerText = customer.gender ?? '---';
                document.querySelector('.view_dob').innerText = customer.date_of_birth ?? '---';
                document.querySelector('.view_package_id').innerText = customer.package_id ?? '---';
                document.querySelector('.view_package_category_id').innerText = customer.package_category_id ?? '---';

                // Optional: format date
                const createdAt = customer.created_at ? new Date(data.created_at).toLocaleString() : '---';
                document.querySelector('.view_created_at').innerText = createdAt;
            }
        } catch (error) {
            console.log('error message', error);
        }
    }
</script>
