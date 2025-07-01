<!-- Category Form Modal -->
<div class="modal fade" id="packageCategoryFormModal" tabindex="-1" aria-labelledby="categoryFormModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="categoryFormModalLabel">Package Category Create Form</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="package_category_form" enctype="multipart/form-data" novalidate>
          <input type="hidden" id="category_id" name="category_id">

          <!-- Name -->
          <div class="mb-3">
            <label for="package_catgory_name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="package_catgory_name" class="form-control" placeholder="Enter Your Category Name" required>
            <div id="package_category_name_error" class="text-danger mt-1"></div>
          </div>

          <!-- Slug (Optional) -->
          <div class="mb-3 d-none">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" placeholder="Auto-generated slug">
            <div id="package_category_slug_error" class="text-danger mt-1"></div>
          </div>

          <!-- Description -->
          <div class="mb-3">
            <label for="package_category_description" class="form-label">Description <span class="text-danger">*</span></label>
            <textarea id="package_category_description" name="description" rows="3" class="form-control" placeholder="Enter description" required></textarea>
            <div id="package_category_description_error" class="text-danger mt-1"></div>
          </div>

          <!-- Image -->
          <div class="mb-3">
            <label for="package_category_image" class="form-label">Image <span class="text-danger">*</span></label>
            <input type="file" id="package_category_image" name="image" class="form-control" accept="image/*" onchange="packageCategoryPreviewImage(event)" required>
            <img id="package_category_image_previewer" src="#" alt="Image Preview" style="display:none; max-width:200px; margin-top:10px; border-radius:4px; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
            <div id="package_category_image_error" class="text-danger mt-1"></div>
          </div>

          <!-- Status -->
          <div class="mb-3">
            <label for="package_category_status" class="form-label">Status <span class="text-danger">*</span></label>
            <select id="package_category_status" name="status" class="form-select" required>
              <option value="">Select Status</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
            <div id="package_category_status_error" class="text-danger mt-1"></div>
          </div>

          <!-- Submit -->
          <div class="text-end">
            <button type="submit" class="btn btn-success px-4" onclick="packageCategoryCreate(event)">Category Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
    let token = localStorage.getItem('token');
    if(!token){
        window.location.href = '/login/admin';
    }
  // Image preview function
  function packageCategoryPreviewImage(event) {
    const input = event.target;
    const preview = document.getElementById('package_category_image_previewer');

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      preview.src = '#';
      preview.style.display = 'none';
    }
  }


  // form submit 
   async function packageCategoryCreate(event) {
    event.preventDefault();

    let token = localStorage.getItem('token');
    if (!token) {
      alert("Please login first.");
      window.location.href = '/login/admin';
      return;
    }

    // Clear previous error messages
    document.getElementById('package_category_name_error').textContent = '';
    document.getElementById('package_category_description_error').textContent = '';
    document.getElementById('package_category_image_error').textContent = '';
    document.getElementById('package_category_status_error').textContent = '';

    // Get form values
    const name = document.getElementById('package_catgory_name').value.trim();
    const description = document.getElementById('package_category_description').value.trim();
    const imageInput = document.getElementById('package_category_image');
    const image = imageInput.files[0];
    const status = document.getElementById('package_category_status').value;

    let hasError = false;

    // Validation
    if (!name) {
      document.getElementById('package_category_name_error').textContent = 'Category name is required';
      hasError = true;
    }
    if (!description) {
      document.getElementById('package_category_description_error').textContent = 'Description is required';
      hasError = true;
    }
    if (!status) {
      document.getElementById('package_category_status_error').textContent = 'Status is required';
      hasError = true;
    }
    if (!image) {
      document.getElementById('package_category_image_error').textContent = 'Please select an image';
      hasError = true;
    } else {
      const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
      if (!allowedTypes.includes(image.type)) {
        document.getElementById('package_category_image_error').textContent = 'Only JPG, PNG, or WEBP allowed';
        hasError = true;
      } else if (image.size > 2 * 1024 * 1024) {
        document.getElementById('package_category_image_error').textContent = 'Image must be under 2MB';
        hasError = true;
      }
    }

    if (hasError) return;

    // Prepare FormData for POST request
    const formData = new FormData();
    formData.append('name', name);
    formData.append('description', description);
    formData.append('status', status);
    formData.append('image', image);

    try {
      const res = await axios.post('/admin/package-category/store', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          'Authorization': `Bearer ${token}`  // যদি তোমার API authorization চায়
        }
      });

      if (res.data.status === 'success') {
        Swal.fire(res.data.message, '', 'success');
        document.getElementById('package_category_form').reset();
        document.getElementById('package_category_image_previewer').style.display = 'none';

        //list refresh
        await packageListLoadData();
        // Hide the modal
        const modalEl = document.getElementById('packageCategoryFormModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        modalInstance.hide();

      } else {
        console.log("category create page something is wrong");
        // document.getElementById('package_category_name_error').textContent = ;
        //console.log(res.data.message[0])
      }
    } catch (error) {
        document.getElementById('package_category_name_error').textContent =  error.response.data.message;
     // console.error('Submission error:', error.response);
      //alert('An error occurred while submitting the form. Check console.');
    }
  }
 
</script>
