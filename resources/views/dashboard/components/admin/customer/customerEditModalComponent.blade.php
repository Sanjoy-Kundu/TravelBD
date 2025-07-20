<div class="modal fade" id="customerEditModal" tabindex="-1" aria-labelledby="customerEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
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
                                <input type="tel" class="form-control customer_phone" name="phone" placeholder="e.g. 01700000000"
                                    id="customer_phone">
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
                                <input type="number" class="form-control customer_age" name="age" placeholder="e.g. 28"
                                    id="customer_age">
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
                                <span class="customer_gender_error" style="color:red" id="customer_gender_error"></span>
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
                                <select class="form-control" name="package_category_id"
                                    id="package_categories_dropdown">
                                    <option value="">Select Purpose</option>
                                </select>
                                <span class="customer_purpose_error" style="color:red"
                                    id="customer_purpose_error"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Available Packages</label>
                                <select class="form-control" name="package_id"
                                    id="customer_create_component_available_packages_dropdown">
                                    <option value="">Choose Category First</option>
                                </select>
                                <span class="customer_package_error" style="color:red"
                                    id="customer_package_error"></span>
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
                                                    <input type="date" class="form-control bg-primary text-white"
                                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Applicatin Start Date</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control bg-success text-white"
                                                        name="start_date" id="start_date" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label>Application End Date</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control bg-danger text-white"
                                                        name="end_date" id="end_date" readonly>
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
                                                    <input type="text" class="form-control"
                                                        id="coupon_use_new_price" placeholder="Enter coupon code"
                                                        readonly name="coupon_use_discounted_price">

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
                                                        <input type="number" class="form-control"
                                                            id="coupon_code_discount_input"
                                                            placeholder="Enter coupon code" name="coupon_discount">
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 card border-info shadow-sm d-none" id="admin_price_section">
                                <div class="col-12 mb-3">
                                    <label>MRP (only admin)</label>
                                    <input type="number" class="form-control" name="mrp" id="customer_mrp"
                                        placeholder="e.g. 480000" readonly>
                                    <span class="customer_mrp_error" style="color:red"
                                        id="customer_mrp_error_message"></span>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Passenger Price (only admin)</label>
                                    <input type="number" class="form-control" name="passenger_price"
                                        id="customer_passenger_price" placeholder="e.g. 480000">
                                    <span class="customer_passenger_price_error" style="color:red"
                                        id="customer_passenger_price_error_message"></span>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Sales Discount(%) Per Passenger Price</label>
                                    <input type="number" class="form-control" name="sales_commission_discount"
                                        id="customer_sales_commission_discount" placeholder="e.g. 20,000">
                                    <span class="customer_sales_commission_discount_error" style="color:red"
                                        id="customer_sales_commission_error_message"></span>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Sales Commission</label>
                                    <input type="number" class="form-control" name="sales_commission"
                                        id="customer_sales_commission" placeholder="e.g. 20,000" readonly>
                                    <span class="customer_sales_commission_error" style="color:red"
                                        id="customer_sales_commission_error_message"></span>
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
                                <input type="text" class="form-control customer_pic" name="pic" id="customer_pic"
                                    placeholder="e.g. PIC001">
                                <span class="customer_pic_error" style="color:red"
                                    id="customer_pic_error_message"></span>
                            </div>



                            <div class="col-4 mb-3 d-none">
                                <label>Agent Name</label>
                                <input type="text" class="form-control" name="agent_name"
                                    placeholder="e.g. RAJU-MAS">
                                <span class="customer_agent_name_error" style="color:red"
                                    id="customer_agent_name_error_message"></span>
                            </div>

                            <div class="col-4 mb-3 d-none">
                                <label>Agent Code</label>
                                <input type="text" class="form-control" name="agent_code"
                                    placeholder="e.g. NJ-AG-01">
                                <span class="customer_agent_code_error" style="color:red"
                                    id="customer_agent_code_error_message"></span>
                            </div>

                            <div class="col-4 mb-3 d-none">
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
                                <select class="form-control" name="visa_online" id="customer_visa_online">
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
                                <select class="form-control customer_training" name="training" id="customer_training">
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                </select>
                                <span class="customer_training_error" style="color:red"
                                    id="customer_training_error_message"></span>
                            </div>

                            <div class="col-6 mb-3">
                                <label>E-Vissa</label>
                                <select class="form-control" name="e_vissa" id="customer_e_vissa">
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
                                <select class="form-control" name="payment" id="customer_payment">
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
                                <select class="form-control" name="payment_method" id="customer_payment_method"
                                    onchange="admintoggleAccountField()">
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
                                <select class="form-control customer_approval" name="approval" id="customer_approval">
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
                            <span class="customer_slot_error" style="color:red"
                                id="customer_slot_error_message"></span>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-primary px-4" onclick="customerCreate(event)">Submit</button>
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
                console.log(customer);
                // Image
                if (customer.image) {
                    document.querySelector('.customer_image').src =
                        `/upload/dashboard/images/customers/${customer.image}`;
                } else {
                    document.querySelector('.customer_image').src =
                        `/upload/dashboard/images/customers/default.jpg`;
                }

                // Set form input values
                document.querySelector('.customer_id').value = customer.id || '';
                document.querySelector('.admin_id').value = customer.admin_id || '';
                document.querySelector('.agent_id').value = customer.agent_id || '';

                document.querySelector('.customer_name').value = customer.name ? customer.name : 'N/A';
                document.querySelector('.customer_email').value = customer.email? customer.email : 'N/A';

                document.querySelector('.customer_phone').value = customer.phone? customer.phone : '*****';
                document.querySelector('.customer_passport_no').value = customer.passport_no?customer.passport_no:'N/A';
                document.querySelector('.customer_age').value = customer.age?customer.age:'N/A';

                document.querySelector('.customer_date_of_birth').value = customer.date_of_birth?customer.date_of_birth:'N/A';
                document.querySelector('.customer_gender').value = customer.gender?customer.gender:'N/A';
                document.querySelector('.customer_nid_number').value = customer.nid_number?customer.nid_number:'N/A';


                document.querySelector('.customer_company_name').value = customer.company_name?customer.company_name:'';
                document.querySelector('.customer_pic').value = customer.pic?customer.pic:'';

                document.querySelector('.customer_approval').value = customer.approval?customer.approval:'';
                document.querySelector('.customer_bmet').value = customer.bmet?customer.bmet:'';
                document.querySelector('.customer_calling').value = customer.calling?customer.calling:'';
                document.querySelector('.customer_fly').value = customer.fly?customer.fly:'';
                document.querySelector('.customer_training').value = customer.training?customer.training:'';
                // document.querySelector('#added_by_name').value = customer.admin_id ? customer.admin.name :
                //     customer.agent_id ? customer.agent.name : '';

                // document.querySelector('#added_by_code').value = customer.admin_id ? '--NO CODE--' :
                //     customer.agent_id ? customer.agent.agent_code : '';




                
                
                
                
                
                // document.querySelector('#customer_slot').value = customer.customer_slot ?? '';
                // document.querySelector('#customer_package_category_id').value = customer.package_category_id || '';
                // document.querySelector('#customer_package_id').value = customer.package_id || '';
                // document.querySelector('#customer_approval').value = customer.approval || '';
                // document.querySelector('#customer_payment_method').value = customer.payment_method || '';
                // document.querySelector('#customer_company_name').value = customer.company_name || '';
                // document.querySelector('#customer_country').value = customer.country || '';
                // document.querySelector('#customer_medical_center').value = customer.medical_center || '';
                // document.querySelector('#customer_medical_date').value = customer.medical_date || '';
                // document.querySelector('#customer_medical_result').value = customer.medical_result || '';
                // document.querySelector('#customer_training').value = customer.training || '';
                // document.querySelector('#customer_fly').value = customer.fly || '';
                // document.querySelector('#customer_visa_online').value = customer.visa_online || '';
                // document.querySelector('#customer_calling').value = customer.calling || '';
                // document.querySelector('#customer_e_visa').value = customer.e_vissa || '';
                // document.querySelector('#customer_bmet').value = customer.bmet || '';
                // document.querySelector('#customer_payment').value = customer.payment || '';
                // document.querySelector('#customer_account_number').value = customer.account_number || '';
                // document.querySelector('#customer_pic').value = customer.pic || '';

                // await loadCategoryListSelectedByCustomerCategoryId(customer.package_category_id);
                // await loadPackagesByCategoryId(customer.package_category_id, customer.package_id);

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
            let dropdown = document.getElementById('customer_package_category_id');

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
            console.log('package lists by category', res.data);

            if (res.data.status === 'success') {
                let packages = res.data.packageListByCategory;
                let packageDropdown = document.getElementById('customer_package_id');

                packageDropdown.innerHTML = '<option value="">Select Package</option>';
                packageDropdown.disabled = false;

                packages.forEach(pkg => {
                    console.log(pkg)
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
