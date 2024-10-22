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
 * @since        1.0
 * @min_xoops    2.5.9
 * @author       Goffy - Wedega - Email:webmaster@wedega.com - Website:https://xoops.wedega.com
 */

use XoopsModules\Wgfilemanager;

\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Mimetype
 */
class Mimetype extends \XoopsObject
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
     */
    public function __construct()
    {
        $this->initVar('id', \XOBJ_DTYPE_INT);
        $this->initVar('extension', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('mimetype', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('desc', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('admin', \XOBJ_DTYPE_INT);
        $this->initVar('user', \XOBJ_DTYPE_INT);
        $this->initVar('category', \XOBJ_DTYPE_INT);
        $this->initVar('date_created', \XOBJ_DTYPE_INT);
        $this->initVar('submitter', \XOBJ_DTYPE_INT);
    }

    /**
     * @static function &getInstance
     *
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
     * @return integer
     */
    public function getNewInsertedIdMimetype()
    {
        return $GLOBALS['xoopsDB']->getInsertId();
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormMimetype($action = false)
    {
        //$helper = \XoopsModules\Wgfilemanager\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        //$isAdmin = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid()) : false;
        // Title
        $title = $this->isNew() ? \_AM_WGFILEMANAGER_MIMETYPE_ADD : \_AM_WGFILEMANAGER_MIMETYPE_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text mimeExtension
        $form->addElement(new \XoopsFormText(\_AM_WGFILEMANAGER_MIMETYPE_EXTENSION, 'extension', 50, 255, $this->getVar('extension')), true);
        // Form Text mimeMimetype
        $form->addElement(new \XoopsFormText(\_AM_WGFILEMANAGER_MIMETYPE_MIMETYPE, 'mimetype', 50, 255, $this->getVar('mimetype')), true);
        // Form Text mimeDesc
        $form->addElement(new \XoopsFormText(\_AM_WGFILEMANAGER_MIMETYPE_DESC, 'desc', 50, 255, $this->getVar('desc')), true);
        // Form Radio Yes/No mimeAdmin
        $mimeAdmin = $this->isNew() ? 1 : $this->getVar('admin');
        $form->addElement(new \XoopsFormRadioYN(\_AM_WGFILEMANAGER_MIMETYPE_ADMIN, 'admin', $mimeAdmin));
        // Form Radio Yes/No mimeUser
        $mimeUser = $this->isNew() ? 0 : $this->getVar('user');
        $form->addElement(new \XoopsFormRadioYN(\_AM_WGFILEMANAGER_MIMETYPE_USER, 'user', $mimeUser));
        // Form Select mimeCategory
        $mimeCategorySelect = new \XoopsFormSelect(\_AM_WGFILEMANAGER_MIMETYPE_CAT, 'category', $this->getVar('category'));
        $mimeCategorySelect->addOption(Constants::MIMETYPE_CAT_NONE, \_AM_WGFILEMANAGER_MIMETYPE_CAT_NONE);
        $mimeCategorySelect->addOption(Constants::MIMETYPE_CAT_IMAGE, \_AM_WGFILEMANAGER_MIMETYPE_CAT_IMAGE);
        $mimeCategorySelect->addOption(Constants::MIMETYPE_CAT_PDF, \_AM_WGFILEMANAGER_MIMETYPE_CAT_PDF);
        $form->addElement($mimeCategorySelect, true);
        // Form Text Date Select mimeDate_created
        $mimeDate_created = $this->isNew() ? \time() : $this->getVar('date_created');
        $form->addElement(new \XoopsFormTextDateSelect(\_AM_WGFILEMANAGER_MIMETYPE_DATE_CREATED, 'date_created', '', $mimeDate_created));
        // Form Select User mimeSubmitter
        $uidCurrent = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->uid() : 0;
        $mimeSubmitter = $this->isNew() ? $uidCurrent : $this->getVar('submitter');
        $form->addElement(new \XoopsFormSelectUser(\_AM_WGFILEMANAGER_MIMETYPE_SUBMITTER, 'submitter', false, $mimeSubmitter));
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
    public function getValuesMimetype($keys = null, $format = null, $maxDepth = null)
    {
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['admin_text']         = (int)$this->getVar('admin') > 0 ? _YES : _NO;
        $ret['user_text']          = (int)$this->getVar('user') > 0 ? _YES : _NO;
        $ret['category_text']      = $this->getCategoryMimetype((int)$this->getVar('category'));
        $ret['date_created_text']  = \formatTimestamp($this->getVar('date_created'), 's');
        $ret['submitter_text']     = \XoopsUser::getUnameFromId($this->getVar('submitter'));
        return $ret;
    }

    /**
     * Returns the description for mime type Category
     *
     * @return string
     */
    private function getCategoryMimetype($category)
    {
        switch ($category) {
            case Constants::MIMETYPE_CAT_PDF:
                return \_AM_WGFILEMANAGER_MIMETYPE_CAT_PDF;
            case Constants::MIMETYPE_CAT_IMAGE:
                return \_AM_WGFILEMANAGER_MIMETYPE_CAT_IMAGE;
            case 0:
            default:
                return \_AM_WGFILEMANAGER_MIMETYPE_CAT_NONE;
        }
    }
    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayMimetype()
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar($var);
        }
        return $ret;
    }
}
