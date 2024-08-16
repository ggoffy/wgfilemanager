<{include file='db:wgfilemanager_header.tpl' }>

<{if $fileShow|default:false}>
<div class='table-responsive'>
    <table class='table table-<{$table_type|default:false}>'>
        <thead>
            <tr class='head'>
                <th colspan="2"><{$smarty.const._MA_WGFILEMANAGER_FILE_DETAILS}></th>
            </tr>
        </thead>
        <tbody>
            <{if $file.image|default:false}>
                <tr>
                    <td class="center" colspan="2">
                        <img class="card-img-top center wgf-preview-<{$file.category|default:0}>" src="<{$file.real_url}>" alt="<{$file.name}>">
                    </td>
                </tr>
            <{/if}>
            <tr>
                <td><{$smarty.const._MA_WGFILEMANAGER_FILE_NAME}></td>
                <td><{$file.name|default:false}></td>
            </tr>
            <{if $file.description_text|default:false}>
                <tr>
                    <td><{$smarty.const._MA_WGFILEMANAGER_FILE_DESCRIPTION}></td>
                    <td><{$file.description_text|default:false}></td>
                </tr>
            <{/if}>
            <{if $file.directory_id|default:0 > 1}>
                <tr>
                    <td><{$smarty.const._MA_WGFILEMANAGER_FILE_DIRECTORY_ID}></td>
                    <td><{$file.dir_fullpath|default:false}></td>
                </tr>
            <{/if}>
            <tr>
                <td><{$smarty.const._MA_WGFILEMANAGER_FILE_MTIME}></td>
                <td><{$file.mtime_text|default:false}></td>
            </tr>
            <tr>
                <td><{$smarty.const._MA_WGFILEMANAGER_FILE_CTIME}></td>
                <td><{$file.ctime_text|default:false}></td>
            </tr>
            <tr>
                <td><{$smarty.const._MA_WGFILEMANAGER_FILE_SIZE}></td>
                <td><{$file.size_text|default:false}></td>
            </tr>
            <tr>
                <td><{$smarty.const._MA_WGFILEMANAGER_FILE_MIMETYPE}></td>
                <td><{$file.mimetype|default:false}></td>
            </tr>
            <tr>
                <td><{$smarty.const._MA_WGFILEMANAGER_FILE_IP}></td>
                <td><{$file.ip|default:false}></td>
            </tr>
            <tr>
                <td><{$smarty.const._MA_WGFILEMANAGER_FILE_DATE_CREATED}></td>
                <td><{$file.date_created_text|default:false}></td>
            </tr>
            <tr>
                <td><{$smarty.const._MA_WGFILEMANAGER_FILE_SUBMITTER}></td>
                <td><{$file.submitter_text|default:false}></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="center"><{include file='db:wgfilemanager_index_fileactions.tpl' }></td>
            </tr>
        </tfoot>
    </table>
</div>
<{/if}>
<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:''}>
    <{$error|default:false}>
<{/if}>

<{include file='db:wgfilemanager_footer.tpl' }>

<!-- ---------------------------------- -->
<!-- Start code for show files as modal -->
<!-- ---------------------------------- -->
<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="imgModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="imgModalLabel">Default Title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="<{$smarty.const._CLOSE}>">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modalimg" class="modal-img" src="assets/images/blank.gif" alt="blank" title="blank">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><{$smarty.const._CLOSE}></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="pdfModalLabel">Default Title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="<{$smarty.const._CLOSE}>">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <embed id="embedPdf" src="assets/images/blank.gif"
                       frameborder="0" width="100%" height="400px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><{$smarty.const._CLOSE}></button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#imgModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var info = button.data('info');
        var title = button.data('title');
        var modal = $(this);
        modal.find('.modal-title').text(title);
        var modalimg = document.getElementById("modalimg");
        modalimg.src = info;
        var width = modalimg.naturalWidth;
        modal.find(".modal-dialog").css("width", width + 100);
    });
    $('#pdfModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var info = button.data('info');
        var title = button.data('title');
        var modal = $(this);
        modal.find('.modal-title').text(title);
        var modalpdf = document.getElementById("embedPdf");
        modalpdf.src = info;
        var width = modalpdf.naturalWidth;
        modal.find(".modal-dialog").css("width", width + 100);
    });
</script>
<!-- End code for show files as modal-->

<!-- ----------------------------- -->
<!-- Start code for printing files -->
<!-- ----------------------------- -->
<script>
    function printFile(url) {
        const iframe = document.createElement('iframe');
        iframe.src = url;
        iframe.style.display = 'none';
        document.body.appendChild(iframe);

        // Use onload to make pdf preview work on firefox
        //iframe.onload = () => {
        //iframe.contentWindow.focus();
        //iframe.contentWindow.print();
        //};
    }
</script>
<style>
    @media print,
    @print {
        .navigation {
            visibility: hidden;
        }
        @page
        {
            size: auto;
            margin: 0;
        }
        @page :footer {
            display: none
        }
        @page :header {
            display: none
        }
    }
</style>
<!-- End code for printing files -->
