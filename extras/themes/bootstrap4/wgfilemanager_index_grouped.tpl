        <div class="row wgf-filepanel-right-header">
            <{include file='db:wgfilemanager_index_filepanel_header.tpl' }>
        </div>
        <div class="row wgf-filepanel-right-body">
            <div class="col-12 col-xs-12 col-sm-12">
                <{if $file_list|default:false}>
                    <table class='table table-<{$table_type|default:'none'}>'>
                        <tr>
                            <{if $wgfindexpreview|default:false}>
                                <th class=''>&nbsp;</th>
                            <{/if}>
                            <th class='left'><{$smarty.const._MA_WGFILEMANAGER_FILE_NAME}></th>
                            <th class='right'><{$smarty.const._MA_WGFILEMANAGER_ACTION}></th>
                        </tr>
                        <!-- Start new link loop -->
                        <{foreach item=file from=$file_list|default:false name=file}>
                            <tr>
                                <{if $wgfindexpreview|default:false}>
                                    <{if $file.image|default:false}>
                                        <td class='wgf-grouped-list'>
                                            <img class="img-fluid wgf-preview-<{$file.category|default:0}>" src="<{$file.image_url}>" alt="<{$file.name}>">
                                        </td>
                                    <{else}>
                                        <td class='wgf-grouped-list'>
                                            <img class="img-fluid wgf-preview-<{$file.category|default:0}>" src="<{$file.icon_url}>" alt="<{$file.name}>">
                                        </td>
                                    <{/if}>
                                <{/if}>
                                <td class='wgf-grouped-list'>
                                    <span class="wgf-filename"><{$file.name}></span>
                                    <{if $file.description_short|default:''}>
                                        <p class="wgf-fileinfo"><{$file.description_short}></p>
                                    <{/if}>
                                    <p class="wgf-fileinfo">
                                        <{$smarty.const._MA_WGFILEMANAGER_FILE_SIZE}>: <{$file.size_text}><br>
                                        <{$smarty.const._MA_WGFILEMANAGER_FILE_CTIME}>: <{$file.ctime_text}><br>
                                        <{$smarty.const._MA_WGFILEMANAGER_FILE_SUBMITTER}>: <{$file.submitter_text}>
                                    </p>
                                </td>
                                <td class='wgf-grouped-list right wgf-fileaction'>
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