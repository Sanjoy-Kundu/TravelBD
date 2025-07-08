<!-- উদাহরণ সহ placeholder যুক্ত -->
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Customer Add (Admin Only)</li>
    </ol>

    <div class="card mb-4 shadow w-100 mx-auto">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-user-plus"></i> Admin: Add New Customer
        </div>

        <div class="card-body">
            <form id="admin_customer_form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label>Admin Id</label>
                        <input type="number" class="form-control" name="admin_id" id="customer_create_by_admin_id"
                            placeholder="Admin id" readonly>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="e.g. MD RUBEL SARDER"
                            id="customer_name">
                        <span class="custoner_name_error" style="color:red" id="customer_name_error"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email"
                            placeholder="e.g. rubelsarder@gmail.com" id="customer_email">
                        <span class="custoner_email_error" style="color:red" id="customer_email_error"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Upload Image</label>
                        <input type="file" class="form-control" name="image" id="customer_image">
                    </div>

                    <div class="col-12 mb-3">
                        <label>Phone</label>
                        <input type="tel" class="form-control" name="phone" placeholder="e.g. 01700000000"
                            id="customer_phone">
                        <span class="customer_phone_error" style="color:red" id="customer_phone_error"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Passport No</label>
                        <input type="text" class="form-control" name="passport_no" placeholder="e.g. B00588828"
                            id="customer_passport_no">
                        <span class="customer_passport_no_error" style="color:red"
                            id="customer_passport_no_error"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Age</label>
                        <input type="number" class="form-control" name="age" placeholder="e.g. 28"
                            id="customer_age">
                        <span class="customer_age_error" style="color:red" id="customer_age_error"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Date Of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth"
                            id="customer_date_of_birth">
                        <span class="customer_date_of_birth_error" style="color:red" id="customer_date_of_birth_error"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Gender</label>
                        <select class="form-control" name="gender" id="customer_gender">
                            <option value="">-- Select Gender --</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <span class="customer_gender_error" style="color:red" id="customer_gender_error"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>NID Number</label>
                        <input type="number" class="form-control" name="nid_number" placeholder="e.g. 28"
                            id="customer_nid_number">
                        <span class="customer_nid_number_error" style="color:red" id="customer_nid_number_error"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Purpose / Categories</label>
                        <select class="form-control" name="package_category_id"
                            id="create_customer_componoent_package_category_dropdown">
                            <option value="">Select Purpose</option>

                        </select>
                        <span class="customer_purpose_error" style="color:red" id="customer_purpose_error"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Available Packages</label>
                        <select class="form-control" name="package_id"
                            id="customer_create_component_available_packages_dropdown">
                            <option value="">Choose Category First</option>
                        </select>
                        <span class="customer_package_error" style="color:red" id="customer_package_error"></span>
                    </div>
                    {{-- purpose wise package  start --}}
                    <!-- Purpose Wise Package - Card Style -->
                    <div class="col-12 mb-4 d-none" id="purpose_wise_package_section">
                        <div class="card border-info shadow-sm">
                            <div class="card-header bg-info text-white fw-bold">
                                <i class="fas fa-box-open me-2"></i>Purpose Wise Package Details
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Package Price</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="price"
                                                id="admin_package_price_field" placeholder="e.g. 450000">
                                            <button type="button" class="btn btn-warning"
                                                onclick="customerCreateUpdatePackagePrice(event)">Update</button>
                                        </div>
                                        <span class="text-danger" id="admin_package_price_error"></span>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Package Duration</label>
                                        <input type="text" class="form-control" name="duration"
                                            placeholder="e.g. 6 Months" readonly id="duration">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Inclusions</label>
                                        <input type="text" class="form-control" name="inclusions"
                                            placeholder="Visa, Ticket, Insurance" readonly id="inclusions">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Exclusions</label>
                                        <input type="text" class="form-control" name="exclusions"
                                            placeholder="Personal Expenses" readonly id="exclusions">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Visa Processing Time</label>
                                        <input type="text" class="form-control" name="visa_processing_time"
                                            placeholder="e.g. 15 Days" readonly id="visa_processing_time">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Documents Required</label>
                                        <input type="text" class="form-control" name="documents_required"
                                            placeholder="Passport, Photo, etc." readonly id="documents_required">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Seat Availability</label>
                                        <input type="text" class="form-control" name="seat_availability"
                                            placeholder="e.g. 20 Seats Left" readonly id="seat_availability">
                                    </div>

                                    <div id="dynamic_coupon_section" class="col-12 mb-3"></div>
                                    {{-- coupon or discount --}}
                                    <div class="col-md-6 mb-3 d-none" id="coupon_code_section">
                                        <label>Write Your Coupon Code</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="coupon_code_input"
                                                placeholder="Enter coupon code">
                                            <button type="button" class="btn btn-warning"
                                                onclick="applyCouponCode()">Apply Your Coupon Code</button>
                                        </div>
                                        <span class="text-success" id="coupon_success_message"
                                            style="display: block; margin-top: 5px;"></span>
                                        <span class="text-danger" id="coupon_error_message"
                                            style="display: block; margin-top: 5px;"></span>
                                    </div>

                                    <div class="col-md-6 mb-3 d-none" id="new_price_section">
                                        <label>Now Your New Price</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="coupon_use_new_price"
                                                placeholder="Enter coupon code" readonly>

                                        </div>
                                        <span class="text-success" id="coupon_success_message"
                                            style="display: block; margin-top: 5px;"></span>
                                        <span class="text-danger" id="coupon_error_message"
                                            style="display: block; margin-top: 5px;"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- purpose wise package end --}}

                    <div class="col-12 mb-3">
                        <label>Country</label>
                        <input type="text" class="form-control" name="country" placeholder="e.g. Malaysia-MAS"
                            id="customer_country">
                        <span class="customer_error text-danger" id="customer_country_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Company Name</label>
                        <input type="text" class="form-control" name="company_name"
                            placeholder="e.g. RAMLY FOOD PROCESSING" id="customer_company_name">
                        <span class="customer_error text-danger" id="customer_company_name_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>PIC</label>
                        <input type="text" class="form-control" name="pic" placeholder="e.g. PIC001"
                            id="customer_pic">
                        <span class="customer_pic_error" id="customer_pic_error_message" style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Sales Commission</label>
                        <input type="text" class="form-control" name="sales_commission" placeholder="e.g. 20,000"
                            id="customer_sales_commission">
                        <span class="customer_sales_commission_error" id="customer_sales_commission_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>MRP(only admin)</label>
                        <input type="text" class="form-control" name="mrp" placeholder="e.g. 4,80,000"
                            id="customer_mrp">
                        <span class="customer_mrp_error" id="customer_mrp_error_message" style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3 d-none">
                        <label>Agent Name</label>
                        <input type="text" class="form-control" name="agent_name" placeholder="e.g. RAJU-MAS">
                        <span class="customer_agent_name_error" id="customer_agent_name_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3 d-none">
                        <label>Agent Code</label>
                        <input type="text" class="form-control" name="agent_code" placeholder="e.g. NJ-AG-01">
                        <span class="customer_agent_code_error" id="customer_agent_code_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3 d-none">
                        <label>Agent Price</label>
                        <input type="text" class="form-control" name="agent_price" placeholder="e.g. 4,50,000">
                        <span class="customer_agent_price_error" id="customer_agent_price_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Passenger Price (only admin)</label>
                        <input type="text" class="form-control" name="passenger_price"
                            placeholder="e.g. 4,80,000" id="customer_passenger_price">
                        <span class="customer_passenger_price_error" id="customer_passenger_price_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Medical Date</label>
                        <input type="date" class="form-control" name="medical_date" id="customer_medical_date">
                        <span class="customer_medical_date_error" id="customer_medical_date_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Medical Center</label>
                        <input type="text" class="form-control" name="medical_center"
                            placeholder="e.g. Green Life Medical" id="customer_medical_center">
                        <span class="customer_medical_center_error" id="customer_medical_center_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Medical Result</label>
                        <input type="text" class="form-control" name="medical_result"
                            placeholder="e.g. FIT / UNFIT" id="customer_medical_result">
                        <span class="customer_medical_result_error" id="customer_medical_result_error_message"
                            style="color:red"></span>
                    </div>

                    <!-- Step Status -->
                    <div class="col-12 mb-3">
                        <label>Visa Online</label>
                        <select class="form-control" name="visa_online" id="customer_visa_online">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_visa_online_error" id="customer_visa_online_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Calling</label>
                        <select class="form-control" name="calling" id="customer_calling">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_calling_error" id="customer_calling_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Training</label>
                        <select class="form-control" name="training" id="customer_training">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_training_error" id="customer_training_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>E-Vissa</label>
                        <select class="form-control" name="e_vissa" id="customer_e_vissa">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_e_vissa_error" id="customer_e_vissa_error_message"
                            style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>BMET</label>
                        <select class="form-control" name="bmet" id="customer_bmet">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_bmet_error" id="customer_bmet_error_message" style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Fly</label>
                        <select class="form-control" name="fly" id="customer_fly">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_fly_error" id="customer_fly_error_message" style="color:red"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Payment</label>
                        <select class="form-control" name="payment" id="customer_payment">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_payment_error" id="customer_payment_error_message"
                            style="color:red"></span>
                    </div>

                    <!-- Payment Summary -->
                    <div class="col-12 mb-3">
                        <label>Method of Payment</label>
                        <select class="form-control" name="payment_method" id="customer_payment_method"
                            onchange="admintoggleAccountField()">
                            <option value="">Select Method</option>
                            <option value="cash">Cash</option>
                            <option value="bank">Bank</option>
                            <option value="wallet">Wallet</option>
                        </select>
                        <span class="customer_payment_method_error" id="customer_payment_method_error_message"
                            style="color:red"></span>
                    </div>

                    <div class="col-12 mb-3 d-none" id="customer_account_number_group">
                        <label>Account Number</label>
                        <input type="text" class="form-control" name="account_number"
                            placeholder="e.g. 1234567890" id="customer_account_number">
                        <span class="customer_account_number_error" id="customer_account_number_error_message"
                            style="color:red"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Approval</label>
                        <select class="form-control" name="approval" id="approval">
                            <option value="">Select approval</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_approval_error" id="customer_approval_error_message"
                            style="color:red"></span>
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4" onclick="customerCreate(event)">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    //set admin id 
    getUserInfo();
    async function getUserInfo() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
        }
        try {
            let res = await axios.get("/user/details/admin", {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            })
            console.log(res.data)

            if (res.data.status == "success") {
                console.log(res.data.data)
                document.getElementById("customer_create_by_admin_id").value = res.data.data.id;
            }
        } catch (error) {
            // middleware error check 
            if (error.response && error.response.status === 401) {
                alert(error.response.data.message); // "Unauthorized"
                //  Token invalid → redirect to login
                localStorage.removeItem('token');
                window.location.href = "/admin/login";
            } else {
                alert("Something went wrong!");
                console.error("Unexpected error:", error);
            }
        }
    }


    //account filed form
    function admintoggleAccountField() {
        let method = document.getElementById('customer_payment_method').value;
        let accountField = document.getElementById('customer_account_number_group');
        let inputField = document.getElementById('customer_account_number');
        if (method === 'bank') {
            accountField.classList.remove('d-none');
            inputField.placeholder = 'Sonali Bank-009874748, Janata Bank-009874748, Pubali Bank-009874748';
        } else if (method === 'wallet') {
            accountField.classList.remove('d-none');
            inputField.placeholder = 'Nagad-017874748, Bkash-018874748, Rocket-019874748';
        } else {
            accountField.classList.add('d-none');
            inputField.placeholder = 'default.......';
        }
    }



    //set category 
    getadminCategoryLists()
    async function getadminCategoryLists() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/admin/login";
        }
        try {

            const res = await axios.get('/admin/package-category/lists', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
            if (res.data.status === 'success') {
                let categories = res.data.PackageCategories;
                let select = document.getElementById('create_customer_componoent_package_category_dropdown');
                select.innerHTML = '<option value="">Select Category</option>';
                categories.forEach(category => {
                    select.innerHTML += `<option value="${category.id}">${category.name}</option>`;
                });
            }

        } catch (error) {
            console.log('error', error)
        }
    }



    // Package show by categories 
    document.getElementById('create_customer_componoent_package_category_dropdown')
        .addEventListener('change', async function() {
            let token = localStorage.getItem('token');
            if (!token) {
                window.location.href = "/admin/login";
            }

            let category_id = this.value;
            console.log(category_id);

            try {
                const res = await axios.post(`/admin/package/lists/by/category`, {
                    category_id: category_id
                }, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });

                if (res.data.status === 'success') {
                    let packages = res.data.packageListByCategory;
                    console.log(packages);


                    let select = document.getElementById(
                        'customer_create_component_available_packages_dropdown');
                    select.innerHTML = '<option value="">Select Package</option>';

                    packages.forEach(package => {
                        //console.log(pkg);
                        select.innerHTML += `<option value="${package.id}">${package.title}</option>`;
                    });
                }
            } catch (error) {
                console.error("Error fetching packages:", error);
            }
        });









    //show package details by id
    document.getElementById('customer_create_component_available_packages_dropdown').addEventListener('change',
        async function() {
            let id = this.value; //packages table id
            //console.log(package_id);
            let token = localStorage.getItem('token');
            //rest inner html data 
            document.getElementById('admin_package_price_error').innerHTML = '';

            document.getElementById('purpose_wise_package_section').classList.remove('d-none');

            try {
                let res = await axios.post('/admin/package/lists/details/by/catgory', {
                    id: id
                }, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                let packageDetails = res.data.packageDetails;
                let currentPrice = packageDetails.price;


                document.querySelector('input[name="price"]').value = packageDetails.price ?? '';
                document.querySelector('input[name="duration"]').value = packageDetails.duration ?? '';
                document.querySelector('input[name="inclusions"]').value = packageDetails.inclusions ?? '';
                document.querySelector('input[name="exclusions"]').value = packageDetails.exclusions ?? '';
                document.querySelector('input[name="visa_processing_time"]').value = packageDetails
                    .visa_processing_time ?? '';
                document.querySelector('input[name="documents_required"]').value = packageDetails
                    .documents_required ?? '';
                document.querySelector('input[name="seat_availability"]').value = packageDetails
                    .seat_availability ?? '';

                // Handle Discounts
                let discounts = packageDetails.discounts || [];
                let couponSection = document.getElementById('dynamic_coupon_section');
                couponSection.innerHTML = ''; // Clear previous content


                let today = new Date().toISOString().slice(0, 10); // Format: YYYY-MM-DD
                let validCoupons = discounts.filter(discount => {
                    return discount.start_date <= today && discount.end_date >= today;
                });


                let hasCoupon = validCoupons.some(discount => discount.coupon_code);
                toggleCouponSections(hasCoupon); // Show/hide coupon input section

                //  Display all valid coupons
                if (validCoupons.length > 0) {
                    validCoupons.forEach((discount, index) => {
                        couponSection.innerHTML += `
                            <div class="row border p-2 mb-2 rounded bg-light">
                                <div class="col-md-3 mb-2">
                                    <label>${discount.coupon_code ? 'Coupon ' + (index + 1) : 'Discount % ' + (index + 1)}</label>
                                    <input type="text" class="form-control" value="${discount.coupon_code ?? 'Only Discount'}" readonly>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Validity</label>
                                    <input type="text" class="form-control" value="${discount.start_date ?? ''} to ${discount.end_date ?? ''}" readonly>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Discount</label>
                                    <input type="text" class="form-control" id="coupon_discounted_price" value="${discount.discount_value ?? 'N/A'}%" readonly>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Current Price</label>
                                    <input type="text" class="form-control" value="${currentPrice}" readonly>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label>Discounted Price</label>
                                    <input type="text" class="form-control" value="${currentPrice - (currentPrice * discount.discount_value / 100)}" readonly>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    // No valid coupon — fallback UI
                    toggleCouponSections(false); // Make sure input section stays hidden
                    couponSection.innerHTML = `
                    <div class="row border p-2 mb-2 rounded bg-light">
                        <div class="col-md-12 mb-2">
                            <label>Discount</label>
                            <input type="text" class="form-control" value="${packageDetails.discount ?? 'No Discount'}" readonly>
                        </div>
                    </div>`;
                }

            } catch (error) {
                console.error("Error fetching packages:", error);
            }

        })








    //package price update
    async function customerCreateUpdatePackagePrice(event) {
        event.preventDefault();
        let token = localStorage.getItem('token');
        if (!token) {
            return alert("Unauthorized. Please login again.");
        }

        let id = document.getElementById("customer_create_component_available_packages_dropdown").value;
        let new_price = document.getElementById("admin_package_price_field").value;

        console.log(id, new_price);
        if (!id) return alert("Please select a package first.");
        if (!new_price || isNaN(new_price)) return alert("Enter a valid price.");

        //console.log(new_price);

        try {
            let res = await axios.post("/admin/package/price/update", {
                id: id,
                price: new_price
            }, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            });

            if (res.data.status === "success") {
                document.getElementById('admin_package_price_error').innerHTML = res.data.message;
            } else {
                console.log("Update failed. " + res.data.message);
            }
        } catch (error) {
            //console.error(error.response.data.message);
            document.getElementById('admin_package_price_error').innerHTML = error.response.data.message;

        }
    }
    //APPLY COUPON SECTION


    //  Apply Coupon Code Function
    async function applyCouponCode() {
        let token = localStorage.getItem('token');
        let coupon_code = document.getElementById('coupon_code_input').value;
        let package_id = document.getElementById('customer_create_component_available_packages_dropdown').value;

        // Clear previous messages
        document.getElementById('coupon_success_message').innerText = '';
        document.getElementById('coupon_error_message').innerText = '';

        if (!coupon_code) {
            document.getElementById('coupon_error_message').innerText = "Please enter a coupon code.";
            return;
        }

        if (!package_id) {
            document.getElementById('coupon_error_message').innerText = "Please select a package first.";
            return;
        }

        try {
            const response = await axios.post("/admin/package/apply-coupon", {
                coupon_code: coupon_code,
                package_id: package_id
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (response.data.status === 'success') {
                console.log(response.data);
                const discount_amount = response.data.discounted_price;
                document.getElementById('coupon_use_new_price').value = discount_amount;
                // document.getElementById('admin_package_price_field').value = new_price;
                document.getElementById('coupon_success_message').innerText =
                    `${response.data.message}: ${discount_amount} Tk`;
                toggleCouponSections(true);
            } else {
                document.getElementById('coupon_error_message').innerText = response.data.message ||
                    'Invalid coupon';
            }
        } catch (error) {
            document.getElementById('coupon_error_message').innerText = error.response?.data?.message ||
                'Something went wrong!';
        }
    }



    document.addEventListener('DOMContentLoaded', () => {
        toggleCouponSections(false); //hide first
    });
    //if coupne toogle then show apply coupon button
    function toggleCouponSections(show) {
        const couponSection = document.getElementById('coupon_code_section');
        const newPriceSection = document.getElementById('new_price_section');

        if (show) {
            couponSection.classList.remove('d-none');
            newPriceSection.classList.remove('d-none');
        } else {
            couponSection.classList.add('d-none');
            newPriceSection.classList.add('d-none');
        }
    }
    //APPLY COUPON SECTION    







    //submit customer
    async function customerCreate(event) {
        let token = localStorage.getItem('token');
        if(!token){
            window.location.href = '/admin/login';
        }
        event.preventDefault();

        // Clear all previous error messages
        document.getElementById('customer_name_error').innerText = '';
        document.getElementById('customer_email_error').innerText = '';
        document.getElementById('customer_phone_error').innerText = '';
        document.getElementById('customer_passport_no_error').innerText = '';
        document.getElementById('customer_age_error').innerText = '';
        document.getElementById('customer_date_of_birth_error').innerText = '';
        document.getElementById('customer_gender_error').innerText = '';
        document.getElementById('customer_nid_number_error').innerText = '';

        document.getElementById('customer_purpose_error').innerText = '';
        document.getElementById('customer_package_error').innerText = '';

        document.getElementById('customer_country_error_message').innerText = '';
        document.getElementById('customer_company_name_error_message').innerText = '';
        document.getElementById('customer_pic_error_message').innerText = '';

        document.getElementById('customer_sales_commission_error_message').innerText = '';
        document.getElementById('customer_mrp_error_message').innerText = '';
        document.getElementById('customer_passenger_price_error_message').innerText = '';
        document.getElementById('customer_medical_date_error_message').innerText = '';
        document.getElementById('customer_medical_center_error_message').innerText = '';
        document.getElementById('customer_medical_result_error_message').innerText = '';


        document.getElementById('customer_visa_online_error_message').innerText = '';
        document.getElementById('customer_calling_error_message').innerText = '';
        document.getElementById('customer_training_error_message').innerText = '';
        document.getElementById('customer_e_vissa_error_message').innerText = '';
        document.getElementById('customer_bmet_error_message').innerText = '';
        document.getElementById('customer_fly_error_message').innerText = '';
        document.getElementById('customer_payment_error_message').innerText = '';
        document.getElementById('customer_payment_method_error_message').innerText = '';
        document.getElementById('customer_account_number_error_message').innerText = '';
        document.getElementById('customer_approval_error_message').innerText = '';

        // Form validation
        let isValid = false;
        let admin_id = document.getElementById('customer_create_by_admin_id').value.trim();
        let name = document.getElementById('customer_name').value.trim();
        let email = document.getElementById('customer_email').value.trim();
        let phone = document.getElementById('customer_phone').value.trim();
        let passportNo = document.getElementById('customer_passport_no').value.trim();
        let age = document.getElementById('customer_age').value.trim();
        let date_of_birth = document.getElementById('customer_date_of_birth').value.trim();
        let gender = document.getElementById('customer_gender').value.trim();
        let customer_nid = document.getElementById('customer_nid_number').value.trim();
        let package_category_id = document.getElementById('create_customer_componoent_package_category_dropdown').value.trim();
        let packageId = document.getElementById('customer_create_component_available_packages_dropdown').value
        .trim();

        let country = document.getElementById('customer_country').value.trim();
        let company_name = document.getElementById('customer_company_name').value.trim();
        let pic = document.getElementById('customer_pic').value.trim();
        let sales_commission = document.getElementById('customer_sales_commission').value.trim();
        let mrp = document.getElementById('customer_mrp').value.trim();
        let customer_price = document.getElementById('customer_passenger_price').value.trim();
        let medical_date = document.getElementById('customer_medical_date').value.trim();
        let medical_center = document.getElementById('customer_medical_center').value.trim();
        let medical_result = document.getElementById('customer_medical_result').value.trim();
        let visa_online = document.getElementById('customer_visa_online').value.trim();
        let calling = document.getElementById('customer_calling').value.trim();
        let training = document.getElementById('customer_training').value.trim();
        let e_vissa = document.getElementById('customer_e_vissa').value.trim();
        let bmet = document.getElementById('customer_bmet').value.trim();
        let fly = document.getElementById('customer_fly').value.trim();
        let payment = document.getElementById('customer_payment').value.trim();
        let payment_method = document.getElementById('customer_payment_method').value.trim();
        let account_number = document.getElementById('customer_account_number').value.trim();
        let approval = document.getElementById('approval').value.trim();
        let couponCode = document.getElementById('coupon_code_input')?.value; //when use coupon
        let discountedPrice = document.getElementById('coupon_use_new_price')?.value; //when use coupon
        let error = false;

        if (!name) {
            document.getElementById('customer_name_error').innerText = 'Name is required';
            error = true;
        }
        if (!email) {
            document.getElementById('customer_email_error').innerText = 'Email is required';
            error = true;
        }
        if (!phone) {
            document.getElementById('customer_phone_error').innerText = 'Phone number is required';
            error = true;
        }
        if (!passportNo) {
            document.getElementById('customer_passport_no_error').innerText = 'Passport number is required';
            error = true;
        }
        if (!age) {
            document.getElementById('customer_age_error').innerText = 'Age is required';
            error = true;
        }

        if (!date_of_birth) {
            document.getElementById('customer_date_of_birth_error').innerText = 'Date field is requried';
            error = true;
        }
        if (!gender) {
            document.getElementById('customer_gender_error').innerText = 'Gender is required';
            error = true;
        }
        if (!customer_nid) {
            document.getElementById('customer_nid_number_error').innerText = 'NID number is required';
            error = true;
        }

        if (!package_category_id) {
            document.getElementById('customer_purpose_error').innerText = 'Choose one Category';
            error = true;
        }
        if (!packageId) {
            document.getElementById('customer_package_error').innerText = 'Package selection is required';
            error = true;
        }

        if (!country) {
            document.getElementById('customer_country_error_message').innerText = 'Country is required';
            error = true;
        }

        if (!company_name) {
            document.getElementById('customer_company_name_error_message').innerText = 'Country is required';
            error = true;
        }

        if (!pic) {
            document.getElementById('customer_pic_error_message').innerText = 'Pic is required';
            error = true;
        }

        if (!sales_commission) {
            document.getElementById('customer_sales_commission_error_message').innerText =
                'Sales Comission is error';
            error = true;
        }

        if (!mrp) {
            document.getElementById('customer_mrp_error_message').innerText = 'MRP is error';
            error = true;
        }
        //passenger price only admin
        if (!customer_price) {
            document.getElementById('customer_passenger_price_error_message').innerText =
            'Passenger Price is error';
            error = true;
        }
        if (!medical_date) {
            document.getElementById('customer_medical_date_error_message').innerText = 'Medical Date is required';
            error = true;
        }
        if (!medical_center) {
            document.getElementById('customer_medical_center_error_message').innerText =
                'Medical Center is required';
            error = true;
        }
        if (!medical_result) {
            document.getElementById('customer_medical_result_error_message').innerText =
                'Medical Result is required';
            error = true;
        }
        if (!visa_online) {
            document.getElementById('customer_visa_online_error_message').innerText = 'Visa Online is required';
            error = true;
        }
        if (!calling) {
            document.getElementById('customer_calling_error_message').innerText = 'Calling is required';
            error = true;
        }

        if (!training) {
            document.getElementById('customer_training_error_message').innerText = 'Training is required';
            error = true;
        }

        if (!e_vissa) {
            document.getElementById('customer_e_vissa_error_message').innerText = 'E Vissa is required';
            error = true;
        }

        if (!bmet) {
            document.getElementById('customer_bmet_error_message').innerText = 'BMET is required';
            error = true;
        }

        if (!fly) {
            document.getElementById('customer_fly_error_message').innerText = 'Fly is required';
            error = true;
        }
        if (!payment) {
            document.getElementById('customer_payment_error_message').innerText = 'Payment is required';
            error = true;
        }
        // console.log('Selected payment method:', payment_method);
        if (payment_method == "") {
            document.getElementById('customer_payment_method_error_message').innerText = 'Please Choose one';
            error = true;
        }
        if (payment_method === 'bank' || payment_method === 'wallet') {
            if (!account_number) {
                document.getElementById('customer_account_number_error_message').innerText =
                    'Account Number is required for bank/wallet payment.';
                error = true;
            }
        }
        if (!approval) {
            document.getElementById('customer_approval_error_message').innerText = 'Approval is required';
            error = true;
        }

        if (error) return;

        // // Form data prepare
        let formData = new FormData();

        let customerImageFile = document.getElementById('customer_image')?.files?.[0];
        if (customerImageFile) {
            formData.append('image', customerImageFile);
        }
        let data = {
            admin_id: admin_id,
            name: name,
            email: email,
            phone: email,
            passportNo: passportNo,
            age: age,
            date_of_birth:date_of_birth,
            gender: gender,
            nid_number:customer_nid,
            package_category_id: package_category_id,
            packageId: packageId,
            country: country,
            company_name: company_name,
            pic: pic,
            sales_commission: sales_commission,
            mrp: mrp,
            customer_price: customer_price,
            medical_date: medical_date,
            medical_center: medical_center,
            medical_result: medical_result,
            visa_online: visa_online,
            calling: calling,
            training: training,
            e_vissa: e_vissa,
            bmet: bmet,
            fly: fly,
            payment: payment,
            payment_method: payment_method,
            account_number: account_number,
            approval: approval,
            couponCode: couponCode,
            discountedPrice: discountedPrice,
        }
        // for(let key in data){
        //     //console.log(key);
        //     if(data[key] !== undefined && data[key] !== null){
        //         formData.append(key, data[key]);
        //     }
        // }
        // console.log("data is",data);
        // for(let [key,value] of formData.entries()){
        //     console.log(`${key} = ${value}`)
        // }
       
        // // Optional: Disable button during submit
        // const submitBtn = document.querySelector('.btn.btn-primary');
        // submitBtn.disabled = true;
        // submitBtn.innerText = 'Submitting...';


        try {
            const response = await axios.post('/admin/customer/create', formData, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'multipart/form-data'
                    
                }
            });

            if (response.data.status === 'success') {
                Swal.fire(response.data.message, '', 'success');
                //alert('✅ Customer created successfully!');
                document.getElementById('admin_customer_form').reset();
                document.getElementById('purpose_wise_package_section').classList.add('d-none');
            } else {
                console.log('❌ Failed: ' + (response.data.message || 'Unknown error'));
            }
        } catch (error) {
            alert('❌ Error: ' + (error.response?.data?.message || error.message));
            console.error(error);
        }
        //  finally {
        //     // Enable button again
        //     submitBtn.disabled = false;
        //     submitBtn.innerText = 'Submit';
        // }
    }
</script>
