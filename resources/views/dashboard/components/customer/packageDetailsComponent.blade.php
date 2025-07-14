<style>
    #printable_package_section {
        background-color: #ffffff;
        padding: 20px;
        overflow: visible !important;
        color: #000;
    }

    /* .no-print {
        display: none !important;
    } */
</style>
<div class="container my-4">
    <h1>Welcome, <span class="customer_name_main text-primary fw-bold">Customer</span></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Customer Dashboard</li>
    </ol>

    <div class="container my-5"id="printable_package_section">
        <h3 class="mb-4 text-primary">📦 My Package Full Details</h3>

        <!-- Customer Info & Package Basic -->
        <div class="card mb-4 shadow-sm rounded-4">
            <div class="card-body">
                <div class="row g-4 align-items-center">
                    <div class="col-md-3 text-center no-print">
                        <img src=""alt="Customer Image" class="img-fluid rounded-4 shadow-sm"
                            id="customer_image" />
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong><input readonly hidden name="id" type="text"
                                            id="customer_id_for_packageDetails"></strong></p>
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
                                <img src=""alt="Customer Image" class="img-fluid rounded-4 shadow-sm no-print"
                                    id="package_image" />
                            </div>
                        </div>
                        <!-- Edit Button  data-bs-toggle="modal"
                                data-bs-target="#editCustomerModal"-->
                        <div class="text-end mt-3 no-print">
                            <button type="button" class="btn btn-primary editCustomerInformation">
                                <i class="fas fa-edit me-2"></i> EDIT YOUR INFORMAION
                            </button>
                            {{-- data-bs-toggle="modal" data-bs-target="#pdfPreviewModal" --}}
                            <button class="btn btn-danger previewPackagePdf">
                                <i class="fas fa-file-pdf me-2"></i> Download PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Price & Discount Section -->
        <div class="card mb-4 shadow rounded-4 border-0">
            <div class="card-header bg-gradient bg-primary text-white rounded-top-4">
                <h5 class="mb-0 fw-semibold"><i class="bi bi-currency-dollar"></i> Pricing Details</h5>
            </div>
            <div class="card-body px-4 py-3">
                <div class="row gy-3 text-center text-md-start">
                    <div class="col-6 col-md-3">
                        <h6 class="text-muted mb-1">Your Package Price</h6>
                        <p class="fs-4 fw-bold text-danger mb-0"><span id="package_price"></span> TAKA</p>
                    </div>

                    <div class="col-6 col-md-3">
                        <h6 class="text-muted mb-1">Coupon Code</h6>
                        <p class="fs-4 fw-bold text-dark mb-0" id="coupon_code"></p>
                    </div>

                    <div class="col-6 col-md-3">
                        <h6 class="text-muted mb-1">Coupon Discount</h6>
                        <p class="fs-4 fw-bold text-success mb-0"><span id="coupon_discount"></span>%</p>
                    </div>

                    <div class="col-6 col-md-3">
                        <h6 class="text-muted mb-1">Coupon Discounted Price</h6>
                        <p class="fs-4 fw-bold text-primary mb-0"><span id="afterCouponPrice"></span> TAKA</p>
                    </div>

                    <div class="col-6 col-md-3">
                        <h6 class="text-muted mb-1">Payable Amount</h6>
                        <p class="fs-4 fw-bold fw-semibold text-success mb-0"><span id="payable_amount"></span> TAKA</p>
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
                <table class="table table-bordered table-striped table-sm align-middle" style="border-collapse: collapse; width: 100%;">
                    <tbody>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Duration</th>
                            <td style="border: 1px solid #000; padding: 8px"id="duration"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Seat Availability</th>
                            <td style="border: 1px solid #000; padding: 8px" id="seat_avaliability"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Customer Slot</th>
                            <td style="border: 1px solid #000; padding: 8px" id="customer_slot"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Inclusions</th>
                            <td style="border: 1px solid #000; padding: 8px">
                                <ol class="mb-0 ps-3" id="inclusionList"></ol>
                            </td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Exclusions</th>
                            <td style="border: 1px solid #000; padding: 8px">
                                <ol class="mb-0 ps-3" id="exclusionList"></ol>
                            </td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Visa Processing Time</th>
                            <td style="border: 1px solid #000; padding: 8px" id="visa_processing_time"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Documents Required</th>
                            <td style="border: 1px solid #000; padding: 8px">
                                <ol class="mb-0 ps-3" id="documentLists"></ol>
                            </td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Medical Center</th>
                            <td style="border: 1px solid #000; padding: 8px" id="medical_center"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Medical Date</th>
                            <td style="border: 1px solid #000; padding: 8px" id="medical_date"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Medical Result</th>
                            <td style="border: 1px solid #000; padding: 8px" id="medical_result"></td>
                        </tr>
                        <tr>
                            <th>Visa Online</th>
                            <td style="border: 1px solid #000; padding: 8px" id="visa_online_status"></td>
                        </tr>
                        <tr>
                            <th>Calling</th>
                            <td style="border: 1px solid #000; padding: 8px" id="calling_status"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Training</th>
                            <td style="border: 1px solid #000; padding: 8px" id="training_status"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">E-Visa</th>
                            <td style="border: 1px solid #000; padding: 8px" id="e_visa_status"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">BMET</th>
                            <td style="border: 1px solid #000; padding: 8px" id="bmet_status"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Fly Status</th>
                            <td style="border: 1px solid #000; padding: 8px" id="fly_status"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Payment</th>
                            <td style="border: 1px solid #000; padding: 8px" id="payment_status"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Payment Method</th>
                            <td style="border: 1px solid #000; padding: 8px" id="payment_method"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Account Number</th>
                            <td style="border: 1px solid #000; padding: 8px" id="account_number"></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px">Approval Status</th>
                            <td style="border: 1px solid #000; padding: 8px" id="approval_status"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-end mt-4 no-print">
                    <a href="{{ url('/customer/payment') }}" class="btn btn-success btn-lg px-4">
                        <i class="fas fa-credit-card me-2"></i> Make Payment
                    </a>
                </div>
            </div>
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








