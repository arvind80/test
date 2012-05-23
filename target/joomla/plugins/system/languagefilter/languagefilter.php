<?php
/**
 * @version		$Id: languagefilter.php 22363 2011-11-08 12:09:34Z github_bot $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.language.helper');
jimport('joomla.plugin.plugin');

/**
 * Joomla! Language Filter Plugin
 *
 * @package		Joomla.Plugin
 * @subpackage	System.languagefilter
 * @since		1.6
 */
class plgSystemLanguageFilter extends JPlugin
{
	protected static $mode_sef;
	protected static $tag;
	protected static $sefs;
	protected static $lang_codes;

	protected static $default_lang;
	protected static $default_sef;

	private static $_user_lang_code;

	public function __construct(&$subject, $config)
	{
		// Ensure that constructor is called one time
		if (!self::$default_lang) {
			$app = JFactory::getApplication();
			$router = $app->getRouter();
			if ($app->isSite()) {
				// setup language data
				self::$mode_sef 	= ($router->getMode() == JROUTER_MODE_SEF) ? true : false;
				self::$sefs 		= JLanguageHelper::getLanguages('sef');
				self::$lang_codes 	= JLanguageHelper::getLanguages('lang_code');
				self::$default_lang = JComponentHelper::getParams('com_languages')->get('site', 'en-GB');
				self::$default_sef 	= self::$lang_codes[self::$default_lang]->sef;

				$app->setLanguageFilter(true);
				$uri = JFactory::getURI();
				if (self::$mode_sef) {
					// Get the route path from the request.
					$path = JString::substr($uri->toString(), JString::strlen($uri->base()));

					// Apache mod_rewrite is Off
					$path = JFactory::getConfig()->get('sef_rewrite') ? $path : JString::substr($path, 10);

					// Trim any spaces or slashes from the ends of the path and explode into segments.
					$path  = JString::trim($path, '/ ');
					$parts = explode('/', $path);

					// The language segment is always at the beginning of the route path if it exists.
					$sef = $uri->getVar('lang');

					if (!empty($parts) && empty($sef)) {
						$sef = reset($parts);
					}
				}
				else {
					$sef = $uri->getVar('lang');
				}
				if (isset(self::$sefs[$sef])) {
					$lang_code = self::$sefs[$sef]->lang_code;
					// Create a cookie
					$conf = JFactory::getConfig();
					$cookie_domain 	= $conf->get('config.cookie_domain', '');
					$cookie_path 	= $conf->get('config.cookie_path', '/');
					setcookie(JUtility::getHash('language'), $lang_code, time() + 365 * 86400, $cookie_path, $cookie_domain);
					// set the request var
					JRequest::setVar('language',$lang_code);
				}
			}
			parent::__construct($subject, $config);
			// 	Detect browser feature
			if ($app->isSite()) {
				$app->setDetectBrowser($this->params->get('detect_browser', '1')=='1');
			}
		}
	}

	public function onAfterInitialise()
	{
		$app = JFactory::getApplication();
		$app->set('menu_associations', $this->params->get('menu_associations', 0));
		if ($app->isSite()) {
			self::$tag = JFactory::getLanguage()->getTag();

			$router = $app->getRouter();
			// attach build rules for language SEF
			$router->attachBuildRule(array($this, 'buildRule'));

			// attach parse rules for language SEF
			$router->attachParseRule(array($this, 'parseRule'));

			// Adding custom site name
			$languages = JLanguageHelper::getLanguages('lang_code');
			if (isset($languages[self::$tag]) && $languages[self::$tag]->sitename) {
				JFactory::getConfig()->set('sitename', $languages[self::$tag]->sitename) ;
			}
		}
	}

