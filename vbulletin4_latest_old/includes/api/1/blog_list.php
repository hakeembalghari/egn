<?php
/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.2.2 Patch Level 1 - Licence Number VBFA489C88
|| # ---------------------------------------------------------------- # ||
|| # Copyright �2000-2014 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/
if (!VB_API) die;

define('VB_API_LOADLANG', true);

loadCommonWhiteList();

$VB_API_WHITELIST = array(
	'response' => array(
		'content' => array(
			'blogheader',
			'featured_blogbits' => array(
				'*' => array(
					'blog' => $VB_API_WHITELIST_COMMON['blog'],
					'show' => array('postcomment')
				)
			), 'display',
			'recentblogbits' => array(
				'*' => array(
					'updated' => $VB_API_WHITELIST_COMMON['blog'],
					'show' => array('postcomment')
				)
			),
			'recentcommentbits',
			'blogbits' => array(
				'*' => array(
					'blog' => $VB_API_WHITELIST_COMMON['blog'],
					'show' => array('postcomment')
				)
			), 'blogcategoryid', 'blogtype',
			'categoryinfo', 'day', 'month', 'pagenav', 'selectedfilter',
			'userinfo' => array('userid', 'username'), 'year'
		),
		'sidebar' => $VB_API_WHITELIST_COMMON['blogsidebarcategory']
	)
);

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 03:05, Wed Apr 16th 2014
|| # CVS: $RCSfile$ - $Revision: 35584 $
|| ####################################################################
\*======================================================================*/