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
                    <form id="admin_customer_form" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-12 mb-3" hidden>

                                <input type="number" class="form-control admin_id" name="admin_id"
                                    id="admin_id"readonly>
                                <input type="number" class="form-control agent_id" name="agent_id" id="agent_id">
                                <input type="number" class="form-control customer_id" name="id"
                                    id="customer_id">
                            </div>

                            <div class="col-6 mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control customer_name" name="name"
                                    placeholder="Customer name .." id="customer_name">
                                <span class="customer_name_error" style="color:red" id="customer_name_error"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control customer_email" name="email"
                                    placeholder="e.g. rubelsarder@gmail.com" id="customer_email">
                                <span class="customer_email_error" style="color:red" id="customer_email_error"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold">Upload Image</label>
                                <input type="file" class="form-control customer_image" name="image"
                                    id="customer_image">

                                <img src="" alt="Preview" class="customer_image_preview mt-2"
                                    id="customer_image_preview"
                                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 1px solid #ccc; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            </div>


                            <div class="col-6 mb-3">
                                <label>Phone</label>
                                <input type="tel" class="form-control customer_phone" name="phone"
                                    placeholder="e.g. 01700000000" id="customer_phone">
                                <span class="customer_phone_error" style="color:red" id="customer_phone_error"></span>
                            </div>


                            <div class="col-6 mb-3">
                                <label>Passport No</label>
                                <input type="text" class="form-control customer_passport_no" name="passport_no"
                                    placeholder="e.g. B00588828" id="customer_passport_no">
                                <span class="customer_passport_no_error" style="color:red"
                                    id="customer_passport_no_error"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Age</label>
                                <input type="number" class="form-control customer_age" name="age"
                                    placeholder="e.g. 28" id="customer_age">
                                <span class="customer_age_error" style="color:red" id="customer_age_error"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Date Of Birth</label>
                                <input type="date" class="form-control customer_date_of_birth" name="date_of_birth"
                                    id="customer_date_of_birth">
                                <span class="customer_date_of_birth_error" style="color:red"
                                    id="customer_date_of_birth_error"></span>
                            </div>

                            <div class="col-6 mb-3">
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

                            <div class="col-6 mb-3">
                                <label>NID Number</label>
                                <input type="text" class="form-control customer_nid_number" name="nid_number"
                                    placeholder="e.g. 1234567890" id="customer_nid_number">
                                <span class="customer_nid_number_error" style="color:red"
                                    id="customer_nid_number_error"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Purpose / Categories</label>
                                <select class="form-control" name="package_category_id"
                                    id="package_categories_dropdown">
                                    <option value="">Select Purpose</option>
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
                                <div class="card border-info shadow-sm">
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
                                                    <input type="date" class="form-control start_date"
                                                        name="start_date" id="start_date" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Application End Date</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control end_date"
                                                        name="end_date" id="end_date" readonly>
                                                </div>
                                            </div>
                                            <!--Application Date section-->

                                            <div class="col-md-6 mb-3">
                                                <label>Package Price</label>
                                                <div class="input-group">
                                                    <input type="number"
                                                        class="form-control admin_package_price_field" name="price"
                                                        id="admin_package_price_field" placeholder="e.g. 450000">
                                                    <button type="button" class="btn btn-warning"
                                                        onclick="customerCreateUpdatePackagePrice(event)">Update</button>
                                                </div>
                                                <span class="text-danger" id="admin_package_price_error"></span>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Package Duration</label>
                                                <input type="text" class="form-control package_duration"
                                                    name="duration" placeholder="e.g. 6 Months" readonly
                                                    id="package_duration">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Inclusions</label>
                                                <textarea readonly name="inclusions" class="form-control package_inclusions" id="package_inclusions" cols="30" rows="10" readonly></textarea>
                                                {{-- <input type="text" class="form-control" name="inclusions"
                                            placeholder="Visa, Ticket, Insurance" readonly id="package_inclusions"> --}}
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Exclusions</label>
                                                <textarea readonly name="exclusions" class="form-control package_exclusions" id="package_exclusions" cols="30"
                                                    rows="10" readonly></textarea>
                                                {{-- <input type="text" class="form-control" name="exclusions"
                                            placeholder="Personal Expenses" readonly id="package_exclusions"> --}}
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Visa Processing Time</label>
                                                <input type="text"
                                                    class="form-control package_visa_processing_time"
                                                    name="visa_processing_time" placeholder="e.g. 15 Days" readonly
                                                    id="package_visa_processing_time">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Documents Required</label>
                                                <textarea name="documents_required" class="form-control package_documents_required" id="package_documents_required"
                                                    cols="30" rows="10" readonly></textarea>
                                                {{-- <input type="text" class="form-control" name="documents_required"
                                            placeholder="Passport, Photo, etc." readonly
                                            id="package_documents_required"> --}}
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Total Seat</label>
                                                <input type="number" class="form-control package_seat_availability"
                                                    name="seat_availability" placeholder="e.g. 20 Seats Left"
                                                    id="package_seat_availability">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Sold Seat</label>
                                                <input type="number" class="form-control total_sold"
                                                    name="total_sold" placeholder="e.g. 20 Seats Left" readonly
                                                    id="total_sold">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Available Seat</label>
                                                <input type="number" class="form-control available_seat"
                                                    placeholder="e.g. 20 Seats Left" readonly id="available_seat"
                                                    readonly>
                                            </div>

                                            <div id="dynamic_coupon_section"
                                                class="col-12 mb-3 dynamic_coupon_section"></div>
                                            {{-- coupon or discount --}}
                                            <section id="coupon_section" class="coupon_section d-none">
                                                <div class="row">
                                                    <!-- Coupon Code Input -->
                                                    <div class="col-md-3 mb-3" id="coupon_code_section">
                                                        <label>Write Your Coupon Code</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                id="coupon_code_input" placeholder="Enter coupon code"
                                                                name="coupon_code">
                                                            <button type="button" class="btn btn-warning"
                                                                onclick="applyCouponCode()">Apply
                                                                Code</button>
                                                        </div>
                                                        <span class="text-success" id="coupon_success_message"
                                                            style="display: block; margin-top: 5px;"></span>
                                                        <span class="text-danger" id="coupon_error_message"
                                                            style="display: block; margin-top: 5px;"></span>
                                                    </div>

                                                    <!-- New Price Display -->
                                                    <div class="col-md-3 mb-3" id="current_price_section">
                                                        <label>Now Your Current Price</label>
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control coupon_use_current_price"
                                                                id="coupon_use_current_price"
                                                                placeholder="Current price" readonly
                                                                name="coupon_use_current_price">
                                                        </div>
                                                    </div>
                                                    <!-- New Price Display -->
                                                    <div class="col-md-3 mb-3" id="new_price_section">
                                                        <label>Now Your New Price</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                id="coupon_use_new_price"
                                                                placeholder="New discounted price" readonly
                                                                name="coupon_use_discounted_price">
                                                        </div>
                                                    </div>

                                                    <!-- Coupon Discount Input -->
                                                    <div class="col-md-3 mb-3" id="coupon_code_discount_section">
                                                        <label>Coupon Discount</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control"
                                                                id="coupon_code_discount_input"
                                                                placeholder="Enter discount %" name="coupon_discount"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-info shadow-sm d-none" id="admin_price_section">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label for="customer_mrp" class="form-label fw-semibold">MRP (only
                                                admin)</label>
                                            <input type="number" class="form-control customer_mrp" name="mrp"
                                                id="customer_mrp" placeholder="e.g. 480000" readonly>
                                            <div class="text-danger customer_mrp_error"
                                                id="customer_mrp_error_message"></div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="customer_passenger_price"
                                                class="form-label fw-semibold">Passenger Price (only admin)</label>
                                            <input type="number" class="form-control customer_passenger_price"
                                                name="passenger_price" id="customer_passenger_price"
                                                placeholder="e.g. 480000">
                                            <div class="text-danger customer_passenger_price_error"
                                                id="customer_passenger_price_error_message"></div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="customer_sales_commission_discount"
                                                class="form-label fw-semibold">Sales Discount (%) Per Passenger
                                                Price</label>
                                            <input type="number"
                                                class="form-control customer_sales_commission_discount"
                                                name="sales_commission_discount"
                                                id="customer_sales_commission_discount" placeholder="e.g. 20">
                                            <div class="text-danger customer_sales_commission_discount_error"
                                                id="customer_sales_commission_discount_error_message"></div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="customer_sales_commission"
                                                class="form-label fw-semibold">Sales Commission</label>
                                            <input type="number" class="form-control" name="sales_commission"
                                                id="customer_sales_commission" placeholder="e.g. 20000" readonly>
                                            <div class="text-danger customer_sales_commission_error"
                                                id="customer_sales_commission_error_message"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- agent price --}}
                            <section class="agent_details">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label>Added By Name</label>
                                        <input type="text" class="form-control customer_added_by_name"
                                            placeholder="e.g. RAJU-MAS">
                                        <span class="customer_agent_name_error" style="color:red"
                                            id="customer_agent_name_error_message"></span>
                                    </div>

                                    <div class="col-6 mb-3">
                                        <label>Code</label>
                                        <input type="text" class="form-control customer_added_by_code"
                                            name="" placeholder="e.g. NJ-AG-01">
                                        <span class="customer_agent_code_error" style="color:red"
                                            id="customer_agent_code_error_message"></span>
                                    </div>


                                </div>
                            </section>

                            <div class="col-6 mb-3">
                                <label>Country</label>
                                <input type="text" class="form-control customer_country" name="country"
                                    id="customer_country" placeholder="e.g. Malaysia-MAS">
                                <span class="customer_country_error" style="color:red"
                                    id="customer_country_error_message"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Company Name</label>
                                <input type="text" class="form-control customer_company_name" name="company_name"
                                    id="customer_company_name" placeholder="e.g. RAMLY FOOD PROCESSING">
                                <span class="customer_company_name_error" style="color:red"
                                    id="customer_company_name_error_message"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>PIC</label>
                                <input type="text" class="form-control customer_pic" name="pic"
                                    id="customer_pic" placeholder="e.g. PIC001">
                                <span class="customer_pic_error" style="color:red"
                                    id="customer_pic_error_message"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label>Medical Date</label>
                                <input type="date" class="form-control customer_medical_date" name="medical_date"
                                    id="customer_medical_date">
                                <span class="customer_medical_date_error" style="color:red"
                                    id="customer_medical_date_error_message"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Medical Center</label>
                                <input type="text" class="form-control customer_medical_center"
                                    name="medical_center" id="customer_medical_center"
                                    placeholder="e.g. Green Life Medical">
                                <span class="customer_medical_center_error" style="color:red"
                                    id="customer_medical_center_error_message"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Medical Result</label>
                                <input type="text" class="form-control customer_medical_result"
                                    name="medical_result" id="customer_medical_result"
                                    placeholder="e.g. FIT / UNFIT">
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
                                    id="customer_payment_method">
                                    <option value="">Select Method</option>
                                    <option value="cash">Cash</option>
                                    {{-- onchange="admintoggleAccountField()" <option value="bank">Bank</option>
                            <option value="wallet">Wallet</option> --}}
                                </select>
                                <span class="customer_payment_method_error" style="color:red"
                                    id="customer_payment_method_error_message"></span>
                            </div>

                            <div class="col-6 mb-3 d-none" id="customer_account_number_group">
                                <label>Account Number</label>
                                <input type="text" class="form-control" name="account_number"
                                    id="customer_account_number" placeholder="e.g. 1234567890">
                                <span class="customer_account_number_error" style="color:red"
                                    id="customer_account_number_error_message"></span>
                            </div>

                            <div class="col-12 mb-3">
                                <label>Approval</label>
                                <select class="form-control customer_approval" name="approval" id="approval">
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
                            <input type="number" class="form-control customer_slot" name="customer_slot"
                                id="customer_slot" placeholder="Enter your slot">
                            <span class="customer_slot_error" style="color:red"
                                id="customer_slot_error_message"></span>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-primary px-4" onclick="customerUpdate(event)">UPDATE CUSTOMER</button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





