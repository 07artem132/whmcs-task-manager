<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 21.04.2019
 * Time: 16:41
 */

namespace WHMCS\Module\Addon\TaskManager\Pages;

use Smarty;
use WHMCS\Module\Addon\TaskManager\Configs\SmartyConfig;
use WHMCS\Scheduling\Task\AbstractTask;

class AdminCronViewPage {
	/**
	 * @throws \SmartyException
	 */
	function render() {
		global $customadminpath;
		$smarty = new Smarty;
		$smarty->setCompileDir( SmartyConfig::GetCompileDir() );
		$smarty->setTemplateDir( SmartyConfig::GetTemplateDir() );
		$smarty->assign( 'adminPath', $customadminpath );
		$smarty->assign( 'tasks', AbstractTask::all() );
		$smarty->display( SmartyConfig::GetTemplateDir() . "AdminCronView.tpl" );
	}
}