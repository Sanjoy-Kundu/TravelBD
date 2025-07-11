
<!-- PDF Preview Modal -->
{{-- <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pdfPreviewModalLabel">📄 Package PDF Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="height: 80vh;">
        <input type="number" class="">
        <!-- PDF Preview Iframe -->
        <iframe id="pdfViewer" src="" style="width: 100%; height: 100%;" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <a id="downloadPdfLink" href="#" target="_blank" class="btn btn-success">
          <i class="fas fa-download me-2"></i> Download PDF
        </a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> --}}

{{-- <script>
  // function showPreviewPdf(id) {
    
  // }
document.addEventListener('DOMContentLoaded', function () {
    const pdfModal = document.getElementById('pdfPreviewModal');
    const pdfViewer = document.getElementById('pdfViewer');
    const downloadPdfLink = document.getElementById('downloadPdfLink');

    pdfModal.addEventListener('show.bs.modal', function () {
        let token = localStorage.getItem('token');
        console.log(token);
        if (!token) {
            window.location.href = "{{ url('/customer/login') }}";
        }

        let id = document.getElementById('customer_id_for_packageDetails').value;
        //console.log(customerId);

        if (!id) {
            alert('Customer ID not found!');
            pdfViewer.src = '';
            downloadPdfLink.href = '#';
            return;
        }

        
        const pdfUrl = `/customer/package/pdf/${id}?token=${token}`;

        pdfViewer.src = pdfUrl;
        downloadPdfLink.href = pdfUrl;
    });

    //reset ifreame
    pdfModal.addEventListener('hidden.bs.modal', function () {
        pdfViewer.src = '';
    });
});

</script> --}}