<script>
    // ==============================
    // Image preview on file change
    // ==============================
    document.getElementById('customer_image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('customer_image_preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = ""; // reset if no file
        }
    });






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
                console.log("==", customer);
                // Set customer image
                document.getElementById('customer_image_preview').src = customer.image ?
                    `/upload/dashboard/images/customers/${customer.image}` :
                    `/upload/dashboard/images/customers/default.jpg`;

                // Set form values
                const setField = (selector, value, fallback = '') => {
                    const el = document.querySelector(selector);
                    if (el) el.value = value || fallback;
                };




                if (customer.admin && customer.admin.id) {
                    setField('.customer_added_by_name', customer.admin.name || 'N/A');
                    setField('.customer_added_by_code', customer.admin.admin_code || 'ADMIN-CODE');
                } else if (customer.agent && customer.agent.id) {
                    setField('.customer_added_by_name', customer.agent.name || 'N/A');
                    setField('.customer_added_by_code', customer.agent.agent_code || 'AGENT-CODE');
                } else {
                    setField('.customer_added_by_name', 'N/A');
                    setField('.customer_added_by_code', 'N/A');
                }




                setField('.customer_id', customer.id); //done
                setField('.admin_id', customer.admin_id); //done
                setField('.agent_id', customer.agent_id); //done
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

        let packageDropdown = document.querySelector('#customer_create_component_available_packages_dropdown');
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

                packageDropdown.innerHTML = '<option value="">Select Category</option>';
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
    let packageDetails = {};
    async function loadPackageDetailsById(packageId) {
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
                packageDetails = res.data.packageDetails;
                let couponLists = packageDetails.discounts || []; //coupon list from package

                // Set details
                document.querySelector('.start_date').value = packageDetails.start_date || '';
                document.querySelector('.end_date').value = packageDetails.end_date || '';
                document.querySelector('.admin_package_price_field').value = parseInt(packageDetails.price) || '';
                document.querySelector('.package_duration').value = packageDetails.duration || '';
                document.querySelector('.package_inclusions').value = packageDetails.inclusions || '';
                document.querySelector('.package_exclusions').value = packageDetails.exclusions || '';
                document.querySelector('.package_visa_processing_time').value = packageDetails
                    .visa_processing_time || '';
                document.querySelector('.package_documents_required').value = packageDetails.documents_required ||
                    '';
                document.querySelector('.package_seat_availability').value = packageDetails.seat_availability;
                document.querySelector('.total_sold').value = packageDetails.total_sold;
                document.querySelector('.available_seat').value = packageDetails.seat_availability - packageDetails
                    .total_sold;

                document.querySelector('.customer_mrp').value = parseInt(packageDetails.price) || '';
                document.querySelector('.customer_passenger_price').value = parseInt(packageDetails.price) || '';
                document.querySelector('.coupon_use_current_price').value = parseInt(packageDetails.price) || '';
                comissoinCalculator();

                // Show coupon section and table
                let couponSection = document.querySelector('.coupon_section');
                let dynamicCuponSection = document.querySelector('.dynamic_coupon_section');

                if (couponLists.length > 0) {
                    couponSection.classList.remove('d-none');

                    const currentPrice = parseFloat(packageDetails.price) || 0;

                    dynamicCuponSection.innerHTML = `
                        <div class="table-responsive">
                            <h3>Available Coupon Lists</h3>
                            <table class="table table-bordered table-striped">
                                <thead class="table">
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Coupon Code</th>
                                        <th>Discount (%)</th>
                                        <th>Validity</th>
                                        <th>Current Price</th>
                                        <th>Discounted Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${couponLists.map((coupon, index) => {
                                        const discountValue = coupon.discount_value || 0;
                                        const discountedPrice = currentPrice - (currentPrice * discountValue / 100);
                                        return `
                                            <tr>
                                                <td>${index + 1}</td>
                                                <td>${coupon.coupon_code}</td>
                                                <td>${discountValue}%</td>
                                                <td>${coupon.start_date} to ${coupon.end_date}</td>
                                                <td>${currentPrice.toFixed(2)}</td>
                                                <td>${discountedPrice.toFixed(2)}</td>
                                            </tr>
                                        `;
                                    }).join('')}
                                </tbody>
                            </table>
                        </div>
                    `;
                } else {
                    couponSection.classList.add('d-none'); // Hide coupon section
                    dynamicCuponSection.innerHTML = `<div class="alert alert-warning">No coupon found</div>`;
                }
            }

            document.getElementById('admin_price_section').classList.remove('d-none');
            document.querySelector('#purpose_wise_package_section').classList.remove('d-none');

        } catch (err) {
            console.error("Package details fetch error:", err);
        }
    }



    //===============================
    // calculate comission 
    //===============================
    function comissoinCalculator() {
        let inputCommissionDiscount = parseFloat(document.querySelector('.customer_sales_commission_discount').value) ||
            0;
        let customerPrice = parseFloat(document.querySelector('.customer_passenger_price').value) || 0;

        if (inputCommissionDiscount >= 100) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Commission!',
                text: 'Commission discount must be less than or equal to 100!',
                confirmButtonText: 'OK'
            });

            document.querySelector('.customer_sales_commission_discount').value = '';
            document.querySelector('#customer_sales_commission').value = '';
            return;
        }

        let agentCommissionAmount = (customerPrice * inputCommissionDiscount) / 100;
        document.querySelector('#customer_sales_commission').value = agentCommissionAmount.toFixed(2);
    }

    document.querySelector('.customer_passenger_price').addEventListener('input', comissoinCalculator);
    document.querySelector('.customer_sales_commission_discount').addEventListener('input', comissoinCalculator);






    //========================
    //update package price
    //========================
    async function customerCreateUpdatePackagePrice(event) {
        event.preventDefault();

        const token = localStorage.getItem('token');
        if (!token) {
            alert("Unauthorized. Please login again.");
            return window.location.href = "/admin/login";
        }

        const id = document.querySelector(".customer_create_component_available_packages_dropdown").value;
        const new_price = document.querySelector(".admin_package_price_field").value.trim();

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
                document.querySelector('.admin_package_price_field').value = new_price;
                document.querySelector('.customer_mrp').value = new_price;
                document.querySelector('.customer_passenger_price').value = new_price;

                // Update all rendered coupon "current price"
                document.querySelectorAll('.coupon_use_current_price').forEach(input => {
                    input.value = new_price;
                });

                // update packageDetails object
                packageDetails.price = Number(new_price);

                // Re-render coupons
                renderCoupons(packageDetails.discounts || [], Number(new_price), packageDetails.discount ?? null);

                //refresh all field 
                document.querySelector('#coupon_code_input').value = ""
                document.querySelector('#coupon_use_new_price').value = ""

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




    function renderCoupons(discounts = [], currentPrice = 0, fallbackDiscount = null) {
        const section = document.getElementById('dynamic_coupon_section');
        section.innerHTML = '';

        const today = new Date().toISOString().slice(0, 10);
        const validCoupons = discounts.filter(d => d.start_date <= today && d.end_date >= today);
        const hasCoupon = validCoupons.some(d => d.coupon_code);
        toggleCouponSections(hasCoupon);

        if (validCoupons.length) {
            section.innerHTML = `
            <div class="table-responsive">
                <h4>Available Coupon Lists</h4>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Coupon Code</th>
                            <th>Discount (%)</th>
                            <th>Validity</th>
                            <th>Current Price</th>
                            <th>Discounted Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${validCoupons.map((coupon, index) => {
                            const discountedPrice = currentPrice - (currentPrice * (coupon.discount_value || 0) / 100);
                            return `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${coupon.coupon_code || 'Only Discount'}</td>
                                    <td>${coupon.discount_value || 'N/A'}%</td>
                                    <td>${coupon.start_date} to ${coupon.end_date}</td>
                                    <td>${currentPrice.toFixed(2)}</td>
                                    <td>${discountedPrice.toFixed(2)}</td>
                                </tr>
                            `;
                        }).join('')}
                    </tbody>
                </table>
            </div>
        `;
        } else if (fallbackDiscount) {
            const discountedPrice = currentPrice - (currentPrice * fallbackDiscount / 100);
            toggleCouponSections(false);
            section.innerHTML = `
            <div class="alert alert-info">
                <p><strong>Only Discount:</strong> ${fallbackDiscount}%</p>
                <p><strong>Current Price:</strong> ${currentPrice.toFixed(2)}</p>
                <p><strong>Discounted Price:</strong> ${discountedPrice.toFixed(2)}</p>
            </div>
        `;
        } else {
            toggleCouponSections(false);
            section.innerHTML = `<div class="alert alert-warning">No Discount Available</div>`;
        }
    }


    function toggleCouponSections(show) {
        ['coupon_code_section', 'new_price_section', 'coupon_code_discount_section'].forEach(id => {
            const el = document.getElementById(id);
            if (show) el.classList.remove('d-none');
            else el.classList.add('d-none');
        });
    }


    // Apply coupon code function
    async function applyCouponCode() {
        const token = localStorage.getItem('token');
        const couponSuccess = document.getElementById('coupon_success_message');
        const couponError = document.getElementById('coupon_error_message');
        const couponInput = document.getElementById('coupon_code_input');
        const packageSelect = document.getElementById('customer_create_component_available_packages_dropdown');
        const couponDiscount = document.getElementById('coupon_discount_input');

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
                const discount_amount = response.data.discounted_price;
                const discount = response.data.discount_value;
                document.getElementById('coupon_use_new_price').value = discount_amount;
                document.getElementById('coupon_code_discount_input').value = discount;

                // ✅ Add these two lines to reflect changes
                document.querySelector('.customer_mrp').value = discount_amount;
                document.querySelector('.customer_passenger_price').value = discount_amount;

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
        // ✅ আগের details hide করো
        document.getElementById('purpose_wise_package_section').classList.add('d-none');
        document.querySelector('.coupon_section')?.classList.add('d-none');
        document.querySelector('#admin_price_section')?.classList.add('d-none');

        // ✅ আগের package dropdown reset করো
        document.getElementById('customer_create_component_available_packages_dropdown').innerHTML =
            '<option value="">প্যাকেজ নির্বাচন করুন</option>';

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
            // document.getElementById('purpose_wise_package_section').classList.add('d-none');
            // document.querySelector('.coupon_section')?.classList.add('d-none');
            // document.querySelector('#coupon_section')?.classList.add('d-none');
            if (selectedPackageId) {
                loadPackageDetailsById(selectedPackageId);
            }
    });





