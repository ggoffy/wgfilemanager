<{include file='db:wgfilemanager_header.tpl' }>
<{if $wgfindexstyle|default:'' == 'GROUPED'}>
    <{include file='db:wgfilemanager_index_grouped.tpl' }>
<{else}>
    <{include file='db:wgfilemanager_index_default.tpl' }>
<{/if}>
<{include file='db:wgfilemanager_footer.tpl' }>
