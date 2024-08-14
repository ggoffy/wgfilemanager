<?php

declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgFileManager module for xoops
 *
 * @copyright    2021 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      wgfilemanager
 * @author       Goffy - Wedega - Email:webmaster@wedega.com - Website:https://xoops.wedega.com
 */

use XoopsModules\Wgfilemanager\Constants;

// 
$moduleDirName      = \basename(__DIR__);
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

include \XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/preloads/autoloader.php';

// ------------------- Informations ------------------- //
$modversion = [
    'name'                => \_MI_WGFILEMANAGER_NAME,
    'version'             => '1.0.0',
    'description'         => \_MI_WGFILEMANAGER_DESC,
    'author'              => 'Goffy - Wedega',
    'author_mail'         => 'webmaster@wedega.com',
    'author_website_url'  => 'https://xoops.wedega.com',
    'author_website_name' => 'XOOPS Project on Wedega',
    'credits'             => 'Goffy, XOOPS Development Team',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'https://www.gnu.org/licenses/gpl-3.0.en.html',
    'help'                => 'page=help',
    'release_info'        => 'release_info',
    'release_file'        => \XOOPS_URL . '/modules/wgfilemanager/docs/release_info file',
    'release_date'        => '2024/06/29',
    'manual'              => 'link to manual file',
    'manual_file'         => \XOOPS_URL . '/modules/wgfilemanager/docs/install.txt',
    'min_php'             => '8.0',
    'min_xoops'           => '2.5.11',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.6', 'mysqli' => '5.6'],
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => \basename(__DIR__),
    'dirmoduleadmin'      => 'Frameworks/moduleclasses/moduleadmin',
    'sysicons16'          => '../../Frameworks/moduleclasses/icons/16',
    'sysicons32'          => '../../Frameworks/moduleclasses/icons/32',
    'modicons16'          => 'assets/icons/16',
    'modicons32'          => 'assets/icons/32',
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    'release'             => '05/25/2020',
    'module_status'       => 'Beta 1',
    'system_menu'         => 1,
    'hasAdmin'            => 1,
    'hasMain'             => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    'onInstall'           => 'include/install.php',
    'onUninstall'         => 'include/uninstall.php',
    'onUpdate'            => 'include/update.php',
];
// ------------------- Templates ------------------- //
$modversion['templates'] = [
    // Admin templates
    ['file' => 'wgfilemanager_admin_about.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgfilemanager_admin_header.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgfilemanager_admin_index.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgfilemanager_admin_directory.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgfilemanager_admin_file.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgfilemanager_admin_mimetype.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgfilemanager_admin_broken.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgfilemanager_admin_permissions.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgfilemanager_admin_clone.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wgfilemanager_admin_footer.tpl', 'description' => '', 'type' => 'admin'],
    // User templates
    ['file' => 'wgfilemanager_header.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_index.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_index_default.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_index_grouped.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_index_card.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_index_dirlist_default.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_index_filepanel_header.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_directory.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_directory_default_table.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_directory_default_row.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_directory_default_item.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_directory_sortable.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_directory_sortable_list.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_file.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_file_list.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_file_item.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_breadcrumbs.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_search.tpl', 'description' => ''],
    ['file' => 'wgfilemanager_footer.tpl', 'description' => ''],
];
// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'] = [
    'wgfilemanager_directory',
    'wgfilemanager_file',
    'wgfilemanager_mimetype',
];
// ------------------- Search ------------------- //
$modversion['hasSearch'] = 1;
$modversion['search'] = [
    'file' => 'include/search.inc.php',
    'func' => 'wgfilemanager_search',
];
// ------------------- Menu ------------------- //
$currdirname  = isset($GLOBALS['xoopsModule']) && \is_object($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : 'system';
if ($currdirname == $moduleDirName) {
    $modversion['sub'][] = [
        'name' => \_MI_WGFILEMANAGER_SMNAME1,
        'url'  => 'index.php',
    ];
    // Sub directory
    $modversion['sub'][] = [
        'name' => \_MI_WGFILEMANAGER_SMNAME2,
        'url'  => 'directory.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_WGFILEMANAGER_SMNAME3,
        'url'  => 'file.php?op=new',
    ];
}
// ------------------- Default Blocks ------------------- //
/*
// Directory last
$modversion['blocks'][] = [
    'file'        => 'directory.php',
    'name'        => \_MI_WGFILEMANAGER_DIRECTORY_BLOCK_LAST,
    'description' => \_MI_WGFILEMANAGER_DIRECTORY_BLOCK_LAST_DESC,
    'show_func'   => 'b_wgfilemanager_directory_show',
    'edit_func'   => 'b_wgfilemanager_directory_edit',
    'template'    => 'wgfilemanager_block_directory.tpl',
    'options'     => 'last|5|25|0',
];
// Directory new
$modversion['blocks'][] = [
    'file'        => 'directory.php',
    'name'        => \_MI_WGFILEMANAGER_DIRECTORY_BLOCK_NEW,
    'description' => \_MI_WGFILEMANAGER_DIRECTORY_BLOCK_NEW_DESC,
    'show_func'   => 'b_wgfilemanager_directory_show',
    'edit_func'   => 'b_wgfilemanager_directory_edit',
    'template'    => 'wgfilemanager_block_directory.tpl',
    'options'     => 'new|5|25|0',
];
// Directory hits
$modversion['blocks'][] = [
    'file'        => 'directory.php',
    'name'        => \_MI_WGFILEMANAGER_DIRECTORY_BLOCK_HITS,
    'description' => \_MI_WGFILEMANAGER_DIRECTORY_BLOCK_HITS_DESC,
    'show_func'   => 'b_wgfilemanager_directory_show',
    'edit_func'   => 'b_wgfilemanager_directory_edit',
    'template'    => 'wgfilemanager_block_directory.tpl',
    'options'     => 'hits|5|25|0',
];
// Directory top
$modversion['blocks'][] = [
    'file'        => 'directory.php',
    'name'        => \_MI_WGFILEMANAGER_DIRECTORY_BLOCK_TOP,
    'description' => \_MI_WGFILEMANAGER_DIRECTORY_BLOCK_TOP_DESC,
    'show_func'   => 'b_wgfilemanager_directory_show',
    'edit_func'   => 'b_wgfilemanager_directory_edit',
    'template'    => 'wgfilemanager_block_directory.tpl',
    'options'     => 'top|5|25|0',
];
// Directory random
$modversion['blocks'][] = [
    'file'        => 'directory.php',
    'name'        => \_MI_WGFILEMANAGER_DIRECTORY_BLOCK_RANDOM,
    'description' => \_MI_WGFILEMANAGER_DIRECTORY_BLOCK_RANDOM_DESC,
    'show_func'   => 'b_wgfilemanager_directory_show',
    'edit_func'   => 'b_wgfilemanager_directory_edit',
    'template'    => 'wgfilemanager_block_directory.tpl',
    'options'     => 'random|5|25|0',
];
// File last
$modversion['blocks'][] = [
    'file'        => 'file.php',
    'name'        => \_MI_WGFILEMANAGER_FILE_BLOCK_LAST,
    'description' => \_MI_WGFILEMANAGER_FILE_BLOCK_LAST_DESC,
    'show_func'   => 'b_wgfilemanager_file_show',
    'edit_func'   => 'b_wgfilemanager_file_edit',
    'template'    => 'wgfilemanager_block_file.tpl',
    'options'     => 'last|5|25|0',
];
// File new
$modversion['blocks'][] = [
    'file'        => 'file.php',
    'name'        => \_MI_WGFILEMANAGER_FILE_BLOCK_NEW,
    'description' => \_MI_WGFILEMANAGER_FILE_BLOCK_NEW_DESC,
    'show_func'   => 'b_wgfilemanager_file_show',
    'edit_func'   => 'b_wgfilemanager_file_edit',
    'template'    => 'wgfilemanager_block_file.tpl',
    'options'     => 'new|5|25|0',
];
// File hits
$modversion['blocks'][] = [
    'file'        => 'file.php',
    'name'        => \_MI_WGFILEMANAGER_FILE_BLOCK_HITS,
    'description' => \_MI_WGFILEMANAGER_FILE_BLOCK_HITS_DESC,
    'show_func'   => 'b_wgfilemanager_file_show',
    'edit_func'   => 'b_wgfilemanager_file_edit',
    'template'    => 'wgfilemanager_block_file.tpl',
    'options'     => 'hits|5|25|0',
];
// File top
$modversion['blocks'][] = [
    'file'        => 'file.php',
    'name'        => \_MI_WGFILEMANAGER_FILE_BLOCK_TOP,
    'description' => \_MI_WGFILEMANAGER_FILE_BLOCK_TOP_DESC,
    'show_func'   => 'b_wgfilemanager_file_show',
    'edit_func'   => 'b_wgfilemanager_file_edit',
    'template'    => 'wgfilemanager_block_file.tpl',
    'options'     => 'top|5|25|0',
];
// File random
$modversion['blocks'][] = [
    'file'        => 'file.php',
    'name'        => \_MI_WGFILEMANAGER_FILE_BLOCK_RANDOM,
    'description' => \_MI_WGFILEMANAGER_FILE_BLOCK_RANDOM_DESC,
    'show_func'   => 'b_wgfilemanager_file_show',
    'edit_func'   => 'b_wgfilemanager_file_edit',
    'template'    => 'wgfilemanager_block_file.tpl',
    'options'     => 'random|5|25|0',
];
// ------------------- Spotlight Blocks ------------------- //
// Directory spotlight
$modversion['blocks'][] = [
    'file'        => 'directory_spotlight.php',
    'name'        => \_MI_WGFILEMANAGER_DIRECTORY_BLOCK_SPOTLIGHT,
    'description' => \_MI_WGFILEMANAGER_DIRECTORY_BLOCK_SPOTLIGHT_DESC,
    'show_func'   => 'b_wgfilemanager_directory_spotlight_show',
    'edit_func'   => 'b_wgfilemanager_directory_spotlight_edit',
    'template'    => 'wgfilemanager_block_directory_spotlight.tpl',
    'options'     => 'spotlight|5|25|0',
];
// File spotlight
$modversion['blocks'][] = [
    'file'        => 'file_spotlight.php',
    'name'        => \_MI_WGFILEMANAGER_FILE_BLOCK_SPOTLIGHT,
    'description' => \_MI_WGFILEMANAGER_FILE_BLOCK_SPOTLIGHT_DESC,
    'show_func'   => 'b_wgfilemanager_file_spotlight_show',
    'edit_func'   => 'b_wgfilemanager_file_spotlight_edit',
    'template'    => 'wgfilemanager_block_file_spotlight.tpl',
    'options'     => 'spotlight|5|25|0',
];
*/
// ------------------- Config ------------------- //
// Editor Admin
\xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editor_admin',
    'title'       => '\_MI_WGFILEMANAGER_EDITOR_ADMIN',
    'description' => '\_MI_WGFILEMANAGER_EDITOR_ADMIN_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtml',
    'options'     => array_flip($editorHandler->getList()),
];
// Editor User
\xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editor_user',
    'title'       => '\_MI_WGFILEMANAGER_EDITOR_USER',
    'description' => '\_MI_WGFILEMANAGER_EDITOR_USER_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtml',
    'options'     => array_flip($editorHandler->getList()),
];
// Editor : max characters admin area
$modversion['config'][] = [
    'name'        => 'editor_maxchar',
    'title'       => '\_MI_WGFILEMANAGER_EDITOR_MAXCHAR',
    'description' => '\_MI_WGFILEMANAGER_EDITOR_MAXCHAR_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 50,
];
// Keywords
$modversion['config'][] = [
    'name'        => 'keywords',
    'title'       => '\_MI_WGFILEMANAGER_KEYWORDS',
    'description' => '\_MI_WGFILEMANAGER_KEYWORDS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'wgfilemanager, directory, file',
];
// module description
$modversion['config'][] = [
    'name'        => 'metadescription',
    'title'       => '\_MI_WGFILEMANAGER_MDESC',
    'description' => '\_MI_WGFILEMANAGER_MDESC_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => \_MI_WGFILEMANAGER_MDESC_DEFAULT,
];
// permission type
$modversion['config'][] = [
    'name'        => 'permission_type',
    'title'       => '\_MI_WGFILEMANAGER_INDEX_PERMISSION_TYPE',
    'description' => '\_MI_WGFILEMANAGER_INDEX_PERMISSION_TYPE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'global',
    'options'     => ['_MI_WGFILEMANAGER_INDEX_PERMISSION_TYPE_GLOBAL' => 'global', '_MI_WGFILEMANAGER_INDEX_PERMISSION_TYPE_FOLDER' => 'folder'],
];
// create increment steps for file size
require_once __DIR__ . '/include/xoops_version.inc.php';
$iniPostMaxSize       = wgfilemanagerReturnBytes(\ini_get('post_max_size'));
$iniUploadMaxFileSize = wgfilemanagerReturnBytes(\ini_get('upload_max_filesize'));
$maxSize              = min($iniPostMaxSize, $iniUploadMaxFileSize);
$increment = 1;
if ($maxSize > 10000 * 1048576) {
    $increment = 500;
}
if ($maxSize <= 10000 * 1048576) {
    $increment = 200;
}
if ($maxSize <= 5000 * 1048576) {
    $increment = 100;
}
if ($maxSize <= 2500 * 1048576) {
    $increment = 50;
}
if ($maxSize <= 1000 * 1048576) {
    $increment = 10;
}
if ($maxSize <= 500 * 1048576) {
    $increment = 5;
}
if ($maxSize <= 100 * 1048576) {
    $increment = 2;
}
if ($maxSize <= 50 * 1048576) {
    $increment = 1;
}
if ($maxSize <= 25 * 1048576) {
    $increment = 0.5;
}
$optionMaxsize = [];
$i = $increment;
while ($i * 1048576 <= $maxSize) {
    $optionMaxsize[$i . ' ' . _MI_WGFILEMANAGER_SIZE_MB] = $i * 1048576;
    $i += $increment;
}
// Uploads : maxsize of file
$modversion['config'][] = [
    'name'        => 'maxsize_file',
    'title'       => '\_MI_WGFILEMANAGER_MAXSIZE_FILE',
    'description' => '\_MI_WGFILEMANAGER_MAXSIZE_FILE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 3145728,
    'options'     => $optionMaxsize,
];
// handle file name
$modversion['config'][] = [
    'name'        => 'file_handlename',
    'title'       => '\_MI_WGFILEMANAGER_FILE_HANDLENAME',
    'description' => '\_MI_WGFILEMANAGER_FILE_HANDLENAME_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => Constants::FILE_HANDLENAME_ORIGINAL,
    'options'     => ['\_MI_WGFILEMANAGER_FILE_HANDLENAME_ORIGINAL' => Constants::FILE_HANDLENAME_ORIGINAL, '\_MI_WGFILEMANAGER_FILE_HANDLENAME_UNIQUE' => Constants::FILE_HANDLENAME_UNIQUE],
];
// Admin pager
$modversion['config'][] = [
    'name'        => 'adminpager',
    'title'       => '\_MI_WGFILEMANAGER_ADMIN_PAGER',
    'description' => '\_MI_WGFILEMANAGER_ADMIN_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];
// User pager
$modversion['config'][] = [
    'name'        => 'userpager',
    'title'       => '\_MI_WGFILEMANAGER_USER_PAGER',
    'description' => '\_MI_WGFILEMANAGER_USER_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];
// Icon set
$modversion['config'][] = [
    'name'        => 'iconset',
    'title'       => '\_MI_WGFILEMANAGER_ICONSET',
    'description' => '\_MI_WGFILEMANAGER_ICONSET_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'classic',
    'options'     => ['_MI_WGFILEMANAGER_ICONSET_NONE' => 'none',
        'classic' => 'classic',
        'high-contrast' => 'high-contrast',
        'square-o' => 'square-o',
        'vivid' => 'vivid',
        'teambox' => 'teambox',
        'eagerterrier' => 'eagerterrier'
    ],
];
// position of  directory list on index page
$modversion['config'][] = [
    'name'        => 'indexdirposition',
    'title'       => '\_MI_WGFILEMANAGER_INDEX_DIRPOSITION',
    'description' => '\_MI_WGFILEMANAGER_INDEX_DIRPOSITION_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'left',
    'options'     => ['_MI_WGFILEMANAGER_INDEX_DIRPOSITION_LEFT' => 'left', '_MI_WGFILEMANAGER_INDEX_DIRPOSITION_TOP' => 'top'],
];
// Style on directory page
$modversion['config'][] = [
    'name'        => 'directorystyle',
    'title'       => '\_MI_WGFILEMANAGER_DIRECTORYSTYLE',
    'description' => '\_MI_WGFILEMANAGER_DIRECTORYSTYLE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'default',
    'options'     => ['default' => 'default', 'sortable' => 'sortable'],
];
// Show Breadcrumbs
$modversion['config'][] = [
    'name'        => 'show_breadcrumbs',
    'title'       => '\_MI_WGFILEMANAGER_SHOW_BREADCRUMBS',
    'description' => '\_MI_WGFILEMANAGER_SHOW_BREADCRUMBS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Table type
$modversion['config'][] = [
    'name'        => 'table_type',
    'title'       => '\_MI_WGFILEMANAGER_TABLE_TYPE',
    'description' => '\_MI_WGFILEMANAGER_TABLE_TYPE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'bordered',
    'options'     => ['bordered' => 'bordered', 'striped' => 'striped', 'hover' => 'hover', 'condensed' => 'condensed'],
];
// Panel by
$modversion['config'][] = [
    'name'        => 'panel_type',
    'title'       => '\_MI_WGFILEMANAGER_PANEL_TYPE',
    'description' => '\_MI_WGFILEMANAGER_PANEL_TYPE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'default',
    'options'     => ['default' => 'default', 'primary' => 'primary', 'success' => 'success', 'info' => 'info', 'warning' => 'warning', 'danger' => 'danger'],
];
// Advertise
$modversion['config'][] = [
    'name'        => 'advertise',
    'title'       => '\_MI_WGFILEMANAGER_ADVERTISE',
    'description' => '\_MI_WGFILEMANAGER_ADVERTISE_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => '',
];
// Make Sample button visible?
$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
// Maintained by
$modversion['config'][] = [
    'name'        => 'maintainedby',
    'title'       => '\_MI_WGFILEMANAGER_MAINTAINEDBY',
    'description' => '\_MI_WGFILEMANAGER_MAINTAINEDBY_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'https://xoops.org/modules/newbb',
];