//customer Update 



function customerUpdate(event){
    event.preventDefault();



    //initialize error message
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

    document.getElementById('customer_sales_commission_discount_error_message').innerText = '';

    document.getElementById('customer_country_error_message').innerText = '';
    document.getElementById('customer_company_name_error_message').innerText = '';

    document.getElementById('customer_pic_error_message').innerText = '';

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
    document.getElementById('customer_approval_error_message').innerText = '';
    document.getElementById('customer_slot_error_message').innerText = '';

    


    //get input value
    let id = document.getElementById('customer_id').value.trim();
    let admin_id = document.getElementById('admin_id').value.trim();
    let agent_id = document.getElementById('agent_id').value.trim();
    let package_id = document.getElementById('customer_create_component_available_packages_dropdown').value.trim();
    let package_category_id = document.getElementById('package_categories_dropdown').value.trim();
    let name = document.getElementById('customer_name').value.trim();
    let email = document.getElementById('customer_email').value.trim();
    let image = document.getElementById('customer_image').value.trim();
    let phone = document.getElementById('customer_phone').value.trim();
    let passport_no = document.getElementById('customer_passport_no').value.trim();
    let age = document.getElementById('customer_age').value.trim();
    let gender = document.getElementById('customer_gender').value.trim();
    let date_of_birth = document.getElementById('customer_date_of_birth').value.trim();
    let nid_number = document.getElementById('customer_nid_number').value.trim();
    let price = document.getElementById('admin_package_price_field').value.trim();
    let duration = document.getElementById('package_duration').value.trim();
    let inclusions = document.getElementById('package_inclusions').value.trim();
    let exclusions = document.getElementById('package_exclusions').value.trim();
    let visa_processing_time = document.getElementById('package_visa_processing_time').value.trim();
    let documents_required = document.getElementById('package_documents_required').value.trim();
    let seat_availability = document.getElementById('package_seat_availability').value.trim();
    let customer_slot = document.getElementById('customer_slot').value.trim();
    let coupon_code = document.getElementById('coupon_code_input').value.trim();
    let coupon_discount = document.getElementById('coupon_code_discount_input').value.trim();
    let coupon_use_discounted_price = document.getElementById('coupon_use_new_price').value.trim();
    // let package_discount = document.getElementById('package_discount').value.trim();
    // let package_discounted_price = document.getElementById('package_discounted_price').value.trim();
    let country = document.getElementById('customer_country').value.trim();
    let company_name = document.getElementById('customer_company_name').value.trim();
    let pic = document.getElementById('customer_pic').value.trim();
    let sales_commission_discount = document.getElementById('customer_sales_commission_discount').value.trim();
    let sales_commission = document.getElementById('customer_sales_commission').value.trim();
    let mrp = document.getElementById('customer_mrp').value.trim();
    // let agent_name = document.getElementById('agent_name').value.trim();
    // let agent_code = document.getElementById('agent_code').value.trim();
    // let agent_price = document.getElementById('agent_price').value.trim();
    // let passenger_price = document.getElementById('passenger_price').value.trim();
    // let staff_name = document.getElementById('staff_name').value.trim();
    // let staff_code = document.getElementById('staff_code').value.trim();
    // let staff_price = document.getElementById('staff_price').value.trim();
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
    //let account_number = document.getElementById('account_number').value.trim();
    let approval = document.getElementById('approval').value.trim();
    let isError = false;


    if(!package_id){
        document.getElementById('customer_package_error').innerText = 'Please Choose a valid Category Package';
        isError = true
    }

    if(!package_category_id){
        document.getElementById('customer_purpose_error').innerText = 'Please Choose Category';
        isError = true
    }

    if(!name){
        document.getElementById('customer_name_error').innerText = 'Please Enter Name';
        isError = true
    }

    if(!email){
        document.getElementById('customer_email_error').innerText = 'Please Enter Email';
        isError = true
    }

    if(!phone){
        document.getElementById('customer_phone_error').innerText = 'Please Enter Phone Number';
        isError = true
    }

    if(!passport_no){
        document.getElementById('customer_passport_no_error').innerText = 'Please Enter Passport Number';
        isError = true
    }

    if(!age){
        document.getElementById('customer_age_error').innerText = 'Please Enter Passport Number';
        isError = true
    }

    if(!gender){
        document.getElementById('customer_gender_error').innerText = 'Please Enter Passport Number';
        isError = true
    }

    if(!date_of_birth){
        document.getElementById('customer_date_of_birth_error').innerText = 'Please Enter Your Bith Date';
        isError = true
    }

    if(!nid_number){
        document.getElementById('customer_nid_number_error').innerText = 'Please Enter Your NID Number';
        isError = true
    }

    if(!price){
        document.getElementById('admin_package_price_error').innerText = 'Package Price is required';
        isError = true
    }

    if(!country){
        document.getElementById('customer_country_error_message').innerText = 'Country is required';
        isError = true
    }

    if(!company_name){
        document.getElementById('customer_company_name_error_message').innerText = 'Company name is required';
        isError = true
    }

    if(!pic){
        document.getElementById('customer_pic_error_message').innerText = 'PIC is required';
        isError = true
    }

    if(!medical_date){
        document.getElementById('customer_medical_date_error_message').innerText = 'Medical Date  is required';
        isError = true
    }

    if(!medical_center){
        document.getElementById('customer_medical_center_error_message').innerText = 'Medical Center  is required';
        isError = true
    }

    if(!medical_result){
        document.getElementById('customer_medical_result_error_message').innerText = 'Medical Result  is required';
        isError = true
    }

    if(!visa_online){
        document.getElementById('customer_visa_online_error_message').innerText = 'Visa Online  is required';
        isError = true
    }

    if(!calling){
        document.getElementById('customer_calling_error_message').innerText = 'Calling  is required';
        isError = true
    }

    if(!training){
        document.getElementById('customer_training_error_message').innerText = 'Training  is required';
        isError = true
    }

    if(!e_vissa){
        document.getElementById('customer_e_vissa_error_message').innerText = 'E-Visa  is required';
        isError = true
    }

    if(!bmet){
        document.getElementById('customer_bmet_error_message').innerText = 'BMET  is required';
        isError = true
    }

    if(!fly){
        document.getElementById('customer_fly_error_message').innerText = 'FLY  is required';
        isError = true
    }

    if(!payment){
        document.getElementById('customer_payment_error_message').innerText = 'Payment  is required';
        isError = true
    }

    if(!payment_method){
        document.getElementById('customer_payment_method_error_message').innerText = 'Payment Method is required';
        isError = true
    }

    if(!approval){
        document.getElementById('customer_approval_error_message').innerText = 'Approval is required';
        isError = true
    }



    if(!customer_slot){
        document.getElementById('customer_slot_error_message').innerText = 'Slot is required';
        isError = true
    }

    if(isError) return;
    console.log("all field done");
}










</script>
