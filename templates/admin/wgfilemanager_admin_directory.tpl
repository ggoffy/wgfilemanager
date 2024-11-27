<!-- Header -->
<{include file='db:wgfilemanager_admin_header.tpl' }>

<{if $error|default:''}>
    <div class="errorMsg"><strong><{$error|default:false}></strong></div>
<{/if}>

<{if $directory_list|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_ID}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_PARENT_ID}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_NAME}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_DESCRIPTION}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_FULLPATH}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_WEIGHT}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_COUNT_SUBDIRS}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_COUNT_FILES}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_FAVORITE_PIN}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_DATE_CREATED}></th>
                <th class="center"><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_SUBMITTER}></th>
                <th class="center width5"><{$smarty.const._MA_WGFILEMANAGER_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $directory_count|default:''}>
        <tbody>
            <{foreach item=directory from=$directory_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$directory.id|default:0}></td>
                <td class='center'><{if $directory.parent_id|default:false}>(<{$directory.parent_id}>) <{/if}><{$directory.parent_text|default:false}></td>
                <td class='center'><{$directory.name|default:false}></td>
                <td class='center'><{$directory.description_short|default:false}></td>
                <td class='center'><{$directory.fullpath|default:false}></td>
                <td class='center'><{$directory.weight|default:0}></td>
                <td class='center'><{$directory.count_subdirs|default:0}></td>
                <td class='center'>
                    <{if $directory.count_files|default:0 >= 0}>
                    <{$directory.count_files|default:0}>
                    <{else}>
                    <span style="color:red;font-weight:700"><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_ERROR_DONOTEXIST}></span>
                    <{/if}>
                </td>
                <td class='center'><{$directory.favorite|default:false}></td>
                <td class='center'><{$directory.date_created_text|default:false}></td>
                <td class='center'><{$directory.submitter_text|default:false}></td>
                <td class="center  width5">
                    <a href="directory.php?op=edit&amp;id=<{$directory.id|default:0}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> directory" ></a>
                    <{if $directory.id|default:0 > 1}>
                        <a href="directory.php?op=clone&amp;id_source=<{$directory.id|default:0}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> directory" ></a>
                        <a href="directory.php?op=delete&amp;id=<{$directory.id|default:0}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> directory" ></a>
                    <{/if}>
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

<!-- Footer -->
<{include file='db:wgfilemanager_admin_footer.tpl' }>