<!-- jsPDF & html2canvas-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


<script>
    getUserInfo();
    async function getUserInfo() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/customer/login";
        }
        try {
            let res = await axios.get("/auth/customer", {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            })
            //console.log(res.data)

            if (res.data.status == "success") {
                document.querySelector("#customer_id_for_packageDetails").value = res.data.data.id;
                getUserPackageDetails();
            }
        } catch (error) {
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



    async function getUserPackageDetails() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = "/customer/login";
        }
        let id = document.getElementById("customer_id_for_packageDetails").value
        try {
            let res = await axios.post("/customer/package/details-by-id", {
                id: id
            }, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            })


            if (res.data.status == "success") {
                //console.log(res.data.packages.package.image)
                console.log('package details', res.data)

                document.getElementById('customer_image').src = res.data.packages.image ?
                    `/upload/dashboard/images/customers/${res.data.packages.image}` :
                    `/upload/dashboard/images/customers/default.jpg`;

                document.getElementById('package_image').src = res.data.packages.package.image ?
                    `/${res.data.packages.package.image}` :
                    `/upload/dashboard/images/customers/default.jpg`;
                document.getElementById('name').innerHTML = res.data.packages.name ? res.data.packages.name : "N/A";
                document.getElementById('email').innerHTML = res.data.packages.email ? res.data.packages.email :
                    "N/A";
                document.getElementById('age').innerHTML = res.data.packages.age ? res.data.packages.age : "N/A";

                document.getElementById('approval_status').innerHTML = res.data.packages.approval ? res.data
                    .packages.approval : "N/A";
                document.getElementById('bmet_status').innerHTML = res.data.packages.bmet ? res.data.packages.bmet :
                    "N/A";
                document.getElementById('calling_status').innerHTML = res.data.packages.calling ? res.data.packages
                    .calling : "N/A";
                document.getElementById('company_name').innerHTML = res.data.packages.company_name ? res.data
                    .packages.company_name : "N/A";
                document.getElementById('country').innerHTML = res.data.packages.country ? res.data.packages
                    .country : "N/A";
                document.getElementById('package_name').innerHTML = res.data.packages.package.title ? res.data
                    .packages.package.title : "N/A";
                document.getElementById('category_name').innerHTML = res.data.packages.package_category.name ? res
                    .data.packages.package_category.name : "N/A";

                document.getElementById('coupon_code').innerHTML = res.data.packages.coupon_code ? res.data.packages
                    .coupon_code : "N/A";
                document.getElementById('coupon_discount').innerHTML = res.data.packages.coupon_discount ? parseInt(res.data
                    .packages.coupon_discount) : 0;
                document.getElementById('afterCouponPrice').innerHTML = res.data.packages
                    .coupon_use_discounted_price ? parseInt(res.data.packages.coupon_use_discounted_price) : 0;
                document.getElementById('payable_amount').innerHTML = res.data.packages
                    .coupon_use_discounted_price ? parseInt(res.data.packages.coupon_use_discounted_price) : parseInt(res.data.packages
                    .mrp);

                document.getElementById('customer_slot').innerHTML = res.data.packages.customer_slot ? parseInt(res.data
                    .packages.customer_slot) : "N/A";
                document.getElementById('dob').innerHTML = res.data.packages.date_of_birth ? res.data.packages
                    .date_of_birth : "N/A";
                document.getElementById('duration').innerHTML = res.data.packages.duration ? res.data.packages
                    .duration : "N/A";
                document.getElementById('e_visa_status').innerHTML = res.data.packages.e_vissa ? res.data.packages
                    .e_vissa : "N/A";
                document.getElementById('fly_status').innerHTML = res.data.packages.fly ? res.data.packages.fly :
                    "N/A";
                document.getElementById('gender').innerHTML = res.data.packages.gender ? res.data.packages.gender :
                    "N/A";
                document.getElementById('medical_center').innerHTML = res.data.packages.medical_center ? res.data
                    .packages.medical_center : "N/A";
                document.getElementById('medical_date').innerHTML = res.data.packages.medical_date ? res.data
                    .packages.medical_date : "N/A";
                document.getElementById('medical_result').innerHTML = res.data.packages.medical_result ? res.data
                    .packages.medical_result : "N/A";
                // document.getElementById('mrp').innerHTML = res.data.packages.mrp ? res.data.packages.mrp : "N/A";
                document.getElementById('nid_number').innerHTML = res.data.packages.nid_number ? res.data.packages
                    .nid_number : "N/A";
                // document.getElementById('package_discount').innerHTML = res.data.packages.package_discount ? res
                //     .data.packages.package_discount : "N/A";
                // document.getElementById('package_discounted_price').innerHTML = res.data.packages
                //     .package_discounted_price ? res.data.packages.package_discounted_price : "N/A";
                // document.getElementById('passenger_price').innerHTML = res.data.packages.passenger_price ? res.data
                //     .packages.passenger_price : "N/A";
                document.getElementById('passport_no').innerHTML = res.data.packages.passport_no ? res.data.packages
                    .passport_no : "N/A";
                document.getElementById('payment_status').innerHTML = res.data.packages.payment ? res.data.packages
                    .payment : "N/A";
                document.getElementById('payment_method').innerHTML = res.data.packages.payment_method ? res.data
                    .packages.payment_method : "N/A";
                document.getElementById('mobile_no').innerHTML = res.data.packages.phone ? res.data.packages.phone :
                    "N/A";
                document.getElementById('pic').innerHTML = res.data.packages.pic ? res.data.packages.pic : "N/A";
                document.getElementById('package_price').innerHTML = res.data.packages.mrp ? parseInt(res.data.packages
                    .mrp) : "N/A";
                //document.getElementById('sales_commission').innerHTML = res.data.packages.sales_commission?res.data.packages.sales_commission:"N/A";  
                document.getElementById('seat_avaliability').innerHTML = res.data.packages.seat_availability ? res
                    .data.packages.seat_availability : "N/A";
                document.getElementById('training_status').innerHTML = res.data.packages.training ? res.data
                    .packages.training : "N/A";
                document.getElementById('visa_online_status').innerHTML = res.data.packages.visa_online ? res.data
                    .packages.visa_online : "N/A";
                document.getElementById('visa_processing_time').innerHTML = res.data.packages.visa_processing_time ?
                    res.data.packages.visa_processing_time : "N/A";
                document.getElementById('account_number').innerHTML = res.data.packages.account_number ? res.data
                    .packages.account_number : "N/A";

                //inclusions 
                let inclusionsString = res.data.packages.inclusions;
                let inclusionsArray = inclusionsString.split(',');
                let inclusionList = document.getElementById("inclusionList");
                inclusionList.innerHTML = "";
                inclusionsArray.forEach(item => {
                    inclusionList.innerHTML += `<li>${item.trim()}</li>`;
                });

                //exclusion
                let exclusionListString = res.data.packages.exclusions;
                let exclusionArray = exclusionListString.split(',');
                let exclusionList = document.getElementById("exclusionList");
                exclusionList.innerHTML = "";
                exclusionArray.forEach(item => {
                    exclusionList.innerHTML += `<li>${item.trim()}</li>`;
                });

                //document lists
                let documentsListString = res.data.packages.documents_required;
                let documentListArray = documentsListString.split(',');
                let documentLists = document.getElementById('documentLists');
                documentLists.innerHTML = "";
                documentListArray.forEach(item => {
                    documentLists.innerHTML += `<li>${item.trim()}</li>`;
                })
            }

        } catch (error) {
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

        //edit modal 
        $(document).ready(function() {
            $('.editCustomerInformation').on('click', async function() {
                //console.log('button click successfully');
                await fillCustomerEditModal(id)
                $('#editCustomerModal').modal('show');
            });
        });

        //preview package pdf
$('.previewPackagePdf').on('click', async function () {
    const id = document.getElementById('customer_id_for_packageDetails')?.value;
    if (!id) {
        alert("Customer ID not found.");
        return;
    }

    const invoiceElement = document.getElementById('printable_package_section');
    if (!invoiceElement) {
        alert("Package content not found!");
        return;
    }

    // 👉 Hide no-print elements before capturing
    const noPrintEls = document.querySelectorAll('.no-print');
    noPrintEls.forEach(el => el.style.display = 'none');

    try {
        const opt = {
            margin:       10,
            filename:     `package-details-${id}.pdf`,
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, scrollY: 0 },
            jsPDF:        { unit: 'pt', format: 'a4', orientation: 'portrait' }
        };

        await html2pdf().set(opt).from(invoiceElement).save();
    } catch (err) {
        console.error("PDF generation failed:", err);
        alert("Failed to generate PDF preview.");
    } finally {
        // Restore no-print elements
        noPrintEls.forEach(el => el.style.display = '');
    }
});




    }
</script>
