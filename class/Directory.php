<?php

declare(strict_types=1);


namespace XoopsModules\Wgfilemanager;

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

use XoopsModules\Wgfilemanager;

\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Directory
 */
class Directory extends \XoopsObject
{
    /**
     * @var int
     */
    public $start = 0;

    /**
     * @var int
     */
    public $limit = 0;

    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        $this->initVar('id', \XOBJ_DTYPE_INT);
        $this->initVar('parent_id', \XOBJ_DTYPE_INT);
        $this->initVar('name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('description', \XOBJ_DTYPE_OTHER);
        $this->initVar('fullpath', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('weight', \XOBJ_DTYPE_INT);
        $this->initVar('date_created', \XOBJ_DTYPE_INT);
        $this->initVar('submitter', \XOBJ_DTYPE_INT);
    }

    /**
     * @static function &getInstance
     *
     * @param null
     */
    public static function getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
    }

    /**
     * The new inserted $Id
     * @return inserted id
     */
    public function getNewInsertedId()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
        return $newInsertedId;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getForm($action = false)
    {
        $helper = \XoopsModules\Wgfilemanager\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $isAdmin = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid()) : false;
        // Title
        $title = $this->isNew() ? \_MA_WGFILEMANAGER_DIRECTORY_ADD : \_MA_WGFILEMANAGER_DIRECTORY_EDIT;
        // handler
        $directoryHandler = $helper->getHandler('Directory');
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Table directory
        if ($this->getVar('id') > 1 || $this->isNew()) {
            $dirParentid = $this->getVar('parent_id');
            $dirParent_idSelect = new \XoopsFormSelect(\_MA_WGFILEMANAGER_DIRECTORY_PARENT_ID, 'parent_id', $dirParentid);
            $dirListSelect = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($directoryHandler->getDirListFormSelect(0)));
            foreach ($dirListSelect as $key => $value) {
                $dirParent_idSelect->addOption($key, $value);
            }
            $form->addElement($dirParent_idSelect);
            $form->addElement(new \XoopsFormHidden('parent_id_old', $dirParentid));
        } else {
            $form->addElement(new \XoopsFormHidden('parent_id', 0));
            $form->addElement(new \XoopsFormHidden('parent_id_old', 0));
        }
        // Form Text dirName
        $dirName = $this->getVar('name');
        $form->addElement(new \XoopsFormText(\_MA_WGFILEMANAGER_DIRECTORY_NAME, 'name', 50, 255, $dirName), true);
        $form->addElement(new \XoopsFormHidden('name_old', $dirName));
        // Form Editor DhtmlTextArea dirDescription
        $dirDescription = $this->getVar('description', 'e');
        $editorConfigs = [];
        if ($isAdmin) {
            $editor = $helper->getConfig('editor_admin');
        } else {
            $editor = $helper->getConfig('editor_user');
        }
        $editorConfigs['name'] = 'description';
        $editorConfigs['value'] = $dirDescription;
        $editorConfigs['rows'] = 5;
        $editorConfigs['cols'] = 40;
        $editorConfigs['width'] = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $editor;
        $form->addElement(new \XoopsFormEditor(\_MA_WGFILEMANAGER_DIRECTORY_DESCRIPTION, 'description', $editorConfigs));
        // Form Text dirFullpath
        $dirFullpath = $this->getVar('fullpath');
        if ($isAdmin) {
            $tbFullpath = new \XoopsFormText(\_MA_WGFILEMANAGER_DIRECTORY_FULLPATH, 'fullpath', 50, 255, $dirFullpath);
            $tbFullpath->setDescription(sprintf(\_MA_WGFILEMANAGER_DIRECTORY_FULLPATH_DESCR, WGFILEMANAGER_UPLOAD_PATH));
            $form->addElement($tbFullpath);
            $form->addElement(new \XoopsFormHidden('fullpath', $dirFullpath));
            $form->addElement(new \XoopsFormHidden('fullpath_old', $dirFullpath));
        } else {
            $form->addElement(new \XoopsFormHidden('fullpath', $dirFullpath));
            $form->addElement(new \XoopsFormHidden('fullpath_old', $dirFullpath));
        }
        // Form Text dirWeight
        $dirWeight = $this->isNew() ? $directoryHandler->getCount() + 1 : $this->getVar('weight');
        if ($isAdmin) {
            $form->addElement(new \XoopsFormText(\_MA_WGFILEMANAGER_DIRECTORY_WEIGHT, 'weight', 50, 255, $dirWeight), true);
        } else {
            $form->addElement(new \XoopsFormHidden('weight', $dirWeight));
        }
        // Form Text Date Select dirDate_created
        $dirDate_created = $this->isNew() ? \time() : $this->getVar('date_created');
        $form->addElement(new \XoopsFormTextDateSelect(\_MA_WGFILEMANAGER_DIRECTORY_DATE_CREATED, 'date_created', '', $dirDate_created));
        // Form Select User dirSubmitter
        $uidCurrent = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->uid() : 0;
        $dirSubmitter = $this->isNew() ? $uidCurrent : $this->getVar('submitter');
        $form->addElement(new \XoopsFormSelectUser(\_MA_WGFILEMANAGER_DIRECTORY_SUBMITTER, 'submitter', false, $dirSubmitter));
        // Permissions
        if ('folder' === $helper->getConfig('permission_type')) {
            $memberHandler = \xoops_getHandler('member');
            $groupList = $memberHandler->getGroupList();
            $grouppermHandler = \xoops_getHandler('groupperm');
            $fullList[] = \array_keys($groupList);
            if ($this->isNew()) {
                $groupsCanApproveCheckbox = new \XoopsFormCheckBox(\_MA_WGFILEMANAGER_PERMISSIONS_APPROVE, 'groups_approve_directory[]', $fullList);
                $groupsCanSubmitCheckbox = new \XoopsFormCheckBox(\_MA_WGFILEMANAGER_PERMISSIONS_SUBMIT, 'groups_submit_directory[]', $fullList);
                $groupsCanViewCheckbox = new \XoopsFormCheckBox(\_MA_WGFILEMANAGER_PERMISSIONS_VIEW, 'groups_view_directory[]', $fullList);
            } else {
                $groupsIdsApprove = $grouppermHandler->getGroupIds('wgfilemanager_approve_directory', $this->getVar('id'), $GLOBALS['xoopsModule']->getVar('mid'));
                $groupsIdsApprove[] = \array_values($groupsIdsApprove);
                $groupsCanApproveCheckbox = new \XoopsFormCheckBox(\_MA_WGFILEMANAGER_PERMISSIONS_APPROVE, 'groups_approve_directory[]', $groupsIdsApprove);
                $groupsIdsSubmit = $grouppermHandler->getGroupIds('wgfilemanager_submit_directory', $this->getVar('id'), $GLOBALS['xoopsModule']->getVar('mid'));
                $groupsIdsSubmit[] = \array_values($groupsIdsSubmit);
                $groupsCanSubmitCheckbox = new \XoopsFormCheckBox(\_MA_WGFILEMANAGER_PERMISSIONS_SUBMIT, 'groups_submit_directory[]', $groupsIdsSubmit);
                $groupsIdsView = $grouppermHandler->getGroupIds('wgfilemanager_view_directory', $this->getVar('id'), $GLOBALS['xoopsModule']->getVar('mid'));
                $groupsIdsView[] = \array_values($groupsIdsView);
                $groupsCanViewCheckbox = new \XoopsFormCheckBox(\_MA_WGFILEMANAGER_PERMISSIONS_VIEW, 'groups_view_directory[]', $groupsIdsView);
            }
            // To Approve
            $groupsCanApproveCheckbox->addOptionArray($groupList);
            $form->addElement($groupsCanApproveCheckbox);
            // To Submit
            $groupsCanSubmitCheckbox->addOptionArray($groupList);
            $form->addElement($groupsCanSubmitCheckbox);
            // To View
            $groupsCanViewCheckbox->addOptionArray($groupList);
            $form->addElement($groupsCanViewCheckbox);
        }
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));
        $form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));
        return $form;
    }

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
    public function getValuesDir($keys = null, $format = null, $maxDepth = null)
    {
        $helper  = \XoopsModules\Wgfilemanager\Helper::getInstance();
        $utility = new \XoopsModules\Wgfilemanager\Utility();
        $ret = $this->getValues($keys, $format, $maxDepth);
        $editorMaxchar = $helper->getConfig('editor_maxchar');
        $directoryHandler = $helper->getHandler('Directory');
        $directoryObj = $directoryHandler->get($this->getVar('parent_id'));
        if (\is_object($directoryObj)) {
            $ret['parent_text'] = $directoryObj->getVar('name');
        } else {
            $ret['parent_text'] = 'error get parent name';
        }
        $ret['count_subdirs']     = $directoryHandler->countSubDirs($this->getVar('id'));
        $ret['count_files']       = $directoryHandler->countFiles($this->getVar('fullpath'));
        $ret['description_text']  = $this->getVar('description', 'e');
        $ret['description_short'] = $utility::truncateHtml($ret['description'], $editorMaxchar);
        $ret['date_created_text'] = \formatTimestamp($this->getVar('date_created'), 's');
        $ret['submitter_text']    = \XoopsUser::getUnameFromId($this->getVar('submitter'));
        return $ret;
    }
}
