<?php
/*
 * @package     Bmws Site System Plugin
 * @version     __DEPLOY_VERSION__
 * @author      SEOexpert Studio - seoexpert.by
 * @copyright   Copyright (c) 2025 SEOexpert Studio. All Rights Reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link        https://seoexpert.by/
 */

namespace Joomla\Plugin\System\Bmws\Extension;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryAwareTrait;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\SubscriberInterface;

\defined('_JEXEC') or die;
class Bmws extends CMSPlugin implements SubscriberInterface
{
	use MVCFactoryAwareTrait;

	/**
	 * Load the language file on instantiation.
	 *
	 * @var    bool
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	protected $autoloadLanguage = true;

	/**
	 * Loads the application object.
	 *
	 * @var  \Joomla\CMS\Application\CMSApplication
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	protected $app = null;

	/**
	 * Loads the database object.
	 *
	 * @var  \Joomla\Database\DatabaseDriver
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	protected $db = null;

	/**
	 * Returns an array of events this subscriber will listen to.
	 *
	 * @return  array
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public static function getSubscribedEvents(): array
	{
		return [

			];
	}

}