<!-- Header -->
<{include file='db:wgfilemanager_admin_header.tpl' }>

<{if $mimetype_list|default:''}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._AM_WGFILEMANAGER_MIMETYPE_ID}></th>
                <th class="center"><{$smarty.const._AM_WGFILEMANAGER_MIMETYPE_EXTENSION}></th>
                <th class="center"><{$smarty.const._AM_WGFILEMANAGER_MIMETYPE_MIMETYPE}></th>
                <th class="center"><{$smarty.const._AM_WGFILEMANAGER_MIMETYPE_DESC}></th>
                <th class="center"><{$smarty.const._AM_WGFILEMANAGER_MIMETYPE_ADMIN}></th>
                <th class="center"><{$smarty.const._AM_WGFILEMANAGER_MIMETYPE_USER}></th>
                <th class="center"><{$smarty.const._AM_WGFILEMANAGER_MIMETYPE_CAT}></th>
                <th class="center"><{$smarty.const._AM_WGFILEMANAGER_MIMETYPE_DATE_CREATED}></th>
                <th class="center"><{$smarty.const._AM_WGFILEMANAGER_MIMETYPE_SUBMITTER}></th>
                <th class="center width5"><{$smarty.const._AM_WGFILEMANAGER_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $mimetype_count|default:''}>
        <tbody>
            <{foreach item=mimetype from=$mimetype_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class='center'><{$mimetype.id|default:false}></td>
                <td class='center'><{$mimetype.extension|default:false}></td>
                <td class='center'><{$mimetype.mimetype|default:false}></td>
                <td class='center'><{$mimetype.desc|default:false}></td>
                <td class='center'><{$mimetype.admin_text|default:false}></td>
                <td class='center'><{$mimetype.user_text|default:false}></td>
                <td class='center'><{$mimetype.category_text|default:false}></td>
                <td class='center'><{$mimetype.date_created_text|default:false}></td>
                <td class='center'><{$mimetype.submitter_text|default:false}></td>
                <td class="center width5">
                    <a href="mimetype.php?op=edit&amp;id=<{$mimetype.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> mimetype" ></a>
                    <a href="mimetype.php?op=clone&amp;id_source=<{$mimetype.id|default:false}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> mimetype" ></a>
                    <a href="mimetype.php?op=delete&amp;id=<{$mimetype.id|default:false}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> mimetype" ></a>
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
