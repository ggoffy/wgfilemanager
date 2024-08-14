<{include file='db:wgfilemanager_header.tpl' }>

<div class="row panel panel-<{$panel_type|default:'none'}>">
    <{if $indexDirPosition|default:'left' == 'top'}>
        <div class="col-sm-12 wgf-filepanel-left">
    <{else}>
        <div class="col-sm-4 wgf-filepanel-left">
    <{/if}>
        <{include file='db:wgfilemanager_index_dirlist_default.tpl' directory=$dir_list}>
    </div>
    <{if $indexDirPosition|default:'left' == 'top'}>
        <div class="col-sm-12 wgf-filepanel-right">
    <{else}>
        <div class="col-sm-8 wgf-filepanel-right">
    <{/if}>
        <{if $wgfindexstyle|default:'' == 'GROUPED'}>
            <{include file='db:wgfilemanager_index_grouped.tpl' }>
        <{elseif $wgfindexstyle|default:'' == 'CARD'}>
            <{include file='db:wgfilemanager_index_card.tpl' }>
        <{else}>
            <{include file='db:wgfilemanager_index_default.tpl' }>
        <{/if}>
    </div>
</div>
<div class="clear"></div>
<{include file='db:wgfilemanager_footer.tpl' }>
