<i id='dirId_<{$directory.id|default:false}>'></i>
<div class='panel-heading'>
    <h3 class='panel-title'><{$directory.name|default:false}></h3>
</div>
<div class='panel-body'>
</div>
<div class='panel-foot'>
    <div class='col-sm-12 right'>
        <{if $showItem|default:false}>
            <a class='btn btn-success right' href='directory.php?op=list&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>#dirId_<{$directory.id|default:false}>' title='<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_LIST}>'><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_LIST}></a>
        <{else}>
            <a class='btn btn-success right' href='directory.php?op=show&amp;id=<{$directory.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._MA_WGFILEMANAGER_DETAILS}>'><{$smarty.const._MA_WGFILEMANAGER_DETAILS}></a>
        <{/if}>
        <{if $permEdit|default:false}>
            <a class='btn btn-primary right' href='directory.php?op=edit&amp;id=<{$directory.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-primary right' href='directory.php?op=clone&amp;id_source=<{$directory.id|default:false}>' title='<{$smarty.const._CLONE}>'><{$smarty.const._CLONE}></a>
            <a class='btn btn-danger right' href='directory.php?op=delete&amp;id=<{$directory.id|default:false}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
    </div>
</div>
