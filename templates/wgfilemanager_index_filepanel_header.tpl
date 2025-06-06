            <div class="col-6 col-xs-6 col-sm-6 wgf-folderaction left">
                <{if $permUploadFileToDir|default:false}>
                    <a class="btn btn-outline-primary" href='file.php?op=new&amp;dir_id=<{$dirId|default:0}>' title='<{$smarty.const._MA_WGFILEMANAGER_FILE_UPLOAD}>'><img src="<{$wgfilemanager_icon_bi_url}>upload.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_FILE_UPLOAD}>" ></a>
                <{/if}>
                <{if $permCreateDir|default:false}>
                    <a class="btn btn-outline-primary" href='directory.php?op=new&amp;parent_id=<{$dirId|default:0}>' title='<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_ADD}>'><img src="<{$wgfilemanager_icon_bi_url}>folder-plus.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_DIRECTORY_ADD}>" ></a>
                <{/if}>
            </div>
            <div class="col-6 col-xs-6 col-sm-6 wgf-folderaction text-end">
                <div class="btn-group btn-group-sm text-end" role="group" aria-label="group_style">
                    <a class="btn btn-sm btn-outline-primary <{if $wgfindexstyle == $styledefault}>disabled<{/if}>" href='index.php?op=setstyle&amp;style=<{$styledefault}><{$params|default:''}>' title='<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLELIST}>'><img src="<{$wgfilemanager_icon_bi_url}>list-ul.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLELIST}>" ></a>
                    <a class="btn btn-sm btn-outline-primary <{if $wgfindexstyle == $stylegrouped}>disabled<{/if}>" href='index.php?op=setstyle&amp;style=<{$stylegrouped}><{$params|default:''}>' title='<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLEGROUPED}>'><img src="<{$wgfilemanager_icon_bi_url}>list-columns.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLEGROUPED}>" ></a>
                    <a class="btn btn-sm btn-outline-primary <{if $wgfindexstyle == $stylecard}>disabled<{/if}>" href='index.php?op=setstyle&amp;style=<{$stylecard}><{$params|default:''}>' title='<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLECARD}>'><img src="<{$wgfilemanager_icon_bi_url}>grid-3x3-gap.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLECARD}>" ></a>
                    <a class="btn btn-sm btn-outline-primary <{if $wgfindexstyle == $stylecardbig}>disabled<{/if}>" href='index.php?op=setstyle&amp;style=<{$stylecardbig}><{$params|default:''}>' title='<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLECARDBIG}>'><img src="<{$wgfilemanager_icon_bi_url}>grid.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_INDEX_STYLECARDBIG}>" ></a>
                </div>
                <div class="btn-group btn-group-sm text-end" role="group" aria-label="group_view">
                    <a class="btn btn-sm btn-outline-primary <{if $wgfindexpreview|default:false == 1}>disabled<{/if}>" href='index.php?op=setpreview&amp;preview=<{$previewshow}><{$params|default:''}>' class="space-before <{if $wgfindexpreview|default:false}>disabled wgf-active<{/if}>" title='<{$smarty.const._MA_WGFILEMANAGER_INDEX_PREVIEW}>'><img src="<{$wgfilemanager_icon_bi_url}>eye.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_INDEX_PREVIEW}>" ></a>
                    <a class="btn btn-sm btn-outline-primary <{if $wgfindexpreview|default:false == 0}>disabled<{/if}>" href='index.php?op=setpreview>&amp;preview=<{$previewhide}><{$params|default:''}>' class="<{if !$wgfindexpreview|default:false}>disabled wgf-active<{/if}>" title='<{$smarty.const._MA_WGFILEMANAGER_INDEX_NOPREVIEW}>'><img src="<{$wgfilemanager_icon_bi_url}>eye-slash.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_INDEX_NOPREVIEW}>" ></a>
                </div>
                <div class="btn-group btn-group-sm text-end" role="group" aria-label="group_sort">
                    <div class="dropdown">
                        <a class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<{$wgfilemanager_icon_bi_url}>sort-up-alt.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_INDEX_SORTLIST}>" ><img src="<{$wgfilemanager_icon_bi_url}>sort-down.svg" alt="<{$smarty.const._MA_WGFILEMANAGER_INDEX_SORTLIST}>" >
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a title="<{$smarty.const._ASCENDING}> {$smarty.const._MA_WGFILEMANAGER_NAME}>" class="dropdown-item <{if $wgfindexsort == $sortnameasc}>disabled<{/if}>" href='index.php?op=setsort&amp;sort=<{$sortnameasc}><{$params|default:''}>'><img src="<{$wgfilemanager_icon_bi_url}>sort-alpha-up.svg" alt="<{$smarty.const._ASCENDING}>" ><{$smarty.const._ASCENDING}> <{$smarty.const._MA_WGFILEMANAGER_NAME}></a></li>
                            <li><a title="<{$smarty.const._DESCENDING}> {$smarty.const._MA_WGFILEMANAGER_NAME}>" class="dropdown-item <{if $wgfindexsort == $sortnamedesc}>disabled<{/if}>" href='index.php?op=setsort&amp;sort=<{$sortnamedesc}><{$params|default:''}>'><img src="<{$wgfilemanager_icon_bi_url}>sort-alpha-down-alt.svg" alt="<{$smarty.const._DESCENDING}>" ><{$smarty.const._DESCENDING}> <{$smarty.const._MA_WGFILEMANAGER_NAME}></a></li>
                            <li><a title="<{$smarty.const._ASCENDING}> {$smarty.const._MA_WGFILEMANAGER_CTIME}>" class="dropdown-item <{if $wgfindexsort == $sortctimeasc}>disabled<{/if}>" href='index.php?op=setsort&amp;sort=<{$sortctimeasc}><{$params|default:''}>'><img src="<{$wgfilemanager_icon_bi_url}>sort-up-alt.svg" alt="<{$smarty.const._ASCENDING}>" ><{$smarty.const._ASCENDING}> <{$smarty.const._MA_WGFILEMANAGER_CTIME}></a></li>
                            <li><a title="<{$smarty.const._DESCENDING}> {$smarty.const._MA_WGFILEMANAGER_CTIME}>" class="dropdown-item <{if $wgfindexsort == $sortctimedesc}>disabled<{/if}>" href='index.php?op=setsort&amp;sort=<{$sortctimedesc}><{$params|default:''}>'><img src="<{$wgfilemanager_icon_bi_url}>sort-down-alt.svg" alt="<{$smarty.const._DESCENDING}>" ><{$smarty.const._DESCENDING}> <{$smarty.const._MA_WGFILEMANAGER_CTIME}></a></li>
                            <li><a title="<{$smarty.const._ASCENDING}> {$smarty.const._MA_WGFILEMANAGER_DATE_CREATE}>" class="dropdown-item <{if $wgfindexsort == $sortdatecreateasc}>disabled<{/if}>" href='index.php?op=setsort&amp;sort=<{$sortdatecreateasc}><{$params|default:''}>'><img src="<{$wgfilemanager_icon_bi_url}>sort-up-alt.svg" alt="<{$smarty.const._ASCENDING}>" ><{$smarty.const._ASCENDING}> <{$smarty.const._MA_WGFILEMANAGER_DATE_CREATE}></a></li>
                            <li><a title="<{$smarty.const._DESCENDING}> {$smarty.const._MA_WGFILEMANAGER_DATE_CREATE}>" class="dropdown-item <{if $wgfindexsort == $sortdatecreatedesc}>disabled<{/if}>" href='index.php?op=setsort&amp;sort=<{$sortdatecreatedesc}><{$params|default:''}>'><img src="<{$wgfilemanager_icon_bi_url}>sort-down.svg" alt="<{$smarty.const._DESCENDING}>" ><{$smarty.const._DESCENDING}> <{$smarty.const._MA_WGFILEMANAGER_DATE_CREATE}></a></li>

                        </ul>
                    </div>
                </div>
            </div>


