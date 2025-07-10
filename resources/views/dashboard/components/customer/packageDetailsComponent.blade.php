<div class="container my-4">
    <h1>Welcome, <span class="customer_name_main text-primary fw-bold">Customer</span></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Customer Dashboard</li>
    </ol>

    <div class="container my-5">
        <h3 class="mb-4 text-primary">📦 My Package Full Details</h3>

        <!-- Customer Info & Package Basic -->
        <div class="card mb-4 shadow-sm rounded-4">
            <div class="card-body">
                <div class="row g-4 align-items-center">
                    <div class="col-md-3 text-center">
                        <img src="https://images.unsplash.com/photo-1504150558240-0b4fd8946624?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Customer Image" class="img-fluid rounded-4 shadow-sm" />
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong><input readonly name="id" type="text" id="customer_id_for_packageDetails"></strong></p>
                                <p><strong>Name:</strong> <span id="name"></span></p>
                                <p><strong>Email:</strong> <span id="email"></span></p>
                                <p><strong>Phone:</strong> <span id="mobile_no"></span></p>
                                <p><strong>Passport No:</strong><span id="passport_no"></span></p>
                                <p><strong>Age:</strong><span id="age"></span></p>
                                <p><strong>Gender:</strong><span id="gender"></span></p>
                                <p><strong>Date of Birth:</strong> <span id="dob"></span></p>
                                <p><strong>NID:</strong> <span id="nid_number"></span></p>
                                <p><strong>Country:</strong> <span id="country"></span></p>
                                <p><strong>Company Name:</strong><span id="company_name"></span></p>
                                <p><strong>PIC:</strong> <span id="pic"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Package:</strong> <span id="package_name"></span></p>
                                <p><strong>Category:</strong> <span id="category_name"></span></p>
                            </div>
                        </div>
                        <!-- Edit Button -->
                        <div class="text-end mt-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editCustomerModal">
                                <i class="fas fa-edit me-2"></i> EDIT YOUR INFO
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Price & Discount Section -->
        <div class="card mb-4 shadow-sm rounded-4 border-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">💰 Pricing Details</h5>
            </div>
            <div class="card-body">
                <div class="row text-center text-md-start">
                    <div class="col-6 col-md-3 mb-3">
                        <h6 class="text-secondary">Original Price</h6>
                        <p class="fs-5 fw-bold text-danger" id="package_price"></p>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <h6 class="text-secondary">Discount (%)</h6>
                        <p class="fs-5 fw-bold text-success"><span id="package_discount"></span>%</p>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <h6 class="text-secondary">Discounted Price</h6>
                        <p class="fs-5 fw-bold text-primary" id="package_discounted_price"></p>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <h6 class="text-secondary">Passenger Price</h6>
                        <p class="fs-5 fw-bold text-warning" id="passenger_price"></p>
                    </div>

                    <div class="col-6 col-md-3 mb-3">
                        <h6 class="text-secondary">Coupon Code</h6>
                        <p class="fs-6" id="coupon_code"></p>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <h6 class="text-secondary">Coupon Discount</h6>
                        <p class="fs-6" id="coupon_discount"></p>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <h6 class="text-secondary">After Coupon Price</h6>
                        <p class="fs-6" id="afterCouponPrice"></p>
                    </div>
                    {{-- <div class="col-6 col-md-3 mb-3">
                        <h6 class="text-secondary">Sales Commission</h6>
                        <p class="fs-6">৳3,500</p>
                    </div> --}}
                    <div class="col-6 col-md-3 mb-3">
                        <h6 class="text-secondary">MRP</h6>
                        <p class="fs-6" id="mrp"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Full Package Details Table -->
        <div class="card shadow-sm rounded-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">📋 Full Package Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm align-middle">
                    <tbody>
                        <tr>
                            <th>Duration</th>
                            <td id="duration"></td>
                        </tr>
                        <tr>
                            <th>Seat Availability</th>
                            <td id="seat_avaliability"></td>
                        </tr>
                        <tr>
                            <th>Customer Slot</th>
                            <td id="customer_slot"></td>
                        </tr>
                        <tr>
                            <th>Inclusions</th>
                            <td>
                                <ul class="mb-0 ps-3">
                                    <li>ভিসা ফি</li>
                                    <li>পারমিট</li>
                                    <li>বিমান টিকিট</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>Exclusions</th>
                            <td>
                                <ul class="mb-0 ps-3">
                                    <li>আবাসন ও যাতায়াত অন্তর্ভুক্ত নয়</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>Visa Processing Time</th>
                            <td id="visa_processing_time"></td>
                        </tr>
                        <tr>
                            <th>Documents Required</th>
                            <td>
                                <ol class="mb-0 ps-3">
                                    <li>পাসপোর্ট</li>
                                    <li>ছবি</li>
                                    <li>চাকরির চিঠি</li>
                                    <li>নিয়োগপত্র</li>
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <th>Medical Center</th>
                            <td id="medical_center"></td>
                        </tr>
                        <tr>
                            <th>Medical Date</th>
                            <td id="medical_date"></td>
                        </tr>
                        <tr>
                            <th>Medical Result</th>
                            <td id="medical_result"></td>
                        </tr>
                        <tr>
                            <th>Visa Online</th>
                            <td id="visa_online_status"></td>
                        </tr>
                        <tr>
                            <th>Calling</th>
                            <td id="calling_status"></td>
                        </tr>
                        <tr>
                            <th>Training</th>
                            <td id="training_status"></td>
                        </tr>
                        <tr>
                            <th>E-Visa</th>
                            <td id="e_visa_status"></td>
                        </tr>
                        <tr>
                            <th>BMET</th>
                            <td id="bmet_status"></td>
                        </tr>
                        <tr>
                            <th>Fly Status</th>
                            <td id="fly_status"></td>
                        </tr>
                        <tr>
                            <th>Payment</th>
                            <td id="payment_status"></td>
                        </tr>
                        <tr>
                            <th>Payment Method</th>
                            <td id="payment_method"></td>
                        </tr>
                        <tr>
                            <th>Account Number</th>
                            <td id="account_number"></td>
                        </tr>
                        <tr>
                            <th>Approval Status</th>
                            <td id="approval_status"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-end mt-4">
                    <a href="{{ url('/customer/payment') }}" class="btn btn-success btn-lg px-4">
                        <i class="fas fa-credit-card me-2"></i> Make Payment
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>




