<div class="btn-group btn-group-sm" role="group" aria-label="group_view">
    <{if $showBtnDetails|default:false}>
        <a class='btn btn-sm btn-outline-primary' href='directory.php?op=show&amp;dir_id=<{$dir.id}><{$params|default:''}>' title='<{$smarty.const._MA_WGFILEMANAGER_DETAILS}>'><img src="<{$wgfilemanager_icon_bi_url}>arrow-right.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_DETAILS}>" ></a>
    <{/if}>
</div>
<{if $permEditDir|default:false || $showBtnBack|default:false}>
    <div class="btn-group btn-group-sm" role="group" aria-label="group_view">
        <{if $permEditDir|default:false}>
            <a class="btn btn-sm btn-outline-primary" href='directory.php?op=edit&amp;dir_id=<{$dir.id}><{$params|default:''}>' title='<{$smarty.const._EDIT}>'><img src="<{$wgfilemanager_icon_bi_url}>pencil-square.svg" alt="<{$smarty.const._EDIT}>" ></a>
            <a class="btn btn-sm btn-outline-danger" href='directory.php?op=delete&amp;dir_id=<{$dir.id}><{$params|default:''}>' title='<{$smarty.const._DELETE}>'><img src="<{$wgfilemanager_icon_bi_url}>trash.svg" alt="<{$smarty.const._DELETE}>" ></a>
        <{/if}>
        <{if $showBtnBack|default:false}>
            <a class='btn btn-sm btn-outline-primary' href='index.php?op=list&amp;dir_id=<{$dir.id}><{$params|default:''}>' title='<{$smarty.const._BACK}>'><img src="<{$wgfilemanager_icon_bi_url}>arrow-return-left.svg" alt="<{$smarty.const._BACK}>" ></a>
        <{/if}>
    </div>
<{/if}>
