        <div class="row wgf-filepanel-right-header">
            <{include file='db:wgfilemanager_index_filepanel_header.tpl' }>
        </div>
        <div class="row wgf-filepanel-right-body">
            <{if $file_list|default:false}>
                <!-- Start new link loop -->
                <{foreach item=file from=$file_list|default:false name=file}>
                    <div class="card wgf-card">
                        <{if $wgfindexpreview|default:false}>
                            <{if $file.image|default:false}>
                                <img class="card-img-top center wgf-preview-<{$file.category|default:0}>" src="<{$file.image_url}>" alt="<{$file.name}>">
                            <{else}>
                                <img class="card-img-top center wgf-preview-<{$file.category|default:0}>" src="<{$file.icon_url}>" alt="<{$file.name}>">
                            <{/if}>
                        <{/if}>
                        <div class="card-body">
                            <span class="wgf-filename"><{$file.name}></span>
                            <{if $file.description_short|default:''}>
                                <p class="card-text wgf-fileinfo"><{$file.description_short}></p>
                            <{/if}>
                        </div>
                        <div class="card-body">
                            <p class="wgf-fileinfo">
                                <{$smarty.const._MA_WGFILEMANAGER_FILE_SIZE}>: <{$file.size_text}><br>
                                <{$smarty.const._MA_WGFILEMANAGER_FILE_CTIME}>: <{$file.ctime_text}><br>
                                <{$smarty.const._MA_WGFILEMANAGER_FILE_SUBMITTER}>: <{$file.submitter_text}>
                            </p>
                        </div>
                        <div class="card-footer center wgf-fileaction">
                            <{include file='db:wgfilemanager_index_fileactions.tpl' }>
                        </div>
                    </div>
                <{/foreach}>
            <{else}>
                <p class="wgf-nofile"><{$smarty.const._MA_WGFILEMANAGER_INDEX_NOFILES}></p>
            <{/if}>

        </div>
        <{if $pagenavFile|default:''}>
            <div class="row wgf-filepanel-right-body">
                <div class='col-xs-12 col-sm-12 col-lg-12'>
                    <div><{$pagenavFile}></div>
                </div>
            </div>
        <{/if}>