	public function buildRule(&$router, &$uri)
	{
		$sef = $uri->getVar('lang');
		if (empty($sef)) {
			$sef = self::$lang_codes[self::$tag]->sef;
		}
		elseif (!isset(self::$sefs[$sef])) {
			$sef = self::$default_sef;
		}

		$Itemid = $uri->getVar('Itemid');
		if (!is_null($Itemid)) {
			if ($item = JFactory::getApplication()->getMenu()->getItem($Itemid))
			{
				if ($item->home && $uri->getVar('option')!='com_search')
				{
					$link = $item->link;
					$parts = JString::parse_url($link);
					if (isset ($parts['query']) && strpos($parts['query'], '&amp;')) {
						$parts['query'] = str_replace('&amp;', '&', $parts['query']);
					}
					parse_str($parts['query'], $vars);

					// test if the url contains same vars as in menu link
					$test = true;
					foreach ($vars as $key=>$value)
					{
						if ($uri->hasVar($key) && $uri->getVar($key) != $value)
						{
							$test = false;
							break;
						}
					}
					if ($test) {
						foreach ($vars as $key=>$value)
						{
							$uri->delVar($key);
						}
						$uri->delVar('Itemid');
					}
				}
			}
			else
			{
				$uri->delVar('Itemid');
			}
		}

		if (self::$mode_sef) {
			$uri->delVar('lang');
			if ($this->params->get('remove_default_prefix', 0) == 0 || $sef != self::$default_sef || $sef != self::$lang_codes[self::$tag]->sef)
			{
				$uri->setPath($uri->getPath().'/'.$sef.'/');
			}
			else
			{
				$uri->setPath($uri->getPath());
			}
		}
		else {
			$uri->setVar('lang', $sef);
		}
	}

