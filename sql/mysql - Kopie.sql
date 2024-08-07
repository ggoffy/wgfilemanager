# SQL Dump for wgfilemanager module
# PhpMyAdmin Version: 4.0.4
# https://www.phpmyadmin.net
#
# Host: localhost
# Generated on: Sat Jun 29, 2024 to 13:11:46
# Server version: 8.0.31
# PHP Version: 7.4.33

#
# Structure table for `wgfilemanager_directory` 7
#

CREATE TABLE `wgfilemanager_directory` (
  `id`           INT(8)          UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id`    INT(10)         NOT NULL DEFAULT '0',
  `name`         VARCHAR(255)    NOT NULL DEFAULT '',
  `description`  TEXT            NOT NULL ,
  `fullpath`     VARCHAR(255)    NOT NULL DEFAULT '',
  `date_created` INT(11)         NOT NULL DEFAULT '0',
  `submitter`    INT(10)         NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

#
# Structure table for `wgfilemanager_file` 9
#

CREATE TABLE `wgfilemanager_file` (
  `id`           INT(8)          UNSIGNED NOT NULL AUTO_INCREMENT,
  `directory_id` INT(10)         NOT NULL DEFAULT '0',
  `name`         VARCHAR(255)    NOT NULL DEFAULT '',
  `description`  TEXT            NOT NULL ,
  `mimetype`     VARCHAR(255)    NOT NULL DEFAULT '',
  `mtime`        INT(11) NOT NULL DEFAULT '0',
  `ip`           VARCHAR(45)     NOT NULL DEFAULT '',
  `status`       INT(1)          NOT NULL DEFAULT '0',
  `date_created` INT(11)         NOT NULL DEFAULT '0',
  `submitter`    INT(10)         NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

#
# Structure table for `wgfilemanager_mimetype` 9
#

CREATE TABLE `wgfilemanager_mimetype` (
   `id`           INT(8)          UNSIGNED NOT NULL AUTO_INCREMENT,
   `extension`    VARCHAR(255)    NOT NULL DEFAULT '',
   `mime_type`    VARCHAR(255)    NOT NULL DEFAULT '',
   `descr`        VARCHAR(255)    NOT NULL DEFAULT '',
   `admin`        INT(1)          NOT NULL DEFAULT '0',
   `user`         INT(1)          NOT NULL DEFAULT '0',
   `is_image`      INT(1)          NOT NULL DEFAULT '0',
   `date_created` INT(11)         NOT NULL DEFAULT '0',
   `submitter`    INT(10)         NOT NULL DEFAULT '0',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB;


--
-- Data for table `wgfilemanager_mimetype`
--
INSERT INTO `wgfilemanager_mimetype` (`id`, `extension`, `mime_type`, `descr`, `admin`, `user`, `is_image`, `date_created`, `submitter`) VALUES
(1, 'bin', 'application/octet-stream', 'Binary File/Linux Executable', 0, 0, 0, 0, 0),
(2, 'dms', 'application/octet-stream', 'Amiga DISKMASHER Compressed Archive', 1, 0, 0, 0, 0),
(3, 'class', 'application/octet-stream', 'Java Bytecode', 1, 0, 0, 0, 0),
(4, 'so', 'application/octet-stream', 'UNIX Shared Library Function', 1, 0, 0, 0, 0),
(5, 'dll', 'application/octet-stream', 'Dynamic Link Library', 0, 0, 0, 0, 0),
(6, 'hqx', 'application/binhex application/mac-binhex application/mac-binhex40', 'Macintosh BinHex 4 Compressed Archive', 1, 0, 0, 0, 0),
(7, 'cpt', 'application/mac-compactpro application/compact_pro', 'Compact Pro Archive', 0, 0, 0, 0, 0),
(8, 'lha', 'application/lha application/x-lha application/octet-stream application/x-compress application/x-compressed application/maclha', 'Compressed Archive File', 1, 0, 0, 0, 0),
(9, 'lzh', 'application/lzh application/x-lzh application/x-lha application/x-compress application/x-compressed application/x-lzh-archive zz-application/zz-winassoc-lzh application/maclha application/octet-stream', 'Compressed Archive File', 1, 0, 0, 0, 0),
(10, 'sh', 'application/x-shar', 'UNIX shar Archive File', 1, 0, 0, 0, 0),
(11, 'shar', 'application/x-shar', 'UNIX shar Archive File', 1, 0, 0, 0, 0),
(12, 'tar', 'application/tar application/x-tar applicaton/x-gtar multipart/x-tar application/x-compress application/x-compressed', 'Tape Archive File', 1, 0, 0, 0, 0),
(13, 'gtar', 'application/x-gtar', 'GNU tar Compressed File Archive', 1, 0, 0, 0, 0),
(14, 'ustar', 'application/x-ustar multipart/x-ustar', 'POSIX tar Compressed Archive', 1, 0, 0, 0, 0),
(15, 'zip', 'application/zip application/x-zip application/x-zip-compressed application/octet-stream application/x-compress application/x-compressed multipart/x-zip', 'Compressed Archive File', 1, 0, 0, 0, 0),
(16, 'exe', 'application/exe application/x-exe application/dos-exe application/x-winexe application/msdos-windows application/x-msdos-program', 'Executable File', 0, 0, 0, 0, 0),
(17, 'wmz', 'application/x-ms-wmz', 'Windows Media Compressed Skin File', 1, 0, 0, 0, 0),
(18, 'wmd', 'application/x-ms-wmd', 'Windows Media Download File', 1, 0, 0, 0, 0),
(19, 'doc', 'application/msword application/doc appl/text application/vnd.msword application/vnd.ms-word application/winword application/word application/x-msw6 application/x-msword', 'Word Document', 1, 0, 0, 0, 0),
(20, 'pdf', 'application/pdf application/acrobat application/x-pdf applications/vnd.pdf text/pdf', 'Acrobat Portable Document Format', 1, 1, 0, 0, 0),
(21, 'eps', 'application/eps application/postscript application/x-eps image/eps image/x-eps', 'Encapsulated PostScript', 1, 0, 0, 0, 0),
(22, 'ps', 'application/postscript application/ps application/x-postscript application/x-ps text/postscript', 'PostScript', 1, 0, 0, 0, 0),
(23, 'smi', 'application/smil', 'SMIL Multimedia', 1, 0, 0, 0, 0),
(24, 'smil', 'application/smil', 'Synchronized Multimedia Integration Language', 1, 0, 0, 0, 0),
(25, 'wmlc', 'application/vnd.wap.wmlc ', 'Compiled WML Document', 1, 0, 0, 0, 0),
(26, 'wmlsc', 'application/vnd.wap.wmlscriptc', 'Compiled WML Script', 1, 0, 0, 0, 0),
(27, 'vcd', 'application/x-cdlink', 'Virtual CD-ROM CD Image File', 1, 0, 0, 0, 0),
(28, 'pgn', 'application/formstore', 'Picatinny Arsenal Electronic Formstore Form in TIFF Format', 1, 0, 0, 0, 0),
(29, 'cpio', 'application/x-cpio', 'UNIX CPIO Archive', 1, 0, 0, 0, 0),
(30, 'csh', 'application/x-csh', 'Csh Script', 0, 0, 0, 0, 0),
(31, 'dcr', 'application/x-director', 'Shockwave Movie', 1, 0, 0, 0, 0),
(32, 'dir', 'application/x-director', 'Macromedia Director Movie', 1, 0, 0, 0, 0),
(33, 'dxr', 'application/x-director application/vnd.dxr', 'Macromedia Director Protected Movie File', 1, 0, 0, 0, 0),
(34, 'dvi', 'application/x-dvi', 'TeX Device Independent Document', 1, 0, 0, 0, 0),
(35, 'spl', 'application/x-futuresplash', 'Macromedia FutureSplash File', 1, 0, 0, 0, 0),
(36, 'hdf', 'application/x-hdf', 'Hierarchical Data Format File', 1, 0, 0, 0, 0),
(37, 'js', 'application/x-javascript text/javascript', 'JavaScript Source Code', 1, 0, 0, 0, 0),
(38, 'skp', 'application/x-koan application/vnd-koan koan/x-skm application/vnd.koan', 'SSEYO Koan Play File', 1, 0, 0, 0, 0),
(39, 'skd', 'application/x-koan application/vnd-koan koan/x-skm application/vnd.koan', 'SSEYO Koan Design File', 1, 0, 0, 0, 0),
(40, 'skt', 'application/x-koan application/vnd-koan koan/x-skm application/vnd.koan', 'SSEYO Koan Template File', 1, 0, 0, 0, 0),
(41, 'skm', 'application/x-koan application/vnd-koan koan/x-skm application/vnd.koan', 'SSEYO Koan Mix File', 1, 0, 0, 0, 0),
(42, 'latex', 'application/x-latex text/x-latex', 'LaTeX Source Document', 1, 0, 0, 0, 0),
(43, 'nc', 'application/x-netcdf text/x-cdf', 'Unidata netCDF Graphics', 1, 0, 0, 0, 0),
(44, 'cdf', 'application/cdf application/x-cdf application/netcdf application/x-netcdf text/cdf text/x-cdf', 'Channel Definition Format', 1, 0, 0, 0, 0),
(45, 'swf', 'application/x-shockwave-flash application/x-shockwave-flash2-preview application/futuresplash image/vnd.rn-realflash', 'Macromedia Flash Format File', 1, 0, 0, 0, 0),
(46, 'sit', 'application/stuffit application/x-stuffit application/x-sit', 'StuffIt Compressed Archive File', 1, 0, 0, 0, 0),
(47, 'tcl', 'application/x-tcl', 'TCL/TK Language Script', 1, 0, 0, 0, 0),
(48, 'tex', 'application/x-tex', 'LaTeX Source', 1, 0, 0, 0, 0),
(49, 'texinfo', 'application/x-texinfo', 'TeX', 1, 0, 0, 0, 0),
(50, 'texi', 'application/x-texinfo', 'TeX', 1, 0, 0, 0, 0);
INSERT INTO `wgfilemanager_mimetype` (`id`, `extension`, `mime_type`, `descr`, `admin`, `user`, `is_image`, `date_created`, `submitter`) VALUES
(51, 't', 'application/x-troff', 'TAR Tape Archive Without Compression', 1, 0, 0, 0, 0),
(52, 'tr', 'application/x-troff', 'Unix Tape Archive = TAR without compression (tar)', 1, 0, 0, 0, 0),
(53, 'src', 'application/x-wais-source', 'Sourcecode', 1, 0, 0, 0, 0),
(54, 'xhtml', 'application/xhtml+xml', 'Extensible HyperText Markup Language File', 1, 0, 0, 0, 0),
(55, 'xht', 'application/xhtml+xml', 'Extensible HyperText Markup Language File', 1, 0, 0, 0, 0),
(56, 'au', 'audio/basic audio/x-basic audio/au audio/x-au audio/x-pn-au audio/rmf audio/x-rmf audio/x-ulaw audio/vnd.qcelp audio/x-gsm audio/snd', 'ULaw/AU Audio File', 1, 0, 0, 0, 0),
(57, 'XM', 'audio/xm audio/x-xm audio/module-xm audio/mod audio/x-mod', 'Fast Tracker 2 Extended Module', 1, 0, 0, 0, 0),
(58, 'snd', 'audio/basic', 'Macintosh Sound Resource', 1, 0, 0, 0, 0),
(59, 'mid', 'audio/mid audio/m audio/midi audio/x-midi application/x-midi audio/soundtrack', 'Musical Instrument Digital Interface MIDI-sequention Sound', 1, 0, 0, 0, 0),
(60, 'midi', 'audio/mid audio/m audio/midi audio/x-midi application/x-midi', 'Musical Instrument Digital Interface MIDI-sequention Sound', 1, 0, 0, 0, 0),
(61, 'kar', 'audio/midi audio/x-midi audio/mid x-music/x-midi', 'Karaoke MIDI File', 1, 0, 0, 0, 0),
(62, 'mpga', 'audio/mpeg audio/mp3 audio/mgp audio/m-mpeg audio/x-mp3 audio/x-mpeg audio/x-mpg video/mpeg', 'Mpeg-1 Layer3 Audio Stream', 1, 0, 0, 0, 0),
(63, 'mp2', 'video/mpeg audio/mpeg', 'MPEG Audio Stream, Layer II', 1, 0, 0, 0, 0),
(64, 'mp3', 'audio/mpeg audio/x-mpeg audio/mp3 audio/x-mp3 audio/mpeg3 audio/x-mpeg3 audio/mpg audio/x-mpg audio/x-mpegaudio', 'MPEG Audio Stream, Layer III', 1, 1, 0, 0, 0),
(65, 'aif', 'audio/aiff audio/x-aiff sound/aiff audio/rmf audio/x-rmf audio/x-pn-aiff audio/x-gsm audio/x-midi audio/vnd.qcelp', 'Audio Interchange File', 1, 0, 0, 0, 0),
(66, 'aiff', 'audio/aiff audio/x-aiff sound/aiff audio/rmf audio/x-rmf audio/x-pn-aiff audio/x-gsm audio/mid audio/x-midi audio/vnd.qcelp', 'Audio Interchange File', 1, 0, 0, 0, 0),
(67, 'aifc', 'audio/aiff audio/x-aiff audio/x-aifc sound/aiff audio/rmf audio/x-rmf audio/x-pn-aiff audio/x-gsm audio/x-midi audio/mid audio/vnd.qcelp', 'Audio Interchange File', 1, 0, 0, 0, 0),
(68, 'm3u', 'audio/x-mpegurl audio/mpeg-url application/x-winamp-playlist audio/scpls audio/x-scpls', 'MP3 Playlist File', 1, 0, 0, 0, 0),
(69, 'ram', 'audio/x-pn-realaudio audio/vnd.rn-realaudio audio/x-pm-realaudio-plugin audio/x-pn-realvideo audio/x-realaudio video/x-pn-realvideo text/plain', 'RealMedia Metafile', 1, 0, 0, 0, 0),
(70, 'rm', 'application/vnd.rn-realmedia audio/vnd.rn-realaudio audio/x-pn-realaudio audio/x-realaudio audio/x-pm-realaudio-plugin', 'RealMedia Streaming Media', 1, 0, 0, 0, 0),
(71, 'rpm', 'audio/x-pn-realaudio audio/x-pn-realaudio-plugin audio/x-pnrealaudio-plugin video/x-pn-realvideo-plugin audio/x-mpegurl application/octet-stream', 'RealMedia Player Plug-in', 1, 0, 0, 0, 0),
(72, 'ra', 'audio/vnd.rn-realaudio audio/x-pn-realaudio audio/x-realaudio audio/x-pm-realaudio-plugin video/x-pn-realvideo', 'RealMedia Streaming Media', 1, 0, 0, 0, 0),
(73, 'wav', 'audio/wav audio/x-wav audio/wave audio/x-pn-wav', 'Waveform Audio', 1, 0, 0, 0, 0),
(74, 'wax', ' audio/x-ms-wax', 'Windows Media Audio Redirector', 1, 0, 0, 0, 0),
(75, 'wma', 'audio/x-ms-wma video/x-ms-asf', 'Windows Media Audio File', 1, 0, 0, 0, 0),
(76, 'bmp', 'image/bmp image/x-bmp image/x-bitmap image/x-xbitmap image/x-win-bitmap image/x-windows-bmp image/ms-bmp image/x-ms-bmp application/bmp application/x-bmp application/x-win-bitmap application/preview', 'Windows OS/2 Bitmap Graphics', 1, 0, 0, 0, 0),
(77, 'gif', 'image/gif image/x-xbitmap image/gi_', 'Graphic Interchange Format', 1, 0, 0, 0, 0),
(78, 'ief', 'image/ief', 'Image File - Bitmap graphics', 1, 0, 0, 0, 0),
(79, 'jpeg', 'image/jpeg image/jpg image/jpe_ image/pjpeg image/vnd.swiftview-jpeg', 'JPEG/JIFF Image', 1, 0, 0, 0, 0),
(80, 'jpg', 'image/jpeg image/jpg image/jp_ application/jpg application/x-jpg image/pjpeg image/pipeg image/vnd.swiftview-jpeg image/x-xbitmap', 'JPEG/JIFF Image', 1, 0, 0, 0, 0),
(81, 'jpe', 'image/jpeg', 'JPEG/JIFF Image', 1, 0, 0, 0, 0),
(82, 'png', 'image/png application/png application/x-png', 'Portable (Public) Network Graphic', 1, 0, 0, 0, 0),
(83, 'tiff', 'image/tiff', 'Tagged Image Format File', 1, 0, 0, 0, 0),
(84, 'tif', 'image/tif image/x-tif image/tiff image/x-tiff application/tif application/x-tif application/tiff application/x-tiff', 'Tagged Image Format File', 1, 0, 0, 0, 0),
(85, 'ico', 'image/ico image/x-icon application/ico application/x-ico application/x-win-bitmap image/x-win-bitmap application/octet-stream', 'Windows Icon', 1, 0, 0, 0, 0),
(86, 'wbmp', 'image/vnd.wap.wbmp', 'Wireless Bitmap File Format', 1, 0, 0, 0, 0),
(87, 'ras', 'application/ras application/x-ras image/ras', 'Sun Raster Graphic', 1, 0, 0, 0, 0),
(88, 'pnm', 'image/x-portable-anymap', 'PBM Portable Any Map Graphic Bitmap', 1, 0, 0, 0, 0),
(89, 'pbm', 'image/portable bitmap image/x-portable-bitmap image/pbm image/x-pbm', 'UNIX Portable Bitmap Graphic', 1, 0, 0, 0, 0),
(90, 'pgm', 'image/x-portable-graymap image/x-pgm', 'Portable Graymap Graphic', 1, 0, 0, 0, 0),
(91, 'ppm', 'image/x-portable-pixmap application/ppm application/x-ppm image/x-p image/x-ppm', 'PBM Portable Pixelmap Graphic', 1, 0, 0, 0, 0),
(92, 'rgb', 'image/rgb image/x-rgb', 'Silicon Graphics RGB Bitmap', 1, 1, 0, 0, 0),
(93, 'xbm', 'image/x-xpixmap image/x-xbitmap image/xpm image/x-xpm', 'X Bitmap Graphic', 1, 0, 0, 0, 0),
(94, 'xpm', 'image/x-xpixmap', 'BMC Software Patrol UNIX Icon File', 1, 0, 0, 0, 0),
(95, 'xwd', 'image/x-xwindowdump image/xwd image/x-xwd application/xwd application/x-xwd', 'X Windows Dump', 1, 1, 0, 0, 0),
(96, 'igs', 'model/iges application/iges application/x-iges application/igs application/x-igs drawing/x-igs image/x-igs', 'Initial Graphics Exchange Specification Format', 1, 0, 0, 0, 0),
(97, 'css', 'application/css-stylesheet text/css', 'Hypertext Cascading Style Sheet', 1, 0, 0, 0, 0),
(98, 'html', 'text/html text/plain', 'Hypertext Markup Language', 1, 0, 0, 0, 0),
(99, 'htm', 'text/html', 'Hypertext Markup Language', 1, 0, 0, 0, 0),
(100, 'txt', 'text/plain application/txt browser/internal', 'Text File', 1, 0, 0, 0, 0);
INSERT INTO `wgfilemanager_mimetype` (`id`, `extension`, `mime_type`, `descr`, `admin`, `user`, `is_image`, `date_created`, `submitter`) VALUES
(101, 'rtf', 'application/rtf application/x-rtf text/rtf text/richtext application/msword application/doc application/x-soffice', 'Rich Text Format File', 1, 0, 0, 0, 0),
(102, 'wml', 'text/vnd.wap.wml text/wml', 'Website META Language File', 1, 0, 0, 0, 0),
(103, 'wmls', 'text/vnd.wap.wmlscript', 'WML Script', 1, 0, 0, 0, 0),
(104, 'etx', 'text/x-setext', 'SetText Structure Enhanced Text', 1, 0, 0, 0, 0),
(105, 'xml', 'text/xml application/xml application/x-xml', 'Extensible Markup Language File', 1, 0, 0, 0, 0),
(106, 'xsl', 'text/xml', 'XML Stylesheet', 1, 0, 0, 0, 0),
(107, 'php', 'application/x-httpd-php text/php application/php magnus-internal/shellcgi application/x-php', 'PHP Script', 1, 0, 0, 0, 0),
(108, 'php3', 'text/php3 application/x-httpd-php', 'PHP Script', 1, 0, 0, 0, 0),
(109, 'mpeg', 'video/mpeg', 'MPEG Movie', 1, 0, 0, 0, 0),
(110, 'mpg', 'video/mpeg video/mpg video/x-mpg video/mpeg2 application/x-pn-mpg video/x-mpeg video/x-mpeg2a audio/mpeg audio/x-mpeg image/mpg', 'MPEG 1 System Stream', 1, 0, 0, 0, 0),
(111, 'mpe', 'video/mpeg', 'MPEG Movie Clip', 1, 0, 0, 0, 0),
(112, 'qt', 'video/quicktime audio/aiff audio/x-wav video/flc', 'QuickTime Movie', 1, 0, 0, 0, 0),
(113, 'mov', 'video/quicktime video/x-quicktime image/mov audio/aiff audio/x-midi audio/x-wav video/avi', 'QuickTime Video Clip', 1, 0, 0, 0, 0),
(114, 'avi', 'video/avi video/msvideo video/x-msvideo image/avi video/xmpg2 application/x-troff-msvideo audio/aiff audio/avi', 'Audio Video Interleave File', 1, 0, 0, 0, 0),
(115, 'movie', 'video/sgi-movie video/x-sgi-movie', 'QuickTime Movie', 1, 0, 0, 0, 0),
(116, 'asf', 'audio/asf application/asx video/x-ms-asf-plugin application/x-mplayer2 video/x-ms-asf application/vnd.ms-asf video/x-ms-asf-plugin video/x-ms-wm video/x-ms-wmx', 'Advanced Streaming Format', 1, 0, 0, 0, 0),
(117, 'asx', 'video/asx application/asx video/x-ms-asf-plugin application/x-mplayer2 video/x-ms-asf application/vnd.ms-asf video/x-ms-asf-plugin video/x-ms-wm video/x-ms-wmx video/x-la-asf', 'Advanced Stream Redirector File', 1, 0, 0, 0, 0),
(118, 'wmv', 'video/x-ms-wmv', 'Windows Media File', 1, 0, 0, 0, 0),
(119, 'wvx', 'video/x-ms-wvx', 'Windows Media Redirector', 1, 0, 0, 0, 0),
(120, 'wm', 'video/x-ms-wm', 'Windows Media A/V File', 1, 0, 0, 0, 0),
(121, 'wmx', 'video/x-ms-wmx', 'Windows Media Player A/V Shortcut', 1, 0, 0, 0, 0),
(122, 'ice', 'x-conference-xcooltalk', 'Cooltalk Audio', 1, 0, 0, 0, 0),
(123, 'rar', 'application/octet-stream', 'WinRAR Compressed Archive', 1, 0, 0, 0, 0),
(124, 'mp4', 'video/mp4', 'MPEG-4', 1, 0, 0, 0, 0),
(125, 'flv', 'video/x-flv', 'Flash Video', 1, 0, 0, 0, 0),
(126, 'm3u8', 'application/x-mpegURL', 'iPhone Index', 0, 0, 0, 0, 0),
(127, 'ts', 'video/MP2T', 'iPhone Segment', 0, 0, 0, 0, 0),
(128, '3gp', 'video/3gpp', '3GP Mobile', 0, 0, 0, 0, 0),
(129, 'docm', 'application/vnd.ms-word.document.macroEnabled.12', 'Office 2007 MS Word', 0, 0, 0, 0, 0),
(130, 'docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'Office 2007 MS Word', 1, 0, 0, 0, 0),
(131, 'dotm', 'application/vnd.ms-word.template.macroEnabled.12', 'Office 2007 MS Word', 0, 0, 0, 0, 0),
(132, 'dotx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.template', 'Office 2007 MS Word', 0, 0, 0, 0, 0),
(133, 'ppsm', 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12', 'Office 2007 MS Powerpoint', 0, 0, 0, 0, 0),
(134, 'ppsx', 'application/vnd.openxmlformats-officedocument.presentationml.slideshow', 'Office 2007 MS Powerpoint', 0, 0, 0, 0, 0),
(135, 'pptm', 'application/vnd.ms-powerpoint.presentation.macroEnabled.12', 'Office 2007 MS Powerpoint', 0, 0, 0, 0, 0),
(136, 'pptx', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'Office 2007 MS Powerpoint', 1, 0, 0, 0, 0),
(137, 'xlsb', 'application/vnd.ms-excel.sheet.binary.macroEnabled.12', 'Office 2007 MS Excel', 0, 0, 0, 0, 0),
(138, 'xlsm', 'application/vnd.ms-excel.sheet.macroEnabled.12', 'Office 2007 MS Excel', 0, 0, 0, 0, 0),
(139, 'xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'Office 2007 MS Excel', 1, 0, 0, 0, 0),
(140, 'xps', 'application/vnd.ms-xpsdocument', 'Office 2007 MS Excel', 0, 0, 0, 0, 0);

