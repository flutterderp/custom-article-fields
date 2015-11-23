<?php
defined('_JEXEC') or die('Restricted access');
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

class plgContentExtrafields extends JPlugin
{
	protected $autoloadLanguage = true;
	
	// Load our custom fields
	function onContentPrepareForm($form, $data) {
		$app		= JFactory::getApplication();
		$option	= $app->input->get('option');
		
		switch($option)
		{
			case 'com_content' :
				if($app->isAdmin())
				{
					JForm::addFormPath(__DIR__ . '/forms');
					$form->loadFile('content', false);
				}
				return true;
				break;
		}
		return true;
	}
	
	// Save to custom table
	public function onContentAfterSave($context = null, $article = null, $isNew = 0)
	{
		$app	= JFactory::getApplication();
		
		if($context == 'com_categories.category')
		{
			/*$params			= new JRegistry;
			$params->loadString($article->params);
			$my_params	= $params->toObject();*/
		}
		elseif($context=='com_content.article')
		{
			$attribs		= new JRegistry;
			$attribs->loadString($article->attribs);
			$db					= JFactory::getDbo();
			$sql				= $db->getQuery(true);
			$my_params	= $attribs->toObject();
			$app->enqueueMessage($my_params->site_share, 'notice');
			
			$sql->select('*')->from($db->quoteName('#__content_extras'))->where('id = ' . (int) $article->id)->setLimit(1);
			$db->setQuery($sql);
			
			try
			{
				$db->execute();
				if($db->getAffectedRows() == 1)
				{
					// Update extra fields
					$sql->clear();
					$sql->update($db->quoteName('#__content_extras'))->set('site_share = ' . (int) $my_params->site_share)->where('id = ' . (int) $article->id);
					$db->setQuery($sql);
					
					try
					{
						$db->execute();
					}
					catch(RuntimeException $e)
					{
						$app->enqueueMessage($e->getMessage(), 'error');
					}
				}
				else
				{
					// Article doesn't have extra fields for some reason
					$tbl_cols	= array('id', 'site_share');
					$tbl_vals	= array((int) $article->id, (int) $my_params->site_share);
					$sql->clear();
					$sql->insert($db->quoteName('#__content_extras'))->columns($db->quoteName($tbl_cols))->values(implode(',', $tbl_vals));
					$db->setQuery($sql);
					
					try
					{
						$db->execute();
					}
					catch(RuntimeException $e)
					{
						$app->enqueueMessage($e->getMessage(), 'error');
					}
				}
			}
			catch(RuntimeException $e)
			{
				$app->enqueueMessage($e->getMessage(), 'error');
			}
			
		}
	}
	
}
