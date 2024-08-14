<{if $dir_list|default:false}>
    <ul style="list-style-type: none;<{if $dir.id|default:0 == 0}>padding:20px 0;<{/if}>">
        <{foreach item=dir from=$dir_list name=dir}>
            <li class="wgf-dirlist <{if $dir.level|default:0 == 1}>wgf-dirlist-default-level1<{/if}>">
                <{if $dir.state|default:'closed' == 'open'}>
                    <i class="fa fa-folder-open"></i><{$dir.name}>
                <{else}>
                    <a class='' href='index.php?op?list&amp;dir_id=<{$dir.id}>' title='<{$dir.name}>'><i class="fa fa-folder-o"></i><{$dir.name}></a>
                <{/if}>
                <{if $dir.count_subdirs > 0}>
                    <{include file='db:wgfilemanager_index_dirlist_default.tpl' dir_list=$dir.subdirs}>
                <{/if}>
            </li>
        <{/foreach}>
    </ul>
<{/if}>

