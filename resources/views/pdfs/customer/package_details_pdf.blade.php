<style>
    *{
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }
    #package_content {
           width: 794px;
          min-height: 1123px;
          padding: 3px;
          box-sizing: border-box;
          font-family: 'Segoe UI', sans-serif;
        
    }

    #package_content h2 {
        font-weight: 700;
        margin-bottom: 1px;
    }

    #package_content table {
        width: 90%;
        border-collapse: collapse;
        margin-bottom: 1rem;
    }

    #package_content table,
    #package_content th,
    #package_content td {
        border: 1px solid #dee2e6;
    }

    #package_content th,
    #package_content td {
        border: 1px solid #dee2e6;
        padding: 8px 12px;
        vertical-align: middle;
        text-align: left;
    }

    #package_content .bg-light {
        background-color: #f8f9fa !important;
    }

    #package_content .fw-bold {
        font-weight: 700;
    }

    #package_content .text-end {
        text-align: right;
    }

    #package_content .small {
        font-size: 0.875em;
    }

    #package_content .text-muted {
        color: #6c757d;
    }

    #package_content p {
        margin-bottom: 0.1rem;
    }

    #package_content .d-flex {
        display: flex;
    }

    #package_content .justify-content-between {
        justify-content: space-between;
    }

    #package_content .align-items-start {
        align-items: flex-start;
    }

    /* Footer social icons spacing */
    #package_content .bi {
        font-size: 1.2rem;
        margin-right: 10px;
        color: #555;
    }
</style>


