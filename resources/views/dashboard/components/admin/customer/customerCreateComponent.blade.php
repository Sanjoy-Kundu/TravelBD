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
                        <label>Admin Id</label>
                        <input type="number" class="form-control" name="admin_id" id="customer_create_by_admin_id"
                            placeholder="Admin id" readonly>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="e.g. MD RUBEL SARDER">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email"
                            placeholder="e.g. rubelsarder@gmail.com">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Upload Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="col-12 mb-3">
                        <label>Phone</label>
                        <input type="tel" class="form-control" name="phone" placeholder="e.g. 01700000000">
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
                        <label>Purpose / Categories</label>
                        <select class="form-control" name="purpose"
                            id="create_customer_componoent_package_category_dropdown">
                            <option value="">Select Purpose</option>

                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label>Available Packages</label>
                        <select class="form-control" name="package_id"
                            id="customer_create_component_available_packages_dropdown">
                            <option value="">Choose Category First</option>
                        </select>
                    </div>
                    {{-- purpose wise package  start --}}
                    <!-- Purpose Wise Package - Card Style -->
                    <div class="col-12 mb-4">
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
                                            placeholder="e.g. 6 Months" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Inclusions</label>
                                        <input type="text" class="form-control" name="inclusions"
                                            placeholder="Visa, Ticket, Insurance" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Exclusions</label>
                                        <input type="text" class="form-control" name="exclusions"
                                            placeholder="Personal Expenses" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Visa Processing Time</label>
                                        <input type="text" class="form-control" name="visa_processing_time"
                                            placeholder="e.g. 15 Days" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Documents Required</label>
                                        <input type="text" class="form-control" name="documents_required"
                                            placeholder="Passport, Photo, etc." readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Seat Availability</label>
                                        <input type="text" class="form-control" name="seat_availability"
                                            placeholder="e.g. 20 Seats Left" readonly>
                                    </div>

                                    <div id="dynamic_coupon_section" class="col-12 mb-3"></div>




                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- purpose wise package end --}}

                    <div class="col-12 mb-3">
                        <label>Country</label>
                        <input type="text" class="form-control" name="country" placeholder="e.g. Malaysia-MAS">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Company Name</label>
                        <input type="text" class="form-control" name="company_name"
                            placeholder="e.g. RAMLY FOOD PROCESSING">
                    </div>
                    <div class="col-12 mb-3">
                        <label>PIC</label>
                        <input type="text" class="form-control" name="pic" placeholder="e.g. PIC001">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Sales Commission</label>
                        <input type="text" class="form-control" name="sales_commission"
                            placeholder="e.g. 20,000">
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
                        <input type="text" class="form-control" name="passenger_price"
                            placeholder="e.g. 4,80,000">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Medical Date</label>
                        <input type="date" class="form-control" name="medical_date">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Medical Center</label>
                        <input type="text" class="form-control" name="medical_center"
                            placeholder="e.g. Green Life Medical">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Medical Result</label>
                        <input type="text" class="form-control" name="medical_result"
                            placeholder="e.g. FIT / UNFIT">
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
                        <select class="form-control" name="approval">
                            <option value="">Select approval</option>
                            <option value="Pending">Pending</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4">Submit</button>
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
        let method = document.getElementById('payment_method').value;
        let accountField = document.getElementById('account_number_group');

        if (method === 'bank' || method === 'wallet') {
            accountField.classList.remove('d-none');
        } else {
            accountField.classList.add('d-none');
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



            try {
                let res = await axios.post('/admin/package/lists/details/by/catgory', {
                    id: id
                }, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                let packageDetails = res.data.packageDetails;


                document.querySelector('input[name="price"]').value = packageDetails.price ?? '';
                document.querySelector('input[name="duration"]').value = packageDetails.duration ?? '';
                document.querySelector('input[name="inclusions"]').value = packageDetails.inclusions ?? '';
                document.querySelector('input[name="exclusions"]').value = packageDetails.exclusions ?? '';
                document.querySelector('input[name="visa_processing_time"]').value = packageDetails.visa_processing_time ?? '';
                document.querySelector('input[name="documents_required"]').value = packageDetails.documents_required ?? '';
                document.querySelector('input[name="seat_availability"]').value = packageDetails.seat_availability ?? '';

                // Handle Discounts
                let discounts = packageDetails.discounts || [];
                let couponSection = document.getElementById('dynamic_coupon_section');
                couponSection.innerHTML = ''; // Clear previous content

                if (discounts.length > 0) {
                    discounts.forEach((discount, index) => {
                        couponSection.innerHTML += `
                    <div class="row border p-2 mb-2 rounded bg-light">
                        <div class="col-md-4 mb-2">
                            <label>Coupon ${index + 1}</label>
                            <input type="text" class="form-control" value="${discount.coupon_code ?? ''}" readonly>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Validity</label>
                            <input type="text" class="form-control" value="${discount.start_date ?? ''} to ${discount.end_date ?? ''}" readonly>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Discount</label>
                            <input type="text" class="form-control" value="${discount.discount_value ?? 'N/A'}" readonly>
                        </div>
                    </div>
                `;
                    });
                } else {
                    // No discount object — fallback (only discount amount)
                    couponSection.innerHTML = `
                <div class="row border p-2 mb-2 rounded bg-light">
                    <div class="col-md-12 mb-2">
                        <label>Discount</label>
                        <input type="text" class="form-control" value="${packageDetails.discount ?? ''}" readonly>
                    </div>
                </div>
            `;
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
</script>
