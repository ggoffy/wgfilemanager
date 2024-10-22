
        <div class="row wgf-filepanel-right-header">
            <{include file='db:wgfilemanager_index_filepanel_header.tpl' }>
        </div>
        <div class="row wgf-filepanel-right-body">
            <div class="col-12 col-xs-12 col-sm-12">
                <{if  $indexDirlist|default:false ||  $indexFilelist|default:false}>
                    <table class='table table-<{$table_type|default:'none'}>'>
                        <tr>
                            <th class=''><{$smarty.const._MA_WGFILEMANAGER_FILE_NAME}></th>
                            <th class=''><{$smarty.const._MA_WGFILEMANAGER_FILE_SIZE}></th>
                            <th class=''><{$smarty.const._MA_WGFILEMANAGER_FILE_CTIME}></th>
                            <th class=''><{$smarty.const._MA_WGFILEMANAGER_FILE_SUBMITTER}></th>
                            <th class=''><{$smarty.const._MA_WGFILEMANAGER_ACTION}></th>
                        </tr>
                        <!-- Start new dir loop -->
                        <{foreach item=dir from=$indexDirlist|default:false name=dir}>
                        <tr>
                            <td class='wgf-default-list'>
                                <{if $wgfindexpreview|default:false}>
                                    <img class="card-img-top center wgf-preview-0" src="<{$indexDirlistIcon}>" alt="<{$dir.name}>">
                                <{/if}>
                                <span class="wgf-filename"><{$dir.name}></span>
                                <{if $dir.description_short|default:''}>
                                <p class="wgf-fileinfo"><{$dir.description_short}></p>
                                <{/if}>
                            </td>
                            <td class='wgf-default-list'>
                                <{$smarty.const._MA_WGFILEMANAGER_COUNT_SUBDIRS}>: <{$dir.count_subdirs}><br>
                                <{$smarty.const._MA_WGFILEMANAGER_COUNT_FILES}>: <{$dir.count_files}><br>
                            </td>
                            <td class='wgf-default-list'><{$dir.ctime_text}></td>
                            <td class='wgf-default-list'><{$dir.submitter_text}></td>
                            <td class='wgf-default-list right wgf-fileaction'>
                                <{include file='db:wgfilemanager_index_actions_dir.tpl' }>
                            </td>
                        </tr>
                        <{/foreach}>
                        <!-- Start new file loop -->
                        <{foreach item=file from=$indexFilelist|default:false name=file}>
                            <tr>
                                <td class='wgf-default-list'>
                                    <{if $wgfindexpreview|default:false}>
                                        <{if $file.image|default:false}>
                                            <img class="card-img-top center wgf-preview-<{$file.category|default:0}>" src="<{$file.image_url}>" alt="<{$file.name}>">
                                        <{else}>
                                            <img class="card-img-top center wgf-preview-0" src="<{$file.icon_url}>" alt="<{$file.name}>">
                                        <{/if}>
                                    <{/if}>
                                    <span class="wgf-filename"><{$file.name}></span>
                                    <{if $file.description_short|default:''}>
                                        <p class="wgf-fileinfo"><{$file.description_short}></p>
                                    <{/if}>
                                </td>
                                <td class='wgf-default-list'><{$file.size_text}></td>
                                <td class='wgf-default-list'><{$file.ctime_text}></td>
                                <td class='wgf-default-list'><{$file.submitter_text}></td>
                                <td class='wgf-default-list right wgf-fileaction'>
                                    <{include file='db:wgfilemanager_index_actions_file.tpl' }>
                                </td>
                            </tr>
                        <{/foreach}>
                    </table>
                    <{if $pagenavFile|default:''}>
                        <div class='pull-right'><{$pagenavFile}></div>
                    <{/if}>
                <{else}>
                    <p class="wgf-nofile"><{$smarty.const._MA_WGFILEMANAGER_INDEX_NOFILES}></p>
                <{/if}>
            </div>
        </div>
