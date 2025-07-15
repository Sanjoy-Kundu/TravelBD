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
                        <span class="customer_name_error" style="color:red" id="customer_name_error"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email"
                            placeholder="e.g. rubelsarder@gmail.com" id="customer_email">
                        <span class="customer_email_error" style="color:red" id="customer_email_error"></span>
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
                        <input type="date" class="form-control" name="date_of_birth" id="customer_date_of_birth">
                        <span class="customer_date_of_birth_error" style="color:red"
                            id="customer_date_of_birth_error"></span>
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
                        <input type="text" class="form-control" name="nid_number" placeholder="e.g. 1234567890"
                            id="customer_nid_number">
                        <span class="customer_nid_number_error" style="color:red" id="customer_nid_number_error"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Purpose / Categories</label>
                        <select class="form-control" name="package_category_id" id="package_categories_dropdown">
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

                    <!-- purpose wise package section -->

                    <div class="col-12 mb-4 d-none" id="purpose_wise_package_section">
                        <div class="card border-info shadow-sm">
                            <div class="card-header bg-info text-white fw-bold">
                                <i class="fas fa-box-open me-2"></i>Purpose Wise Package Details
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!--Application Date section-->
                                    <div class="col-md-4 mb-3">
                                        <label>Today Date</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control bg-primary text-white"  value="{{\Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label>Applicatin Start Date</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control bg-success text-white" name="start_date" id="start_date" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Application End Date</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control bg-danger text-white" name="end_date" id="end_date" readonly>
                                        </div>
                                    </div>
                                   <!--Application Date section-->




                                    <div class="col-md-6 mb-3">
                                        <label>Package Price</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control bg-danger text-white"
                                                name="price" id="admin_package_price_field"
                                                placeholder="e.g. 450000">
                                            <button type="button" class="btn btn-warning"
                                                onclick="customerCreateUpdatePackagePrice(event)">Update</button>
                                        </div>
                                        <span class="text-danger" id="admin_package_price_error"></span>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Package Duration</label>
                                        <input type="text" class="form-control" name="duration"
                                            placeholder="e.g. 6 Months" readonly id="package_duration">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Inclusions</label>
                                        <textarea readonly name="inclusions" class="form-control" id="package_inclusions" cols="30" rows="10" readonly></textarea>
                                        {{-- <input type="text" class="form-control" name="inclusions"
                                            placeholder="Visa, Ticket, Insurance" readonly id="package_inclusions"> --}}
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Exclusions</label>
                                        <textarea readonly name="exclusions" class="form-control" id="package_exclusions" cols="30" rows="10" readonly></textarea>
                                        {{-- <input type="text" class="form-control" name="exclusions"
                                            placeholder="Personal Expenses" readonly id="package_exclusions"> --}}
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Visa Processing Time</label>
                                        <input type="text" class="form-control" name="visa_processing_time" placeholder="e.g. 15 Days" readonly id="package_visa_processing_time">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Documents Required</label>
                                        <textarea name="documents_required" class="form-control" id="package_documents_required" cols="30" rows="10" readonly></textarea>
                                        {{-- <input type="text" class="form-control" name="documents_required"
                                            placeholder="Passport, Photo, etc." readonly
                                            id="package_documents_required"> --}}
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Total Seat</label>
                                        <input type="number" class="form-control" name="seat_availability" placeholder="e.g. 20 Seats Left" readonly id="package_seat_availability">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Sold Seat</label>
                                        <input type="number" class="form-control" name="total_sold" placeholder="e.g. 20 Seats Left" readonly id="total_sold">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Available Seat</label>
                                        <input type="number" class="form-control" placeholder="e.g. 20 Seats Left" readonly id="available_seat" readonly>
                                    </div>

                                    <div id="dynamic_coupon_section" class="col-12 mb-3"></div>
                                    {{-- coupon or discount --}}
                                    <div class="col-md-4 mb-3 d-none" id="coupon_code_section">
                                        <label>Write Your Coupon Code</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="coupon_code_input"
                                                placeholder="Enter coupon code" name="coupon_code">
                                            <button type="button" class="btn btn-warning"
                                                onclick="applyCouponCode()">Apply Your Coupon Code</button>
                                        </div>
                                        
                                        <span class="text-success" id="coupon_success_message"
                                            style="display: block; margin-top: 5px;"></span>
                                        <span class="text-danger" id="coupon_error_message"
                                            style="display: block; margin-top: 5px;"></span>
                                    </div>

                                    <div class="col-md-4 mb-3 d-none" id="new_price_section">
                                        <label>Now Your New Price</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="coupon_use_new_price"
                                                placeholder="Enter coupon code" readonly
                                                name="coupon_use_discounted_price">

                                        </div>
                                        <span class="text-success" id="coupon_success_message"
                                            style="display: block; margin-top: 5px;"></span>
                                        <span class="text-danger" id="coupon_error_message"
                                            style="display: block; margin-top: 5px;"></span>
                                    </div>

                                    <div class="col-md-4 mb-3" id="coupon_code_discount_section">
                                        
                                        <div class="input-group">
                                       <label>Coupon Discount</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="coupon_code_discount_input"
                                                placeholder="Enter coupon code" name="coupon_discount">
                                        </div>

                                        </div>
                                     
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 card border-info shadow-sm d-none" id="admin_price_section">
                        <div class="col-12 mb-3">
                            <label>MRP (only admin)</label>
                            <input type="number" class="form-control" name="mrp" id="customer_mrp"
                                placeholder="e.g. 480000" readonly>
                            <span class="customer_mrp_error" style="color:red"
                                id="customer_mrp_error_message"></span>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Passenger Price (only admin)</label>
                            <input type="number" class="form-control" name="passenger_price"
                                id="customer_passenger_price" placeholder="e.g. 480000">
                            <span class="customer_passenger_price_error" style="color:red"
                                id="customer_passenger_price_error_message"></span>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Sales Discount(%) Per Passenger Price</label>
                            <input type="number" class="form-control" name="sales_commission_discount"
                                id="customer_sales_commission_discount" placeholder="e.g. 20,000">
                            <span class="customer_sales_commission_discount_error" style="color:red"
                                id="customer_sales_commission_error_message"></span>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Sales Commission</label>
                            <input type="number" class="form-control" name="sales_commission"
                                id="customer_sales_commission" placeholder="e.g. 20,000" readonly>
                            <span class="customer_sales_commission_error" style="color:red"
                                id="customer_sales_commission_error_message"></span>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Country</label>
                        <input type="text" class="form-control" name="country" id="customer_country"
                            placeholder="e.g. Malaysia-MAS">
                        <span class="customer_country_error" style="color:red"
                            id="customer_country_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Company Name</label>
                        <input type="text" class="form-control" name="company_name" id="customer_company_name"
                            placeholder="e.g. RAMLY FOOD PROCESSING">
                        <span class="customer_company_name_error" style="color:red"
                            id="customer_company_name_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>PIC</label>
                        <input type="text" class="form-control" name="pic" id="customer_pic"
                            placeholder="e.g. PIC001">
                        <span class="customer_pic_error" style="color:red" id="customer_pic_error_message"></span>
                    </div>



                    <div class="col-12 mb-3 d-none">
                        <label>Agent Name</label>
                        <input type="text" class="form-control" name="agent_name" placeholder="e.g. RAJU-MAS">
                        <span class="customer_agent_name_error" style="color:red"
                            id="customer_agent_name_error_message"></span>
                    </div>

                    <div class="col-12 mb-3 d-none">
                        <label>Agent Code</label>
                        <input type="text" class="form-control" name="agent_code" placeholder="e.g. NJ-AG-01">
                        <span class="customer_agent_code_error" style="color:red"
                            id="customer_agent_code_error_message"></span>
                    </div>

                    <div class="col-12 mb-3 d-none">
                        <label>Agent Price</label>
                        <input type="text" class="form-control" name="agent_price" placeholder="e.g. 450000">
                        <span class="customer_agent_price_error" style="color:red"
                            id="customer_agent_price_error_message"></span>
                    </div>







                    <div class="col-12 mb-3">
                        <label>Medical Date</label>
                        <input type="date" class="form-control" name="medical_date" id="customer_medical_date">
                        <span class="customer_medical_date_error" style="color:red"
                            id="customer_medical_date_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Medical Center</label>
                        <input type="text" class="form-control" name="medical_center"
                            id="customer_medical_center" placeholder="e.g. Green Life Medical">
                        <span class="customer_medical_center_error" style="color:red"
                            id="customer_medical_center_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Medical Result</label>
                        <input type="text" class="form-control" name="medical_result"
                            id="customer_medical_result" placeholder="e.g. FIT / UNFIT">
                        <span class="customer_medical_result_error" style="color:red"
                            id="customer_medical_result_error_message"></span>
                    </div>

                    <!-- Status Fields -->

                    <div class="col-12 mb-3">
                        <label>Visa Online</label>
                        <select class="form-control" name="visa_online" id="customer_visa_online">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_visa_online_error" style="color:red"
                            id="customer_visa_online_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Calling</label>
                        <select class="form-control" name="calling" id="customer_calling">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_calling_error" style="color:red"
                            id="customer_calling_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Training</label>
                        <select class="form-control" name="training" id="customer_training">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_training_error" style="color:red"
                            id="customer_training_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>E-Vissa</label>
                        <select class="form-control" name="e_vissa" id="customer_e_vissa">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_e_vissa_error" style="color:red"
                            id="customer_e_vissa_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>BMET</label>
                        <select class="form-control" name="bmet" id="customer_bmet">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_bmet_error" style="color:red" id="customer_bmet_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Fly</label>
                        <select class="form-control" name="fly" id="customer_fly">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_fly_error" style="color:red" id="customer_fly_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Payment</label>
                        <select class="form-control" name="payment" id="customer_payment">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_payment_error" style="color:red"
                            id="customer_payment_error_message"></span>
                    </div>

                    <!-- Payment Method -->

                    <div class="col-12 mb-3">
                        <label>Method of Payment</label>
                        <select class="form-control" name="payment_method" id="customer_payment_method"
                            onchange="admintoggleAccountField()">
                            <option value="">Select Method</option>
                            <option value="cash">Cash</option>
                            <option value="bank">Bank</option>
                            <option value="wallet">Wallet</option>
                        </select>
                        <span class="customer_payment_method_error" style="color:red"
                            id="customer_payment_method_error_message"></span>
                    </div>

                    <div class="col-12 mb-3 d-none" id="customer_account_number_group">
                        <label>Account Number</label>
                        <input type="text" class="form-control" name="account_number"
                            id="customer_account_number" placeholder="e.g. 1234567890">
                        <span class="customer_account_number_error" style="color:red"
                            id="customer_account_number_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Approval</label>
                        <select class="form-control" name="approval" id="approval">
                            <option value="">Select approval</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="customer_approval_error" style="color:red"
                            id="customer_approval_error_message"></span>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label>Customer Slot</label>
                    <input type="number" class="form-control" name="customer_slot" id="customer_slot"
                        placeholder="Enter your slot">
                    <span class="customer_slot_error" style="color:red" id="customer_slot_error_message"></span>
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
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Seat Error',
                    text: res.data.message,
                });
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
        const method = document.getElementById('customer_payment_method').value;
        const accountField = document.getElementById('customer_account_number_group');
        const inputField = document.getElementById('customer_account_number');

        const placeholders = {
            bank: 'Sonali Bank-009874748, Janata Bank-009874748, Pubali Bank-009874748',
            wallet: 'Nagad-017874748, Bkash-018874748, Rocket-019874748',
            default: 'default.......'
        };

        if (method === 'bank' || method === 'wallet') {
            accountField.classList.remove('d-none');
            inputField.placeholder = placeholders[method];
        } else {
            accountField.classList.add('d-none');
            inputField.placeholder = placeholders.default;
        }
    }




    //set category 
