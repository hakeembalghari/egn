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

loadCommonWhiteList();

$VB_API_WHITELIST = array(
	'response' => array(
		'albumbits' => $VB_API_WHITELIST_COMMON['albumbits'],
		'latestbits' => $VB_API_WHITELIST_COMMON['albumbits'],
		'latest_pagenav' => $VB_API_WHITELIST_COMMON['pagenav'],
		'pagenav' => $VB_API_WHITELIST_COMMON['pagenav'],
		'userinfo' => array(
			'userid', 'username'
		)
	),
	'show' => array(
		'personalalbum', 'moderated', 'add_album_option'
	)
);

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 03:05, Wed Apr 16th 2014
|| # CVS: $RCSfile$ - $Revision: 35584 $
|| ####################################################################
\*======================================================================*/