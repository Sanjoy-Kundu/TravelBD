<!-- Modal -->
<div class="modal fade" id="packageView" tabindex="-1" aria-labelledby="packageViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="packageViewLabel">View Of Tour Package</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="view_package_id">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th colspan="2" class="bg-dark text-white">Package Info</th>
                            <th colspan="2" class="bg-dark text-white">Category Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Title</th>
                            <td id="view_title"></td>
                            <th>Category Name</th>
                            <td id="view_category_name"></td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td id="view_slug"></td>
                            <th>Category Slug</th>
                            <td id="view_category_slug"></td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td colspan="3" id="view_short_description"></td>
                        </tr>
                        <tr>
                            <th>Long Description</th>
                            <td colspan="3" id="view_long_description"></td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td id="view_price"></td>
                            <th>Currency</th>
                            <td id="view_currency"></td>
                        </tr>
                        <tr>
                            <th>Duration</th>
                            <td id="view_duration"></td>
                            <th>Status</th>
                            <td id="view_status"></td>
                        </tr>
                        <tr>
                            <th>Inclusions</th>
                            <td colspan="3" id="view_inclusions"></td>
                        </tr>
                        <tr>
                            <th>Exclusions</th>
                            <td colspan="3" id="view_exclusions"></td>
                        </tr>
                        <tr>
                            <th>Visa Processing Time</th>
                            <td id="view_visa_processing_time"></td>
                            <th>Seat Availability</th>
                            <td id="view_seat_availability"></td>
                        </tr>
                        <tr>
                            <th>Documents Required</th>
                            <td colspan="3" id="view_documents_required"></td>
                        </tr>
                        <tr>
                            <th>Package Image</th>
                            <td>
                                <img id="view_package_image" src="" class="img-fluid w-100 h-100">
                            </td>
                            <th>Category Image</th>
                            <td>
                                <img id="view_category_image" src="" class="img-fluid w-100 h-100">
                            </td>
                        </tr>
                        <tr>
                            <th>Category Description</th>
                            <td colspan="3" id="view_category_description"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    let token = localStorage.getItem('token');
    if (!token) {
        window.location.href = '/admin/login';
    }

    async function fillPackageViewModal(id) {
        document.getElementById('view_package_id').value = id;

        try {
            let res = await axios.post('/admin/package/details', {
                id: id
            }, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });

            if (res.data.status === 'success') {
                const package = res.data.package;
                console.log(package);
                const category = package.package_category || {};
                console.log(category)

                document.getElementById('view_title').innerText = package.title || '';
                document.getElementById('view_slug').innerText = package.slug || '';
                document.getElementById('view_short_description').innerText = package.short_description || '';
                document.getElementById('view_long_description').innerText = package.long_description || '';
                document.getElementById('view_price').innerText = package.price || '';
                document.getElementById('view_currency').innerText = package.currency || '';
                document.getElementById('view_duration').innerText = package.duration || '';
                document.getElementById('view_inclusions').innerText = package.inclusions || '';
                document.getElementById('view_exclusions').innerText = package.exclusions || '';
                document.getElementById('view_visa_processing_time').innerText = package.visa_processing_time || '';
                document.getElementById('view_documents_required').innerText = package.documents_required || '';
                document.getElementById('view_seat_availability').innerText = package.seat_availability || '';
                document.getElementById('view_status').innerText = package.status === 'active' ? 'Active' :
                    'Inactive';

                document.getElementById('view_package_image').src = package.image ?
                    `/${package.image}` :
                    `/upload/dashboard/images/packages/default.png`;

                // Category fields
                document.getElementById('view_category_name').innerText = category.name || '';
                document.getElementById('view_category_slug').innerText = category.slug || '';
                document.getElementById('view_category_description').innerText = category.description || '';
                document.getElementById('view_category_image').src = category.image ?
                    `/upload/dashboard/images/package-category/${category.image}` :
                    `/upload/dashboard/images/package-category/default.png`;




            document.body.classList.remove('modal-open'); 
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(el => el.remove());
            }

        } catch (error) {
            console.log("Error loading package details", error);
        }
    }
</script>
