<{if $directory_list|default:false}>
    <{foreach item=dir from=$directory_list name=dir}>
        <{include file='db:wgfilemanager_directory_default_list.tpl' directory=$dir}>
        <{if $dir.count_subdirs > 0 && $dir.subdirs|count > 0}>
            <{include file='db:wgfilemanager_directory_default.tpl' directory_list=$dir.subdirs}>
        <{/if}>
    <{/foreach}>
<{/if}>