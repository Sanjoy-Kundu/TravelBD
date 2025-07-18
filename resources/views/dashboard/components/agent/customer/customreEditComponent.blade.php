<div class="modal fade" id="agentCustomerEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="agentCustomerEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- larger modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agentCustomerEditModalLabel">Customer Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="agent_customer_form" enctype="multipart/form-data">
                    <div class="row">

                        <!-- Customer Id (hidden) -->
                        <div class="col-12 mb-3">
                            <label>Customer Id</label>
                            <input type="number" class="form-control customer_id" name="id" placeholder=""
                                readonly>
                        </div>

                        <div class="col-12 mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="e.g. MD RUBEL SARDER"
                                id="customer_name">
                            <span class="text-danger" id="customer_name_error"></span>
                        </div>

                        <div class="col-12 mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"
                                placeholder="e.g. rubelsarder@gmail.com" id="customer_email">
                            <span class="text-danger" id="customer_email_error"></span>
                        </div>

                        <div class="col-12 mb-3">
                            <label>Upload Image</label>
                            <input type="file" class="form-control" name="image" id="customer_image">
                        </div>

                        <div class="col-12 mb-3">
                            <label>Phone</label>
                            <input type="tel" class="form-control" name="phone" placeholder="e.g. 01700000000"
                                id="customer_phone">
                            <span class="text-danger" id="customer_phone_error"></span>
                        </div>

                        <div class="col-12 mb-3">
                            <label>Passport No</label>
                            <input type="text" class="form-control" name="passport_no" placeholder="e.g. B00588828"
                                id="customer_passport_no">
                            <span class="text-danger" id="customer_passport_no_error"></span>
                        </div>

                        <div class="col-12 mb-3">
                            <label>Age</label>
                            <input type="number" class="form-control" name="age" placeholder="e.g. 28"
                                id="customer_age">
                            <span class="text-danger" id="customer_age_error"></span>
                        </div>

                        <div class="col-12 mb-3">
                            <label>Date Of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth" id="customer_date_of_birth">
                            <span class="text-danger" id="customer_date_of_birth_error"></span>
                        </div>

                        <div class="col-12 mb-3">
                            <label>Gender</label>
                            <select class="form-control" name="gender" id="customer_gender">
                                <option value="">-- Select Gender --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <span class="text-danger" id="customer_gender_error"></span>
                        </div>

                        <div class="col-12 mb-3">
                            <label>NID Number</label>
                            <input type="text" class="form-control" name="nid_number" placeholder="e.g. 1234567890"
                                id="customer_nid_number">
                            <span class="text-danger" id="customer_nid_number_error"></span>
                        </div>

                        <div class="col-12 mb-3">
                            <label>Purpose / Categories</label>
                            <select class="form-control package_categories_dropdown" name="package_category_id">
                                <option value="">Select Purpose</option>
                            </select>
                            <span class="text-danger customer_purpose_error" id="customer_purpose_error"></span>
                        </div>

                        <div class="col-12 mb-3">
                            <label>Available Packages</label>
                            <select class="form-control customer_create_component_available_packages_dropdown"
                                name="package_id" id="agent_package_list">
                                <option value="">Choose Category First</option>
                            </select>
                            <span class="text-danger" id="customer_package_error"></span>
                        </div>

                        <!-- category wise package section -->
                        <div class="col-12 mb-4 d-none purpose_wise_package_section">
                            <div class="card border-info shadow-sm">
                                <div class="card-header bg-info text-white fw-bold">
                                    <i class="fas fa-box-open me-2"></i> Purpose Wise Package Details
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Today Date</th>
                                                <td>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Package Name</th>
                                                <td id="package_title"></td>
                                            </tr>
                                            <tr>
                                                <th>Application Start Date</th>
                                                <td id="start_date"></td>
                                            </tr>
                                            <tr>
                                                <th>Application End Date</th>
                                                <td id="end_date"></td>
                                            </tr>
                                            <tr>
                                                <th>Package Price</th>
                                                <td id="admin_package_price_field"></td>
                                            </tr>
                                            <tr>
                                                <th>Package Duration</th>
                                                <td id="package_duration"></td>
                                            </tr>
                                            <tr>
                                                <th>Inclusions</th>
                                                <td id="package_inclusions" style="white-space: pre-wrap;"></td>
                                            </tr>
                                            <tr>
                                                <th>Exclusions</th>
                                                <td id="package_exclusions" style="white-space: pre-wrap;"></td>
                                            </tr>
                                            <tr>
                                                <th>Visa Processing Time</th>
                                                <td id="package_visa_processing_time"></td>
                                            </tr>
                                            <tr>
                                                <th>Documents Required</th>
                                                <td id="package_documents_required" style="white-space: pre-wrap;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Total Seat</th>
                                                <td id="package_seat_availability"></td>
                                            </tr>
                                            <tr>
                                                <th>Sold Seat</th>
                                                <td id="total_sold"></td>
                                            </tr>
                                            <tr>
                                                <th>Available Seat</th>
                                                <td id="available_seat"></td>
                                            </tr>
                                            <tr>
                                                <th>Coupon Discount</th>
                                                <td id="coupon_discount_info">No Discount Applied</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>




                        <div class="col-12 mb-3">
                            <label>Country</label>
                            <input type="text" class="form-control" value="Bangladesh" readonly name="country"
                                id="customer_country">
                            <span class="text-danger" id="customer_country_error_message"></span>
                        </div>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary px-4" onclick="agentUpdateCustomer(event)"
                            id="customer_submit_btn">Create Customer</button>
                    </div>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    async function fillCustomerEditModal(id) {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/agent/login';
            return;
        }
        document.querySelector('.customer_id').value = id;
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
                console.log(customer);
                // সেট করো সাধারণ ইনপুট ফিল্ড
                document.querySelector('#customer_name').value = customer.name ?? '';
                document.querySelector('#customer_email').value = customer.email ?? '';
                document.querySelector('#customer_phone').value = customer.phone ?? '';
                document.querySelector('#customer_passport_no').value = customer.passport_no ?? '';
                document.querySelector('#customer_age').value = customer.age ?? '';
                document.querySelector('#customer_nid_number').value = customer.nid_number ?? '';
                document.querySelector('#customer_gender').value = customer.gender ?? '';
                document.querySelector('#customer_date_of_birth').value = customer.date_of_birth ?? '';

                // ক্যাটাগরি লোড করো
                await getAgentCategoryLists();

                // ক্যাটাগরি সেট করো
                const categoryDropdown = document.querySelector('.package_categories_dropdown');
                categoryDropdown.value = customer.package_category?.id ?? '';

                // প্যাকেজ লোড করো ক্যাটাগরি ভিত্তিতে এবং প্যাকেজ সেট করো
                await loadPackagesByCategory(categoryDropdown.value, customer.package?.id ?? '');
            }
        } catch (error) {
            console.log('error message', error);
        }
    }

    // ক্যাটাগরি লিস্ট লোড করার ফাংশন (তুমি আগেই লিখেছো, ঠিক আছে)
    async function getAgentCategoryLists() {
        const token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/agent/login";
            return;
        }

        try {
            const res = await axios.get('/category-all/lists', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (res.data.status === 'success') {
                const categories = res.data.PackageCategories;
                const select = document.querySelector('.package_categories_dropdown');
                select.innerHTML = '<option value="">Select Category</option>';

                categories.forEach(({
                    id,
                    name
                }) => {
                    const option = document.createElement('option');
                    option.value = id;
                    option.textContent = name;
                    select.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Error loading categories:', error);
        }
    }

    // ক্যাটাগরি অনুযায়ী প্যাকেজ লোড করার ফাংশন
    async function loadPackagesByCategory(categoryId, selectedPackageId = null) {
        let token = localStorage.getItem('token');
        const packageDropdown = $('.customer_create_component_available_packages_dropdown');
        packageDropdown.empty();
        packageDropdown.append('<option value="">---Loading---</option>');

        if (!categoryId) {
            packageDropdown.empty();
            packageDropdown.append('<option value="">Select Category First</option>');
            return;
        }

        try {
            let res = await axios.post('/agent/package/lists/by/category/details', {
                category_id: categoryId
            }, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });

            let packages = res.data.packageListByCategory;
            packageDropdown.empty();
            packageDropdown.append('<option value="">Select Package</option>');
            packages.forEach(pkg => {
                packageDropdown.append(`<option value="${pkg.id}">${pkg.title}</option>`);
            });

            if (selectedPackageId) {
                packageDropdown.val(selectedPackageId);
                packageDropdown.trigger('change');
            }

        } catch (error) {
            packageDropdown.empty();
            packageDropdown.append(
                '<option value="" style="background-color:red;color:white">Package are not available please choose another</option>'
                );
        }
    }

    // ক্যাটাগরি ড্রপডাউন onchange এ প্যাকেজ লোড করা
    $(document).ready(function() {
        $('.package_categories_dropdown').on('change', function() {
            const categoryId = $(this).val();
            loadPackagesByCategory(categoryId);
        });
    });

    // প্যাকেজ ড্রপডাউন onchange এ প্যাকেজ ডিটেইলস দেখানো (তুমি আগেই ভালো করেছো)
    $(document).ready(function() {
        $('.customer_create_component_available_packages_dropdown').on('change', async function() {
            let id = $(this).val();
            let token = localStorage.getItem('token');

            if (!token) {
                window.location.href = '/agent/login';
                return;
            }

            try {
                let res = await axios.post('/agent/package/lists/details', {
                    id
                }, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });

                if (res.data.status === 'success') {
                    $('.purpose_wise_package_section').removeClass('d-none');
                    let packageDetails = res.data.packageDetails;

                    $('#start_date').text(packageDetails.start_date);
                    $('#package_title').text(packageDetails.title);
                    $('#end_date').text(packageDetails.end_date);
                    $('#admin_package_price_field').text(parseInt(packageDetails.price));
                    $('#package_duration').text(packageDetails.duration);

                    if (packageDetails.inclusions) {
                        let inclusionsArray = packageDetails.inclusions.split(',');
                        let list = '<ol type="i">';
                        inclusionsArray.forEach(item => list += `<li>${item.trim()}</li>`);
                        list += '</ol>';
                        $('#package_inclusions').html(list);
                    } else {
                        $('#package_inclusions').text('-');
                    }

                    if (packageDetails.exclusions) {
                        let exclusionsArray = packageDetails.exclusions.split(',');
                        let list = '<ol type="i">';
                        exclusionsArray.forEach(item => list += `<li>${item.trim()}</li>`);
                        list += '</ol>';
                        $('#package_exclusions').html(list);
                    } else {
                        $('#package_exclusions').text('-');
                    }

                    $('#package_visa_processing_time').text(packageDetails.visa_processing_time);

                    if (packageDetails.documents_required) {
                        let documents_requiredArray = packageDetails.documents_required.split(',');
                        let list = '<ol type="i">';
                        documents_requiredArray.forEach(item => list += `<li>${item.trim()}</li>`);
                        list += '</ol>';
                        $('#package_documents_required').html(list);
                    } else {
                        $('#package_documents_required').text('-');
                    }

                    $('#package_seat_availability').text(parseInt(packageDetails
                    .seat_availability));
                    $('#total_sold').text(parseInt(packageDetails.total_sold));
                    $('#available_seat').text(parseInt(packageDetails.seat_availability -
                        packageDetails.total_sold));

                    if (packageDetails.discounts && packageDetails.discounts.length > 0) {
                        let couponDiscounts = packageDetails.discounts.filter(discount => discount
                            .discount_mode === 'coupon');
                        if (couponDiscounts.length > 0) {
                            let discountList = '<ol type="i">';
                            couponDiscounts.forEach(discount => {
                                discountList += `<li>
                                    <strong>Coupon Code:</strong> ${discount.coupon_code}<br>
                                    <strong>Discount:</strong> ${discount.discount_value}%<br>
                                    <strong>Date Validity:</strong> ${discount.start_date} to ${discount.end_date}
                                </li>`;
                            });
                            discountList += '</ol>';
                            $('#coupon_discount_info').html(discountList);
                        } else {
                            $('#coupon_discount_info').text('No Coupon Discount');
                        }
                    } else {
                        $('#coupon_discount_info').text('No Coupon');
                    }
                }
            } catch (error) {
                console.error("error message", error);
            }
        });
    });

    // Update customer function (তুমি আগেই ভালো করেছো)
    async function agentUpdateCustomer(event) {
        event.preventDefault();

        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/agent/login";
            return;
        }

        let formData = new FormData();
        formData.append('id', document.querySelector('.customer_id').value);
        formData.append('name', document.querySelector('#customer_name').value.trim());
        formData.append('email', document.querySelector('#customer_email').value.trim());
        formData.append('phone', document.querySelector('#customer_phone').value.trim());
        formData.append('passport_no', document.querySelector('#customer_passport_no').value.trim());
        formData.append('age', document.querySelector('#customer_age').value.trim());
        formData.append('date_of_birth', document.querySelector('#customer_date_of_birth').value);
        formData.append('gender', document.querySelector('#customer_gender').value);
        formData.append('nid_number', document.querySelector('#customer_nid_number').value.trim());
        formData.append('package_category_id', document.querySelector('.package_categories_dropdown').value);
        formData.append('package_id', document.querySelector(
            '.customer_create_component_available_packages_dropdown').value);
        formData.append('country', document.querySelector('#customer_country').value.trim());

        let imageInput = document.querySelector('#customer_image');
        if (imageInput.files.length > 0) {
            formData.append('image', imageInput.files[0]);
        }

        try {
            const res = await axios.post("/agent/customer/update/by/id", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': `Bearer ${token}`
                }
            });

            if (res.data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: res.data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                document.querySelector('#agent_customer_form').reset();
                $('#agentCustomerEditModal').modal('hide');
                await getCustomerlists();
            }
        } catch (error) {
            if (error.response && error.response.status === 422) {
                let message = '';

                if (error.response.data.errors) {
                    let errors = error.response.data.errors;
                    for (let key in errors) {
                        message += `<b>${key}</b>: ${errors[key][0]}<br>`;
                    }
                } else if (error.response.data.message) {
                    message = error.response.data.message;
                } else {
                    message = 'Validation error occurred.';
                }

                Swal.fire({
                    icon: "error",
                    html: message
                });
            } else if (error.response && error.response.status === 401) {
                Swal.fire({
                    icon: "error",
                    title: "Unauthorized Token",
                });
                localStorage.removeItem('token');
                window.location.href = "/agent/login";
            } else {
                console.log(error);
            }
        }
    }
</script>
