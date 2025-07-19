<!-- Customer View Modal -->
<!-- Customer Edit Modal -->
<div class="modal fade" id="customerEditModal" tabindex="-1" aria-labelledby="customerEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #8ea9a9; color: white;">
                <h5 class="modal-title" id="customerEditModalLabel">Edit Customer Details</h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="admin_customer_form" enctype="multipart/form-data">
                    <div class="row g-3">

                        <!-- Name -->
                        <div class="col-md-6">
                            <label for="customer_name" class="form-label fw-semibold">Customer Id <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_id" name="id" required>
                            <div class="invalid-feedback" id="customer_id_error"></div>
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label for="customer_name" class="form-label fw-semibold">Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="customer_name" name="name"
                                placeholder="e.g. MD RUBEL SARDER" required>
                            <div class="invalid-feedback" id="customer_name_error"></div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="customer_email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" id="customer_email" name="email"
                                placeholder="e.g. rubelsarder@gmail.com">
                            <div class="invalid-feedback" id="customer_email_error"></div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label for="customer_phone" class="form-label fw-semibold">Phone</label>
                            <input type="tel" class="form-control" id="customer_phone" name="phone"
                                placeholder="e.g. 01700000000">
                            <div class="invalid-feedback" id="customer_phone_error"></div>
                        </div>

                        <!-- Passport No -->
                        <div class="col-md-6">
                            <label for="customer_passport_no" class="form-label fw-semibold">Passport No</label>
                            <input type="text" class="form-control" id="customer_passport_no" name="passport_no"
                                placeholder="e.g. B00588828">
                            <div class="invalid-feedback" id="customer_passport_no_error"></div>
                        </div>

                        <!-- Age -->
                        <div class="col-md-3">
                            <label for="customer_age" class="form-label fw-semibold">Age</label>
                            <input type="number" class="form-control" id="customer_age" name="age"
                                placeholder="e.g. 28" min="1">
                            <div class="invalid-feedback" id="customer_age_error"></div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-3">
                            <label for="customer_date_of_birth" class="form-label fw-semibold">Date of Birth</label>
                            <input type="date" class="form-control" id="customer_date_of_birth" name="date_of_birth">
                            <div class="invalid-feedback" id="customer_date_of_birth_error"></div>
                        </div>

                        <!-- Gender -->
                        <div class="col-md-3">
                            <label for="customer_gender" class="form-label fw-semibold">Gender</label>
                            <select class="form-select" id="customer_gender" name="gender">
                                <option value="" selected>-- Select Gender --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <div class="invalid-feedback" id="customer_gender_error"></div>
                        </div>

                        <!-- NID Number -->
                        <div class="col-md-3">
                            <label for="customer_nid_number" class="form-label fw-semibold">NID Number</label>
                            <input type="text" class="form-control" id="customer_nid_number" name="nid_number"
                                placeholder="e.g. 1234567890">
                            <div class="invalid-feedback" id="customer_nid_number_error"></div>
                        </div>

                        <!-- Upload Image -->
                        <div class="col-md-6">
                            <label for="customer_image" class="form-label fw-semibold">Upload Image</label>
                            <input type="file" class="form-control" id="customer_image" name="image"
                                accept="image/*">
                        </div>

                        <!-- Purpose / Categories -->
                        <div class="col-md-6">
                            <label for="package_categories_dropdown" class="form-label fw-semibold">Purpose /
                                Categories</label>
                            <select class="form-select" id="package_categories_dropdown" name="package_category_id">
                                <option value="">Select Purpose</option>
                                <!-- Options loaded dynamically -->
                            </select>
                            <div class="invalid-feedback" id="customer_purpose_error"></div>
                        </div>

                        <!-- Available Packages -->
                        <div class="col-md-6">
                            <label for="customer_create_component_available_packages_dropdown"
                                class="form-label fw-semibold">Available Packages</label>
                            <select class="form-select" id="customer_create_component_available_packages_dropdown"
                                name="package_id" disabled>
                                <option value="">Choose Category First</option>
                                <!-- Options loaded dynamically -->
                            </select>
                            <div class="invalid-feedback" id="customer_package_error"></div>
                        </div>

                        <!-- Customer Slot -->
                        <div class="col-md-6">
                            <label for="customer_slot" class="form-label fw-semibold">Customer Slot</label>
                            <input type="number" class="form-control" id="customer_slot" name="customer_slot"
                                placeholder="Enter your slot" min="0">
                            <div class="invalid-feedback" id="customer_slot_error_message"></div>
                        </div>

                        <!-- Country -->
                        <div class="col-md-6">
                            <label for="customer_country" class="form-label fw-semibold">Country</label>
                            <input type="text" class="form-control" id="customer_country" name="country"
                                placeholder="e.g. Malaysia-MAS">
                            <div class="invalid-feedback" id="customer_country_error_message"></div>
                        </div>

                        <!-- Company Name -->
                        <div class="col-md-6">
                            <label for="customer_company_name" class="form-label fw-semibold">Company Name</label>
                            <input type="text" class="form-control" id="customer_company_name"
                                name="company_name" placeholder="e.g. RAMLY FOOD PROCESSING">
                            <div class="invalid-feedback" id="customer_company_name_error_message"></div>
                        </div>

                        <!-- PIC -->
                        <div class="col-md-6">
                            <label for="customer_pic" class="form-label fw-semibold">PIC</label>
                            <input type="text" class="form-control" id="customer_pic" name="pic"
                                placeholder="e.g. PIC001">
                            <div class="invalid-feedback" id="customer_pic_error_message"></div>
                        </div>

                        <!-- Medical Date -->
                        <div class="col-md-4">
                            <label for="customer_medical_date" class="form-label fw-semibold">Medical Date</label>
                            <input type="date" class="form-control" id="customer_medical_date"
                                name="medical_date">
                            <div class="invalid-feedback" id="customer_medical_date_error_message"></div>
                        </div>

                        <!-- Medical Center -->
                        <div class="col-md-4">
                            <label for="customer_medical_center" class="form-label fw-semibold">Medical Center</label>
                            <input type="text" class="form-control" id="customer_medical_center"
                                name="medical_center" placeholder="e.g. Green Life Medical">
                            <div class="invalid-feedback" id="customer_medical_center_error_message"></div>
                        </div>

                        <!-- Medical Result -->
                        <div class="col-md-4">
                            <label for="customer_medical_result" class="form-label fw-semibold">Medical Result</label>
                            <input type="text" class="form-control" id="customer_medical_result"
                                name="medical_result" placeholder="e.g. FIT / UNFIT">
                            <div class="invalid-feedback" id="customer_medical_result_error_message"></div>
                        </div>

                        <!-- Status Fields (Visa Online, Calling, Training, etc) -->
                        <div class="col-md-4">
                            <label for="customer_visa_online" class="form-label fw-semibold">Visa Online</label>
                            <select class="form-select" id="customer_visa_online" name="visa_online">
                                <option value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                            </select>
                            <div class="invalid-feedback" id="customer_visa_online_error_message"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="customer_calling" class="form-label fw-semibold">Calling</label>
                            <select class="form-select" id="customer_calling" name="calling">
                                <option value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                            </select>
                            <div class="invalid-feedback" id="customer_calling_error_message"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="customer_training" class="form-label fw-semibold">Training</label>
                            <select class="form-select" id="customer_training" name="training">
                                <option value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                            </select>
                            <div class="invalid-feedback" id="customer_training_error_message"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="customer_e_vissa" class="form-label fw-semibold">E-Vissa</label>
                            <select class="form-select" id="customer_e_vissa" name="e_vissa">
                                <option value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                            </select>
                            <div class="invalid-feedback" id="customer_e_vissa_error_message"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="customer_bmet" class="form-label fw-semibold">BMET</label>
                            <select class="form-select" id="customer_bmet" name="bmet">
                                <option value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                            </select>
                            <div class="invalid-feedback" id="customer_bmet_error_message"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="customer_fly" class="form-label fw-semibold">Fly</label>
                            <select class="form-select" id="customer_fly" name="fly">
                                <option value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                            </select>
                            <div class="invalid-feedback" id="customer_fly_error_message"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="customer_payment" class="form-label fw-semibold">Payment</label>
                            <select class="form-select" id="customer_payment" name="payment">
                                <option value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                            </select>
                            <div class="invalid-feedback" id="customer_payment_error"></div>
                        </div>

                        <!-- Payment Method -->
                        <div class="col-md-4">
                            <label for="customer_payment_method" class="form-label fw-semibold">Method of
                                Payment</label>
                            <select class="form-select" id="customer_payment_method" name="payment_method"
                                onchange="admintoggleAccountField()">
                                <option value="">Select Method</option>
                                <option value="cash">Cash</option>
                                <!-- Other options if needed -->
                            </select>
                            <div class="invalid-feedback" id="customer_payment_method_error_message"></div>
                        </div>

                        <!-- Account Number (conditionally shown) -->
                        <div class="col-md-6 d-none" id="customer_account_number_group">
                            <label for="customer_account_number" class="form-label fw-semibold">Account Number</label>
                            <input type="text" class="form-control" id="customer_account_number"
                                name="account_number" placeholder="e.g. 1234567890">
                            <div class="invalid-feedback" id="customer_account_number_error_message"></div>
                        </div>

                        <!-- Approval -->
                        <div class="col-md-6">
                            <label for="approval" class="form-label fw-semibold">Approval</label>
                            <select class="form-select" id="approval" name="approval">
                                <option value="">Select Approval</option>
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                            </select>
                            <div class="invalid-feedback" id="customer_approval_error_message"></div>
                        </div>

                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary px-4" id="customer_submit_btn">Submit</button>
                    </div>

                </form>
            </div>

            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<script>
    async function fillCustomerEditModal(id) {
        console.log(id);
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/admin/login';
            return;
        }
        try {
            let res = await axios.post('/admin/customer/view/by/random', {
                id: id
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
            if (res.data.status == 'success') {
                let customer = res.data.customer;
                // console.log(customer);
                // Image
                if (customer.image) {
                    document.querySelector('.customer_image').src =
                        `/upload/dashboard/images/customers/${customer.image}`;
                } else {
                    document.querySelector('.customer_image').src =
                        `/upload/dashboard/images/customers/default.jpg`;
                }

                // Set form input values
                document.querySelector('#customer_id').value = customer.id || '';
                document.querySelector('#customer_name').value = customer.name || '';
                document.querySelector('#customer_email').value = customer.email || '';
                document.querySelector('#customer_phone').value = customer.phone || '';
                document.querySelector('#customer_passport_no').value = customer.passport_no || '';
                document.querySelector('#customer_nid_number').value = customer.nid_number || '';
                document.querySelector('#customer_gender').value = customer.gender || '';
                document.querySelector('#customer_age').value = customer.age || '';
                document.querySelector('#customer_date_of_birth').value = customer.date_of_birth || '';
                document.querySelector('#customer_slot').value = customer.customer_slot ?? '';
                document.querySelector('#package_categories_dropdown').value = customer.package_category_id || '';
                document.querySelector('#customer_create_component_available_packages_dropdown').value = customer
                    .package_id || '';
                document.querySelector('#approval').value = customer.approval || '';
                document.querySelector('#customer_payment_method').value = customer.payment_method || '';
                document.querySelector('#customer_company_name').value = customer.company_name || '';
                document.querySelector('#customer_country').value = customer.country || '';
                document.querySelector('#customer_medical_center').value = customer.medical_center || '';
                document.querySelector('#customer_medical_date').value = customer.medical_date || '';
                document.querySelector('#customer_medical_result').value = customer.medical_result || '';
                document.querySelector('#customer_training').value = customer.training || '';
                document.querySelector('#customer_fly').value = customer.fly || '';
                document.querySelector('#customer_visa_online').value = customer.visa_online || '';
                document.querySelector('#customer_calling').value = customer.calling || '';
                document.querySelector('#customer_e_vissa').value = customer.e_vissa || '';
                document.querySelector('#customer_bmet').value = customer.bmet || '';
                document.querySelector('#customer_payment').value = customer.payment || '';
                document.querySelector('#customer_account_number').value = customer.account_number || '';
                document.querySelector('#customer_pic').value = customer.pic || '';

                await loadCategoryListSelectedByCustomerCategoryId(customer.package_category_id);
                await loadPackagesByCategoryId(customer.package_category_id, customer.package_id);

            } else {
                console.log('error', res.data);
            }
        } catch (error) {
            console.log('error', error);
        }
    }


    //load categories list and selecte by value
    async function loadCategoryListSelectedByCustomerCategoryId(selectedCategoryId) {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/admin/login';
            return;
        }

        try {
            let res = await axios.get('/category-all/lists', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            let categories = res.data.PackageCategories;
            let dropdown = document.getElementById('package_categories_dropdown');

            dropdown.innerHTML = '<option value="">Select Purpose</option>'; // Default option

            categories.forEach(category => {
                let option = document.createElement('option');
                option.value = category.id;
                option.text = category.name;

                if (parseInt(selectedCategoryId) === category.id) {
                    option.selected = true;
                }

                dropdown.appendChild(option);
            });

        } catch (error) {
            console.error("Error loading categories:", error);
        }
    }



    //load package by category id
    async function loadPackagesByCategoryId(categoryId, packageId) {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/admin/login';
            return;
        }
        let submitBtn = document.querySelector('#customer_submit_btn');
            submitBtn.disabled = false;
            submitBtn.textContent = 'SUBMIT';
        //console.log('categoryId', categoryId);
        //console.log('package_id', packageId);
        try {
            let res = await axios.post(`/admin/package/lists/by/category`, {
                category_id: categoryId
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
            console.log(res.data);

            if (res.data.status === 'success') {
                let packages = res.data.packageListByCategory;
                let packageDropdown = document.getElementById(
                    'customer_create_component_available_packages_dropdown');

                packageDropdown.innerHTML = '<option value="">Select Package</option>';
                packageDropdown.disabled = false;

                packages.forEach(pkg => {
                    let option = document.createElement('option');
                    option.value = pkg.id;
                    option.text = pkg.title;

                    if (parseInt(pkg.id) === parseInt(packageId)) {
                        option.selected = true;
                    }

                    packageDropdown.appendChild(option);
                });
            }


        } catch (error) {
            submitBtn.disabled = true;
            submitBtn.textContent = error.response.data.message || 'Fail to Submit';
     

            if (error.response && error.response.data && error.response.data.status === 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.response.data.message,
                    confirmButtonText: 'ঠিক আছে'
                });
                
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'কিছু সমস্যা হয়েছে, পরে চেষ্টা করুন।',
                    confirmButtonText: 'ঠিক আছে'
                });
            }
        }
    }
</script>