{{-- Edit button modal --}}
<!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel"
    aria-hidden="true">
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
                            <label for="imageInput" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" id="imageInput" accept="image/*" />
                        </div>

                        <div class="col-md-6 d-flex align-items-end">
                            <div class="border rounded-3 shadow-sm p-2 w-100 text-center" style="height: 180px;">
                                <img src="https://images.unsplash.com/photo-1504150558240-0b4fd8946624?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Preview" id="imagePreview"
                                    class="img-fluid h-100 rounded-3 object-fit-cover"
                                    style="max-height: 100%; max-width: 100%;" />
                                <small class="text-muted d-block mt-1">Preview</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nameInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nameInput" value="RUBEL HASSAN"
                                required />
                        </div>
                        <div class="col-md-6">
                            <label for="emailInput" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailInput" readonly
                                value="rubel@gmail.com" required />
                        </div>
                        <div class="col-md-6">
                            <label for="phoneInput" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phoneInput" value="01896325514"
                                required />
                        </div>
                        <div class="col-md-6">
                            <label for="passportInput" class="form-label">Passport No</label>
                            <input type="text" class="form-control" id="passportInput" value="1122334455"
                                required />
                        </div>
                        <div class="col-md-4">
                            <label for="ageInput" class="form-label">Age</label>
                            <input type="number" class="form-control" id="ageInput" value="27" required />
                        </div>
                        <div class="col-md-4">
                            <label for="genderSelect" class="form-label">Gender</label>
                            <select id="genderSelect" class="form-select" required>
                                <option value="Male" selected>Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="dobInput" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dobInput" value="1997-07-07" required />
                        </div>
                        <div class="col-md-6">
                            <label for="nidInput" class="form-label">NID</label>
                            <input type="text" class="form-control" id="nidInput" value="99663322501"
                                required />
                        </div>
                        <div class="col-md-6">
                            <label for="countryInput" class="form-label">Country</label>
                            <input type="text" class="form-control" id="countryInput" value="BANGLADESH" readonly
                                required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit button modal --}}





<style>
    .table th {
        width: 220px;
        font-weight: 600;
    }

    .table td {
        background-color: #fff;
    }

    ul,
    ol {
        margin: 0;
        padding-left: 1.2rem;
    }
</style>




<script>
    getUserInfo();
    async function getUserInfo(){
        let token = localStorage.getItem('token');
        if(!token){
            window.location.href = "/customer/login";
        }
        try{
          let res = await axios.get("/auth/customer",{headers:{
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json'
        }})
        console.log(res.data)

        if(res.data.status == "success"){
            document.querySelector("#customer_id_for_packageDetails").value = res.data.data.id;
            getUserPackageDetails();
        }
        }catch(error){
           // middleware error check 
            if (error.response && error.response.status === 401) {
                alert(error.response.data.message); // "Unauthorized"
                //  Token invalid → redirect to login
                localStorage.removeItem('token');
                window.location.href = "/customer/login";
            } else {
                alert("Something went wrong!");
                console.error("Unexpected error:", error);
            }
        }
    }


    
    async function getUserPackageDetails(){
        let token = localStorage.getItem('token');
        if(!token){
            window.location.href = "/customer/login";
        }
        let id = document.getElementById("customer_id_for_packageDetails").value 
        try{
          let res = await axios.post("/customer/package/details-by-id",{id:id},{headers:{
            Authorization: `Bearer ${token}`,
            'Content-Type': 'application/json'
        }})
    

        if(res.data.status == "success"){
            console.log(res.data.packages)
            document.getElementById('name').innerHTML = res.data.packages.name?res.data.packages.name:"N/A";
            document.getElementById('email').innerHTML = res.data.packages.email?res.data.packages.email:"N/A"; 
            document.getElementById('age').innerHTML = res.data.packages.age?res.data.packages.age:"N/A"; 

            document.getElementById('approval_status').innerHTML = res.data.packages.approval?res.data.packages.approval:"N/A";      
            document.getElementById('bmet_status').innerHTML = res.data.packages.bmet?res.data.packages.bmet:"N/A";      
            document.getElementById('calling_status').innerHTML = res.data.packages.calling?res.data.packages.calling:"N/A";      
            document.getElementById('company_name').innerHTML = res.data.packages.company_name?res.data.packages.company_name:"N/A";      
            document.getElementById('country').innerHTML = res.data.packages.country?res.data.packages.country:"N/A";  

            document.getElementById('coupon_code').innerHTML = res.data.packages.coupon_code?res.data.packages.coupon_code:"N/A";      
            document.getElementById('coupon_discount').innerHTML = res.data.packages.coupon_discount?res.data.packages.coupon_discount:"N/A";      
            document.getElementById('afterCouponPrice').innerHTML = res.data.packages.coupon_use_discounted_price?res.data.packages.coupon_use_discounted_price:"N/A";  

            document.getElementById('customer_slot').innerHTML = res.data.packages.customer_slot?res.data.packages.customer_slot:"N/A";      
            document.getElementById('dob').innerHTML = res.data.packages.date_of_birth?res.data.packages.date_of_birth:"N/A";  
            document.getElementById('duration').innerHTML = res.data.packages.duration?res.data.packages.duration:"N/A";  
            document.getElementById('e_visa_status').innerHTML = res.data.packages.e_vissa?res.data.packages.e_vissa:"N/A";  
            document.getElementById('fly_status').innerHTML = res.data.packages.fly?res.data.packages.fly:"N/A";  
            document.getElementById('gender').innerHTML = res.data.packages.gender?res.data.packages.gender:"N/A";  
            document.getElementById('medical_center').innerHTML = res.data.packages.medical_center?res.data.packages.medical_center:"N/A";  
            document.getElementById('medical_date').innerHTML = res.data.packages.medical_date?res.data.packages.medical_date:"N/A";  
            document.getElementById('medical_result').innerHTML = res.data.packages.medical_result?res.data.packages.medical_result:"N/A";  
            document.getElementById('mrp').innerHTML = res.data.packages.mrp?res.data.packages.mrp:"N/A";  
            document.getElementById('nid_number').innerHTML = res.data.packages.nid_number?res.data.packages.nid_number:"N/A";  
            document.getElementById('package_discount').innerHTML = res.data.packages.package_discount?res.data.packages.package_discount:"N/A";  
            document.getElementById('package_discounted_price').innerHTML = res.data.packages.package_discounted_price?res.data.packages.package_discounted_price:"N/A";  
            document.getElementById('passenger_price').innerHTML = res.data.packages.passenger_price?res.data.packages.passenger_price:"N/A";  
            document.getElementById('passport_no').innerHTML = res.data.packages.passport_no?res.data.packages.passport_no:"N/A";  
            document.getElementById('payment_status').innerHTML = res.data.packages.payment?res.data.packages.payment:"N/A";  
            document.getElementById('payment_method').innerHTML = res.data.packages.payment_method?res.data.packages.payment_method:"N/A";  
            document.getElementById('mobile_no').innerHTML = res.data.packages.phone?res.data.packages.phone:"N/A";  
            document.getElementById('pic').innerHTML = res.data.packages.pic?res.data.packages.pic:"N/A";  
            document.getElementById('package_price').innerHTML = res.data.packages.price?res.data.packages.price:"N/A";  
            //document.getElementById('sales_commission').innerHTML = res.data.packages.sales_commission?res.data.packages.sales_commission:"N/A";  
            document.getElementById('seat_avaliability').innerHTML = res.data.packages.seat_availability?res.data.packages.seat_availability:"N/A";  
            document.getElementById('training_status').innerHTML = res.data.packages.training?res.data.packages.training:"N/A";  
            document.getElementById('visa_online_status').innerHTML = res.data.packages.visa_online?res.data.packages.visa_online:"N/A";  
            document.getElementById('visa_processing_time').innerHTML = res.data.packages.visa_processing_time?res.data.packages.visa_processing_time:"N/A";  
            document.getElementById('account_number').innerHTML = res.data.packages.account_number?res.data.packages.account_number:"N/A";  
            //console     documents_required:"পাসপোর্ট, ছবি, চাকরির চিঠি, নিয়োগপত্র"
            //console      exclusions: "আবাসন ও যাতায়াত অন্তর্ভুক্ত নয়"
            //console      inclusions: "ভিসা ফি, পারমিট, বিমান টিকিট"


        }
        }catch(error){
           // middleware error check 
            if (error.response && error.response.status === 401) {
                alert(error.response.data.message); // "Unauthorized"
                //  Token invalid → redirect to login
                localStorage.removeItem('token');
                window.location.href = "/customer/login";
            } else {
                alert("Something went wrong!");
                console.error("Unexpected error:", error);
            }
        }
    }
</script>
