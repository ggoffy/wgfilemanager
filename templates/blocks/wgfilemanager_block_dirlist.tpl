<style>
    .wgf-dirlist i,
    .wgf-dirlist svg {
        margin-right:0.5rem;
    }
    .wgf-i {
        border:1px solid;
        padding:1px 4px;
        border-radius:2px;
    }
    .wgf-div-link {
        display: inline;
        color: #212529;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
</style>

<{if $wgfilemanager_typeblock|default:'' == 'collapsable'}>
    <{include file='db:wgfilemanager_index_favlist_collapsable.tpl' fav_list=$block['fav_list']}>
    <{include file='db:wgfilemanager_index_dirlist_collapsable.tpl' dir_list=$block['dir_list']}>
<{else}>
    <{include file='db:wgfilemanager_index_favlist_default.tpl' fav_list=$block['fav_list']}>
    <{include file='db:wgfilemanager_index_dirlist_default.tpl' fav_list=$block['fav_list']}>
<{/if}>
