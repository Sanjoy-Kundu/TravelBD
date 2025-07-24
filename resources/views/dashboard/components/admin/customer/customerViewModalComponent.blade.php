<style>
@media print {
    .btn, .modal-header, .modal-footer {
        display: none !important;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #000;
        padding: 6px;
    }
}
</style>



<!-- Customer View Modal -->
<div class="modal fade" id="customerViewModal" tabindex="-1" aria-labelledby="customerViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          
            <div class="modal-header justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="/images/logo/logo.png" alt="Agency Logo" style="height: 40px; margin-right: 10px;">
                    <div>
                        <h5 class="modal-title mb-0" id="customerViewModalLabel">AB TRAVELS</h5>
                        <small class="text-muted">Customer Information Details</small>
                    </div>
                </div>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="printableCustomerViewDetails">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <!-- Image and Name -->
                            <tr>
                                <th>Name</th>
                                <td class="name">---</td>
                                <th>Image</th>
                                <td class="image" colspan="1">
                                    <img src="" alt="Customer Image" class="img-fluid rounded customer_image"
                                        style="max-height: 150px; max-width: 150px; border: 1px solid grey; padding: 5px; border-radius: 50%;" />
                                </td>
                            </tr>

                            <!-- Contact Info -->
                            <tr>
                                <th>Email</th>
                                <td class="email">---</td>
                                <th>Phone</th>
                                <td class="phone">---</td>
                            </tr>
                            <tr>
                                <th>Passport No</th>
                                <td class="passport_no">---</td>
                                <th>NID Number</th>
                                <td class="nid_number">---</td>
                            </tr>

                            <!-- Personal Info -->
                            <tr>
                                <th>Gender</th>
                                <td class="gender">---</td>
                                <th>Date of Birth</th>
                                <td class="date_of_birth">---</td>
                            </tr>

                            <!-- Slot and Package Info -->
                            <tr>
                                <th>Customer Slot</th>
                                <td class="customer_slot">---</td>
                                <th>Package Category</th>
                                <td class="package_category_id">---</td>
                            </tr>
                            <tr>
                                <th>Package</th>
                                <td class="package_id">---</td>
                                <th>Approval</th>
                                <td class="approval">---</td>
                            </tr>

                            <!-- Payment Info -->
                            <tr>
                                <th>Payment Method</th>
                                <td class="payment_method">---</td>
                                <th>Company Name</th>
                                <td class="company_name">---</td>
                            </tr>

                            <!-- Country and Medical -->
                            <tr>
                                <th>Country</th>
                                <td class="country">---</td>
                                <th>Medical Center</th>
                                <td class="medical_center">---</td>
                            </tr>
                            <tr>
                                <th>Medical Date</th>
                                <td class="medical_date">---</td>
                                <th>Medical Result</th>
                                <td class="medical_result">---</td>
                            </tr>

                            <!-- Travel Info -->
                            <tr>
                                <th>Training</th>
                                <td class="training">---</td>
                                <th>Fly</th>
                                <td class="fly">---</td>
                            </tr>
                            <tr>
                                <th>Visa Online</th>
                                <td class="visa_online">---</td>
                                <th>Visa Processing Time</th>
                                <td class="visa_processing_time">---</td>
                            </tr>
                            <tr>
                                <th>Duration</th>
                                <td class="duration">---</td>
                                <th>Seat Availability</th>
                                <td class="seat_availability">---</td>
                            </tr>

                            <!-- Pricing Info -->
                            <tr>
                                <th>MRP</th>
                                <td class="mrp">---</td>
                                <th>Package Price</th>
                                <td class="package_main_price">---</td>
                            </tr>
                            <tr>
                                <th>Agent Commission (%)</th>
                                <td class="agent_comission">---</td>
                                <th>Amount</th>
                                <td class="agent_comission_amount">---</td>
                            </tr>
                            <tr>
                                <th>Customer Price</th>
                                <td class="passenger_price">---</td>
                                <th>Coupon Code</th>
                                <td class="coupon_code">---</td>
                            </tr>

                            <!-- Others -->
                            <tr>
                                <th>Inclusions</th>
                                <td class="inclusions" colspan="3">---</td>
                            </tr>
                            <tr>
                                <th>Exclusions</th>
                                <td class="exclusions" colspan="3">---</td>
                            </tr>
                            <tr>
                                <th>Documents Required</th>
                                <td class="documents_required" colspan="3">---</td>
                            </tr>
                            <tr>
                                <th>Payment</th>
                                <td class="payment">---</td>
                                <th>Created IP</th>
                                <td class="created_by_ip">---</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-primary" onclick="printCustomerViewDetails()"><i class="bi bi-printer"></i> Print </button>
            </div>
        </div>
    </div>
   
</div>



