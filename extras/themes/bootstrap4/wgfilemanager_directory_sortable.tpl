<div class="panel panel-default">
    <div class="panel-heading"><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_LIST}></div>
    <div class="panel-body wgf-sortable-directory">
        <ol class="sortable ui-sortable mjs-nestedSortable-branch mjs-nestedSortable-expanded">
            <{include file='db:wgfilemanager_directory_sortable_list.tpl'}>
        </ol>
        <p class="center">
            <a class="btn btn-outline-primary" href="directory.php" title="<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_REFRESH}>"><img src="<{$wgfilemanager_icon_bi_url}>arrow-repeat.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_REFRESH}>" ></a>
            <a class="btn btn-outline-success" href="directory.php?op=new&amp;parent_id=0" title="<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_ADD}>"><img src="<{$wgfilemanager_icon_bi_url}>folder-plus.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_ADD}>" ></a>
        </p>
    </div>
</div>

<script>
    $('.disclose').attr('title','<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_SHOWHIDE}>');
</script>