<tr>
    <td style="padding-left:<{$directory.level|default:0*20}>px">
        <p ><{$directory.name|default:false}></p>
        <{if $directory.description_short|default:false}>
            <p class="small"><{$directory.description_short}></p>
        <{/if}>
    </td>
    <td class='center'><{$directory.count_subdirs|default:0}></td>
    <td class='center'><{$directory.count_files|default:0}></td>
    <td class=''>
        <a class='btn btn-primary' href='index.php?op=list&amp;dir_id=<{$directory.id|default:false}>' title='<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_GOTO}>'><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_GOTO}></a>
        <{if $directory.id|default:0 > 0 && $permEdit|default:false}>
            <a class='btn btn-success' href='directory.php?op=edit&amp;id=<{$directory.id|default:false}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
            <a class='btn btn-danger' href='directory.php?op=delete&amp;id=<{$directory.id|default:false}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
        <{/if}>
    </td>
</tr>

