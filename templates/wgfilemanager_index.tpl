<style>
    .wgf-dirlist i,
    .wgf-dirlist svg {
        margin-right:0.5rem;
    }
</style>

<{include file='db:wgfilemanager_header.tpl' }>

<{if $permViewDirectory|default:false}>
    <div class="row panel panel-<{$panel_type|default:'none'}>">
        <{if $indexDirPosTop|default:false}>
            <div class="col-sm-12 wgf-filepanel-left">
                <{include file='db:wgfilemanager_index_dirlist_default.tpl' directory=$dir_list}>
            </div>
        <{/if}>
        <{if $indexDirPosLeft|default:false}>
            <div class="col-xs-12 col-sm-4 wgf-filepanel-left">
                <{include file='db:wgfilemanager_index_dirlist_default.tpl' directory=$dir_list}>
            </div>
        <{/if}>
        <{if $indexDirPosTop|default:false || $indexDirPosNone|default:false}>
            <div class="col-sm-12 wgf-filepanel-right">
        <{else}>
            <div class="col-xs-12 col-sm-8 wgf-filepanel-right">
        <{/if}>
            <{if $wgfindexstyle|default:'' == 'GROUPED'}>
                <{include file='db:wgfilemanager_index_grouped.tpl' }>
            <{elseif $wgfindexstyle|default:'' == 'CARD' || $wgfindexstyle|default:'' == 'CARDBIG'}>
                <{include file='db:wgfilemanager_index_card.tpl' }>
            <{else}>
                <{include file='db:wgfilemanager_index_default.tpl' }>
            <{/if}>
        </div>
    </div>
<{else}>
    <div class="alert"><{$smarty.const._MA_WGFILEMANAGER_NO_PERM_DIRECTORY_VIEW}></div>
<{/if}>
<div class="clear"></div>

<{include file='db:wgfilemanager_footer.tpl' }>

<{include file='db:wgfilemanager_modal.tpl' }>
<{include file='db:wgfilemanager_print.tpl' }>