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
            <form id="admin_customer_form" enctype="multipart/form-data" onsubmit="customerCreate(event)">
                <div class="row">

                    <!-- Agent Id (hidden) -->
                    <div class="col-12 mb-3">
                        <label>Agent Id</label>
                        <input type="number" class="form-control customer_create_by_agent_id" name="admin_id" placeholder="Admin id" readonly>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="e.g. MD RUBEL SARDER" id="customer_name">
                        <span class="text-danger" id="customer_name_error"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="e.g. rubelsarder@gmail.com" id="customer_email">
                        <span class="text-danger" id="customer_email_error"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Upload Image</label>
                        <input type="file" class="form-control" name="image" id="customer_image">
                    </div>

                    <div class="col-12 mb-3">
                        <label>Phone</label>
                        <input type="tel" class="form-control" name="phone" placeholder="e.g. 01700000000" id="customer_phone">
                        <span class="text-danger" id="customer_phone_error"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Passport No</label>
                        <input type="text" class="form-control" name="passport_no" placeholder="e.g. B00588828" id="customer_passport_no">
                        <span class="text-danger" id="customer_passport_no_error"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Age</label>
                        <input type="number" class="form-control" name="age" placeholder="e.g. 28" id="customer_age">
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
                        <input type="text" class="form-control" name="nid_number" placeholder="e.g. 1234567890" id="customer_nid_number">
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
                        <select class="form-control" name="package_id" id="customer_create_component_available_packages_dropdown">
                            <option value="">Choose Category First</option>
                        </select>
                        <span class="text-danger" id="customer_package_error"></span>
                    </div>

                    <!-- purpose wise package section -->
                    <div class="col-12 mb-4 d-none" id="purpose_wise_package_section">
                        <div class="card border-info shadow-sm">
                            <div class="card-header bg-info text-white fw-bold">
                                <i class="fas fa-box-open me-2"></i> Purpose Wise Package Details
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <!-- Application Date section -->
                                    <div class="col-md-4 mb-3">
                                        <label>Today Date</label>
                                        <input type="date" class="form-control bg-primary text-white" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Application Start Date</label>
                                        <input type="date" class="form-control bg-success text-white" name="start_date" id="start_date" readonly>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Application End Date</label>
                                        <input type="date" class="form-control bg-danger text-white" name="end_date" id="end_date" readonly>
                                    </div>
                                    <!-- Application Date section end -->

                                    <div class="col-md-6 mb-3">
                                        <label>Package Price</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control bg-danger text-white" name="price" id="admin_package_price_field" placeholder="e.g. 450000">
                                            <button type="button" class="btn btn-warning" onclick="customerCreateUpdatePackagePrice(event)">Update</button>
                                        </div>
                                        <span class="text-danger" id="admin_package_price_error"></span>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Package Duration</label>
                                        <input type="text" class="form-control" name="duration" placeholder="e.g. 6 Months" readonly id="package_duration">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Inclusions</label>
                                        <textarea readonly name="inclusions" class="form-control" id="package_inclusions" rows="4"></textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Exclusions</label>
                                        <textarea readonly name="exclusions" class="form-control" id="package_exclusions" rows="4"></textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Visa Processing Time</label>
                                        <input type="text" class="form-control" name="visa_processing_time" placeholder="e.g. 15 Days" readonly id="package_visa_processing_time">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Documents Required</label>
                                        <textarea readonly name="documents_required" class="form-control" id="package_documents_required" rows="4"></textarea>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Total Seat</label>
                                        <input type="number" class="form-control" name="seat_availability" placeholder="e.g. 20 Seats Left" readonly id="package_seat_availability">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Sold Seat</label>
                                        <input type="number" class="form-control" name="total_sold" placeholder="e.g. 20 Seats Sold" readonly id="total_sold">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>Available Seat</label>
                                        <input type="number" class="form-control" placeholder="e.g. 20 Seats Left" readonly id="available_seat">
                                    </div>

                                    <div id="dynamic_coupon_section" class="col-12 mb-3"></div>

                                    <!-- coupon or discount -->
                                    <div class="col-md-4 mb-3 d-none" id="coupon_code_section">
                                        <label>Write Your Coupon Code</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="coupon_code_input" placeholder="Enter coupon code" name="coupon_code">
                                            <button type="button" class="btn btn-warning" onclick="applyCouponCode()">Apply Your Coupon Code</button>
                                        </div>
                                        <span class="text-success" id="coupon_success_message" style="margin-top:5px;"></span>
                                        <span class="text-danger" id="coupon_error_message" style="margin-top:5px;"></span>
                                    </div>

                                    <div class="col-md-4 mb-3 d-none" id="new_price_section">
                                        <label>Now Your New Price</label>
                                        <input type="text" class="form-control" id="coupon_use_new_price" placeholder="Discounted Price" readonly name="coupon_use_discounted_price">
                                    </div>

                                    <div class="col-md-4 mb-3" id="coupon_code_discount_section">
                                        <label>Coupon Discount</label>
                                        <input type="number" class="form-control" id="coupon_code_discount_input" placeholder="Discount Amount" name="coupon_discount">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 card border-info shadow-sm d-none" id="admin_price_section">
                        <div class="col-12 mb-3">
                            <label>MRP (only admin)</label>
                            <input type="number" class="form-control" name="mrp" id="customer_mrp" placeholder="e.g. 480000" readonly>
                            <span class="text-danger" id="customer_mrp_error_message"></span>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Passenger Price (only admin)</label>
                            <input type="number" class="form-control" name="passenger_price" id="customer_passenger_price" placeholder="e.g. 480000">
                            <span class="text-danger" id="customer_passenger_price_error_message"></span>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Sales Discount(%) Per Passenger Price</label>
                            <input type="number" class="form-control" name="sales_commission_discount" id="customer_sales_commission_discount" placeholder="e.g. 20">
                            <span class="text-danger" id="customer_sales_commission_error_message"></span>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Sales Commission</label>
                            <input type="number" class="form-control" name="sales_commission" id="customer_sales_commission" placeholder="e.g. 20000" readonly>
                            <span class="text-danger" id="customer_sales_commission_error_message"></span>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Country</label>
                        <input type="text" class="form-control" name="country" id="customer_country" placeholder="e.g. Malaysia-MAS">
                        <span class="text-danger" id="customer_country_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Company Name</label>
                        <input type="text" class="form-control" name="company_name" id="customer_company_name" placeholder="e.g. RAMLY FOOD PROCESSING">
                        <span class="text-danger" id="customer_company_name_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>PIC</label>
                        <input type="text" class="form-control" name="pic" id="customer_pic" placeholder="e.g. PIC001">
                        <span class="text-danger" id="customer_pic_error_message"></span>
                    </div>

                    <!-- Hidden Agent fields (if needed) -->
                    <div class="col-12 mb-3 d-none">
                        <label>Agent Name</label>
                        <input type="text" class="form-control" name="agent_name" placeholder="e.g. RAJU-MAS">
                        <span class="text-danger" id="customer_agent_name_error_message"></span>
                    </div>

                    <div class="col-12 mb-3 d-none">
                        <label>Agent Code</label>
                        <input type="text" class="form-control" name="agent_code" placeholder="e.g. NJ-AG-01">
                        <span class="text-danger" id="customer_agent_code_error_message"></span>
                    </div>

                    <div class="col-12 mb-3 d-none">
                        <label>Agent Price</label>
                        <input type="text" class="form-control" name="agent_price" placeholder="e.g. 450000">
                        <span class="text-danger" id="customer_agent_price_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Medical Date</label>
                        <input type="date" class="form-control" name="medical_date" id="customer_medical_date">
                        <span class="text-danger" id="customer_medical_date_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Medical Center</label>
                        <input type="text" class="form-control" name="medical_center" id="customer_medical_center" placeholder="e.g. Green Life Medical">
                        <span class="text-danger" id="customer_medical_center_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Medical Result</label>
                        <input type="text" class="form-control" name="medical_result" id="customer_medical_result" placeholder="e.g. FIT / UNFIT">
                        <span class="text-danger" id="customer_medical_result_error_message"></span>
                    </div>

                    <!-- Status Fields -->
                    <div class="col-12 mb-3">
                        <label>Visa Online</label>
                        <select class="form-control" name="visa_online" id="customer_visa_online">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="text-danger" id="customer_visa_online_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Calling</label>
                        <select class="form-control" name="calling" id="customer_calling">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="text-danger" id="customer_calling_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Training</label>
                        <select class="form-control" name="training" id="customer_training">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="text-danger" id="customer_training_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>E-Vissa</label>
                        <select class="form-control" name="e_vissa" id="customer_e_vissa">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="text-danger" id="customer_e_vissa_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>BMET</label>
                        <select class="form-control" name="bmet" id="customer_bmet">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="text-danger" id="customer_bmet_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Fly</label>
                        <select class="form-control" name="fly" id="customer_fly">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="text-danger" id="customer_fly_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Payment</label>
                        <select class="form-control" name="payment" id="customer_payment">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="text-danger" id="customer_payment_error_message"></span>
                    </div>

                    <!-- Payment Method -->
                    <div class="col-12 mb-3">
                        <label>Method of Payment</label>
                        <select class="form-control" name="payment_method" id="customer_payment_method" onchange="admintoggleAccountField()">
                            <option value="">Select Method</option>
                            <option value="cash">Cash</option>
                            <!-- <option value="bank">Bank</option> -->
                            <!-- <option value="wallet">Wallet</option> -->
                        </select>
                        <span class="text-danger" id="customer_payment_method_error_message"></span>
                    </div>

                    <div class="col-12 mb-3 d-none" id="customer_account_number_group">
                        <label>Account Number</label>
                        <input type="text" class="form-control" name="account_number" id="customer_account_number" placeholder="e.g. 1234567890">
                        <span class="text-danger" id="customer_account_number_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Approval</label>
                        <select class="form-control" name="approval" id="approval">
                            <option value="">Select approval</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                        <span class="text-danger" id="customer_approval_error_message"></span>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Customer Slot</label>
                        <input type="number" class="form-control" name="customer_slot" id="customer_slot" placeholder="Enter your slot">
                        <span class="text-danger" id="customer_slot_error_message"></span>
                    </div>

                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>



<script>
    getUserInfo();
    async function getUserInfo(){
        let token = localStorage.getItem('token');
        if(!token){
            window.location.href = "/agent/login";
        }
        try{
          let res = await axios.get("/auth/agent",{headers:{
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json'
        }})
   

        if(res.data.status == "success"){
            console.log(res.data.data.id)
            document.querySelector(".customer_create_by_agent_id").value = res.data.data.id;
        }
        }catch(error){
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

</script>