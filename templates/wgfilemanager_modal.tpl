<!-- ---------------------------------- -->
<!-- Start code for show files as modal -->
<!-- ---------------------------------- -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="pdfModalLabel">Default Title</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<{$smarty.const._CLOSE}>">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <embed id="embedPdf" class="modal-embedPdf" src="assets/images/blank.gif"
                       frameborder="0" width="100%" height="400px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal"><{$smarty.const._CLOSE}></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="imgModal" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imgModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<{$smarty.const._CLOSE}>"></button>
            </div>
            <div class="modal-body">
                <img id="modalimg" class="modal-img img-fluid" src="assets/images/blank.gif" alt="blank" title="blank">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><{$smarty.const._CLOSE}></button>
            </div>
        </div>
    </div>
</div>

<script>
    const imgModal = document.getElementById('imgModal')
    if (imgModal) {
        imgModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const info = button.getAttribute('data-bs-info')
            const title = button.getAttribute('data-bs-title')
            // Update the modal's content.
            const modalTitle = imgModal.querySelector('.modal-title')
            modalTitle.textContent = title

            const modalBodyImg = imgModal.querySelector('.modal-img')
            modalBodyImg.src = info;
            var width = modalBodyImg.naturalWidth;
            imgModal.find(".modal-dialog").css("width", width + 100);

        })
    }
    const pdfModal = document.getElementById('pdfModal')
    if (pdfModal) {
        pdfModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const info = button.getAttribute('data-bs-info')
            const title = button.getAttribute('data-bs-title')
            // Update the modal's content.
            const modalTitle = pdfModal.querySelector('.modal-title')
            modalTitle.textContent = title

            var modalpdf = pdfModal.querySelector(".modal-embedPdf");
            modalpdf.src = info;
            var width = modalpdf.naturalWidth;
            modal.find(".modal-dialog").css("width", width + 100);

        })
    }
</script>
<!-- End code for show files as modal-->