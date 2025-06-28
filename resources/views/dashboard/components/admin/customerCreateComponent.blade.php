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
            <form id="admin_customer_form">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="e.g. MD RUBEL SARDER">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Passport No</label>
                        <input type="text" class="form-control" name="passport_no" placeholder="e.g. B00588828">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Age</label>
                        <input type="number" class="form-control" name="age" placeholder="e.g. 28">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Purpose</label>
                        <select class="form-control" name="purpose">
                            <option value="">Select Purpose</option>
                            <option value="Work Permit">Work Permit</option>
                            <option value="Tourist">Tourist</option>
                            <option value="Business">Business</option>
                            <option value="Student Visa">Student Visa</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Country</label>
                        <input type="text" class="form-control" name="country" placeholder="e.g. Malaysia-MAS">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Company Name</label>
                        <input type="text" class="form-control" name="company_name" placeholder="e.g. RAMLY FOOD PROCESSING">
                    </div>
                    <div class="col-12 mb-3">
                        <label>PIC</label>
                        <input type="text" class="form-control" name="pic" placeholder="e.g. PIC001">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Sales Commission</label>
                        <input type="text" class="form-control" name="sales_commission" placeholder="e.g. 20,000">
                    </div>
                    <div class="col-12 mb-3">
                        <label>MRP</label>
                        <input type="text" class="form-control" name="mrp" placeholder="e.g. 4,80,000">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Agent Name</label>
                        <input type="text" class="form-control" name="agent_name" placeholder="e.g. RAJU-MAS">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Agent Code</label>
                        <input type="text" class="form-control" name="agent_code" placeholder="e.g. NJ-AG-01">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Agent Price</label>
                        <input type="text" class="form-control" name="agent_price" placeholder="e.g. 4,50,000">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Passenger Price</label>
                        <input type="text" class="form-control" name="passenger_price" placeholder="e.g. 4,80,000">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Medical Date</label>
                        <input type="date" class="form-control" name="medical_date">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Medical Center</label>
                        <input type="text" class="form-control" name="medical_center" placeholder="e.g. Green Life Medical">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Medical Result</label>
                        <input type="text" class="form-control" name="medical_result" placeholder="e.g. FIT / UNFIT">
                    </div>

                    <!-- Step Status -->
                    <div class="col-12 mb-3">
                        <label>Visa Online</label>
                        <select class="form-control" name="visa_online">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Calling</label>
                        <select class="form-control" name="calling">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Training</label>
                        <select class="form-control" name="training">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label>E-Vissa</label>
                        <select class="form-control" name="e_vissa">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label>BMET</label>
                        <select class="form-control" name="bmet">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Fly</label>
                        <select class="form-control" name="fly">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Payment</label>
                        <select class="form-control" name="payment">
                            <option value="">Select Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </div>

                    <!-- Payment Summary -->
                   <div class="col-12 mb-3">
                        <label>Method of Payment</label>
                        <select class="form-control" name="payment_method" id="payment_method"
                            onchange="admintoggleAccountField()">
                            <option value="">Select Method</option>
                            <option value="cash">Cash</option>
                            <option value="bank">Bank</option>
                            <option value="wallet">Wallet</option>
                        </select>
                    </div>

                    <div class="col-12 mb-3 d-none" id="account_number_group">
                        <label>Account Number</label>
                        <input type="text" class="form-control" name="account_number"
                            placeholder="e.g. 1234567890">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Approval</label>
                        <input type="text" class="form-control" name="approval" placeholder="e.g. Approved / Rejected">
                    </div>
                </div>

                <div class="text-end">
                    <button  class="btn btn-primary px-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function admintoggleAccountField() {
        let method = document.getElementById('payment_method').value;
        let accountField = document.getElementById('account_number_group');

        if (method === 'bank' || method === 'wallet') {
            accountField.classList.remove('d-none');
        } else {
            accountField.classList.add('d-none');
        }
    }

    // Token-based login check
    let token = localStorage.getItem('token');
    if (!token) {
        window.location.href = "/staff/login";
    }
</script>
