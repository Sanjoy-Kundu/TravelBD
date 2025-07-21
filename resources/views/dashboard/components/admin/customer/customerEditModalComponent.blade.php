<div class="modal fade" id="customerEditModal" tabindex="-1" aria-labelledby="customerEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerEditModalLabel">Customer Edit (Admin Only)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Full Customer Form copied from Create -->
                <div class="container-fluid px-4">
                    <form id="edit_customer_form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label>ID</label>
                                <input type="text" name="admin_id" class="admin_id" placeholder="admin id">
                                <input type="text" name="customer_id" class="customer_id" placeholder="customer id">
                                <input type="text" name="agent_id" class="agent_id" placeholder="agent id">
                            </div>

                            <div class="col-4 mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control customer_name" name="name"
                                    placeholder="e.g. MD RUBEL SARDER" id="customer_name">
                                <span class="customer_name_error" style="color:red" id="customer_name_error"></span>
                            </div>

                            <div class="col-4 mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control customer_email" name="email"
                                    placeholder="e.g. rubelsarder@gmail.com" id="customer_email">
                                <span class="customer_email_error" style="color:red" id="customer_email_error"></span>
                            </div>

                            <div class="col-4 mb-3">
                                <label>Upload Image</label>
                                <input type="file" class="form-control" name="image" id="customer_image">
                            </div>

                            <div class="col-4 mb-3">
                                <label>Phone</label>
                                <input type="tel" class="form-control customer_phone" name="phone"
                                    placeholder="e.g. 01700000000" id="customer_phone">
                                <span class="customer_phone_error" style="color:red" id="customer_phone_error"></span>
                            </div>


                            <div class="col-4 mb-3">
                                <label>Passport No</label>
                                <input type="text" class="form-control customer_passport_no" name="passport_no"
                                    placeholder="e.g. B00588828" id="customer_passport_no">
                                <span class="customer_passport_no_error" style="color:red"
                                    id="customer_passport_no_error"></span>
                            </div>

                            <div class="col-4 mb-3">
                                <label>Age</label>
                                <input type="number" class="form-control customer_age" name="age"
                                    placeholder="e.g. 28" id="customer_age">
                                <span class="customer_age_error" style="color:red" id="customer_age_error"></span>
                            </div>

                            <div class="col-4 mb-3">
                                <label>Date Of Birth</label>
                                <input type="date" class="form-control customer_date_of_birth" name="date_of_birth"
                                    id="customer_date_of_birth">
                                <span class="customer_date_of_birth_error" style="color:red"
                                    id="customer_date_of_birth_error"></span>
                            </div>

                            <div class="col-4 mb-3">
                                <label>Gender</label>
                                <select class="form-control customer_gender" name="gender" id="customer_gender">
                                    <option value="">-- Select Gender --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                <span class="customer_gender_error" style="color:red"
                                    id="customer_gender_error"></span>
                            </div>

                            <div class="col-4 mb-3">
                                <label>NID Number</label>
                                <input type="text" class="form-control customer_nid_number" name="nid_number"
                                    placeholder="e.g. 1234567890" id="customer_nid_number">
                                <span class="customer_nid_number_error" style="color:red"
                                    id="customer_nid_number_error"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Purpose / Categories</label>
                                <select class="form-control"
                                    name="package_category_id"id="package_categories_dropdown">
                                </select>
                                <span class="customer_purpose_error" style="color:red"
                                    id="customer_purpose_error"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Available Packages</label>
                                <select class="form-control customer_create_component_available_packages_dropdown"
                                    name="package_id" id="customer_create_component_available_packages_dropdown">
                                    <option value="">Choose Category First</option>
                                </select>
                                <span class="customer_package_error" style="color:red"
                                    id="customer_package_error"></span>
                            </div>

                            <!-- purpose wise package section -->

                            <div class="col-12 mb-4 d-none" id="purpose_wise_package_section">
                                <div class="card border-dark shadow-sm">
                                    <div class="card-header fw-bold">
                                        <i class="fas fa-box-open me-2"></i>Purpose Wise Package Details
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!--Application Date section-->
                                            <div class="col-md-4 mb-3">
                                                <label>Today Date</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control"
                                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Applicatin Start Date</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" name="start_date"
                                                        id="start_date" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Application End Date</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" name="end_date"
                                                        id="end_date" readonly>
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
                                                <textarea readonly name="inclusions" class="form-control" id="package_inclusions" cols="30" rows="10"
                                                    readonly></textarea>
                                                {{-- <input type="text" class="form-control" name="inclusions"
                                            placeholder="Visa, Ticket, Insurance" readonly id="package_inclusions"> --}}
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Exclusions</label>
                                                <textarea readonly name="exclusions" class="form-control" id="package_exclusions" cols="30" rows="10"
                                                    readonly></textarea>
                                                {{-- <input type="text" class="form-control" name="exclusions"
                                            placeholder="Personal Expenses" readonly id="package_exclusions"> --}}
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Visa Processing Time</label>
                                                <input type="text" class="form-control"
                                                    name="visa_processing_time" placeholder="e.g. 15 Days" readonly
                                                    id="package_visa_processing_time">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Documents Required</label>
                                                <textarea name="documents_required" class="form-control" id="package_documents_required" cols="30"
                                                    rows="10" readonly></textarea>
                                                {{-- <input type="text" class="form-control" name="documents_required"
                                            placeholder="Passport, Photo, etc." readonly
                                            id="package_documents_required"> --}}
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Total Seat</label>
                                                <input type="number" class="form-control" name="seat_availability"
                                                    placeholder="e.g. 20 Seats Left" readonly
                                                    id="package_seat_availability">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Sold Seat</label>
                                                <input type="number" class="form-control" name="total_sold"
                                                    placeholder="e.g. 20 Seats Left" readonly id="total_sold">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Available Seat</label>
                                                <input type="number" class="form-control"
                                                    placeholder="e.g. 20 Seats Left" readonly id="available_seat"
                                                    readonly>
                                            </div>

                                            <div id="dynamic_coupon_section" class="col-12 mb-3"></div>
                                            {{-- coupon or discount --}}
                                            <div class="col-md-4 mb-3" id="coupon_code_section">
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

                                            <div class="col-md-4 mb-3" id="new_price_section">
                                                <label>Now Your New Price</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        id="coupon_use_new_price" placeholder="Enter coupon code"
                                                        readonly name="coupon_use_discounted_price">

                                                </div>
                                                <span class="text-success" id="coupon_success_message"
                                                    style="display: block; margin-top: 5px;"></span>
                                                <span class="text-danger" id="coupon_error_message"
                                                    style="display: block; margin-top: 5px;"></span>
                                            </div>

                                               <div id="dynamic_coupon_section" class="col-12 mb-3"></div>
                                    {{-- coupon or discount --}}
                                    <div class="col-md-4 mb-3" id="coupon_code_section">
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

                                    <div class="col-md-4 mb-3" id="new_price_section">
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
                                            {{-- <div class="col-md-4 mb-3" id="coupon_code_discount_section">

                                                <div class="input-group">
                                                    <label>Coupon Discount</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control"
                                                            id="coupon_code_discount_input"
                                                            placeholder="Enter coupon code" name="coupon_discount">
                                                    </div>

                                                </div>

                                            </div> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-info shadow-sm p-4 d-none" id="admin_price_section">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="customer_mrp" class="form-label fw-bold text-primary">MRP (Only Admin)</label>
                                        <input type="number" class="form-control" name="mrp" id="customer_mrp"
                                            placeholder="e.g. 480000" readonly>
                                        <span class="text-danger small" id="customer_mrp_error_message"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="customer_passenger_price" class="form-label fw-bold">Passenger Price (Only Admin)</label>
                                        <input type="number" class="form-control" name="passenger_price"
                                            id="customer_passenger_price" placeholder="e.g. 480000">
                                        <span class="text-danger small"
                                            id="customer_passenger_price_error_message"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="customer_sales_commission_discount"
                                            class="form-label fw-bold">Sales Discount (%) Per Passenger</label>
                                        <input type="number" class="form-control" name="sales_commission_discount"
                                            id="customer_sales_commission_discount" placeholder="e.g. 20000">
                                        <span class="text-danger small"
                                            id="customer_sales_commission_error_message"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="customer_sales_commission" class="form-label fw-bold">Sales
                                            Commission</label>
                                        <input type="number" class="form-control" name="sales_commission"
                                            id="customer_sales_commission" placeholder="e.g. 20000" readonly>
                                        <span class="text-danger small"
                                            id="customer_sales_commission_error_message"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 mb-3">
                                <label>Country</label>
                                <input type="text" class="form-control" name="country" id="customer_country"
                                    placeholder="e.g. Malaysia-MAS">
                                <span class="customer_country_error" style="color:red"
                                    id="customer_country_error_message"></span>
                            </div>

                            <div class="col-4 mb-3">
                                <label>Company Name</label>
                                <input type="text" class="form-control customer_company_name" name="company_name"
                                    id="customer_company_name" placeholder="e.g. RAMLY FOOD PROCESSING">
                                <span class="customer_company_name_error" style="color:red"
                                    id="customer_company_name_error_message"></span>
                            </div>

                            <div class="col-4 mb-3">
                                <label>PIC</label>
                                <input type="text" class="form-control customer_pic" name="pic"
                                    id="customer_pic" placeholder="e.g. PIC001">
                                <span class="customer_pic_error" style="color:red"
                                    id="customer_pic_error_message"></span>
                            </div>



                            <div class="col-4 mb-3">
                                <label>Added By Name</label>
                                <input type="text" class="form-control" name="agent_name"
                                    placeholder="e.g. RAJU-MAS">
                                <span class="customer_agent_name_error" style="color:red"
                                    id="customer_agent_name_error_message"></span>
                            </div>

                            <div class="col-4 mb-3">
                                <label>Agent Code</label>
                                <input type="text" class="form-control" name="agent_code"
                                    placeholder="e.g. NJ-AG-01">
                                <span class="customer_agent_code_error" style="color:red"
                                    id="customer_agent_code_error_message"></span>
                            </div>

                            <div class="col-4 mb-3">
                                <label>Agent Price</label>
                                <input type="text" class="form-control" name="agent_price"
                                    placeholder="e.g. 450000">
                                <span class="customer_agent_price_error" style="color:red"
                                    id="customer_agent_price_error_message"></span>
                            </div>







                            <div class="col-4 mb-3">
                                <label>Medical Date</label>
                                <input type="date" class="form-control" name="medical_date"
                                    id="customer_medical_date">
                                <span class="customer_medical_date_error" style="color:red"
                                    id="customer_medical_date_error_message"></span>
                            </div>

                            <div class="col-4 mb-3">
                                <label>Medical Center</label>
                                <input type="text" class="form-control" name="medical_center"
                                    id="customer_medical_center" placeholder="e.g. Green Life Medical">
                                <span class="customer_medical_center_error" style="color:red"
                                    id="customer_medical_center_error_message"></span>
                            </div>

                            <div class="col-4 mb-3">
                                <label>Medical Result</label>
                                <input type="text" class="form-control" name="medical_result"
                                    id="customer_medical_result" placeholder="e.g. FIT / UNFIT">
                                <span class="customer_medical_result_error" style="color:red"
                                    id="customer_medical_result_error_message"></span>
                            </div>

                            <!-- Status Fields -->

                            <div class="col-6 mb-3">
                                <label>Visa Online</label>
                                <select class="form-control customer_visa_online" name="visa_online"
                                    id="customer_visa_online">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                </select>
                                <span class="customer_visa_online_error" style="color:red"
                                    id="customer_visa_online_error_message"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Calling</label>
                                <select class="form-control customer_calling" name="calling" id="customer_calling">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                </select>
                                <span class="customer_calling_error" style="color:red"
                                    id="customer_calling_error_message"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Training</label>
                                <select class="form-control customer_training" name="training"
                                    id="customer_training">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                </select>
                                <span class="customer_training_error" style="color:red"
                                    id="customer_training_error_message"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>E-Vissa</label>
                                <select class="form-control customer_e_vissa" name="e_vissa" id="customer_e_vissa">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                </select>
                                <span class="customer_e_vissa_error" style="color:red"
                                    id="customer_e_vissa_error_message"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>BMET</label>
                                <select class="form-control customer_bmet" name="bmet" id="customer_bmet">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                </select>
                                <span class="customer_bmet_error" style="color:red"
                                    id="customer_bmet_error_message"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Fly</label>
                                <select class="form-control customer_fly" name="fly" id="customer_fly">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                </select>
                                <span class="customer_fly_error" style="color:red"
                                    id="customer_fly_error_message"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Payment</label>
                                <select class="form-control customer_payment" name="payment" id="customer_payment">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                </select>
                                <span class="customer_payment_error" style="color:red"
                                    id="customer_payment_error_message"></span>
                            </div>

                            <!-- Payment Method -->

                            <div class="col-6 mb-3">
                                <label>Method of Payment</label>
                                <select class="form-control customer_payment_method" name="payment_method"
                                    id="customer_payment_method" onchange="admintoggleAccountField()">
                                    <option value="">Select Method</option>
                                    <option value="cash">Cash</option>
                                    {{-- <option value="bank">Bank</option>
                            <option value="wallet">Wallet</option> --}}
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
                                <select class="form-control customer_approval" name="approval"
                                    id="customer_approval">
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
                            <input type="number" class="form-control customer_slot_input" name="customer_slot"
                                id="customer_slot" placeholder="Enter your slot">
                            <span class="customer_slot_error" style="color:red"
                                id="customer_slot_error_message"></span>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-primary px-4" onclick="customerUpdate(event)"
                                id="customer_button_update">Update Customer</button>
                        </div>
                    </form>
                </div>
                <!-- End Full Customer Form -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>






<script>
    // ==============================
    // Fill Customer Edit Modal
    // ==============================
    async function fillCustomerEditModal(id) {
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

            if (res.data.status === 'success') {
                let customer = res.data.customer;

                // Set customer image
                document.querySelector('.customer_image').src =
                    customer.image ?
                    `/upload/dashboard/images/customers/${customer.image}` :
                    `/upload/dashboard/images/customers/default.jpg`;

                // Set form values
                const setField = (selector, value, fallback = '') => {
                    const el = document.querySelector(selector);
                    if (el) el.value = value || fallback;
                };

                setField('.customer_id', customer.id);
                setField('.admin_id', customer.admin_id);
                setField('.agent_id', customer.agent_id);
                setField('.customer_name', customer.name, 'N/A');
                setField('.customer_email', customer.email, 'N/A');
                setField('.customer_phone', customer.phone, '*****');
                setField('.customer_passport_no', customer.passport_no, 'N/A');
                setField('.customer_age', customer.age, 'N/A');
                setField('.customer_date_of_birth', customer.date_of_birth, 'N/A');
                setField('.customer_gender', customer.gender, 'N/A');
                setField('.customer_nid_number', customer.nid_number, 'N/A');
                setField('.customer_company_name', customer.company_name);
                setField('.customer_pic', customer.pic);
                setField('.customer_approval', customer.approval);
                setField('.customer_bmet', customer.bmet);
                setField('.customer_calling', customer.calling);
                setField('.customer_fly', customer.fly);
                setField('.customer_training', customer.training);
                setField('.customer_visa_online', customer.visa_online);
                setField('.customer_e_vissa', customer.e_vissa);
                setField('.customer_payment', customer.payment);
                setField('.customer_payment_method', customer.payment_method);
                setField('.customer_slot_input', parseInt(customer.customer_slot) || '');

                // Load categories and packages
                await loadCategoryLists(customer.package_category_id, customer.package_id);

                // Load package details
                if (customer.package_id) {
                    await loadPackageDetailsById(customer.package_id);
                }

            } else {
                console.error('Error fetching customer:', res.data);
            }

        } catch (error) {
            console.error('Exception:', error);
        }
    }

    // ==============================
    // Load Category Lists
    // ==============================
    async function loadCategoryLists(selectedCategoryId = null, selectedPackageId = null) {
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
            let dropdown = document.querySelector('#package_categories_dropdown');
            dropdown.innerHTML = '<option value="">Select Purpose</option>';

            categories.forEach(category => {
                let option = document.createElement('option');
                option.value = category.id;
                option.text = category.name;
                if (parseInt(selectedCategoryId) === category.id) {
                    option.selected = true;
                }
                dropdown.appendChild(option);
            });

            if (selectedCategoryId) {
                await loadPackagesByCategoryId(selectedCategoryId, selectedPackageId);
            } else {
                clearPackageDropdown();
            }

        } catch (error) {
            console.error("Error loading categories:", error);
        }
    }

    // ==============================
    // Load Packages by Category ID
    // ==============================
    async function loadPackagesByCategoryId(categoryId, selectedPackageId = null) {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/admin/login';
            return;
        }

        //document.querySelector('#purpose_wise_package_section').classList.remove('d-none');

        let packageDropdown = document.querySelector('.customer_create_component_available_packages_dropdown');
        let errorSpan = document.getElementById('customer_package_error');
        errorSpan.innerText = '';

        try {
            let res = await axios.post('/admin/package/lists/by/category', {
                category_id: categoryId
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (res.data.status === 'success') {
                let packages = res.data.packageListByCategory;

                if (!packages.length) {
                    handlePackageError("এই ক্যাটাগরির প্যাকেজগুলো এখন উপলব্ধ নেই।");
                    return;
                }

                packageDropdown.innerHTML = '<option value="">Select Package</option>';
                packageDropdown.disabled = false;

                packages.forEach(pkg => {
                    let option = document.createElement('option');
                    option.value = pkg.id;
                    option.text = pkg.title;
                    if (parseInt(pkg.id) === parseInt(selectedPackageId)) {
                        option.selected = true;
                    }
                    packageDropdown.appendChild(option);
                });

                // Load details if package is already selected
                if (selectedPackageId) {
                    await loadPackageDetailsById(selectedPackageId);
                }

            } else {
                handlePackageError(res.data.message);
            }

        } catch (error) {
            if (error.response?.status === 404) {
                handlePackageError(error.response.data.message);
            } else {
                handlePackageError('কিছু সমস্যা হয়েছে, পরে চেষ্টা করুন।');
            }
            clearPackageDropdown();
        }
    }

    // ==============================
    // Load Package Details By ID
    // ==============================
    async function loadPackageDetailsById(packageId) {
        //console.log('loadPackageDetailsById', packageId);
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/admin/login';
            return;
        }

        try {
            let res = await axios.post('/admin/package/lists/details/by/catgory', {
                id: packageId
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });

            if (res.data.status === 'success') {
                let pkg = res.data.packageDetails;
                console.log(pkg);
                // Set details
                document.getElementById('start_date').value = pkg.start_date || '';
                document.getElementById('end_date').value = pkg.end_date || '';
                document.getElementById('admin_package_price_field').value = pkg.price || '';
                document.getElementById('package_duration').value = pkg.duration || '';
                document.getElementById('package_inclusions').value = pkg.inclusions || '';
                document.getElementById('package_exclusions').value = pkg.exclusions || '';
                document.getElementById('package_visa_processing_time').value = pkg.visa_processing_time || '';
                document.getElementById('package_documents_required').value = pkg.documents_required || '';
                document.getElementById('package_seat_availability').value = pkg.seat_availability;
                document.getElementById('total_sold').value = pkg.total_sold;
                document.getElementById('available_seat').value = pkg.seat_availability - pkg.total_sold;

                document.getElementById('admin_price_section').classList.remove('d-none');
                document.querySelector('#purpose_wise_package_section').classList.remove('d-none');
            }

        } catch (err) {
            console.error("Package details fetch error:", err);
        }
    }

    // ==============================
    // Handle Package Error
    // ==============================
    function handlePackageError(message) {
        Swal.fire({
            icon: 'warning',
            title: 'দুঃখিত!',
            text: message || 'কোনো প্যাকেজ পাওয়া যায়নি।',
            confirmButtonText: 'ঠিক আছে'
        });

        let errorSpan = document.getElementById('customer_package_error');
        if (errorSpan) {
            errorSpan.innerText = message;
        }

        clearPackageDropdown();
    }

    // ==============================
    // Clear Package Dropdown
    // ==============================
    function clearPackageDropdown() {
        let packageDropdown = document.querySelector('.customer_create_component_available_packages_dropdown');
        packageDropdown.innerHTML = '<option value="">Select Package</option>';
        packageDropdown.disabled = true;
        document.querySelector('#purpose_wise_package_section').classList.add('d-none');
    }

    // ==============================
    // On Category Dropdown Change
    // ==============================
    document.querySelector('#package_categories_dropdown').addEventListener('change', function() {
        let selectedCategoryId = this.value;
        if (selectedCategoryId) {
            loadPackagesByCategoryId(selectedCategoryId);
        } else {
            clearPackageDropdown();
            document.getElementById('customer_package_error').innerText = '';
        }
    });

    // ==============================
    // On Package Dropdown Change
    // ==============================
    document.querySelector('.customer_create_component_available_packages_dropdown').addEventListener('change',
        function() {
            let selectedPackageId = this.value;
            if (selectedPackageId) {
                loadPackageDetailsById(selectedPackageId);
            }
        });
</script>
