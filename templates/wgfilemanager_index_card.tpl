<style>
    .wgf-card-sm {
        width:12rem;
    }
    .wgf-card-lg {
        width:20rem;
    }
</style>
        <div class="row wgf-filepanel-right-header">
            <{include file='db:wgfilemanager_index_filepanel_header.tpl' }>
        </div>
        <div class="row wgf-filepanel-right-body">
            <{if $indexDirlist|default:false || $indexFilelist|default:false}>
                <!-- Start dir loop -->
                <{foreach item=dir from=$indexDirlist|default:false name=dir}>
                    <div class="card wgf-card <{if $wgfindexstyle|default:'' == 'CARD'}>wgf-card-sm<{else}>wgf-card-lg<{/if}>">
                        <{if $wgfindexpreview|default:false}>
                            <div class="text-center"><img class="card-img-top center wgf-preview-card-folder" src="<{$indexDirlistIcon}>" alt="<{$dir.name}>"></div>
                        <{/if}>
                        <div class="card-body">
                            <{if $wgfindexstyle|default:'' == 'CARD'}><h6 class="card-title"><{else}><h5 class="card-title"><{/if}>
                                <{$dir.name}>
                            <{if $wgfindexstyle|default:'' == 'CARDBIG'}></h5><{else}></h6><{/if}>
                            <{if $dir.description_text|default:''}>
                                <p class="card-text wgf-fileinfo"><{$file.description_text}></p>
                            <{/if}>
                        </div>
                        <{if $wgfindexstyle|default:'' == 'CARDBIG'}>
                            <div class="card-body">
                                <p class="">
                                    <{$smarty.const._MA_WGFILEMANAGER_COUNT_SUBDIRS}>: <{$dir.count_subdirs}><br>
                                    <{$smarty.const._MA_WGFILEMANAGER_COUNT_FILES}>: <{$dir.count_files}><br>
                                    <{$smarty.const._MA_WGFILEMANAGER_FILE_CTIME}>: <{$dir.ctime_text}><br>
                                    <{$smarty.const._MA_WGFILEMANAGER_FILE_SUBMITTER}>: <{$dir.submitter_text}>
                                </p>
                            </div>
                        <{/if}>
                        <div class="card-footer center wgf-fileaction text-center">
                            <{include file='db:wgfilemanager_index_actions_dir.tpl' }>
                        </div>
                    </div>
                <{/foreach}>
                <div class="clear"></div>
                <!-- Start file loop -->
                <{foreach item=file from=$indexFilelist|default:false name=file}>
                    <div class="card wgf-card <{if $wgfindexstyle|default:'' == 'CARD'}>wgf-card-sm<{else}>wgf-card-lg<{/if}>">
                        <{if $wgfindexpreview|default:false}>
                            <div class="text-center">
                                <{if $file.image|default:false}>
                                    <img class="card-img-top center wgf-preview-card-<{$file.category|default:0}>" src="<{$file.image_url}>" alt="<{$file.name}>">
                                <{else}>
                                    <img class="card-img-top center wgf-preview-card-<{$file.category|default:0}>" src="<{$file.icon_url}>" alt="<{$file.name}>">
                                <{/if}>
                            </div>
                        <{/if}>
                        <div class="card-body">
                            <{if $wgfindexstyle|default:'' == 'CARD'}><h6 class="card-title"><{else}><h5 class="card-title"><{/if}>
                                <{$file.name}>
                            <{if $wgfindexstyle|default:'' == 'CARDBIG'}></h5><{else}></h6><{/if}>
                            <{if $file.description_short|default:''}>
                                <p class="card-text wgf-fileinfo"><{$file.description_short}></p>
                            <{/if}>
                        </div>
                        <{if $wgfindexstyle|default:'' == 'CARDBIG'}>
                            <div class="card-body">
                                <p class="">
                                    <{$smarty.const._MA_WGFILEMANAGER_FILE_SIZE}>: <{$file.size_text}><br>
                                    <{$smarty.const._MA_WGFILEMANAGER_FILE_CTIME}>: <{$file.ctime_text}><br>
                                    <{$smarty.const._MA_WGFILEMANAGER_FILE_SUBMITTER}>: <{$file.submitter_text}>
                                </p>
                            </div>
                        <{/if}>
                        <div class="card-footer center wgf-fileaction text-center">
                            <{include file='db:wgfilemanager_index_actions_file.tpl' }>
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