
            <{if $directory_list|default:false}>
                <{foreach item=directory from=$directory_list name=dir}>
                <li style="display: list-item;" class="mjs-nestedSortable-branch <{if $directory.id|default:0 > 1}>mjs-nestedSortable-collapsed<{else}>mjs-nestedSortable-expanded<{/if}> <{if $directory.count_subdirs == 0}>mjs-nestedSortable-leaf<{/if}>" id="menuItem_<{$directory.id|default:0}>">
                    <div class="menuDiv ui-sortable-handle">
                        <{if $directory.count_subdirs > 0}>
                        <span title="Click to show/hide the sub items" class="disclose ui-icon <{if $directory.id|default:0 > 1}>ui-icon-plusthick<{else}>ui-icon-minusthick<{/if}>"><span>-</span></span>
                        <{/if}>
                        <span>
                        <span data-id="<{$directory.id|default:0}>" class="itemTitle"><{$directory.name|default:false}></span>
                        <span class="pull-right">
                            <a class='btn btn-outline-primary' href='index.php?op=list&amp;dir_id=<{$directory.id|default:0}>' title='<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_GOTO}>'><img src="<{$wgfilemanager_icon_bi_url}>folder2-open.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_GOTO}>" ></a>
                            <{if $permEdit|default:false}>
                                <a class='btn btn-outline-success' href='directory.php?op=edit&amp;id=<{$directory.id|default:0}>' title='<{$smarty.const._EDIT}>'><img src="<{$wgfilemanager_icon_bi_url}>pencil-square.svg" alt="<{$smarty.const._EDIT}>" ></a>
                                <a class='btn btn-outline-success' href='directory.php?op=new&amp;parent_id=<{$directory.id|default:0}>' title='<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_ADD}>'><img src="<{$wgfilemanager_icon_bi_url}>folder-plus.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_ADD}>" ></a>
                            <{/if}>
                            <{if $directory.id|default:0 > 1 && $permEdit|default:false}>
                                <a class='btn btn-outline-danger' href='directory.php?op=delete&amp;id=<{$directory.id|default:0}>' title='<{$smarty.const._DELETE}>'><img src="<{$wgfilemanager_icon_bi_url}>trash.svg" alt="<{$smarty.const._DELETE}>" ></a>
                            <{/if}>


                        </span>
                    </span>
                    </div>

                    <{if $directory.count_subdirs > 0 && $directory.subdirs|count > 0}>
                        <ol>
                            <{include file='db:wgfilemanager_directory_sortable_list.tpl' directory_list=$directory.subdirs}>
                        </ol>
                    <{/if}>
                </li>
                <{/foreach}>
            <{/if}>
