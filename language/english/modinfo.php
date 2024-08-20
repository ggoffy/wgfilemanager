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

require_once __DIR__ . '/common.php';

// ---------------- Admin Main ----------------
\define('_MI_WGFILEMANAGER_NAME', 'wgFileManager');
\define('_MI_WGFILEMANAGER_DESC', 'This module is storing files in directories');
// ---------------- Admin Menu ----------------
\define('_MI_WGFILEMANAGER_ADMENU1', 'Dashboard');
\define('_MI_WGFILEMANAGER_ADMENU2', 'Directory');
\define('_MI_WGFILEMANAGER_ADMENU3', 'File');
\define('_MI_WGFILEMANAGER_ADMENU4', 'Broken items');
\define('_MI_WGFILEMANAGER_ADMENU5', 'Mime Types');
\define('_MI_WGFILEMANAGER_ADMENU6', 'Permissions');
\define('_MI_WGFILEMANAGER_ADMENU7', 'Clone');
\define('_MI_WGFILEMANAGER_ADMENU8', 'Feedback');
\define('_MI_WGFILEMANAGER_ABOUT', 'About');
// ---------------- Admin Nav ----------------
\define('_MI_WGFILEMANAGER_ADMIN_PAGER', 'Admin pager');
\define('_MI_WGFILEMANAGER_ADMIN_PAGER_DESC', 'Admin per page list');
// User
\define('_MI_WGFILEMANAGER_USER_PAGER', 'User pager');
\define('_MI_WGFILEMANAGER_USER_PAGER_DESC', 'User per page list');
// Submenu
\define('_MI_WGFILEMANAGER_SMNAME1', 'Index page');
\define('_MI_WGFILEMANAGER_SMNAME2', 'Directory');
\define('_MI_WGFILEMANAGER_SMNAME3', 'Submit File');
//\define('_MI_WGFILEMANAGER_SMNAME6', 'Search');
// Blocks
\define('_MI_WGFILEMANAGER_DIRECTORY_BLOCK_LAST', 'Block last directories');
\define('_MI_WGFILEMANAGER_DIRECTORY_BLOCK_LAST_DESC', 'Block last directories description');
\define('_MI_WGFILEMANAGER_DIRECTORY_BLOCK_NEW', 'Block new directories');
\define('_MI_WGFILEMANAGER_DIRECTORY_BLOCK_NEW_DESC', 'Block new directories');
\define('_MI_WGFILEMANAGER_FILE_BLOCK_LAST', 'Block last files');
\define('_MI_WGFILEMANAGER_FILE_BLOCK_LAST_DESC', 'Block last files description');
\define('_MI_WGFILEMANAGER_FILE_BLOCK_NEW', 'Block new files');
\define('_MI_WGFILEMANAGER_FILE_BLOCK_NEW_DESC', 'Block new files description');
// Config
\define('_MI_WGFILEMANAGER_EDITOR_ADMIN', 'Editor admin');
\define('_MI_WGFILEMANAGER_EDITOR_ADMIN_DESC', 'Select the editor which should be used in admin area for text area fields');
\define('_MI_WGFILEMANAGER_EDITOR_USER', 'Editor user');
\define('_MI_WGFILEMANAGER_EDITOR_USER_DESC', 'Select the editor which should be used in user area for text area fields');
\define('_MI_WGFILEMANAGER_EDITOR_MAXCHAR', 'Text max characters');
\define('_MI_WGFILEMANAGER_EDITOR_MAXCHAR_DESC', 'Max characters for showing text of a textarea or editor field in admin area');
\define('_MI_WGFILEMANAGER_KEYWORDS', 'Keywords');
\define('_MI_WGFILEMANAGER_KEYWORDS_DESC', 'Insert here the keywords (separate by comma)');
\define('_MI_WGFILEMANAGER_MDESC', 'Module description');
\define('_MI_WGFILEMANAGER_MDESC_DESC', 'Insert here module description which should be shown in meta data description');
\define('_MI_WGFILEMANAGER_MDESC_DEFAULT', 'XOOPS file manager');
\define('_MI_WGFILEMANAGER_INDEX_PERMISSION_TYPE', 'Permission type');
\define('_MI_WGFILEMANAGER_INDEX_PERMISSION_TYPE_DESC', 'Define the type of permission handling');
\define('_MI_WGFILEMANAGER_INDEX_PERMISSION_TYPE_GLOBAL', 'Use global permissions');
\define('_MI_WGFILEMANAGER_INDEX_PERMISSION_TYPE_DIR', 'Use permissions for each directory');
\define('_MI_WGFILEMANAGER_SIZE_MB', 'MB');
\define('_MI_WGFILEMANAGER_MAXSIZE_FILE', 'Max size file');
\define('_MI_WGFILEMANAGER_MAXSIZE_FILE_DESC', 'Define the max size for uploading files');
\define('_MI_WGFILEMANAGER_FILE_HANDLENAME', 'How to handle file names');
\define('_MI_WGFILEMANAGER_FILE_HANDLENAME_DESC', 'Define which file name should be used');
\define('_MI_WGFILEMANAGER_FILE_HANDLENAME_ORIGINAL', 'Use original file name');
\define('_MI_WGFILEMANAGER_FILE_HANDLENAME_UNIQUE', 'Create unique name based on original file name');
\define('_MI_WGFILEMANAGER_MIMETYPES_FILE', 'Mime types file');
\define('_MI_WGFILEMANAGER_MIMETYPES_FILE_DESC', 'Define the allowed mime types for uploading files');
\define('_MI_WGFILEMANAGER_ICONSET', 'Icon Set');
\define('_MI_WGFILEMANAGER_ICONSET_DESC', 'Define which icon set you want use');
\define('_MI_WGFILEMANAGER_ICONSET_NONE', 'Do not use an icon set');
\define('_MI_WGFILEMANAGER_INDEX_DIRPOSITION', 'Position Directory List');
\define('_MI_WGFILEMANAGER_INDEX_DIRPOSITION_DESC', 'Select the position of the directory list on index page');
\define('_MI_WGFILEMANAGER_INDEX_DIRPOSITION_LEFT', 'Left side');
\define('_MI_WGFILEMANAGER_INDEX_DIRPOSITION_TOP', 'On top');
\define('_MI_WGFILEMANAGER_DIRECTORYSTYLE', 'List Style Directory Page');
\define('_MI_WGFILEMANAGER_DIRECTORYSTYLE_DESC', 'Select list style on directory page');
\define('_MI_WGFILEMANAGER_TABLE_TYPE', 'Table Type');
\define('_MI_WGFILEMANAGER_TABLE_TYPE_DESC', 'Table Type is the bootstrap html table');
\define('_MI_WGFILEMANAGER_PANEL_TYPE', 'Panel Type');
\define('_MI_WGFILEMANAGER_PANEL_TYPE_DESC', 'Panel Type is the bootstrap html div');
\define('_MI_WGFILEMANAGER_USE_BROKEN', 'Use Feature BROKEN');
\define('_MI_WGFILEMANAGER_USE_BROKEN_DESC', 'Decide whether you want to use festure BROKEN. Users can notify admins about broken file links.');
\define('_MI_WGFILEMANAGER_SHOW_BREADCRUMBS', 'Show breadcrumb navigation');
\define('_MI_WGFILEMANAGER_SHOW_BREADCRUMBS_DESC', 'Show breadcrumb navigation which displays the current page in context within the site structure');
\define('_MI_WGFILEMANAGER_MAINTAINEDBY', 'Maintained By');
\define('_MI_WGFILEMANAGER_MAINTAINEDBY_DESC', 'Allow url of support site or community');
\define('_MI_WGFILEMANAGER_BOOKMARKS', 'Social Bookmarks');
\define('_MI_WGFILEMANAGER_BOOKMARKS_DESC', 'Show Social Bookmarks in the single page');
// Permissions Groups
\define('_MI_WGFILEMANAGER_GROUPS', 'Groups access');
\define('_MI_WGFILEMANAGER_GROUPS_DESC', 'Select general access permission for groups.');
\define('_MI_WGFILEMANAGER_ADMIN_GROUPS', 'Admin Group Permissions');
\define('_MI_WGFILEMANAGER_ADMIN_GROUPS_DESC', 'Which groups have access to tools and permissions page');
\define('_MI_WGFILEMANAGER_UPLOAD_GROUPS', 'Upload Group Permissions');
\define('_MI_WGFILEMANAGER_UPLOAD_GROUPS_DESC', 'Which groups have permissions to upload files');
// ---------------- End ----------------
