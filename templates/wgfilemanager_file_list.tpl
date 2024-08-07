<div class='panel-heading'>
</div>
<div class='panel-body'>
    <span class='col-sm-9 justify'><{$file.directory_id|default:false}></span>
    <span class='col-sm-9 justify'><{$file.name|default:false}></span>
</div>
<div class='panel-foot'>
    <span class='col-sm-12'><a class='btn btn-primary' href='file.php?op=show&amp;id=<{$file.id|default:false}>' title='<{$smarty.const._MA_WGFILEMANAGER_DETAILS}>'><{$smarty.const._MA_WGFILEMANAGER_DETAILS}></a></span>
</div>
