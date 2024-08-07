<div class="row panel panel-<{$panel_type|default:'none'}>">
    <div class="col-sm-3 wgf-filepanel-left">
        <{include file='db:wgfilemanager_index_default_dirlist.tpl' directory=$dir_list}>
    </div>
    <div class="col-sm-9 wgf-filepanel-right">
        <div class="row wgf-filepanel-right-header">
            <div class="col-6 col-xs-6 col-sm-6 wgf-folderaction left">
                <a href='index.php?op=setstyle&amp;style=<{$styledefault|default:'none'}><{$params|default:''}>' title='<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLELIST}>'><img src="<{$wgfilemanager_icon_bi_url}>list-ul.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLELIST}>" ></a>
                <a href='index.php?op=setstyle&amp;style=<{$stylegrouped|default:'none'}><{$params|default:''}>' title='<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLEGROUPED}>'><img src="<{$wgfilemanager_icon_bi_url}>list-columns.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLEGROUPED}>" ></a>
                <a href='index.php?op=setstyle&amp;style=<{$stylecard|default:'none'}><{$params|default:''}>' title='<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLECARD}>'><img src="<{$wgfilemanager_icon_bi_url}>grid.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLECARD}>" ></a>
            </div>
            <div class="col-6 col-xs-6 col-sm-6 wgf-folderaction right">
                <{if $permUpload|default:false}>
                    <a href='file.php?op=new&amp;dir_id=<{$dirId|default:0}>' title='<{$smarty.const._MA_WGFILEMANAGER_FILE_UPLOAD}>'><img src="<{$wgfilemanager_icon_bi_url}>upload.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_FILE_UPLOAD}>" ></a>
                <{/if}>
            </div>
        </div>
        <div class="row wgf-filepanel-right-body">
            <div class="col-12 col-xs-12 col-sm-12">
                <{if $file_list|default:false}>
                    <table class='table table-<{$table_type|default:'none'}>'>
                        <tr>
                            <th class='left'><{$smarty.const._MA_WGFILEMANAGER_FILE_NAME}></th>
                            <th class='right'><{$smarty.const._MA_WGFILEMANAGER_ACTION}></th>
                        </tr>
                        <!-- Start new link loop -->
                        <{foreach item=file from=$file_list|default:false name=file}>
                            <tr>
                                <td class=''>
                                    <{$file.name}>
                                    <{if $file.description_short|default:''}>
                                        <p class="wgf-fileinfo"><{$file.description_short}></p>
                                    <{/if}>
                                    <p class="wgf-fileinfo">
                                        <{$smarty.const._MA_WGFILEMANAGER_FILE_SIZE}>: <{$file.size_text}><br>
                                        <{$smarty.const._MA_WGFILEMANAGER_FILE_CTIME}>: <{$file.ctime_text}><br>
                                        <{$smarty.const._MA_WGFILEMANAGER_FILE_SUBMITTER}>: <{$file.submitter_text}>
                                    </p>
                                </td>
                                <td class='right wgf-fileaction'>
                                    <{if $permDownload|default:false}>
                                        <a href='download.php?op=download&amp;file_id=<{$file.id|default:0}>' title='<{$smarty.const._MA_WGFILEMANAGER_FILE_DOWNLOAD}>'><img src="<{$wgfilemanager_icon_bi_url}>download.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_FILE_DOWNLOAD}>" ></a>
                                    <{/if}>
                                    <{if $permEdit|default:false}>
                                        <a href='file.php?op=edit&amp;id=<{$file.id|default:false}><{$params|default:''}>' title='<{$smarty.const._EDIT}>'><img src="<{$wgfilemanager_icon_bi_url}>pencil-square.svg" alt="<{$smarty.const._EDIT}>" ></a>
                                        <a href='file.php?op=delete&amp;id=<{$file.id|default:false}><{$params|default:''}>' title='<{$smarty.const._DELETE}>'><img src="<{$wgfilemanager_icon_bi_url}>trash.svg" alt="<{$smarty.const._DELETE}>" ></a>
                                    <{/if}>
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
    </div>
</div>
<div class="clear"></div>
