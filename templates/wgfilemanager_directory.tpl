
<{include file='db:wgfilemanager_header.tpl' }>

<{if $directoryCount|default:0 > 0}>
<div class='table-responsive'>
    <table class='table table-<{$table_type|default:false}>'>
        <thead>
            <tr class='head'>
                <th colspan='<{$divideby|default:false}>'><{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_TITLE}></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <{foreach item=directory from=$directory_list name=directory}>
                <td>
                    <div class='panel panel-<{$panel_type|default:false}>'>
                        <{include file='db:wgfilemanager_directory_item.tpl' directory=$directory}>
                    </div>
                </td>
                <{if $smarty.foreach.directory.iteration is div by $divideby}>
                    </tr><tr>
                <{/if}>
                <{/foreach}>
            </tr>
        </tbody>
        <tfoot><tr><td>&nbsp;</td></tr></tfoot>
    </table>
</div>
<{/if}>
<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:''}>
    <{$error|default:false}>
<{/if}>

<{include file='db:wgfilemanager_footer.tpl' }>
