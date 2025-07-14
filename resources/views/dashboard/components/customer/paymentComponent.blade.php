<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>

<div class="container-fluid px-4">
    <h1 class="mt-4 no-print">Welcome To Your Dashboard<span class="customer_name text-primary fw-bold"></span></h1>
    <ol class="breadcrumb mb-4 no-print">
        <li class="breadcrumb-item active">Customer Dashboard</li>
    </ol>

    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5 makeInvoicePDF"
                style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 820px; margin:auto; border:1px solid #ddd; border-radius:8px; background:#fff;">

                <!-- Logo -->
                <div class="text-center mb-4">
                    <img src="{{ asset('/images/logo/cl.jpg') }}" alt="Company Logo"
                        style="height: 100px; object-fit: contain;">
                </div>

                <!-- Header Row -->
                <div class="row mb-4" style="border-bottom: 2px solid #007bff; padding-bottom: 15px;">
                    <div class="col-6">
                        <h3 class="text-primary fw-bold" style="letter-spacing: 1px;">Invoice & Payment</h3>
                        <p class="text-muted" style="font-size: 0.95rem; max-width: 320px;">
                            Review your invoice details and pay online via mobile banking or bank transfer.
                        </p>
                        <p class="mb-1" style="font-size: 0.95rem;">Invoice No: <strong>#INV-{{ now()->format('ymdHis') }}</strong></p>
                        <p style="font-size: 0.95rem;">Date: {{ \Carbon\Carbon::now()->format('d F, Y') }}</p>
                    </div>

                    <div class="col-6 text-end">
                        <h5 class="fw-bold" id="payment_customer_name" style="font-size: 1.1rem;"></h5>
                        <p class="mb-1" id="payment_customer_email" style="font-size: 0.95rem;"></p>
                        <p id="payment_customer_phone" style="font-size: 0.95rem;"></p>
                    </div>
                </div>

                <!-- Payment Summary -->
                <h5 class="mb-3 text-primary fw-semibold border-bottom pb-2">Payment Summary</h5>
                <table class="table" style="border: 1px solid #ddd;">
                    <thead style="background-color: #f0f7ff;">
                        <tr>
                            <th style="padding: 12px 15px; border-right: 1px solid #ddd;">Description</th>
                            <th class="text-end" style="padding: 12px 15px;">Amount (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 12px 15px; border-right: 1px solid #ddd;">Package Price</td>
                            <td class="text-end" id="payment_package_price" style="padding: 12px 15px;"></td>
                        </tr>
                        <tr>
                            <td style="padding: 12px 15px; border-right: 1px solid #ddd;">Coupon (<span
                                    id="payment_coupon_code"></span>)</td>
                            <td class="text-end text-success" id="payment_coupon_discount" style="padding: 12px 15px;">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 12px 15px; border-right: 1px solid #ddd;">Coupon Discounted Price</td>
                            <td class="text-end" id="payment_couon_discounted_price" style="padding: 12px 15px;"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" style="padding: 12px 15px; border-right: 1px solid #ddd;">Total Paid
                            </td>
                            <td class="text-end text-success fw-bold" id="payment_total_paid"
                                style="padding: 12px 15px;"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold" style="padding: 12px 15px; border-right: 1px solid #ddd;">Due Amount
                            </td>
                            <td class="text-end text-danger fw-bold" id="payment_due_ammount"
                                style="padding: 12px 15px;"></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Bottom Info & Print Button -->
                <div class="row mt-5 no-print" style="align-items: center;">
                    <div class="col-md-6">
                        <p class="text-muted" style="font-size: 0.9rem;">Current Date -> on
                            {{ \Carbon\Carbon::now()->format('d F, Y') }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-danger" id="downloadPdfBtn"
                            style="padding: 10px 22px; font-weight: 600;">
                            <i class="fas fa-print me-1"></i> Print Invoice
                        </button>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-5 text-center" style="font-size: 14px; color: #666;">
                 <p>Thank you for your payment!</p>
                    <p>
                        If you have any questions, feel free to contact us at 
                        <strong>support@fcti.com</strong><br>
                        Please note that you have an outstanding balance of: <strong style="color:red;" id="footer_due_balance">BDT</strong><br>
                        We kindly request you to settle this amount at your earliest convenience.
                    </p>
                </div>
            </div>


        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- axios CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    async function getCustomerData() {
        let token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/customer/login';
            return;
        }

        try {
            let res = await axios.get('/auth/customer', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });
            const data = res.data.data;
            console.log(data.coupon_code);
            console.log(data);

            document.getElementById('payment_customer_name').innerText = data.name ?? 'N/A';
            document.getElementById('payment_customer_email').innerText = data.email ?? 'N/A';
            document.getElementById('payment_customer_phone').innerText = data.phone ?? 'N/A';

            document.getElementById('payment_package_price').innerText = parseInt(data.price) ?? 'N/A';
            document.getElementById('payment_coupon_code').innerText = data.coupon_code ?? 'N/A';
            document.getElementById('payment_coupon_discount').innerText = parseInt(data.coupon_discount) ? parseInt(data.coupon_discount) :  0;
            document.getElementById('payment_couon_discounted_price').innerText = parseInt(data.coupon_use_discounted_price) ? parseInt(data.coupon_use_discounted_price) : 0;
            document.getElementById('payment_total_paid').innerText = data.coupon_use_discounted_price ? parseInt(data.coupon_use_discounted_price) : parseInt(data.price);
            console.log(parseInt(data.price));
            console.log(parseInt(data.coupon_discount));
            console.log(parseInt(data.coupon_use_discounted_price));

            let dueAmount = 0;
            if (parseInt(data.price) && parseInt(data.coupon_discount)) {
                let discountedMoney = (parseInt(data.price) * parseInt(data.coupon_discount) / 100);
                dueAmount = parseInt(data.price) - discountedMoney;
            } else {
                dueAmount = parseInt(data.price);
            }

            document.getElementById('payment_due_ammount').innerText = dueAmount;
            document.getElementById('footer_due_balance').innerText = dueAmount;

        } catch (error) {
            console.error("Error fetching customer data:", error);
        }
    }

    getCustomerData();

    document.getElementById('downloadPdfBtn').addEventListener('click', async () => {
        // Hide form and bottom info before generating PDF
        document.querySelectorAll('.no-print').forEach(el => el.style.display = 'none');

        const {
            jsPDF
        } = window.jspdf;
        const invoiceElement = document.querySelector('.makeInvoicePDF');

        if (!invoiceElement) {
            alert('Invoice element not found!');
            return;
        }

        const canvas = await html2canvas(invoiceElement, {
            scale: 2
        });
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('p', 'pt', 'a4');

        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        pdf.save('invoice.pdf');

        // Show again after saving PDF
        document.querySelectorAll('.no-print').forEach(el => el.style.display = '');
    });
</script>