	public function parseRule(&$router, &$uri)
	{
		$array = array();
		$lang_code = JRequest::getString(JUtility::getHash('language'), null ,'cookie');
		// No cookie - let's try to detect browser language or use site default
		if (!$lang_code) {
			if ($this->params->get('detect_browser', 1)){
				$lang_code = JLanguageHelper::detectLanguage();
			} else {
				$lang_code = self::$default_sef;
 			}
		}
		if (self::$mode_sef) {
			$path = $uri->getPath();
			$parts = explode('/', $path);

			$sef = $parts[0];

			$app = JFactory::getApplication();

			// Redirect only if not in post
			$post = JRequest::get('POST');
			if (JRequest::getMethod() != "POST" || count($post) == 0)
			{
				if ($this->params->get('remove_default_prefix', 0) == 0)
				{
					// redirect if sef does not exists
					if (!isset(self::$sefs[$sef]))
					{
						// Use the current language sef or the default one
						$sef = isset(self::$lang_codes[$lang_code]) ? self::$lang_codes[$lang_code]->sef : self::$default_sef;
						$uri->setPath($sef . '/' . $path);

						if ($app->getCfg('sef_rewrite')) {
							$app->redirect($uri->base().$uri->toString(array('path', 'query', 'fragment')));
						}
						else {
							$path = $uri->toString(array('path', 'query', 'fragment'));
							$app->redirect($uri->base().'index.php'.($path ? ('/' . $path) : ''));
						}
					}
				}
				else
				{
					// redirect if sef does not exists and language is not the default one
					if (!isset(self::$sefs[$sef]) && $lang_code != self::$default_lang)
					{
						$sef = isset(self::$lang_codes[$lang_code]) ? self::$lang_codes[$lang_code]->sef : self::$default_sef;
						$uri->setPath($sef . '/' . $path);

						if ($app->getCfg('sef_rewrite')) {
							$app->redirect($uri->base().$uri->toString(array('path', 'query', 'fragment')));
						}
						else {
							$path = $uri->toString(array('path', 'query', 'fragment'));
							$app->redirect($uri->base().'index.php'.($path ? ('/' . $path) : ''));
						}
					}
					// redirect if sef is the default one
					elseif ($sef == self::$default_sef)
					{
						array_shift($parts);
						$uri->setPath(implode('/' , $parts));

						if ($app->getCfg('sef_rewrite')) {
							$app->redirect($uri->base().$uri->toString(array('path', 'query', 'fragment')));
						}
						else {
							$path = $uri->toString(array('path', 'query', 'fragment'));
							$app->redirect($uri->base().'index.php'.($path ? ('/' . $path) : ''));
						}
					}
				}
			}

			$lang_code = isset(self::$sefs[$sef]) ? self::$sefs[$sef]->lang_code : '';
			if ($lang_code && JLanguage::exists($lang_code)) {
				array_shift($parts);
				$uri->setPath(implode('/', $parts));
			}
		}
		else {
			$sef = $uri->getVar('lang');
			if (!isset(self::$sefs[$sef])) {
				$sef = isset(self::$lang_codes[$lang_code]) ? self::$lang_codes[$lang_code]->sef : self::$default_sef;
				$uri->setVar('lang', $sef);
				$post = JRequest::get('POST');
				if (JRequest::getMethod() != "POST" || count($post) == 0)
				{
					$app = JFactory::getApplication();
					$app->redirect(JURI::base(true).'/index.php?'.$uri->getQuery());
				}
			}
		}

		$array = array('lang' => $sef);
		return $array;
	}
	/**
	 * before store user method
	 *
	 * Method is called before user data is stored in the database
	 *
	 * @param	array		$user	Holds the old user data.
	 * @param	boolean		$isnew	True if a new user is stored.
	 * @param	array		$new	Holds the new user data.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public function onUserBeforeSave($user, $isnew, $new)
	{
		if ($this->params->get('automatic_change', '1')=='1' && key_exists('params', $user))
		{
			$registry = new JRegistry();
			$registry->loadString($user['params']);
			self::$_user_lang_code = $registry->get('language');
			if (empty(self::$_user_lang_code)) {
				self::$_user_lang_code = self::$default_lang;
			}
		}
	}


	/**
	 * after store user method
	 *
	 * Method is called after user data is stored in the database
	 *
	 * @param	array		$user		Holds the new user data.
	 * @param	boolean		$isnew		True if a new user is stored.
	 * @param	boolean		$success	True if user was succesfully stored in the database.
	 * @param	string		$msg		Message.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public function onUserAfterSave($user, $isnew, $success, $msg)
	{
		if ($this->params->get('automatic_change', '1')=='1' && key_exists('params', $user) && $success)
		{
			$registry = new JRegistry();
			$registry->loadString($user['params']);
			$lang_code = $registry->get('language');
			if (empty($lang_code)) {
				$lang_code = self::$default_lang;
			}
			$app = JFactory::getApplication();
			if ($lang_code == self::$_user_lang_code || !isset(self::$lang_codes[$lang_code]))
			{
				if ($app->isSite())
				{
					$app->setUserState('com_users.edit.profile.redirect',null);
				}
			}
			else
			{
				if ($app->isSite())
				{
					$app->setUserState('com_users.edit.profile.redirect','index.php?Itemid='.$app->getMenu()->getDefault($lang_code)->id.'&lang='.$lang_codes[$lang_code]->sef);
					self::$tag = $lang_code;
					// Create a cookie
					$conf = JFactory::getConfig();
					$cookie_domain 	= $conf->get('config.cookie_domain', '');
					$cookie_path 	= $conf->get('config.cookie_path', '/');
					setcookie(JUtility::getHash('language'), $lang_code, time() + 365 * 86400, $cookie_path, $cookie_domain);
				}
			}
		}
	}

	/**
	 * This method should handle any login logic and report back to the subject
	 *
	 * @param	array	$user		Holds the user data
	 * @param	array	$options	Array holding options (remember, autoregister, group)
	 *
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	public function onUserLogin($user, $options = array())
	{
		$app = JFactory::getApplication();
		if ($app->isSite())
		{
			if ($this->params->get('automatic_change', 1)) {
				$lang_code = $user['language'];
				if (empty($lang_code)) {
					$lang_code = self::$default_lang;
				}
				self::$tag = $lang_code;
				// Create a cookie
				$conf = JFactory::getConfig();
				$cookie_domain 	= $conf->get('config.cookie_domain', '');
				$cookie_path 	= $conf->get('config.cookie_path', '/');
				setcookie(JUtility::getHash('language'), $lang_code, time() + 365 * 86400, $cookie_path, $cookie_domain);
			}
		}
	}
}
