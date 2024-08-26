
        <div class="row wgf-filepanel-right-header">
            <{include file='db:wgfilemanager_index_filepanel_header.tpl' }>
        </div>
        <div class="row wgf-filepanel-right-body">
            <div class="col-12 col-xs-12 col-sm-12">
                <{if $file_list|default:false}>
                    <table class='table table-<{$table_type|default:'none'}>'>
                        <tr>
                            <th class=''><{$smarty.const._MA_WGFILEMANAGER_FILE_NAME}></th>
                            <th class=''><{$smarty.const._MA_WGFILEMANAGER_FILE_SIZE}></th>
                            <th class=''><{$smarty.const._MA_WGFILEMANAGER_FILE_CTIME}></th>
                            <th class=''><{$smarty.const._MA_WGFILEMANAGER_FILE_SUBMITTER}></th>
                            <th class=''><{$smarty.const._MA_WGFILEMANAGER_ACTION}></th>
                        </tr>
                        <!-- Start new link loop -->
                        <{foreach item=file from=$file_list|default:false name=file}>
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
                                    <{include file='db:wgfilemanager_index_fileactions.tpl' }>
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
