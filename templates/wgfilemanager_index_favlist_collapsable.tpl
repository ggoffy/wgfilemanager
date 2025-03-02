<{if $countFavlist|default:0 > 0}>
    <div class="collapse show wgf-dirlist" id="collapseLevel0Fav" aria-labelledby="headingZero" data-bs-parent="#sidenavAccordionFav">
        <div class="sb-sidenav-menu-nested nav">
            <div class="wgf-div-link">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseLevel1Fav" data-bs-toggle="collapse" data-bs-target="#collapseLevel1Fav" aria-expanded="false" aria-controls="collapseLevel1Fav">
                    <{$smarty.const._MA_WGFILEMANAGER_FAVORITE}><span class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down wgf-i"></i></span></a>
            </div>
            <div class="collapse" id="collapseLevel1Fav" aria-labelledby="headingone" data-bs-parent="#collapseLevel0Fav">
                <div class="sb-sidenav-menu-nested nav">
                    <{foreach item=favdir from=$fav_list.dirs name=favdir}>
                        <div class="wgf-div-link----">
                            <a style="display:inline-block;text-align:left;padding-top:0;padding-bottom:0;" class="nav-link" href="<{$wgfilemanager_url}>/file.php?op=show&dir_id=<{$favdir.directory_id}>" title="<{$favdir.name}>">
                                <{if $favdir.icon|default:false}><div class="sb-nav-link-icon"><{$favdir.icon}></div><{/if}>
                                <{$favdir.name}></a>
                            <a style="display:inline-block" class='nav-link pull-right' href='<{$wgfilemanager_url}>/directory.php?op=favorite_pin&amp;id=<{$favdir.id}>&amp;parent_id=<{$favdir.parent_id}>' title='<{$smarty.const._MA_WGFILEMANAGER_FAVORITE_UNPIN}>'><i class="bi-pin wgf-pin"></i></a>
                        </div>
                    <{/foreach}>
                    <{foreach item=favfile from=$fav_list.files name=favfile}>
                        <div class="wgf-div-link----">
                            <a style="display:inline-block;text-align:left;padding-top:0;padding-bottom:0;" class="nav-link" href="<{$wgfilemanager_url}>/file.php?op=show&file_id=<{$favfile.id}>&dir_id=<{$favfile.directory_id}>" title="<{$favfile.name}>">
                                <{if $favfile.icon|default:false}><div class="sb-nav-link-icon"><{$favfile.icon}></div><{/if}>
                                <{$favfile.name}>
                            </a>
                            <a style="display:inline-block" class='nav-link pull-right' href='<{$wgfilemanager_url}>/file.php?op=favorite_unpin&amp;file_id=<{$favfile.id}>' title='<{$smarty.const._MA_WGFILEMANAGER_FAVORITE_UNPIN}>'><i class="bi-pin wgf-pin"></i></a>
                        </div>
                    <{/foreach}>
                </div>
            </div>
        </div>
    </div>
<{/if}>