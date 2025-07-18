<!-- Customer View Modal -->
<div class="modal fade" id="customerViewModal" tabindex="-1" aria-labelledby="customerViewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="customerViewModalLabel">Customer Details</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <th>ID</th>
                <td class="id">---</td>
                <th>Name</th>
                <td class="name">---</td>
              </tr>
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
              <tr>
                <th>Gender</th>
                <td class="gender">---</td>
                <th>Date of Birth</th>
                <td class="date_of_birth">---</td>
              </tr>
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
              <tr>
                <th>Payment Method</th>
                <td class="payment_method">---</td>
                <th>Company Name</th>
                <td class="company_name">---</td>
              </tr>
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
              <tr>
                <th>MRP</th>
                <td class="mrp">---</td>
                <th>Discounted Price</th>
                <td class="package_discounted_price">---</td>
              </tr>
              <tr>
                <th>Passenger Price</th>
                <td class="passenger_price">---</td>
                <th>Coupon Code</th>
                <td class="coupon_code">---</td>
              </tr>
              <tr>
                <th>Inclusions</th>
                <td colspan="3" class="inclusions">---</td>
              </tr>
              <tr>
                <th>Exclusions</th>
                <td colspan="3" class="exclusions">---</td>
              </tr>
              <tr>
                <th>Documents Required</th>
                <td colspan="3" class="documents_required">---</td>
              </tr>
              <tr>
                <th>Payment</th>
                <td class="payment">---</td>
                <th>Created IP</th>
                <td class="created_by_ip">---</td>
              </tr>
              <tr>
                <th>Image</th>
                <td colspan="3" class="image">
                  <img src="" alt="Customer Image" class="img-fluid rounded" style="max-height: 200px;" />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer justify-content-end">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>
    async function fillCustomerViewModal(id){
        console.log(id);
        let token = localStorage.getItem('token')
        if(!token){
            window.location.href = '/admin/login'
            return;
        }
        try{
            let res = await axios.post('/admin/customer/view/by/random',{id:id},{headers:{Authorization: `Bearer ${token}`}})
            if(res.data.status == 'success'){
                console.log(res.data.customer)
                document.querySelector('.name').innerHTML = res.data.customer.name || 'N/A'

                document.querySelector('.email').innerHTML = res.data.customer.email || 'N/A'
                document.querySelector('.phone').innerHTML = res.data.customer.phone || 'N/A'

                document.querySelector('.passport_no').innerHTML = res.data.customer.passport_no || 'N/A'
                document.querySelector('.nid_number').innerHTML = res.data.customer.nid_number || 'N/A'

                document.querySelector('.gender').innerHTML = res.data.customer.gender || 'N/A'
                document.querySelector('.date_of_birth').innerHTML = res.data.customer.date_of_birth || 'N/A'

                document.querySelector('.customer_slot').innerHTML = parseInt(res.data.customer.customer_slot) || 'N/A'
                document.querySelector('.package_category_id').innerHTML = res.data.customer.package_category_id || 'N/A'

                document.querySelector('.package_id').innerHTML = res.data.customer.package_id || 'N/A'
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
                document.querySelector('.visa_processing_time').innerHTML = res.data.customer.visa_processing_time || 'N/A'

                document.querySelector('.duration').innerHTML = res.data.customer.duration || 'N/A'
                document.querySelector('.seat_availability').innerHTML = res.data.customer.seat_availability || 'N/A'

                document.querySelector('.mrp').innerHTML = res.data.customer.mrp || 'N/A'
                document.querySelector('.package_discounted_price').innerHTML = res.data.customer.package_discounted_price || 'N/A'

                document.querySelector('.passenger_price').innerHTML = res.data.customer.passenger_price || 'N/A'
                document.querySelector('.coupon_code').innerHTML = res.data.customer.coupon_code || 'N/A'

                document.querySelector('.inclusions').innerHTML = res.data.customer.inclusions || 'N/A'
                document.querySelector('.exclusions').innerHTML = res.data.customer.exclusions || 'N/A'

                document.querySelector('.documents_required').innerHTML = res.data.customer.documents_required || 'N/A'
                document.querySelector('.payment').innerHTML = res.data.customer.payment || 'N/A'

                document.querySelector('.created_by_ip').innerHTML = res.data.customer.created_by_ip || 'N/A'



            }else{
                consolee.log('error',res.data)
            }
        }catch(error){
            console.log('error',error)
        }
     
    }
</script>