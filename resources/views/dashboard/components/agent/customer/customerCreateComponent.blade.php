<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Customer Add</li>
    </ol>

    <div class="card mb-4 shadow w-100 mx-auto">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user-plus"></i> Agent: Add New Customer
        </div>

        <div class="card-body">
            <form id="agent_customer_form" enctype="multipart/form-data" onsubmit="customerCreate(event)">
                <div class="row">

                    <!-- Agent Id (hidden) -->
                    <div class="col-12 mb-3">
                        <label>Agent Id</label>
                        <input type="number" class="form-control customer_create_by_agent_id" name="agent_id"
                            placeholder="" readonly>
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
                                            <td id="package_documents_required" style="white-space: pre-wrap;"></td>
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
                    <button type="submit" class="btn btn-primary px-4"
                        onclick="agentSubmitCustomer(event)">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    getUserInfo();
    async function getUserInfo() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/agent/login";
        }
        try {
            let res = await axios.get("/auth/agent", {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            })


            if (res.data.status == "success") {
                console.log(res.data.data.id)
                document.querySelector(".customer_create_by_agent_id").value = res.data.data.id;
            }
        } catch (error) {
            // middleware error check 
            if (error.response && error.response.status === 401) {
                alert(error.response.data.message); // "Unauthorized"
                //  Token invalid → redirect to login
                localStorage.removeItem('token');
                window.location.href = "/agent/login";
            } else {
                alert("Something went wrong!");
                console.error("Unexpected error:", error);
            }
        }
    }




    //get show category lists 
    async function getAgentCategoryLists() {
        const token = localStorage.getItem('token');
        if (!token) {
            return window.location.href = "/agent/login";
        }

        try {
            const res = await axios.get('/category-all/lists', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (res.data.status === 'success') {
                console.log(res.data);
                const categories = res.data.PackageCategories;
                const select = document.querySelector('.package_categories_dropdown');

                // Clear and insert first default option
                select.innerHTML = '<option value="">Select Category</option>';

                // Add each category
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
    getAgentCategoryLists();

    // load packge by categoy lists
    $(document).ready(function() {
        $('.package_categories_dropdown').on('change', async function() {
            let category_id = $(this).val();
            let token = localStorage.getItem('token');

            //reset pakcage dropdown 
            let packageDropdown = $('.customer_create_component_available_packages_dropdown');
            packageDropdown.empty();
            packageDropdown.append('<option value="">---Loading---</option>');

            if (!category_id) {
                packageDropdown.empty();
                packageDropdown.append('<option value="">Select Category First</option>');
            }
            try {
                let res = await axios.post('/agent/package/lists/by/category/details', {
                    category_id: category_id
                }, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                let packages = res.data.packageListByCategory;
                packageDropdown.empty();
                packageDropdown.append('<option value="">Select Package</option>');
                packages.forEach(function(package) {
                    packageDropdown.append(
                        `<option value="${package.id}">${package.title}</option>`);
                })
            } catch (error) {
                if (error.response.data.status === 'error') {
                    packageDropdown.empty();
                    packageDropdown.append(
                        '<option value="" style="background-color:red;color:white">Package are not available please chose another</option>'
                    );
                }
            }
            //console.log(category_id);
        })
    })


    //package details by package id
    $(document).ready(function() {
        $('.customer_create_component_available_packages_dropdown').on('change', async function() {
            let id = $(this).val();
            let token = localStorage.getItem('token');

            if (!token) {
                window.location.href = '/agent/login';
            }

            try {
                let res = await axios.post('/agent/package/lists/details', {
                    id: id
                }, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });
                if (res.data.status === 'success') {
                    $('.purpose_wise_package_section').removeClass('d-none');
                    let packageDetails = res.data.packageDetails
                    $('#start_date').text(packageDetails.start_date);
                    $('#package_title').text(packageDetails.title);
                    $('#end_date').text(packageDetails.end_date);
                    $('#admin_package_price_field').text(parseInt(packageDetails.price));
                    $('#package_duration').text(packageDetails.duration);

                    if (packageDetails.inclusions) {
                        let inclusionsArray = packageDetails.inclusions.split(',');
                        let list = '<ol type="i">';
                        inclusionsArray.forEach(function(item) {
                            list += `<li>${item.trim()}</li>`;
                        });
                        list += '</ol>';
                        $('#package_inclusions').html(list);
                    } else {
                        $('#package_inclusions').text('-');
                    }


                    if (packageDetails.exclusions) {
                        let exclusionsArray = packageDetails.exclusions.split(',');
                        let list = '<ol type="i">';
                        exclusionsArray.forEach(function(item) {
                            list += `<li>${item.trim()}</li>`;
                        });
                        list += '</ol>';
                        $('#package_exclusions').html(list);
                    } else {
                        $('#package_exclusions').text('-');
                    }

                    $('#package_visa_processing_time').text(packageDetails.visa_processing_time);


                    if (packageDetails.documents_required) {
                        let documents_requiredArray = packageDetails.documents_required.split(',');
                        let list = '<ol type="i">';
                        documents_requiredArray.forEach(function(item) {
                            list += `<li>${item.trim()}</li>`;
                        });
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


                //console.log(res.data);
            } catch (error) {
                console.error("error message", error);
            }


        })
    })





    // agent sumited customer 
    async function agentSubmitCustomer(event) {
        event.preventDefault();
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/agent/login";
        }
        let errorFields = [
            "customer_name_error",
            "customer_email_error",
            "customer_phone_error",
            "customer_passport_no_error",
            "customer_age_error",
            "customer_date_of_birth_error",
            "customer_gender_error",
            "customer_nid_number_error",
            "customer_purpose_error",
            "customer_package_error",
            "customer_country_error_message",
        ]
        errorFields.forEach(id => {
            document.getElementById(id).innerText = '';
        });
        let agent_id = document.querySelector('.customer_create_by_agent_id').value.trim();
        let name = document.querySelector('#customer_name').value.trim();
        let email = document.querySelector('#customer_email').value.trim();
        let phone = document.querySelector('#customer_phone').value.trim();
        let passport_no = document.querySelector('#customer_passport_no').value.trim();
        let age = document.querySelector('#customer_age').value.trim();
        let date_of_birth = document.querySelector('#customer_date_of_birth').value.trim();
        let gender = document.querySelector('#customer_gender').value.trim();
        let nid_number = document.querySelector('#customer_nid_number').value.trim();
        let package_category_id = document.querySelector('.package_categories_dropdown').value.trim();
        let package_id = document.querySelector('#agent_package_list').value.trim();
        let country = document.querySelector('#customer_country').value.trim();
        let isError = false;

        if (!agent_id) {
            document.querySelector('.customer_create_by_agent_id_error').innerHTML = 'Agent ID is required';
            isError = true;
        }

        if (!name) {
            document.querySelector('#customer_name_error').innerHTML = 'Name is required';
            isError = true;
        }

        if (!email) {
            document.querySelector('#customer_email_error').innerHTML = 'Email is required';
            isError = true;
        }

        if (!phone) {
            document.querySelector('#customer_phone_error').innerHTML = 'Phone Number is required';
            isError = true;
        }

        if (!passport_no) {
            document.querySelector('#customer_passport_no_error').innerHTML = 'Passport Number is required';
            isError = true;
        }

        if (!age) {
            document.querySelector('#customer_age_error').innerHTML = 'Age is required';
            isError = true;
        }

        if (!date_of_birth) {
            document.querySelector('#customer_date_of_birth_error').innerHTML = 'Date of Birth is required';
            isError = true;
        }
        if (!gender) {
            document.querySelector('#customer_gender_error').innerHTML = 'Gender is required';
            isError = true;
        }
        if (!nid_number) {
            document.querySelector('#customer_nid_number_error').innerHTML = 'NID Number is required';
            isError = true;
        }
        if (!package_category_id) {
            document.querySelector('#customer_purpose_error').innerHTML = 'Package Category is required';
            isError = true;
        }
        if (!package_id) {
            document.querySelector('#customer_package_error').innerText = 'Package is required';
            isError = true;
        }

        if (isError) return;

        //using form data 
        let formData = new FormData();
        let customerImageFile = document.getElementById('customer_image')?.files?.[0];
        if (customerImageFile) {
            formData.append('image', customerImageFile);
        }
        let data = {
            agent_id: agent_id,
            name: name,
            email: email,
            phone: phone,
            passport_no: passport_no,
            age: age,
            date_of_birth: date_of_birth,
            gender: gender,
            nid_number: nid_number,
            package_category_id: package_category_id,
            package_id: package_id,
            country: country
        }
        //console.log(data);
        for (let key in data) {
            if (data[key] !== undefined && data[key] !== null) {
                formData.append(key, data[key]);
            }
        }
        try {
            let res = await axios.post('/agent/customer/create', formData, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'multipart/form-data'
                }
            });
            if (res.data.status === 'success') {
                 //await getCustomerlists(); //refresh customer list
                Swal.fire(res.data.message, '', 'success');
                document.querySelector('.purpose_wise_package_section').classList.add('d-none');

                //refresh inpur field 
                document.querySelector('#customer_name').value = '';
                document.querySelector('#customer_email').value = '';
                document.querySelector('#customer_phone').value = '';
                document.querySelector('#customer_passport_no').value = '';
                document.querySelector('#customer_age').value = '';
                document.querySelector('#customer_date_of_birth').value = '';
                document.querySelector('#customer_gender').value = '';
                document.querySelector('#customer_nid_number').value = '';
                document.querySelector('.package_categories_dropdown').value = '';
                document.querySelector('#agent_package_list').value = '';
               // document.querySelector('#customer_country').value = '';
               
            } else {
                console.log(res.data)
            }

        } catch (error) {
            if (error.response && error.response.status === 422) {
                const errors = error.response.data.errors;

                if (errors.name) {
                    document.querySelector('#customer_name_error').innerText = errors.name[0];
                }
                if (errors.email) {
                    document.querySelector('#customer_email_error').innerText = errors.email[0];
                }
                if (errors.phone) {
                    document.querySelector('#customer_phone_error').innerText = errors.phone[0];
                }
                if (errors.passport_no) {
                    document.querySelector('#customer_passport_no_error').innerText = errors.passport_no[0];
                }
                if (errors.age) {
                    document.querySelector('#customer_age_error').innerText = errors.age[0];
                }
                if (errors.date_of_birth) {
                    document.querySelector('#customer_date_of_birth_error').innerText = errors.date_of_birth[0];
                }
                if (errors.gender) {
                    document.querySelector('#customer_gender_error').innerText = errors.gender[0];
                }
                if (errors.nid_number) {
                    document.querySelector('#customer_nid_number_error').innerText = errors.nid_number[0];
                }
                if (errors.package_category_id) {
                    document.querySelector('#customer_purpose_error').innerText = errors.package_category_id[0];
                }
                if (errors.package_id) {
                    document.querySelector('#customer_package_error').innerText = errors.package_id[0];
                }
                if (errors.agent_id) {
                    document.querySelector('.customer_create_by_agent_id_error').innerText = errors.agent_id[0];
                }
            } else {
                console.log("agent customer error", error);
            }
        }
    }
</script>
