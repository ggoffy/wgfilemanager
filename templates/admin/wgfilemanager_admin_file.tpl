<!-- Header -->
<{include file='db:wgfilemanager_admin_header.tpl' }>

<{if $file_list|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FILE_ID}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FILE_DIRECTORY_ID}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FILE_NAME}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FILE_DESCRIPTION}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FILE_MIMETYPE}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FILE_MTIME}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FILE_CTIME}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FILE_SIZE}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FILE_IP}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FILE_STATUS}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FILE_DATE_CREATED}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FILE_SUBMITTER}></th>
                <th class="center width5"><{$smarty.const._MA_WGFILEMANAGER_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $file_count|default:''}>
        <tbody>
            <{foreach item=file from=$file_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$file.id|default:false}></td>
                <td class='center'>(<{$file.directory_id|default:false}>) <{$file.dir_name|default:false}></td>
                <td class='center'><{$file.name|default:false}></td>
                <td class='center'><{$file.description_short|default:false}></td>
                <td class='center'><{$file.mimetype|default:false}></td>
                <td class='center'><{$file.mtime_text|default:false}></td>
                <td class='center'><{$file.ctime_text|default:false}></td>
                <td class='center'><{$file.size_text|default:false}></td>
                <td class='center'><{$file.ip|default:false}></td>
                <td class='center'><img src="<{$modPathIcon16}>status<{$file.status|default:false}>.png" alt="<{$file.status_text|default:false}>" title="<{$file.status_text|default:false}>" ></td>
                <td class='center'><{$file.date_created_text|default:false}></td>
                <td class='center'><{$file.submitter_text|default:false}></td>
                <td class="center  width5">
                    <a href="file.php?op=edit&amp;id=<{$file.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> file" ></a>
                    <a href="file.php?op=clone&amp;id_source=<{$file.id|default:false}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> file" ></a>
                    <a href="file.php?op=delete&amp;id=<{$file.id|default:false}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> file" ></a>
                </td>
            </tr>
            <{/foreach}>
        </tbody>
        <{/if}>
    </table>
    <div class="clear">&nbsp;</div>
    <{if $pagenav|default:''}>
        <div class="xo-pagenav floatright"><{$pagenav|default:false}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:''}>
    <div class="errorMsg"><strong><{$error|default:false}></strong></div>
<{/if}>

<!-- Footer -->
<{include file='db:wgfilemanager_admin_footer.tpl' }>
