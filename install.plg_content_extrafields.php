<?php
defined('_JEXEC') or die('Restricted access');

class plgcontentextrafieldsInstallerScript
{
	/*
	 * Method to install the component
	 * 
	 * @return void
	 */
	function install($parent)
	{
		$lang = JFactory::getLanguage();
		$lang->load('plg_content_extrafields', JPATH_ADMINISTRATOR);
	}
	
	/*
	 * Method to uninstall the component
	 * 
	 * @return void
	 */
	function uninstall($parent)
	{
	}
	
	/*
	 * Method to update the component
	 * 
	 * @return void
	 */
	function update($parent)
	{
		$lang = JFactory::getLanguage();
		$lang->load('plg_content_extrafields', JPATH_ADMINISTRATOR);
	}
	
	/*
	 * Method to run before an install/update/uninstall method
	 * 
	 * @return void
	 */
	function preflight($type, $parent)
	{
	}
	
	/*
	 * Method to run after an install/update/uninstall method
	 * 
	 * @return void
	 */
	function postflight($type, $parent)
	{
		if($type == 'install')
		{
		}
	}
}
?>