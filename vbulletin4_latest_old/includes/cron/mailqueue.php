<?php
/*======================================================================*\
|| #################################################################### ||
|| # vBulletin Blog 4.2.2 Patch Level 1 - Licence Number VBFA489C88
|| # ---------------------------------------------------------------- # ||
|| # Copyright �2000-2014 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/

// ######################## SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE);
if (!is_object($vbulletin->db))
{
	exit;
}

if ($vbulletin->options['mailqueue'])
{
	exec_mail_queue();
}

log_cron_action('', $nextitem, 1);

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 03:05, Wed Apr 16th 2014
|| # CVS: $Revision: 25612 $
|| ####################################################################
\*======================================================================*/
