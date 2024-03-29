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

if (!isset($GLOBALS['vbulletin']->db))
{
	exit;
}

class vB_Upgrade_367 extends vB_Upgrade_Version
{
	/*Constants=====================================================================*/

	/*Properties====================================================================*/

	/**
	* The short version of the script
	*
	* @var	string
	*/
	public $SHORT_VERSION = '367';

	/**
	* The long version of the script
	*
	* @var	string
	*/
	public $LONG_VERSION  = '3.6.7';

	/**
	* Versions that can upgrade to this script
	*
	* @var	string
	*/
	public $PREV_VERSION = '3.6.6';

	/**
	* Beginning version compatibility
	*
	* @var	string
	*/
	public $VERSION_COMPAT_STARTS = '';

	/**
	* Ending version compatibility
	*
	* @var	string
	*/
	public $VERSION_COMPAT_ENDS   = '';

	/**
	* Step #1
	*
	*/
	function step_1()
	{
		$this->show_message($this->phrase['version']['367']['remove_calendar_xss_fix']);
		require_once(DIR . '/includes/adminfunctions_plugin.php');
		delete_product('vb_calendar366_xss_fix', true);
	}
}

/*======================================================================*\
|| ####################################################################
|| # Downloaded: 03:05, Wed Apr 16th 2014
|| # CVS: $RCSfile$ - $Revision: 35750 $
|| ####################################################################
\*======================================================================*/
