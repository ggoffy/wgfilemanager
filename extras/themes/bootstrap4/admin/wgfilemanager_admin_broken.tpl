<!-- Header -->
<{include file='db:wgfilemanager_admin_header.tpl' }>

<h3><{$file_result|default:false}></h3>
<{if $file_count|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class='center'><{$smarty.const._AM_WGFILEMANAGER_BROKEN_TABLE}></th>
                <th class='center'><{$smarty.const._AM_WGFILEMANAGER_BROKEN_MAIN}></th>
                <th class='center width5'><{$smarty.const._AM_WGFILEMANAGER_FORM_ACTION}></th>
            </tr>
        </thead>
        <tbody>
            <{foreach item=file from=$file_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$file.table|default:false}></td>
                <td class='center'><{$file.main|default:false}></td>
                <td class='center width5'>
                    <a href='file.php?op=edit&amp;<{$file.key|default:false}>=<{$file.keyval|default:false}>' title='<{$smarty.const._EDIT}>'><img src="<{xoModuleIcons16 'edit.png'}>" alt='file' ></a>
                    <a href='file.php?op=delete&amp;<{$file.key|default:false}>=<{$file.keyval|default:false}>' title='<{$smarty.const._DELETE}>'><img src="<{xoModuleIcons16 'delete.png'}>" alt='file' ></a>
                </td>
            </tr>
            <{/foreach}>
        </tbody>
    </table>
    <div class='clear'>&nbsp;</div>
    <{if $pagenav|default:''}>
        <div class='xo-pagenav floatright'><{$pagenav|default:false}></div>
        <div class='clear spacer'></div>
    <{/if}>
<{else}>
    <{if $nodataFile|default:''}>
        <div>
            <{$nodataFile|default:false}><img src="<{xoModuleIcons32 'button_ok.png'}>" alt='file' >
        </div>
        <div class='clear spacer'></div>
        <br>
        <br>
    <{/if}>
<{/if}>
<br>
<br>
<br>
<{if $error|default:''}>
    <div class='errorMsg'>
<strong><{$error|default:false}></strong>    </div>
<{/if}>

<!-- Footer -->
<{include file='db:wgfilemanager_admin_footer.tpl' }>