<script>
    async function fillCustomerViewModal(id) {
        console.log(id);
        let token = localStorage.getItem('token')
        if (!token) {
            window.location.href = '/admin/login'
            return;
        }
        try {
            let res = await axios.post('/admin/customer/view/by/random', {
                id: id
            }, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            })
            if (res.data.status == 'success') {
                console.log(res.data.customer)
                if (res.data.customer.image) {
                    document.querySelector('.customer_image').src =
                        `/upload/dashboard/images/customers/${res.data.customer.image}`
                } else {
                    document.querySelector('.customer_image').src = `/upload/dashboard/images/customers/default.jpg`
                }
                document.querySelector('.name').innerHTML = res.data.customer.name || 'N/A'

                document.querySelector('.email').innerHTML = res.data.customer.email || 'N/A'
                document.querySelector('.phone').innerHTML = res.data.customer.phone || 'N/A'

                document.querySelector('.passport_no').innerHTML = res.data.customer.passport_no || 'N/A'
                document.querySelector('.nid_number').innerHTML = res.data.customer.nid_number || 'N/A'

                document.querySelector('.gender').innerHTML = res.data.customer.gender || 'N/A'
                document.querySelector('.date_of_birth').innerHTML = res.data.customer.date_of_birth || 'N/A'

                document.querySelector('.customer_slot').innerHTML = parseInt(res.data.customer.customer_slot) ||
                    'N/A'
                document.querySelector('.package_category_id').innerHTML = res.data.customer.package_category
                    .name || 'N/A'

                document.querySelector('.package_id').innerHTML = res.data.customer.package.title || 'N/A'
                document.querySelector('.approval').innerHTML = res.data.customer.approval || 'N/A'

                document.querySelector('.payment_method').innerHTML = res.data.customer.payment_method || 'N/A'
                document.querySelector('.company_name').innerHTML = res.data.customer.company_name || 'N/A'

                document.querySelector('.country').innerHTML = res.data.customer.country || 'N/A'
                document.querySelector('.medical_center').innerHTML = res.data.customer.medical_center || 'N/A'

                document.querySelector('.medical_date').innerHTML = res.data.customer.medical_date || 'N/A'
                document.querySelector('.medical_result').innerHTML = res.data.customer.medical_result || 'N/A'

                document.querySelector('.training').innerHTML = res.data.customer.training || 'N/A'
                document.querySelector('.fly').innerHTML = res.data.customer.fly || 'N/A'

                document.querySelector('.visa_online').innerHTML = res.data.customer.visa_online || 'N/A'
                document.querySelector('.visa_processing_time').innerHTML = res.data.customer
                    .visa_processing_time || 'N/A'

                document.querySelector('.duration').innerHTML = res.data.customer.duration || 'N/A'
                document.querySelector('.seat_availability').innerHTML = res.data.customer.seat_availability ||
                    'N/A'

                document.querySelector('.mrp').innerHTML = parseInt(res.data.customer.mrp) || 'N/A'
                document.querySelector('.package_main_price').innerHTML = parseInt(res.data.customer.package
                    .price) || 'N/A'

                document.querySelector('.agent_comission').innerHTML = parseInt(res.data.customer
                    .sales_commission_discount) || 'N/A'
                document.querySelector('.agent_comission_amount').innerHTML = parseInt(res.data.customer
                    .sales_commission) || 'N/A'




                document.querySelector('.passenger_price').innerHTML = parseInt(res.data.customer
                    .passenger_price) || 'N/A'
                document.querySelector('.coupon_code').innerHTML = res.data.customer.coupon_code || 'N/A'

                document.querySelector('.inclusions').innerHTML = res.data.customer.inclusions || 'N/A'
                document.querySelector('.exclusions').innerHTML = res.data.customer.exclusions || 'N/A'

                document.querySelector('.documents_required').innerHTML = res.data.customer.documents_required ||
                    'N/A'
                document.querySelector('.payment').innerHTML = res.data.customer.payment || 'N/A'
                document.querySelector('.created_by_ip').innerHTML = res.data.customer.created_by_ip || 'N/A'
            } else {
                consolee.log('error', res.data)
            }
        } catch (error) {
            console.log('error', error)
        }

    }



    // print 
function printCustomerViewDetails() {
    const printContents = document.getElementById('printableCustomerViewDetails').innerHTML;
    const printWindow = window.open('', '_blank', 'height=800,width=1000');

    const today = new Date();
    const dateTime = today.toLocaleString('en-GB', {
        day: '2-digit', month: '2-digit', year: 'numeric',
        hour: '2-digit', minute: '2-digit', hour12: true
    });

    printWindow.document.write(`
        <html>
        <head>
            <title>Customer Details</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                body {
                    font-family: 'Segoe UI', sans-serif;
                    padding: 30px;
                    background-color: #fff;
                    color: #000;
                }
                .header {
                    text-align: center;
                    margin-bottom: 30px;
                    border-bottom: 2px solid #000;
                    padding-bottom: 15px;
                }
                .logo img {
                    max-width: 100px;
                }
                .agency-info {
                    margin-top: 10px;
                }
                .agency-info h4 {
                    margin: 5px 0 0 0;
                    font-weight: bold;
                }
                .agency-info p {
                    margin: 0;
                    font-size: 14px;
                }
                .datetime {
                    text-align: right;
                    font-size: 14px;
                    margin-bottom: 20px;
                }
                .signature-box {
                    margin-top: 60px;
                    text-align: right;
                }
                .signature-line {
                    display: inline-block;
                    border-top: 1px solid #000;
                    padding-top: 5px;
                    margin-top: 30px;
                    width: 200px;
                    text-align: center;
                    font-weight: bold;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    padding: 8px 12px;
                    border: 1px solid #dee2e6;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="logo">
                    <img src="${window.location.origin}/images/logo/logo.png" alt="Agency Logo">
                </div>
                <div class="agency-info">
                    <h4>Job Mama Agency</h4>
                    <p>1234 Dhaka Street, Bangladesh</p>
                    <p>Phone: +880 1234-567890 | Email: info@jobmama.com</p>
                </div>
            </div>

            <div class="datetime"><strong>Date & Time:</strong> ${dateTime}</div>

            ${printContents}

            <div class="signature-box">
                <div class="signature-line">Authorized Signature</div>
            </div>
        </body>
        </html>
    `);

    printWindow.document.close();
    printWindow.focus();

    setTimeout(() => {
        printWindow.print();
        printWindow.close();
    }, 1000);
}




</script>
