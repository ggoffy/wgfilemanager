<i id='fileId_<{$file.id|default:false}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$file.directory_id|default:false}></span>
    <span class='col-sm-9 justify'><{$file.name|default:false}></span>
    <span class='col-sm-9 justify'><{$file.date_created_text|default:false}></span>
    <span class='col-sm-9 justify'><{$file.submitter_text|default:false}></span>
</div>
<div class='panel-foot'>
    <div class='col-sm-12 right'>
        <{if $showItem|default:false}>
            <a class='btn btn-success right' href='file.php?op=list&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>#fileId_<{$file.id|default:false}>' title='<{$smarty.const._MA_WGFILEMANAGER_FILE_LIST}>'><{$smarty.const._MA_WGFILEMANAGER_FILE_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='file.php?op=show&amp;id=<{$file.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._MA_WGFILEMANAGER_DETAILS}>'><{$smarty.const._MA_WGFILEMANAGER_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:false}>
            <a class='btn btn-primary right' href='file.php?op=edit&amp;id=<{$file.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='file.php?op=clone&amp;id_source=<{$file.id|default:false}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='file.php?op=delete&amp;id=<{$file.id|default:false}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
        <a class='btn btn-warning right' href='file.php?op=broken&amp;id=<{$file.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._MA_WGFILEMANAGER_BROKEN}>'><{$smarty.const._MA_WGFILEMANAGER_BROKEN}></a>
    </div>
</div>
