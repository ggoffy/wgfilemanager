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
     * load default mimetype set
     *
     * @return bool
     */
    public function loadDefaultMimetypeSet()
    {
        global $xoopsDB;
        $sql = "INSERT INTO `" . $xoopsDB->prefix('wgfilemanager_mimetype') . "` (`id`, `extension`, `mimetype`, `desc`, `admin`, `user`, `category`, `date_created`, `submitter`) VALUES
(1, 'bin', 'application/octet-stream', 'Binary File/Linux Executable', 0, 0, 0, 1721574964, 1),
(2, 'dms', 'application/octet-stream', 'Amiga DISKMASHER Compressed Archive', 0, 0, 0, 1721574964, 1),
(3, 'class', 'application/octet-stream', 'Java Bytecode', 0, 0, 0, 1721574964, 1),
(4, 'so', 'application/octet-stream', 'UNIX Shared Library Function', 0, 0, 0, 1721574964, 1),
(5, 'dll', 'application/octet-stream', 'Dynamic Link Library', 0, 0, 0, 1721574964, 1),
(6, 'hqx', 'application/binhex application/mac-binhex application/mac-binhex40', 'Macintosh BinHex 4 Compressed Archive', 0, 0, 0, 1721574964, 1),
(7, 'cpt', 'application/mac-compactpro application/compact_pro', 'Compact Pro Archive', 0, 0, 0, 1721574964, 1),
(8, 'lha', 'application/lha application/x-lha application/octet-stream application/x-compress application/x-compressed application/maclha', 'Compressed Archive File', 0, 0, 0, 1721574964, 1),
(9, 'lzh', 'application/lzh application/x-lzh application/x-lha application/x-compress application/x-compressed application/x-lzh-archive zz-application/zz-winassoc-lzh application/maclha application/octet-stream', 'Compressed Archive File', 0, 0, 0, 1721574964, 1),
(10, 'sh', 'application/x-shar', 'UNIX shar Archive File', 0, 0, 0, 1721574964, 1),
(11, 'shar', 'application/x-shar', 'UNIX shar Archive File', 0, 0, 0, 1721574964, 1),
(12, 'tar', 'application/tar application/x-tar applicaton/x-gtar multipart/x-tar application/x-compress application/x-compressed', 'Tape Archive File', 0, 0, 0, 1721574964, 1),
(13, 'gtar', 'application/x-gtar', 'GNU tar Compressed File Archive', 0, 0, 0, 1721574964, 1),
(14, 'ustar', 'application/x-ustar multipart/x-ustar', 'POSIX tar Compressed Archive', 0, 0, 0, 1721574964, 1),
(15, 'zip', 'application/zip application/x-zip application/x-zip-compressed application/octet-stream application/x-compress application/x-compressed multipart/x-zip', 'Compressed Archive File', 1, 1, 0, 1721574964, 1),
(16, 'exe', 'application/exe application/x-exe application/dos-exe application/x-winexe application/msdos-windows application/x-msdos-program', 'Executable File', 0, 0, 0, 1721574964, 1),
(17, 'wmz', 'application/x-ms-wmz', 'Windows Media Compressed Skin File', 0, 0, 0, 1721574964, 1),
(18, 'wmd', 'application/x-ms-wmd', 'Windows Media Download File', 0, 0, 0, 1721574964, 1),
(19, 'doc', 'application/msword application/doc appl/text application/vnd.msword application/vnd.ms-word application/winword application/word application/x-msw6 application/x-msword', 'Word Document', 1, 1, 0, 1721574964, 1),
(20, 'pdf', 'application/pdf application/acrobat application/x-pdf applications/vnd.pdf text/pdf', 'Acrobat Portable Document Format', 1, 1, 0, 1721574964, 1),
(21, 'eps', 'application/eps application/postscript application/x-eps image/eps image/x-eps', 'Encapsulated PostScript', 0, 0, 0, 1721574964, 1),
(22, 'ps', 'application/postscript application/ps application/x-postscript application/x-ps text/postscript', 'PostScript', 0, 0, 0, 1721574964, 1),
(23, 'smi', 'application/smil', 'SMIL Multimedia', 0, 0, 0, 1721574964, 1),
(24, 'smil', 'application/smil', 'Synchronized Multimedia Integration Language', 0, 0, 0, 1721574964, 1),
(25, 'wmlc', 'application/vnd.wap.wmlc ', 'Compiled WML Document', 0, 0, 0, 1721574964, 1),
(26, 'wmlsc', 'application/vnd.wap.wmlscriptc', 'Compiled WML Script', 0, 0, 0, 1721574964, 1),
(27, 'vcd', 'application/x-cdlink', 'Virtual CD-ROM CD Image File', 0, 0, 0, 1721574964, 1),
(28, 'pgn', 'application/formstore', 'Picatinny Arsenal Electronic Formstore Form in TIFF Format', 0, 0, 0, 1721574964, 1),
(29, 'cpio', 'application/x-cpio', 'UNIX CPIO Archive', 0, 0, 0, 1721574964, 1),
(30, 'csh', 'application/x-csh', 'Csh Script', 0, 0, 0, 1721574964, 1),
(31, 'dcr', 'application/x-director', 'Shockwave Movie', 0, 0, 0, 1721574964, 1),
(32, 'dir', 'application/x-director', 'Macromedia Director Movie', 0, 0, 0, 1721574964, 1),
(33, 'dxr', 'application/x-director application/vnd.dxr', 'Macromedia Director Protected Movie File', 0, 0, 0, 1721574964, 1),
(34, 'dvi', 'application/x-dvi', 'TeX Device Independent Document', 0, 0, 0, 1721574964, 1),
(35, 'spl', 'application/x-futuresplash', 'Macromedia FutureSplash File', 0, 0, 0, 1721574964, 1),
(36, 'hdf', 'application/x-hdf', 'Hierarchical Data Format File', 0, 0, 0, 1721574964, 1),
(37, 'js', 'application/x-javascript text/javascript', 'JavaScript Source Code', 0, 0, 0, 1721574964, 1),
(38, 'skp', 'application/x-koan application/vnd-koan koan/x-skm application/vnd.koan', 'SSEYO Koan Play File', 0, 0, 0, 1721574964, 1),
(39, 'skd', 'application/x-koan application/vnd-koan koan/x-skm application/vnd.koan', 'SSEYO Koan Design File', 0, 0, 0, 1721574964, 1),
(40, 'skt', 'application/x-koan application/vnd-koan koan/x-skm application/vnd.koan', 'SSEYO Koan Template File', 0, 0, 0, 1721574964, 1),
(41, 'skm', 'application/x-koan application/vnd-koan koan/x-skm application/vnd.koan', 'SSEYO Koan Mix File', 0, 0, 0, 1721574964, 1),
(42, 'latex', 'application/x-latex text/x-latex', 'LaTeX Source Document', 0, 0, 0, 1721574964, 1),
(43, 'nc', 'application/x-netcdf text/x-cdf', 'Unidata netCDF Graphics', 0, 0, 0, 1721574964, 1),
(44, 'cdf', 'application/cdf application/x-cdf application/netcdf application/x-netcdf text/cdf text/x-cdf', 'Channel Definition Format', 0, 0, 0, 1721574964, 1),
(45, 'swf', 'application/x-shockwave-flash application/x-shockwave-flash2-preview application/futuresplash image/vnd.rn-realflash', 'Macromedia Flash Format File', 0, 0, 0, 1721574964, 1),
(46, 'sit', 'application/stuffit application/x-stuffit application/x-sit', 'StuffIt Compressed Archive File', 0, 0, 0, 1721574964, 1),
(47, 'tcl', 'application/x-tcl', 'TCL/TK Language Script', 0, 0, 0, 1721574964, 1),
(48, 'tex', 'application/x-tex', 'LaTeX Source', 0, 0, 0, 1721574964, 1),
(49, 'texinfo', 'application/x-texinfo', 'TeX', 0, 0, 0, 1721574964, 1),
(50, 'texi', 'application/x-texinfo', 'TeX', 0, 0, 0, 1721574964, 1),
(51, 't', 'application/x-troff', 'TAR Tape Archive Without Compression', 0, 0, 0, 1721574964, 1),
(52, 'tr', 'application/x-troff', 'Unix Tape Archive = TAR without compression (tar)', 0, 0, 0, 1721574964, 1),
(53, 'src', 'application/x-wais-source', 'Sourcecode', 0, 0, 0, 1721574964, 1),
(54, 'xhtml', 'application/xhtml+xml', 'Extensible HyperText Markup Language File', 0, 0, 0, 1721574964, 1),
(55, 'xht', 'application/xhtml+xml', 'Extensible HyperText Markup Language File', 0, 0, 0, 1721574964, 1),
(56, 'au', 'audio/basic audio/x-basic audio/au audio/x-au audio/x-pn-au audio/rmf audio/x-rmf audio/x-ulaw audio/vnd.qcelp audio/x-gsm audio/snd', 'ULaw/AU Audio File', 0, 0, 0, 1721574964, 1),
(57, 'XM', 'audio/xm audio/x-xm audio/module-xm audio/mod audio/x-mod', 'Fast Tracker 2 Extended Module', 0, 0, 0, 1721574964, 1),
(58, 'snd', 'audio/basic', 'Macintosh Sound Resource', 0, 0, 0, 1721574964, 1),
(59, 'mid', 'audio/mid audio/m audio/midi audio/x-midi application/x-midi audio/soundtrack', 'Musical Instrument Digital Interface MIDI-sequention Sound', 0, 0, 0, 1721574964, 1),
(60, 'midi', 'audio/mid audio/m audio/midi audio/x-midi application/x-midi', 'Musical Instrument Digital Interface MIDI-sequention Sound', 0, 0, 0, 1721574964, 1),
(61, 'kar', 'audio/midi audio/x-midi audio/mid x-music/x-midi', 'Karaoke MIDI File', 0, 0, 0, 1721574964, 1),
(62, 'mpga', 'audio/mpeg audio/mp3 audio/mgp audio/m-mpeg audio/x-mp3 audio/x-mpeg audio/x-mpg video/mpeg', 'Mpeg-1 Layer3 Audio Stream', 0, 0, 0, 1721574964, 1),
(63, 'mp2', 'video/mpeg audio/mpeg', 'MPEG Audio Stream, Layer II', 0, 0, 0, 1721574964, 1),
(64, 'mp3', 'audio/mpeg audio/x-mpeg audio/mp3 audio/x-mp3 audio/mpeg3 audio/x-mpeg3 audio/mpg audio/x-mpg audio/x-mpegaudio', 'MPEG Audio Stream, Layer III', 0, 0, 0, 1721574964, 1),
(65, 'aif', 'audio/aiff audio/x-aiff sound/aiff audio/rmf audio/x-rmf audio/x-pn-aiff audio/x-gsm audio/x-midi audio/vnd.qcelp', 'Audio Interchange File', 0, 0, 0, 1721574964, 1),
(66, 'aiff', 'audio/aiff audio/x-aiff sound/aiff audio/rmf audio/x-rmf audio/x-pn-aiff audio/x-gsm audio/mid audio/x-midi audio/vnd.qcelp', 'Audio Interchange File', 0, 0, 0, 1721574964, 1),
(67, 'aifc', 'audio/aiff audio/x-aiff audio/x-aifc sound/aiff audio/rmf audio/x-rmf audio/x-pn-aiff audio/x-gsm audio/x-midi audio/mid audio/vnd.qcelp', 'Audio Interchange File', 0, 0, 0, 1721574964, 1),
(68, 'm3u', 'audio/x-mpegurl audio/mpeg-url application/x-winamp-playlist audio/scpls audio/x-scpls', 'MP3 Playlist File', 0, 0, 0, 1721574964, 1),
(69, 'ram', 'audio/x-pn-realaudio audio/vnd.rn-realaudio audio/x-pm-realaudio-plugin audio/x-pn-realvideo audio/x-realaudio video/x-pn-realvideo text/plain', 'RealMedia Metafile', 0, 0, 0, 1721574964, 1),
(70, 'rm', 'application/vnd.rn-realmedia audio/vnd.rn-realaudio audio/x-pn-realaudio audio/x-realaudio audio/x-pm-realaudio-plugin', 'RealMedia Streaming Media', 0, 0, 0, 1721574964, 1),
(71, 'rpm', 'audio/x-pn-realaudio audio/x-pn-realaudio-plugin audio/x-pnrealaudio-plugin video/x-pn-realvideo-plugin audio/x-mpegurl application/octet-stream', 'RealMedia Player Plug-in', 0, 0, 0, 1721574964, 1),
(72, 'ra', 'audio/vnd.rn-realaudio audio/x-pn-realaudio audio/x-realaudio audio/x-pm-realaudio-plugin video/x-pn-realvideo', 'RealMedia Streaming Media', 0, 0, 0, 1721574964, 1),
(73, 'wav', 'audio/wav audio/x-wav audio/wave audio/x-pn-wav', 'Waveform Audio', 0, 0, 0, 1721574964, 1),
(74, 'wax', ' audio/x-ms-wax', 'Windows Media Audio Redirector', 0, 0, 0, 1721574964, 1),
(75, 'wma', 'audio/x-ms-wma video/x-ms-asf', 'Windows Media Audio File', 0, 0, 0, 1721574964, 1),
(76, 'bmp', 'image/bmp image/x-bmp image/x-bitmap image/x-xbitmap image/x-win-bitmap image/x-windows-bmp image/ms-bmp image/x-ms-bmp application/bmp application/x-bmp application/x-win-bitmap application/preview', 'Windows OS/2 Bitmap Graphics', 1, 1, 1, 1721574964, 1),
(77, 'gif', 'image/gif image/x-xbitmap image/gi_', 'Graphic Interchange Format', 1, 1, 1, 1721574964, 1),
(78, 'ief', 'image/ief', 'Image File - Bitmap graphics', 0, 0, 0, 1721574964, 1),
(79, 'jpeg', 'image/jpeg image/jpg image/jpe_ image/pjpeg image/vnd.swiftview-jpeg', 'JPEG/JIFF Image', 1, 1, 1, 1721574964, 1),
(80, 'jpg', 'image/jpeg image/jpg image/jp_ application/jpg application/x-jpg image/pjpeg image/pipeg image/vnd.swiftview-jpeg image/x-xbitmap', 'JPEG/JIFF Image', 1, 1, 1, 1721574964, 1),
(81, 'jpe', 'image/jpeg', 'JPEG/JIFF Image', 1, 1, 1, 1721574964, 1),
(82, 'png', 'image/png application/png application/x-png', 'Portable (Public) Network Graphic', 1, 1, 1, 1721574964, 1),
(83, 'tiff', 'image/tiff', 'Tagged Image Format File', 1, 1, 1, 1721574964, 1),
(84, 'tif', 'image/tif image/x-tif image/tiff image/x-tiff application/tif application/x-tif application/tiff application/x-tiff', 'Tagged Image Format File', 1, 1, 1, 1721574964, 1),
(85, 'ico', 'image/ico image/x-icon application/ico application/x-ico application/x-win-bitmap image/x-win-bitmap application/octet-stream', 'Windows Icon', 0, 0, 0, 1721574964, 1),
(86, 'wbmp', 'image/vnd.wap.wbmp', 'Wireless Bitmap File Format', 0, 0, 0, 1721574964, 1),
(87, 'ras', 'application/ras application/x-ras image/ras', 'Sun Raster Graphic', 0, 0, 0, 1721574964, 1),
(88, 'pnm', 'image/x-portable-anymap', 'PBM Portable Any Map Graphic Bitmap', 0, 0, 0, 1721574964, 1),
(89, 'pbm', 'image/portable bitmap image/x-portable-bitmap image/pbm image/x-pbm', 'UNIX Portable Bitmap Graphic', 0, 0, 0, 1721574964, 1),
(90, 'pgm', 'image/x-portable-graymap image/x-pgm', 'Portable Graymap Graphic', 0, 0, 0, 1721574964, 1),
(91, 'ppm', 'image/x-portable-pixmap application/ppm application/x-ppm image/x-p image/x-ppm', 'PBM Portable Pixelmap Graphic', 0, 0, 0, 1721574964, 1),
(92, 'rgb', 'image/rgb image/x-rgb', 'Silicon Graphics RGB Bitmap', 0, 0, 0, 1721574964, 1),
(93, 'xbm', 'image/x-xpixmap image/x-xbitmap image/xpm image/x-xpm', 'X Bitmap Graphic', 0, 0, 0, 1721574964, 1),
(94, 'xpm', 'image/x-xpixmap', 'BMC Software Patrol UNIX Icon File', 0, 0, 0, 1721574964, 1),
(95, 'xwd', 'image/x-xwindowdump image/xwd image/x-xwd application/xwd application/x-xwd', 'X Windows Dump', 0, 0, 0, 1721574964, 1),
(96, 'igs', 'model/iges application/iges application/x-iges application/igs application/x-igs drawing/x-igs image/x-igs', 'Initial Graphics Exchange Specification Format', 0, 0, 0, 1721574964, 1),
(97, 'css', 'application/css-stylesheet text/css', 'Hypertext Cascading Style Sheet', 0, 0, 0, 1721574964, 1),
(98, 'html', 'text/html text/plain', 'Hypertext Markup Language', 0, 0, 0, 1721574964, 1),
(99, 'htm', 'text/html', 'Hypertext Markup Language', 0, 0, 0, 1721574964, 1),
(100, 'txt', 'text/plain application/txt browser/internal', 'Text File', 1, 1, 0, 1721574964, 1),
(101, 'rtf', 'application/rtf application/x-rtf text/rtf text/richtext application/msword application/doc application/x-soffice', 'Rich Text Format File', 1, 1, 0, 1721574964, 1),
(102, 'wml', 'text/vnd.wap.wml text/wml', 'Website META Language File', 0, 0, 0, 1721574964, 1),
(103, 'wmls', 'text/vnd.wap.wmlscript', 'WML Script', 0, 0, 0, 1721574964, 1),
(104, 'etx', 'text/x-setext', 'SetText Structure Enhanced Text', 0, 0, 0, 1721574964, 1),
(105, 'xml', 'text/xml application/xml application/x-xml', 'Extensible Markup Language File', 1, 1, 0, 1721574964, 1),
(106, 'xsl', 'text/xml', 'XML Stylesheet', 0, 0, 0, 1721574964, 1),
(107, 'php', 'application/x-httpd-php text/php application/php magnus-internal/shellcgi application/x-php', 'PHP Script', 0, 0, 0, 1721574964, 1),
(108, 'php3', 'text/php3 application/x-httpd-php', 'PHP Script', 0, 0, 0, 1721574964, 1),
(109, 'mpeg', 'video/mpeg', 'MPEG Movie', 0, 0, 0, 1721574964, 1),
(110, 'mpg', 'video/mpeg video/mpg video/x-mpg video/mpeg2 application/x-pn-mpg video/x-mpeg video/x-mpeg2a audio/mpeg audio/x-mpeg image/mpg', 'MPEG 1 System Stream', 0, 0, 0, 1721574964, 1),
(111, 'mpe', 'video/mpeg', 'MPEG Movie Clip', 0, 0, 0, 1721574964, 1),
(112, 'qt', 'video/quicktime audio/aiff audio/x-wav video/flc', 'QuickTime Movie', 0, 0, 0, 1721574964, 1),
(113, 'mov', 'video/quicktime video/x-quicktime image/mov audio/aiff audio/x-midi audio/x-wav video/avi', 'QuickTime Video Clip', 0, 0, 0, 1721574964, 1),
(114, 'avi', 'video/avi video/msvideo video/x-msvideo image/avi video/xmpg2 application/x-troff-msvideo audio/aiff audio/avi', 'Audio Video Interleave File', 0, 0, 0, 1721574964, 1),
(115, 'movie', 'video/sgi-movie video/x-sgi-movie', 'QuickTime Movie', 0, 0, 0, 1721574964, 1),
(116, 'asf', 'audio/asf application/asx video/x-ms-asf-plugin application/x-mplayer2 video/x-ms-asf application/vnd.ms-asf video/x-ms-asf-plugin video/x-ms-wm video/x-ms-wmx', 'Advanced Streaming Format', 0, 0, 0, 1721574964, 1),
(117, 'asx', 'video/asx application/asx video/x-ms-asf-plugin application/x-mplayer2 video/x-ms-asf application/vnd.ms-asf video/x-ms-asf-plugin video/x-ms-wm video/x-ms-wmx video/x-la-asf', 'Advanced Stream Redirector File', 0, 0, 0, 1721574964, 1),
(118, 'wmv', 'video/x-ms-wmv', 'Windows Media File', 0, 0, 0, 1721574964, 1),
(119, 'wvx', 'video/x-ms-wvx', 'Windows Media Redirector', 0, 0, 0, 1721574964, 1),
(120, 'wm', 'video/x-ms-wm', 'Windows Media A/V File', 0, 0, 0, 1721574964, 1),
(121, 'wmx', 'video/x-ms-wmx', 'Windows Media Player A/V Shortcut', 0, 0, 0, 1721574964, 1),
(122, 'ice', 'x-conference-xcooltalk', 'Cooltalk Audio', 0, 0, 0, 1721574964, 1),
(123, 'rar', 'application/octet-stream', 'WinRAR Compressed Archive', 1, 1, 0, 1721574964, 1),
(124, 'mp4', 'video/mp4', 'MPEG-4', 0, 0, 0, 1721574964, 1),
(125, 'flv', 'video/x-flv', 'Flash Video', 0, 0, 0, 1721574964, 1),
(126, 'm3u8', 'application/x-mpegURL', 'iPhone Index', 0, 0, 0, 1721574964, 1),
(127, 'ts', 'video/MP2T', 'iPhone Segment', 0, 0, 0, 1721574964, 1),
(128, '3gp', 'video/3gpp', '3GP Mobile', 0, 0, 0, 1721574964, 1),
(129, 'docm', 'application/vnd.ms-word.document.macroEnabled.12', 'Office 2007 MS Word', 0, 1, 0, 1721574964, 1),
(130, 'docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'Office 2007 MS Word', 1, 1, 0, 1721574964, 1),
(131, 'dotm', 'application/vnd.ms-word.template.macroEnabled.12', 'Office 2007 MS Word', 0, 1, 0, 1721574964, 1),
(132, 'dotx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.template', 'Office 2007 MS Word', 0, 1, 0, 1721574964, 1),
(133, 'ppsm', 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12', 'Office 2007 MS Powerpoint', 0, 0, 0, 1721574964, 1),
(134, 'ppsx', 'application/vnd.openxmlformats-officedocument.presentationml.slideshow', 'Office 2007 MS Powerpoint', 0, 1, 0, 1721574964, 1),
(135, 'pptm', 'application/vnd.ms-powerpoint.presentation.macroEnabled.12', 'Office 2007 MS Powerpoint', 0, 1, 0, 1721574964, 1),
(136, 'pptx', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'Office 2007 MS Powerpoint', 1, 1, 0, 1721574964, 1),
(137, 'xlsb', 'application/vnd.ms-excel.sheet.binary.macroEnabled.12', 'Office 2007 MS Excel', 1, 1, 0, 1721574964, 1),
(138, 'xlsm', 'application/vnd.ms-excel.sheet.macroEnabled.12', 'Office 2007 MS Excel', 1, 1, 0, 1721574964, 1),
(139, 'xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'Office 2007 MS Excel', 1, 1, 0, 1721574964, 1),
(140, 'xps', 'application/vnd.ms-xpsdocument', 'Office 2007 MS Excel', 0, 0, 0, 1721574964, 1),
(141, 'odt', 'application/vnd.oasis.opendocument.text', 'OpenOffice Document', 1, 1, 0, 1721575882, 1),
(142, 'ods', 'application/vnd.oasis.opendocument.spreadsheet', 'OpenOffice Spreadsheet', 1, 1, 0, 1721575939, 1),
(143, 'odp', 'application/vnd.oasis.opendocument.presentation', 'OpenOffice Presentation', 1, 1, 0, 1721575998, 1),
(144, 'xls', 'application/vnd.ms-excel application/msexcel application/x-msexcel application/x-ms-excel application/x-excel application/x-dos_ms_excel application/xls application/x-xls', 'Microsoft Excel', 1, 1, 0, 1721576498, 1),
(145, 'csv', 'text/comma-separated-values', 'Text Comma Separated Values', 1, 1, 0, 1721583413, 1),
(146, 'json', 'application/json', 'JSON file', 1, 1, 0, 1721583413, 1);
            ";
        return $xoopsDB->query($sql);
    }
}
