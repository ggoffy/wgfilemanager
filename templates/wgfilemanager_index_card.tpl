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
                    <!-- Start new link loop -->
                    <{foreach item=file from=$file_list|default:false name=file}>
                        <div class="card" style="width: 12rem;">
                            <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
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