<style>
    @media print {
        .no-print {
            display: none !important;
        }
        .print-hide {
            display: none !important;
        }
    }
</style>

<div class="container-fluid px-4">
    <h1 class="mt-4 no-print">Welcome <span class="customer_name text-primary fw-bold">Mr. Rahim</span></h1>
    <ol class="breadcrumb mb-4 no-print">
        <li class="breadcrumb-item active">Customer Dashboard</li>
    </ol>

    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
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
                        <p class="mb-1"id="payment_customer_email">rahim@email.com</p>
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
                        {{-- <tr>
                            <td>Package Discount (10%)</td>
                            <td class="text-end text-success">-30,000.00</td>
                        </tr> --}}
                        {{-- <tr>
                            <td>After Package Discount</td>
                            <td class="text-end">270,000.00</td>
                        </tr> --}}
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
                <hr class="my-4 print-hide">
                <h5 class="text-primary mb-3 print-hide">Pay with Mobile Banking</h5>

              <div class="alert alert-primary print-hide">
                    <strong>Instruction:</strong> 
                    <ul class="mb-0">
                        <li>নিচে Amount, Payment Method এবং আপনার bKash/Nagad নম্বর দিন।</li>
                        <li>Pay Now চাপলে আপনার পেমেন্ট প্রসেস হবে।</li>
                        <li>পেমেন্ট সফল হলে স্বয়ংক্রিয়ভাবে আপনি কনফার্মেশন পাবেন।</li>
                    </ul>
            </div>

                <form class="print-hide">
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
                    <div class="col-md-6 text-end">
                        <button class="btn btn-danger" onclick="window.print()">
                            <i class="fas fa-print me-1"></i> Print Invoice
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>





<script>
    getCustomerData();
    async function getCustomerData(){
        let token = localStorage.getItem('token');
        if(!token){
            window.location.href = '/customer/login'
        }

        document.getElementById('payment_customer_name').innerText = '';
        document.getElementById('payment_package_price').innerText = '';
        try{
            let res = await axios.get('/auth/customer',{
                headers:{
                    'Authorization':`Bearer ${token}`
                }
            });
            console.log(res.data.data)
         document.getElementById('payment_customer_name').innerText = res.data.data.name?res.data.data.name:'N/A'
         document.getElementById('payment_customer_email').innerText = res.data.data.email?res.data.data.email:'N/A'
         document.getElementById('payment_customer_phone').innerText = res.data.data.phone?res.data.data.phone:'N/A'

         document.getElementById('payment_package_price').innerText = res.data.data.price?res.data.data.price:'N/A'
         document.getElementById('payment_coupon_ode').innerText = res.data.data.coupon_code?res.data.data.coupon_code:'N/A'
         document.getElementById('payment_coupon_discount').innerText = res.data.data.coupon_discount?res.data.data.coupon_discount:'0'
         document.getElementById('payment_couon_discounted_price').innerText = res.data.data.coupon_use_discounted_price?res.data.data.coupon_use_discounted_price:res.data.data.price
         document.getElementById('payment_total_paid').innerText = res.data.data.coupon_use_discounted_price?res.data.data.price - res.data.data.coupon_use_discounted_price:res.data.data.price

         let deu_ammount = 0;
         if(res.data.data.coupon_use_discounted_price && res.data.data.passenger_price){
            deu_ammount = res.data.data.passenger_price - res.data.data.coupon_use_discounted_price;
         }else if(res.data.data.passenger_price && res.data.data.price){
              deu_ammount = res.data.data.passenger_price;
         }

         document.getElementById('payment_due_ammount').innerText = deu_ammount.toLocaleString()?deu_ammount.toLocaleString():0;
        }catch(error){
            console.log("error",error)
        }

    }
</script>