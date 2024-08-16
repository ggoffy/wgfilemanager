<{include file='db:wgfilemanager_header.tpl' }>

<{if $permViewDirectory|default:false}>
    <div class="row panel panel-<{$panel_type|default:'none'}>">
        <{if $indexDirPosition|default:'left' == 'top'}>
            <div class="col-sm-12 wgf-filepanel-left">
        <{else}>
            <div class="col-sm-4 wgf-filepanel-left">
        <{/if}>
            <{include file='db:wgfilemanager_index_dirlist_default.tpl' directory=$dir_list}>
        </div>
        <{if $indexDirPosition|default:'left' == 'top'}>
            <div class="col-sm-12 wgf-filepanel-right">
        <{else}>
            <div class="col-sm-8 wgf-filepanel-right">
        <{/if}>
            <{if $wgfindexstyle|default:'' == 'GROUPED'}>
                <{include file='db:wgfilemanager_index_grouped.tpl' }>
            <{elseif $wgfindexstyle|default:'' == 'CARD'}>
                <{include file='db:wgfilemanager_index_card.tpl' }>
            <{else}>
                <{include file='db:wgfilemanager_index_default.tpl' }>
            <{/if}>
        </div>
    </div>
<{else}>
    <div class="alert"><{$smarty.const._MA_WGFILEMANAGER_NO_PERM_DIRECTORY_VIEW}></div>
<{/if}>
<div class="clear"></div>

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
