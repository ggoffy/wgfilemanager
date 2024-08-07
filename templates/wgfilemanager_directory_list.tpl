<div class='row'>
    <div class='col-xs-12 col-sm-4'>
        <p><{$directory.name|default:false}></p>
        <{if $directory.description_short|default:false}>
        <p class="small"><{$directory.description_short}></p>
        <{/if}>
    </div>
    <div class='col-xs-12 col-sm-2'><i class="fa fa-folder-o">&nbsp;</i><{$directory.count_subdirs|default:0}></div>
    <div class='col-xs-12 col-sm-2'><i class="fa fa-file-o">&nbsp;</i><i class="bi bi-files"></i><{$directory.count_files|default:0}></div>
    <div class='col-xs-12 col-sm-2'><a class='btn btn-primary' href='directory.php?op=show&amp;id=<{$directory.id|default:false}>' title='<{$smarty.const._MA_WGFILEMANAGER_DETAILS}>'><{$smarty.const._MA_WGFILEMANAGER_DETAILS}></a></div>
</div>

