<{if $dir_list|default:false}>
    <ul style="list-style-type: none;<{if $dir.id|default:0 == 0}>padding:20px 0;<{/if}>">
        <{foreach item=dir from=$dir_list name=dir}>
            <li>
                <{if $dir.state|default:'closed' == 'open'}>
                    <i class="fa fa-folder-open wgf-link-fa"></i><{$dir.name}>
                <{else}>
                    <i class="fa fa-folder-o wgf-link-fa"></i>
                    <a class='wgf-fol' href='index.php?op?list&amp;dir_id=<{$dir.id}>' title='<{$dir.name}>'><{$dir.name}></a>
                <{/if}>
                <{if $dir.count_subdirs > 0}>
                    <{include file='db:wgfilemanager_index_default_dirlist.tpl' dir_list=$dir.subdirs}>
                <{/if}>
            </li>
        <{/foreach}>
    </ul>
<{/if}>