async function getadminCategoryLists() {
        const token = localStorage.getItem('token');
        if (!token) {
            return window.location.href = "/admin/login";
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
                const select = document.getElementById('package_categories_dropdown');

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

    getadminCategoryLists();




    // Show Packages Based on Selected Category

document.getElementById('package_categories_dropdown').addEventListener('change', async function() {
            const token = localStorage.getItem('token');
            if (!token) {
                return window.location.href = "/admin/login";
            }

            const category_id = this.value;
            const select = document.getElementById('customer_create_component_available_packages_dropdown');

            try {
                const res = await axios.post('/admin/package/lists/by/category', {
                    category_id: category_id
                }, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });

                if (res.data.status === 'success') {
                    const packages = res.data.packageListByCategory;
                    console.log(packages);

                    // Efficient way to add options
                    let optionsHTML = '<option value="">Select Package</option>';
                    packages.forEach(pkg => {
                        optionsHTML += `<option value="${pkg.id}">${pkg.title}</option>`;
                    });
                    select.innerHTML = optionsHTML;
                }

            } catch (error) {
                console.error("Error fetching packages:", error.response?.data || error.message);
                alert("Package list load try again");
            }
});








//packge updata value randering
// global variable to hold current package details
let packageDetails = {};

// Show/hide coupon section
function toggleCouponSections(show) {
    const section = document.getElementById('coupon_section_wrapper');
    if (section) {
        section.classList.toggle('d-none', !show);
    }
}


// Coupon Render Function
function renderCoupons(discounts = [], currentPrice = 0, fallbackDiscount = null) {
    const couponSection = document.getElementById('dynamic_coupon_section');
    couponSection.innerHTML = '';

    const today = new Date().toISOString().slice(0, 10);
    const validCoupons = discounts.filter(discount => discount.start_date <= today && discount.end_date >= today);
    const hasCoupon = validCoupons.some(discount => discount.coupon_code);
    toggleCouponSections(hasCoupon);

    if (validCoupons.length > 0) {
        validCoupons.forEach((discount, index) => {
            const isOnlyDiscount = !discount.coupon_code;
            const discountedPrice = currentPrice - (currentPrice * (discount.discount_value ?? 0) / 100);

            couponSection.innerHTML += `
            <div class="row border p-2 mb-2 rounded bg-light">
                <div class="col-md-3 mb-2">
                    <label>${isOnlyDiscount ? 'Discount % ' + (index + 1) : 'Coupon ' + (index + 1)}</label>
                    <input type="text" class="form-control" value="${isOnlyDiscount ? 'Only Discount' : discount.coupon_code}" readonly>
                </div>
                <div class="col-md-2 mb-2">
                    <label>Validity</label>
                    <input type="text" class="form-control" value="${discount.start_date ?? ''} to ${discount.end_date ?? ''}" readonly>
                </div>
                <div class="col-md-2 mb-2">
                    <label>Discount</label>
                    <input type="text" class="form-control" value="${discount.discount_value ?? 'N/A'}%" readonly>
                </div>
                <div class="col-md-2 mb-2">
                    <label>Current Price</label>
                    <input type="text" class="form-control customer_current_price" value="${currentPrice}" readonly>
                </div>
                <div class="col-md-3 mb-2">
                    <label>Discounted Price</label>
                    <input type="text" class="form-control" value="${discountedPrice.toFixed(2)}" readonly>
                </div>
            </div>`;
        });
    } else if (fallbackDiscount) {
        const discountedPrice = currentPrice - (currentPrice * fallbackDiscount / 100);
        toggleCouponSections(false);
        couponSection.innerHTML = `
        <div class="row border p-2 mb-2 rounded bg-light">
            <div class="col-md-3 mb-2">
                <label>Discount</label>
                <input type="text" class="form-control" value="Only Discount" readonly>
            </div>
            <div class="col-md-2 mb-2">
                <label>Discount %</label>
                <input type="text" class="form-control" value="${fallbackDiscount}%" readonly>
            </div>
            <div class="col-md-2 mb-2">
                <label>Current Price</label>
                <input type="text" class="form-control customer_current_price" value="${currentPrice}" readonly>
            </div>
            <div class="col-md-3 mb-2">
                <label>Discounted Price</label>
                <input type="text" class="form-control" value="${discountedPrice.toFixed(2)}" readonly>
            </div>
        </div>`;
    } else {
        toggleCouponSections(false);
        couponSection.innerHTML = `
        <div class="row border p-2 mb-2 rounded bg-light">
            <div class="col-md-12 mb-2">
                <label>No Discount Available</label>
                <input type="text" class="form-control" value="N/A" readonly>
            </div>
        </div>`;
    }
}


// Fetch package details on dropdown change
document.getElementById('customer_create_component_available_packages_dropdown').addEventListener('change', async function () {
    const id = this.value;
    const token = localStorage.getItem('token');

    document.getElementById('admin_package_price_error').innerHTML = '';
    document.getElementById('purpose_wise_package_section').classList.remove('d-none');
    document.getElementById('admin_price_section').classList.remove('d-none');

    try {
        const res = await axios.post('/admin/package/lists/details/by/catgory', { id }, {
            headers: { Authorization: `Bearer ${token}` }
        });

        if (res.data.status !== 'success') throw new Error(res.data.message || 'Failed to fetch package details');

        packageDetails = res.data.packageDetails || {};
        console.log('customer create component',packageDetails);
        const currentPrice = packageDetails.price ?? 0;

        // Set form fields
        document.getElementById('customer_mrp').value = parseInt(currentPrice);
        document.getElementById('customer_passenger_price').value = parseInt(currentPrice);
        document.getElementById('admin_package_price_field').value = parseInt(currentPrice);
        document.getElementById('package_duration').value = packageDetails.duration ?? '';
        document.getElementById('package_inclusions').value = packageDetails.inclusions ?? '';
        document.getElementById('start_date').value = packageDetails.start_date ?? '';
        document.getElementById('end_date').value = packageDetails.end_date ?? '';
        document.getElementById('package_exclusions').value = packageDetails.exclusions ?? '';
        document.getElementById('package_visa_processing_time').value = packageDetails.visa_processing_time ?? '';
        document.getElementById('package_documents_required').value = packageDetails.documents_required ?? '';
        document.getElementById('package_seat_availability').value = packageDetails.seat_availability ?? '';
        document.getElementById('total_sold').value = packageDetails.total_sold ?? '';
        document.getElementById('available_seat').value = packageDetails.seat_availability - packageDetails.total_sold;

        // Render coupons
        renderCoupons(packageDetails.discounts || [], currentPrice, packageDetails.discount ?? null);

    } catch (error) {
        console.error("Error fetching packages:", error);
        alert("Failed to load package details. Please try again.");
    }
});

//packge updata value randering end



// price update function with coupon re-rendering
// Update package price
async function customerCreateUpdatePackagePrice(event) {
    event.preventDefault();

    const token = localStorage.getItem('token');
    if (!token) {
        alert("Unauthorized. Please login again.");
        return window.location.href = "/admin/login";
    }

    const id = document.getElementById("customer_create_component_available_packages_dropdown").value;
    const new_price = document.getElementById("admin_package_price_field").value.trim();

    if (!id) return alert("Please select a package first.");
    if (!new_price || isNaN(new_price) || Number(new_price) <= 0) return alert("Enter a valid price.");

    try {
        const res = await axios.post("/admin/package/price/update", {
            id,
            price: Number(new_price)
        }, {
            headers: {
                Authorization: `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        });

        if (res.data.status === "success") {
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: res.data.message,
                timer: 2000,
                showConfirmButton: false
            });

            // Update price on all fields
            document.getElementById('admin_package_price_field').value = new_price;
            document.getElementById('customer_mrp').value = new_price;
            document.getElementById('customer_passenger_price').value = new_price;

            // Update all rendered coupon "current price"
            document.querySelectorAll('.customer_current_price').forEach(input => {
                input.value = new_price;
            });

            // update packageDetails object
            packageDetails.price = Number(new_price);

            // Re-render coupons
            renderCoupons(packageDetails.discounts || [], Number(new_price), packageDetails.discount ?? null);

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Update failed',
                text: res.data.message
            });
        }
    } catch (error) {
        const msg = error?.response?.data?.message || "An error occurred. Please try again.";
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: msg
        });
        console.error("Update error:", error);
    }
}





    //APPLY COUPON SECTION


    //  Apply Coupon Code Function
    async function applyCouponCode() {
        const token = localStorage.getItem('token');
        const couponSuccess = document.getElementById('coupon_success_message');
        const couponError = document.getElementById('coupon_error_message');
        const couponInput = document.getElementById('coupon_code_input');
        const packageSelect = document.getElementById('customer_create_component_available_packages_dropdown');
        const couponDiscount = document.getElementById('coupon_discount_input') 

        couponSuccess.innerText = '';
        couponError.innerText = '';

        if (!token) {
            alert("Unauthorized. Please login.");
            return window.location.href = "/admin/login";
        }

        const coupon_code = couponInput.value.trim();
        const package_id = packageSelect.value;

        if (!coupon_code) {
            couponError.innerText = "Please enter a coupon code.";
            return;
        }

        if (!package_id) {
            couponError.innerText = "Please select a package first.";
            return;
        }

        try {
            const response = await axios.post("/admin/package/apply-coupon", {
                coupon_code,
                package_id
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (response.data.status === 'success') {
                console.log(response.data);
                const discount_amount = response.data.discounted_price;
                const discount = response.data.discount_value;
                document.getElementById('coupon_use_new_price').value = discount_amount;
                document.getElementById('coupon_code_discount_input').value = discount;

                Swal.fire({
                    icon: 'success',
                    title: 'Coupon Applied!',
                    text: `${response.data.message}: ${discount_amount} Tk`,
                    timer: 2000,
                    showConfirmButton: false
                });

                toggleCouponSections(true);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: response.data.message || 'Invalid coupon'
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.response?.data?.message || 'Something went wrong!'
            });
        }
    }


    //comission calculator
    let customerPriceInput = document.getElementById('customer_passenger_price');
    let customerPriceDiscount = document.getElementById('customer_sales_commission_discount');
    let comission_output = document.getElementById('customer_sales_commission');

    function calculateComission() {
        let customerPrice = parseFloat(customerPriceInput.value) || 0;
        let discountPersentage = parseFloat(customerPriceDiscount.value) || 0;
        let comission_calculate = (customerPrice * discountPersentage) / 100;
        comission_output.value = comission_calculate.toFixed(2);
    }
    customerPriceInput.addEventListener('input', calculateComission);
    customerPriceDiscount.addEventListener('input', calculateComission);

    //comission calculaiton end


    document.addEventListener('DOMContentLoaded', () => {
        toggleCouponSections(false); //hide first
    });
    //if coupne toogle then show apply coupon button
    function toggleCouponSections(show) {
        const couponSection = document.getElementById('coupon_code_section');
        const newPriceSection = document.getElementById('new_price_section');
        const newCouponDiscount = document.getElementById('coupon_code_discount_section');

        if (show) {
            couponSection.classList.remove('d-none');
            newPriceSection.classList.remove('d-none');
            newCouponDiscount.classList.remove('d-none');
        } else {
            couponSection.classList.add('d-none');
            newPriceSection.classList.add('d-none');
            newCouponDiscount.classList.add('d-none');
        }
    }
    //APPLY COUPON SECTION    







    //submit customer
    async function customerCreate(event) {
        event.preventDefault();

        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/admin/login';
            return;
        }

        // Clear all previous error messages
        const errorFields = [
            'customer_name_error',
            'customer_email_error',
            'customer_phone_error',
            'customer_passport_no_error',
            'customer_age_error',
            'customer_date_of_birth_error',
            'customer_gender_error',
            'customer_nid_number_error',
            'customer_purpose_error',
            'customer_package_error',
            'customer_country_error_message',
            'customer_company_name_error_message',
            'customer_pic_error_message',
            'customer_sales_commission_error_message',
            'customer_mrp_error_message',
            'customer_passenger_price_error_message',
            'customer_medical_date_error_message',
            'customer_medical_center_error_message',
            'customer_medical_result_error_message',
            'customer_visa_online_error_message',
            'customer_calling_error_message',
            'customer_training_error_message',
            'customer_e_vissa_error_message',
            'customer_bmet_error_message',
            'customer_fly_error_message',
            'customer_payment_error_message',
            'customer_payment_method_error_message',
            'customer_account_number_error_message',
            'customer_approval_error_message',
            'customer_slot_error_message'
        ];

        errorFields.forEach(id => {
            document.getElementById(id).innerText = '';
        });

        // Fetch all values
        let admin_id = document.getElementById('customer_create_by_admin_id').value.trim();
        let name = document.getElementById('customer_name').value.trim();
        let email = document.getElementById('customer_email').value.trim();
        let phone = document.getElementById('customer_phone').value.trim();
        let passportNo = document.getElementById('customer_passport_no').value.trim();
        let age = document.getElementById('customer_age').value.trim();
        let date_of_birth = document.getElementById('customer_date_of_birth').value.trim();
        let gender = document.getElementById('customer_gender').value.trim();
        let customer_nid = document.getElementById('customer_nid_number').value.trim();
        // Corrected package_category_id id here:
        let package_category_id = document.getElementById('package_categories_dropdown').value.trim();
        let package_id = document.getElementById('customer_create_component_available_packages_dropdown').value
            .trim();

        let country = document.getElementById('customer_country').value.trim();
        let company_name = document.getElementById('customer_company_name').value.trim();
        let pic = document.getElementById('customer_pic').value.trim();
        let sales_commission = document.getElementById('customer_sales_commission').value.trim();
        let sales_commission_discount = document.getElementById('customer_sales_commission_discount').value.trim();
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
        let approval_status = document.getElementById('approval').value.trim();

        let coupon_code = document.getElementById('coupon_code_input')?.value;
        let coupon_discount = document.getElementById('coupon_discount_input')?.value;
        let coupon_use_discounted_price = document.getElementById('coupon_use_new_price')?.value;
        let package_discount = document.getElementById('package_discount')?.value;
        let customer_slot = document.getElementById('customer_slot').value.trim();

        let error = false;

        // Validation
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
            document.getElementById('customer_date_of_birth_error').innerText = 'Date field is required';
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
        if (!package_id) {
            document.getElementById('customer_package_error').innerText = 'Package selection is required';
            error = true;
        }
        if (!country) {
            document.getElementById('customer_country_error_message').innerText = 'Country is required';
            error = true;
        }
        if (!company_name) {
            document.getElementById('customer_company_name_error_message').innerText = 'Company Name is required';
            error = true;
        }
        if (!pic) {
            document.getElementById('customer_pic_error_message').innerText = 'PIC is required';
            error = true;
        }
        // if (!sales_commission) {
        //     document.getElementById('customer_sales_commission_error_message').innerText =
        //         'Sales Commission is required';
        //     error = true;
        // }
        if (!mrp) {
            document.getElementById('customer_mrp_error_message').innerText = 'MRP is required';
            error = true;
        }
        if (!customer_price) {
            document.getElementById('customer_passenger_price_error_message').innerText =
                'Passenger Price is required';
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
            document.getElementById('customer_visa_online_error_message').innerText =
                'Visa Online status is required';
            error = true;
        }
        if (!calling) {
            document.getElementById('customer_calling_error_message').innerText = 'Calling status is required';
            error = true;
        }
        if (!training) {
            document.getElementById('customer_training_error_message').innerText = 'Training status is required';
            error = true;
        }
        if (!e_vissa) {
            document.getElementById('customer_e_vissa_error_message').innerText = 'E Vissa status is required';
            error = true;
        }
        if (!bmet) {
            document.getElementById('customer_bmet_error_message').innerText = 'BMET status is required';
            error = true;
        }
        if (!fly) {
            document.getElementById('customer_fly_error_message').innerText = 'Fly status is required';
            error = true;
        }
        if (!payment) {
            document.getElementById('customer_payment_error_message').innerText = 'Payment status is required';
            error = true;
        }
        if (payment_method === "") {
            document.getElementById('customer_payment_method_error_message').innerText =
                'Please choose a payment method';
            error = true;
        }
        if (payment_method === 'bank' || payment_method === 'wallet') {
            if (!account_number) {
                document.getElementById('customer_account_number_error_message').innerText =
                    'Account Number is required for bank/wallet payment.';
                error = true;
            }
        }
        if (!approval_status) {
            document.getElementById('customer_approval_error_message').innerText = 'Approval status is required';
            error = true;
        }
        if (!customer_slot) {
            document.getElementById('customer_slot_error_message').innerText = 'Customer slot is required';
            error = true;
        }

        if (error) return; // stop if validation error

        // Prepare FormData for submission
        let formData = new FormData();

        let customerImageFile = document.getElementById('customer_image')?.files?.[0];
        if (customerImageFile) {
            formData.append('image', customerImageFile);
        }

        const data = {
            admin_id,
            package_id,
            package_category_id,
            name,
            email,
            phone,
            passport_no: passportNo,
            age,
            gender,
            date_of_birth,
            nid_number: customer_nid,
            coupon_code,
            coupon_discount,
            coupon_use_discounted_price,
            country,
            company_name,
            pic,
            sales_commission,
            sales_commission_discount,
            mrp,
            passenger_price: customer_price,
            medical_date,
            medical_center,
            medical_result,
            visa_online,
            calling,
            training,
            e_vissa,
            bmet,
            fly,
            payment,
            payment_method,
            account_number,
            approval: approval_status,
            customer_slot: customer_slot
        };

        // Append all data keys to formData
        for (let key in data) {
            if (data[key] !== undefined && data[key] !== null) {
                formData.append(key, data[key]);
            }
        }

        try {
            const response = await axios.post('/admin/customer/create', formData, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'multipart/form-data'
                }
            });

            if (response.data.status === 'success') {
                Swal.fire(response.data.message, '', 'success');
                //document.getElementById('admin_customer_form').reset();
                document.getElementById('purpose_wise_package_section').classList.add('d-none');
                //refresh input field 
                document.getElementById('customer_name').value = "";
                document.getElementById('customer_email').value = "";
                document.getElementById('customer_phone').value = "";
                document.getElementById('customer_passport_no').value = "";
                document.getElementById('customer_age').value = "";
                document.getElementById('customer_date_of_birth').value = "";
                document.getElementById('customer_gender').value = "";
                document.getElementById('customer_nid_number').value = "";
                // Corrected package_category_id id here:
                document.getElementById('package_categories_dropdown').value = "";
                document.getElementById('customer_create_component_available_packages_dropdown').value = "";

                let country = document.getElementById('customer_country').value = "";
                let company_name = document.getElementById('customer_company_name').value = "";
                let pic = document.getElementById('customer_pic').value = "";
                let sales_commission = document.getElementById('customer_sales_commission').value = "";
                let sales_commission_discount = document.getElementById('customer_sales_commission_discount').value = "";
                let mrp = document.getElementById('customer_mrp').value = "";
                let customer_price = document.getElementById('customer_passenger_price').value = "";
                let medical_date = document.getElementById('customer_medical_date').value = "";
                let medical_center = document.getElementById('customer_medical_center').value = "";
                let medical_result = document.getElementById('customer_medical_result').value = "";
                let visa_online = document.getElementById('customer_visa_online').value = "";
                let calling = document.getElementById('customer_calling').value = "";
                let training = document.getElementById('customer_training').value = "";
                let e_vissa = document.getElementById('customer_e_vissa').value = "";
                let bmet = document.getElementById('customer_bmet').value = "";
                let fly = document.getElementById('customer_fly').value = "";
                let payment = document.getElementById('customer_payment').value = "";
                let payment_method = document.getElementById('customer_payment_method').value = "";
                let account_number = document.getElementById('customer_account_number').value = "";
                let approval_status = document.getElementById('approval').value = "";
                let customer_slot = document.getElementById('customer_slot').value = "";
            } else {
                console.log('❌ Failed: ' + (response.data.message || 'Unknown error'));
            }
        } catch (error) {
            if (error.response && error.response.status === 422) {
                // Just show first validation error
                const errors = error.response.data.errors;
                const firstError = Object.values(errors)[0][0];

                Swal.fire('❌ Error', firstError, 'error');
            } else {
                Swal.fire('❌ Error', error.response?.data?.message || error.message, 'error');
            }
        }
    }</script>
