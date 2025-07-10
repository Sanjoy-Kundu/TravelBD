<!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="editCustomerForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">Edit Personal Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="customer_edit_image" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" id="customer_edit_image" name="image"
                                accept="image/*" />
                            <span id="customer_edit_image_error" class="text-danger"></span>
                        </div>

                        <div class="col-md-6 d-flex align-items-end">
                            <div class="border rounded-3 shadow-sm p-2 w-50 text-center" style="height: 150px;">
                                <img src="" alt="Preview"
                                    id="editImagePreview"class="img-fluid h-100 rounded-3 object-fit-cover"
                                    style="max-height: 100%; max-width: 100%;" />
                                <small class="text-muted d-block mt-1">Preview</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="customer_edit_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="customer_edit_name" name="name" />
                            <span id="customer_edit_name_error" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="customer_edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="customer_edit_email" name="email"
                                readonly />
                        </div>
                        <div class="col-md-6">
                            <label for="customer_edit_phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="customer_edit_phone" name="phone" />
                            <span id="customer_edit_phone_error" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="customer_edit_passport_no" class="form-label">Passport No</label>
                            <input type="text" class="form-control" id="customer_edit_passport_no"
                                name="passport_no" />
                            <span id="customer_edit_passport_no_error" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="customer_edit_age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="customer_edit_age" name="age" />
                            <span id="customer_edit_age_error" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="customer_edit_gender" class="form-label">Gender</label>
                            <select id="customer_edit_gender" class="form-select" required name="gender">
                                <option value="">---choose one ---</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <span id="customer_edit_gender_error" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="customer_edit_dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="customer_edit_dob" name="date_of_birth" />
                            <span id="customer_edit_dob_error" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="customer_edit_nid_number" class="form-label">NID</label>
                            <input type="text" class="form-control" id="customer_edit_nid_number"
                                name="nid_number" />
                            <span id="customer_edit_nid_number_error" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="customer_edit_country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="customer_edit_country" name="country" />
                            <span id="customer_edit_country_error" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" onclick="onUpdateCustomer(event)">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit button modal --}}



<script>
    // Image Preview Handler
    document.addEventListener("DOMContentLoaded", function() {
        const preview = document.getElementById("editImagePreview");
        preview.src = "/upload/dashboard/images/customers/default.jpg";

        document.getElementById("customer_edit_image").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "/upload/dashboard/images/customer/default.jpg";
            }
        });
    });



    fillCustomerEditModal();
    async function fillCustomerEditModal(id) {
        let token = localStorage.getItem("token");
        if (!token) {
            window.location.href = "/customer/login";
        }

        //console.log(id)
        let res = await axios.post("/customer/package/details-by-id", {
            id: id
        }, {
            headers: {
                Authorization: `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        })
        if (res.data.status == "success") {
            //console.log(res.data.packages.gender)
            // console.log(res.data.packages.package_category.name)

            document.getElementById('editImagePreview').src = res.data.packages.image ?
                `/upload/dashboard/images/customers/${res.data.packages.image}` :
                `/upload/dashboard/images/customers/default.jpg`;
            document.getElementById('customer_edit_name').value = res.data.packages.name ? res.data.packages.name :
                "N/A";
            document.getElementById('customer_edit_email').value = res.data.packages.email ? res.data.packages
                .email : "N/A";
            document.getElementById('customer_edit_age').value = res.data.packages.age ? res.data.packages.age :
                "N/A";
            document.getElementById('customer_edit_country').value = res.data.packages.country ? res.data.packages
                .country : "N/A";
            document.getElementById('customer_edit_phone').value = res.data.packages.phone ? res.data.packages
                .phone : "N/A";
            document.getElementById('customer_edit_nid_number').value = res.data.packages.nid_number ? res.data
                .packages.nid_number : "N/A";

            document.getElementById("customer_edit_gender").value = res.data.packages.gender.toLowerCase() ? res.data.packages.gender.toLowerCase() : '';
            document.getElementById("customer_edit_dob").value = res.data.packages.date_of_birth ? res.data.packages.date_of_birth : '';
            document.getElementById("customer_edit_passport_no").value = res.data.packages.passport_no ? res.data.packages.passport_no : '';

        }

    }




    //update customer
    async function onUpdateCustomer(event) {
        event.preventDefault();

        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/customer/login";
            return;
        }

        // Clear previous errors
        const errorFields = [
            "image", "name", "phone", "passport_no", "age", "gender",
            "date_of_birth", "nid_number", "country"
        ];
        errorFields.forEach(field => {
                const errorSpan = document.getElementById(`customer_edit_${field}_error`);
                if (errorSpan) {
                    errorSpan.innerHTML = '';
                } else {
                    console.warn(`Element not found: customer_edit_${field}_error`);
                }
         });


        let form = document.getElementById('editCustomerForm');
        let formData = new FormData(form);
        let id = document.getElementById("customer_id_for_packageDetails").value;
        formData.append('id', id);

        try {
            let res = await axios.post(`/customer/update/`,formData, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'multipart/form-data'
                }
            });

            if (res.data.status === 'success') {
                console.log(res.data);
                const modal = bootstrap.Modal.getInstance(document.getElementById('editCustomerModal'));
                if (modal) {
                    modal.hide(); // Close the modal
                }
                await getUserPackageDetails(); // Reload customer data
                Swal.fire({
                    title: res.data.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            }else{
                    Swal.fire({
                    title: res.data.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        } catch (error) {
            if (error.response && error.response.status === 422) {
                // Laravel validation error
                let errors = error.response.data.errors;
                Object.keys(errors).forEach(key => {
                    let errorSpan = document.getElementById(`customer_edit_${key}_error`);
                    if (errorSpan) {
                        errorSpan.innerHTML = errors[key][0];
                    }
                });
            } else if (error.response && error.response.status === 401) {
                alert("Unauthorized. Please login again.");
                localStorage.removeItem("token");
                window.location.href = "/customer/login";
            } else {
                alert("Something went wrong!");
                console.error(error);
            }
        }
    }
</script>
