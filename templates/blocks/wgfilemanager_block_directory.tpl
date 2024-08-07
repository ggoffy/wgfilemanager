<table class='table table-<{$table_type|default:false}>'>
    <thead>
        <tr class='head'>
            <th>&nbsp;</th>
            <th class='center'><{$smarty.const._MB_WGFILEMANAGER_DIR_NAME}></th>
        </tr>
    </thead>
    <{if count($block|default:0) > 0}>
    <tbody>
        <{foreach item=directory from=$block}>
        <tr class='<{cycle values="odd, even"}>'>
            <td class='center'><{$directory.id|default:false}></td>
            <td class='center'><{$directory.name|default:false}></td>
            <td class='center'><a href='directory.php?op=show&amp;id=<{$directory.id|default:false}>' title='<{$smarty.const._MB_WGFILEMANAGER_DIRECTORY_GOTO}>'><{$smarty.const._MB_WGFILEMANAGER_DIRECTORY_GOTO}></a></td>
        </tr>
        <{/foreach}>
    </tbody>
    <{/if}>
    <tfoot><tr><td>&nbsp;</td></tr></tfoot>
</table>
