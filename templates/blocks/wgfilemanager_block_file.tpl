<table class='table table-<{$table_type|default:false}>'>
    <thead>
        <tr class='head'>
            <th class='center'><{$smarty.const._MB_WGFILEMANAGER_FILE_NAME}></th>
            <th class='center'><{$smarty.const._MB_WGFILEMANAGER_FILE_DIRECTORY_ID}></th>
            <th class='center'>&nbsp;</th>
        </tr>
    </thead>
    <{if count($block|default:0) > 0}>
    <tbody>
        <{foreach item=file from=$block}>
        <tr class='<{cycle values="odd, even"}>'>
            <td class='center'><{$file.name|default:false}></td>
            <td class='center'><{$file.dir_name|default:false}></td>
            <td class='center'><a href='<{$wgfilemanager_url}>/file.php?op=show&amp;id=<{$file.id|default:false}>' title='<{$smarty.const._MB_WGFILEMANAGER_FILE_GOTO}>'><{$smarty.const._MB_WGFILEMANAGER_FILE_GOTO}></a></td>
        </tr>
        <{/foreach}>
    </tbody>
    <{/if}>
    <tfoot><tr><td>&nbsp;</td></tr></tfoot>
</table>