<div class="modal fade" id="packagePdfModal" tabindex="-1" aria-labelledby="packagePdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-sm">

            <div class="modal-body" id="package_content" style="font-family: 'Segoe UI', sans-serif;">

                <!-- Header -->
                <div class="">
                    <!-- Logo + Title -->
                    <div>
                        <img src="{{ asset('/images/logo/logo.png') }}" alt="Logo" style="height: 50px;">
                        <h2 class="fw-bold">Package Invoice</h2>
                    </div>

                    <!-- Company Info -->
                    {{-- <div class="text-end small text-muted">
                        <strong>SANDY TRAVELS</strong><br>
                        12/A Puran Polton, Dhaka<br>
                        Dhaka Bangladesh<br>
                        sales@sandytravels.com<br>
                        Phone: +8801759351546
                    </div> --}}
                </div>

                <!-- Customer & Invoice Info -->
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1 fw-semibold">Name: <span id="customer_name">Marcus Rochester</span></p>
                        <p class="mb-1" style="font-weight:bold">Email: <span id="customer_email">marcus@virtuenetwork.com</span></p>
                        <p class="mb-0" style="font-weight:bold">Phone: <span id="customer_phone">+1 234 56787</span></p>
                        <p class="mb-0" style="font-weight:bold">Passport No: <span id="customer_passport_no">+1 234 56787</span></p>
                    </div>

                    {{-- <div class="col-md-6 text-end small">
            <p class="mb-1"><strong>Invoice Number:</strong> <span id="invoice_number">KB-72332</span></p>
            <p class="mb-1"><strong>Date:</strong> <span id="invoice_date">May 25, 2022</span></p>
            <p class="mb-1"><strong>Destination:</strong> <span id="destination">Colorado Springs, CO</span></p>
            <p class="mb-0"><strong>Duration:</strong> <span id="duration">May 15–17, 2022</span></p>
          </div> --}}
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered align-middle"
                        style="border-collapse: collapse; font-family: 'Segoe UI', sans-serif;">
                        {{-- <thead class="table-light">
                            <tr>
                                <th style="padding: 10px; border: 1px solid #dee2e6;">Description</th>
                                <th style="padding: 10px; border: 1px solid #dee2e6;">Details</th>
                                <th style="padding: 10px; border: 1px solid #dee2e6;">Rate</th>
                                <th style="padding: 10px; border: 1px solid #dee2e6; text-align: right;">Amount (BDT)
                                </th>
                            </tr>
                        </thead> --}}
                        <tbody>
                            <!-- Personal Info -->
                            {{-- <tr>
                                <td colspan="4" class="fw-bold bg-light" style="padding: 10px; border: 1px solid #dee2e6;">Customer Information</td>
                            </tr> --}}
                            <!-- Package Info -->
                            <tr>
                                <td colspan="4" class="fw-bold bg-light"style="padding: 10px; border: 1px solid #dee2e6;">Package Details</td>
                            </tr>
                            <tr>
                                <td>Package Title</td>
                                <td colspan="3" id="customer_package_title"></td>
                            </tr>
                            <tr>
                                <td>Visa Processing Time</td>
                                <td colspan="3" id="customer_visa_processing_time"></td>
                            </tr>
                            <tr>
                                <td>Documents Required</td>
                                <td colspan="3" id="customer_documents_required"></td>
                            </tr>

                            <!-- Financial Info -->
                            <tr>
                                <td colspan="4" class="fw-bold bg-light" style="padding: 10px; border: 1px solid #dee2e6;">Financial Details</td>
                            </tr>
                            <tr>
                                <td>Package Price</td>
                                <td colspan="2">BDT </td>
                                <td style="text-align: right;"><span id="customer_package_price"></span>BDT</td>
                            </tr>
                            <tr>
                                <td>Package Discount Or Coupon Discount</td>
                                <td colspan="2"><span id="customer_discount"></span>%</td>
                                <td style="text-align: right;" >- BDT </td>
                            </tr>
                            <tr>
                                <td><strong>Discounted Price</strong></td>
                                <td colspan="2" id="customer_discounted_price"></td>
                                <td style="text-align: right; font-weight: 700;">BDT</td>
                            </tr>
                            {{-- <tr>
                                <td>Sales Commission</td>
                                <td colspan="2"></td>
                                <td style="text-align: right;">BDT</td>
                            </tr> --}}
                            <tr>
                                <td>Payment Method</td>
                                <td colspan="2" id="customer_payment_method"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- Totals -->
                <div class="row justify-content-start">
                    <div class="col-md-6">
                        <table class="table" style="width: 90%">
                            <tr>
                                <td class="fw-semibold">SUBTOTAL</td>
                                <td class="text-end" id="customer_subtotal"></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">AGENCY VAT</td>
                                <td class="text-end" id="agency_vat"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">GRAND TOTAL</td>
                                <td class="text-end fw-bold" id="grand_total_customer">$1288</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-muted text-center small">
                    www.sanjoy.info.com
                    <div class="mt-2">
                        <i class="bi bi-instagram me-2"></i>
                        <i class="bi bi-facebook me-2"></i>
                        <i class="bi bi-linkedin"></i>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-light">
                <button class="btn btn-primary" id="downloadPdf">Download PDF</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
    let token = localStorage.getItem('token');
    if (!token) {
        window.location.href = "{{ url('/customer/login') }}";
    }


    async function fillPackageDetailsLoad(id) {
      //refresh showing message 
      document.getElementById('customer_name').innerText = '';
      document.getElementById('customer_email').innerText = '';
      document.getElementById('customer_phone').innerText = '';
      document.getElementById('customer_passport_no').innerText = '';

      document.getElementById('customer_package_title').innerText = '';
      document.getElementById('customer_visa_processing_time').innerText = '';
      document.getElementById('customer_documents_required').innerText = '';

      document.getElementById('customer_package_price').innerText = '';
      document.getElementById('customer_discount').innerText = '';
      document.getElementById('customer_discounted_price').innerText = '';
      document.getElementById('customer_payment_method').innerText = '';


      document.getElementById('customer_subtotal').innerText = '';
      document.getElementById('agency_vat').innerText = '';
      document.getElementById('grand_total_customer').innerText = '';
      





        try {
            let res = await axios.post('/customer/package/pdf/view-by-id', {
                id: id
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            })
            console.log(res.data.packageData)
            document.getElementById('customer_name').innerText = res.data.packageData.name?res.data.packageData.name:'N/A';
            document.getElementById('customer_email').innerText = res.data.packageData.email?res.data.packageData.email:'N/A';
            document.getElementById('customer_phone').innerText = res.data.packageData.phone?res.data.packageData.phone:'N/A'; 
            document.getElementById('customer_passport_no').innerText = res.data.packageData.passport_no?res.data.packageData.passport_no:'N/A';

            document.getElementById('customer_package_title').innerText = res.data.packageData.package.title?res.data.packageData.package.title:'N/A';
            document.getElementById('customer_visa_processing_time').innerText = res.data.packageData.package.visa_processing_time?res.data.packageData.package.visa_processing_time:'N/A';
            document.getElementById('customer_documents_required').innerText = res.data.packageData.package.documents_required?res.data.packageData.package.documents_required:'N/A';

            document.getElementById('customer_package_price').innerText = res.data.packageData.package.price?res.data.packageData.package.price:'N/A';
            document.getElementById('customer_discount').innerText = res.data.packageData.package.coupon_discount?res.data.packageData.package.coupon_discount:'N/A';
            document.getElementById('customer_discounted_price').innerText = res.data.packageData.package.coupon_use_discounted_price?res.data.packageData.package.coupon_use_discounted_price:'N/A';
            document.getElementById('customer_payment_method').innerText = res.data.packageData.payment_method?res.data.packageData.payment_method:'N/A';

            document.getElementById('customer_subtotal').innerText = res.data.packageData.package.coupon_use_discounted_price?res.data.packageData.package.coupon_use_discounted_price:res.data.packageData.package.price;
            document.getElementById('agency_vat').innerText = res.data.packageData.package.coupon_use_discounted_price?res.data.packageData.passenger_price-res.data.packageData.package.coupon_use_discounted_price:
            res.data.packageData.passenger_price-res.data.packageData.package.price;

            document.getElementById('grand_total_customer').innerText = res.data.packageData.passenger_price?res.data.packageData.passenger_price:'N/A';
            } catch (error) {
            console.error('error', error);
        }
    }
</script>