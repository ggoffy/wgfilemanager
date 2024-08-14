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


/**
 * Class Object Handler Mimetype
 */
class MimetypeHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'wgfilemanager_mimetype', Mimetype::class, 'id', 'extension');
    }

    /**
     * @param bool $isNew
     *
     * @return object
     */
    public function create($isNew = true)
    {
        return parent::create($isNew);
    }

    /**
     * retrieve a field
     *
     * @param int $id field id
     * @param null fields
     * @return \XoopsObject|null reference to the {@link Get} object
     */
    public function get($id = null, $fields = null)
    {
        return parent::get($id, $fields);
    }

    /**
     * get inserted id
     *
     * @param null
     * @return int reference to the {@link Get} object
     */
    public function getInsertId()
    {
        return $this->db->getInsertId();
    }

    /**
     * Get Count Mimetype in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountMimetype($start = 0, $limit = 0, $sort = 'id', $order = 'ASC')
    {
        $crCountMimetype = new \CriteriaCompo();
        $crCountMimetype = $this->getMimetypeCriteria($crCountMimetype, $start, $limit, $sort, $order);
        return $this->getCount($crCountMimetype);
    }

    /**
     * Get All Mimetype in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllMimetype($start = 0, $limit = 0, $sort = 'extension', $order = 'ASC')
    {
        $crAllMimetype = new \CriteriaCompo();
        $crAllMimetype = $this->getMimetypeCriteria($crAllMimetype, $start, $limit, $sort, $order);
        return $this->getAll($crAllMimetype);
    }

    /**
     * Get Criteria Mimetype
     * @param        $crMimetype
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getMimetypeCriteria($crMimetype, $start, $limit, $sort, $order)
    {
        $crMimetype->setStart($start);
        $crMimetype->setLimit($limit);
        $crMimetype->setSort($sort);
        $crMimetype->setOrder($order);
        return $crMimetype;
    }

    /**
     * Get Mimetypes
     *
     * @return array
     */
    public function getMimetypeArray()
    {
        $isAdmin = \is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid()) : false;

        $crMimetype = new \CriteriaCompo();
        if ($isAdmin) {
            $crMimetype->add(new \Criteria('admin', '1'));
        } else {
            $crMimetype->add(new \Criteria('user', '1'));
        }
        $mimetypeAll = $this->getAll($crMimetype);
        $mimetypeArray = [];
        foreach (\array_keys($mimetypeAll) as $i) {
            $mimetype = $mimetypeAll[$i]->getVar('mimetype');
            if (\strpos($mimetype, ' ') > 0) {
                //mimetype comtains multiple mimetypes
                $multiMime = explode(' ', $mimetype);
                foreach ($multiMime as $m) {
                    $mimetypeArray[] = $m;
                }
            } else {
                //mimetype comtains single mimetype
                $mimetypeArray[] = $mimetype;
            }
            unset($mimetype);
        }

        return \array_unique(\array_filter($mimetypeArray));

    }

    /**
     * Get all allowed extensions
     *
     * @return array
     */
    public function getExtensionArray()
    {
        $crMimetype = new \CriteriaCompo();
        $crMimetype->add(new \Criteria('admin', '1'));
        $crMimetype->add(new \Criteria('user', '1'), 'OR');

        $mimetypeAll = $this->getAll($crMimetype);
        $extensionArray = [];
        foreach (\array_keys($mimetypeAll) as $i) {
            $extensionArray[$i]['extension'] = $mimetypeAll[$i]->getVar('extension');
            $extensionArray[$i]['category'] = $mimetypeAll[$i]->getVar('category');
        }

        return $extensionArray;

    }
}
