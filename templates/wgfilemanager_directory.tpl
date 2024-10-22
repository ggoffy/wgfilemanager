<{include file='db:wgfilemanager_header.tpl' }>

<{if $error|default:''}>
    <div class="wgf-error"><{$error|default:false}></div>
    <div class="clear"></div>
<{/if}>

<{if $directoryCount|default:0 > 0}>
    <{include file='db:wgfilemanager_directory_default_table.tpl'}>
<{/if}>
<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>


<{include file='db:wgfilemanager_footer.tpl' }>
