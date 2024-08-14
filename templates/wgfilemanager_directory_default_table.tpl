<div class='table-responsive'>
    <table class='table table-<{$table_type|default:false}>'>
        <thead>
        <tr class='head'>
            <th><{$smarty.const._MA_WGFILEMANAGER_FILE_TITLE}></th>
            <th><{$smarty.const._MA_WGFILEMANAGER_COUNT_SUBDIRS}></th>
            <th><{$smarty.const._MA_WGFILEMANAGER_COUNT_FILES}></th>
            <th><{$smarty.const._MA_WGFILEMANAGER_ACTION}></th>
        </tr>
        </thead>
        <tbody>
            <{include file='db:wgfilemanager_directory_default_row.tpl'}>
        </tbody>
        <tfoot><tr><td class="center" colspan="4"><a class='btn btn-primary' href='directory.php?op=new' title='<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_ADD}>'><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_ADD}></a></td></tr></tfoot>
    </table>
</div>