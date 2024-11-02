<div class="btn-group btn-group-sm" role="group" aria-label="group_view">
    <a class='btn btn-outline-primary' href='index.php?op=list&amp;dir_id=<{$dir.id|default:false}>' title='<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_GOTO}>'><img src="<{$wgfilemanager_icon_bi_url}>search.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_GOTO}>" ></a>
    <{if $permEditDir|default:false}>
        <a class='btn btn-sm btn-outline-primary' href='directory.php?op=new&amp;parent_id=<{$dir.id}><{$params|default:''}>' title='<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_ADD}>'><img src="<{$wgfilemanager_icon_bi_url}>folder-plus.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_ADD}>" ></a>
    <{/if}>
</div>
<{if $permEditDir|default:false || $showBtnBack|default:false}>
    <div class="btn-group btn-group-sm" role="group" aria-label="group_view">
        <{if $permEditDir|default:false}>
            <a class="btn btn-sm btn-outline-primary" href='directory.php?op=edit&amp;id=<{$dir.id}><{$params|default:''}>' title='<{$smarty.const._EDIT}>'><img src="<{$wgfilemanager_icon_bi_url}>pencil-square.svg" alt="<{$smarty.const._EDIT}>" ></a>
            <a class="btn btn-sm btn-outline-danger" href='directory.php?op=delete&amp;id=<{$dir.id}><{$params|default:''}>' title='<{$smarty.const._DELETE}>'><img src="<{$wgfilemanager_icon_bi_url}>trash.svg" alt="<{$smarty.const._DELETE}>" ></a>
        <{/if}>
        <{if $showBtnBack|default:false}>
            <a class='btn btn-sm btn-outline-primary' href='index.php?op=list&amp;dir_id=<{$dir.id}><{$params|default:''}>' title='<{$smarty.const._BACK}>'><img src="<{$wgfilemanager_icon_bi_url}>arrow-return-left.svg" alt="<{$smarty.const._BACK}>" ></a>
        <{/if}>
    </div>
<{/if}>
