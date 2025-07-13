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
            <div class="card-body p-5 makeInvoicePDF">
                <!-- Invoice Header -->
                <div class="row mb-4">
                    <div class="col-6">
                        <h4 class="fw-bold text-primary">Invoice & Payment</h4>
                        <p class="text-muted">Review your invoice details and pay online via mobile banking or bank transfer.</p>

                        <p class="mb-1">Invoice No: <strong>#INV-001</strong></p>
                        <p>Date: {{ \Carbon\Carbon::now()->format('d F, Y') }}</p>
                    </div>
                    <div class="col-6 text-end">
                        <h5 class="fw-bold" id="payment_customer_name"></h5>
                        <p class="mb-1" id="payment_customer_email">rahim@email.com</p>
                        <p id="payment_customer_phone">+8801712345678</p>
                    </div>
                </div>

                <hr>

                <!-- Payment Summary -->
                <h5 class="mb-3">Payment Summary</h5>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Description</th>
                            <th class="text-end">Amount (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Package Price</td>
                            <td class="text-end" id="payment_package_price"></td>
                        </tr>
                        <tr>
                            <td>Coupon (<span id="payment_coupon_ode"></span>)</td>
                            <td class="text-end text-success" id="payment_coupon_discount"></td>
                        </tr>
                        <tr>
                            <td>Coupon Discounted Price</td>
                            <td class="text-end" id="payment_couon_discounted_price"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Total Paid</td>
                            <td class="text-end text-success fw-bold" id="payment_total_paid"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Due Amount</td>
                            <td class="text-end text-danger fw-bold" id="payment_due_ammount"></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Payment Form -->
                <hr class="my-4 no-print">
                <h5 class="text-primary mb-3 no-print">Pay with Mobile Banking</h5>

                <div class="alert alert-primary no-print">
                    <strong>Instruction:</strong> 
                    <ul class="mb-0">
                        <li>নিচে Amount, Payment Method এবং আপনার bKash/Nagad নম্বর দিন।</li>
                        <li>Pay Now চাপলে আপনার পেমেন্ট প্রসেস হবে।</li>
                        <li>পেমেন্ট সফল হলে স্বয়ংক্রিয়ভাবে আপনি কনফার্মেশন পাবেন।</li>
                    </ul>
                </div>

                <form class="no-print">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Amount to Pay (৳)</label>
                            <input type="number" class="form-control" value="50000" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Payment Method</label>
                            <select class="form-select" required>
                                <option selected disabled>Select</option>
                                <option value="bkash">bKash</option>
                                <option value="nagad">Nagad</option>
                                <option value="rocket">Rocket</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Your Account / Mobile Number</label>
                            <input type="text" class="form-control" placeholder="01XXXXXXXXX" required>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check-circle me-1"></i> Pay Now
                        </button>
                    </div>
                </form>

                <!-- Bottom Info & Print Button -->
                <div class="row mt-5 no-print">
                    <div class="col-md-6">
                        <p class="text-muted">Generated on 12 July, 2025 at 04:30 PM</p>
                    </div>
                    <div class="col-md-6 text-end no-print">
                        <button class="btn btn-danger" id="downloadPdfBtn">
                            <i class="fas fa-print me-1"></i> Print Invoice
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>  <!-- axios CDN -->
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

            document.getElementById('payment_customer_name').innerText = data.name ?? 'N/A';
            document.getElementById('payment_customer_email').innerText = data.email ?? 'N/A';
            document.getElementById('payment_customer_phone').innerText = data.phone ?? 'N/A';

            document.getElementById('payment_package_price').innerText = data.price ?? 'N/A';
            document.getElementById('payment_coupon_ode').innerText = data.coupon_code ?? 'N/A';
            document.getElementById('payment_coupon_discount').innerText = data.coupon_discount ?? '0';
            document.getElementById('payment_couon_discounted_price').innerText = data.coupon_use_discounted_price ?? data.price;
            document.getElementById('payment_total_paid').innerText = data.coupon_use_discounted_price ? (data.price - data.coupon_use_discounted_price) : data.price;

            let dueAmount = 0;
            if (data.coupon_use_discounted_price && data.passenger_price) {
                dueAmount = data.passenger_price - data.coupon_use_discounted_price;
            } else if (data.passenger_price && data.price) {
                dueAmount = data.passenger_price;
            }
            document.getElementById('payment_due_ammount').innerText = dueAmount.toLocaleString() ?? 0;

        } catch (error) {
            console.error("Error fetching customer data:", error);
        }
    }

    getCustomerData();

    document.getElementById('downloadPdfBtn').addEventListener('click', async () => {
        // Hide form and bottom info before generating PDF
        document.querySelectorAll('.no-print').forEach(el => el.style.display = 'none');

        const { jsPDF } = window.jspdf;
        const invoiceElement = document.querySelector('.makeInvoicePDF');

        if (!invoiceElement) {
            alert('Invoice element not found!');
            return;
        }

        const canvas = await html2canvas(invoiceElement, { scale: 2 });
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
