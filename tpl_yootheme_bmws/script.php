<?php
/*
 * @package     Bmws Site Template
 * @version     __DEPLOY_VERSION__
 * @author      SEOexpert Studio - seoexpert.by
 * @copyright   Copyright (c) 2025 SEOexpert Studio. All Rights Reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link        https://seoexpert.by/
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Application\AdministratorApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Installer\Installer;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Version;
use Joomla\Database\DatabaseDriver;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Filesystem\Folder;
use Joomla\Filesystem\File;
use Joomla\Filesystem\Path;
use Joomla\Registry\Registry;

return new class () implements ServiceProviderInterface {
	public function register(Container $container)
	{
		$container->set(InstallerScriptInterface::class, new class ($container->get(AdministratorApplication::class)) implements InstallerScriptInterface {
			/**
			 * The application object
			 *
			 * @var  AdministratorApplication
			 *
			 * @since  1.0.0
			 */
			protected AdministratorApplication $app;

			/**
			 * The Database object.
			 *
			 * @var   DatabaseDriver
			 *
			 * @since  1.0.0
			 */
			protected DatabaseDriver $db;

			/**
			 * Constructor.
			 *
			 * @param   AdministratorApplication  $app  The application object.
			 *
			 * @since 1.0.0
			 */
			public function __construct(AdministratorApplication $app)
			{
				$this->app = $app;
				$this->db  = Factory::getContainer()->get('DatabaseDriver');
			}

			/**
			 * Function called after the extension is installed.
			 *
			 * @param   InstallerAdapter  $adapter  The adapter calling this method
			 *
			 * @return  boolean  True on success
			 *
			 * @since   1.0.0
			 */
			public function install(InstallerAdapter $adapter): bool
			{
				return true;
			}

			/**
			 * Function called after the extension is updated.
			 *
			 * @param   InstallerAdapter  $adapter  The adapter calling this method
			 *
			 * @return  boolean  True on success
			 *
			 * @since   1.0.0
			 */
			public function update(InstallerAdapter $adapter): bool
			{
				return true;
			}

			/**
			 * Function called after the extension is uninstalled.
			 *
			 * @param   InstallerAdapter  $adapter  The adapter calling this method
			 *
			 * @return  boolean  True on success
			 *
			 * @since   1.0.0
			 */
			public function uninstall(InstallerAdapter $adapter): bool
			{
				return true;
			}

			/**
			 * Function called before extension installation/update/removal procedure commences.
			 *
			 * @param   string            $type     The type of change (install or discover_install, update, uninstall)
			 * @param   InstallerAdapter  $adapter  The adapter calling this method
			 *
			 * @return  boolean  True on success
			 *
			 * @since   1.0.0
			 */
			public function preflight(string $type, InstallerAdapter $adapter): bool
			{
				return true;
			}

			/**
			 * Function called after extension installation/update/removal procedure commences.
			 *
			 * @param   string            $type     The type of change (install or discover_install, update, uninstall)
			 * @param   InstallerAdapter  $adapter  The adapter calling this method
			 *
			 * @return  boolean  True on success
			 *
			 * @since   1.0.0
			 */
			public function postflight(string $type, InstallerAdapter $adapter): bool
			{
				if ($type !== 'uninstall')
				{
					$this->checkTemplateParams();
				}

				return true;
			}

			protected function checkTemplateParams()
			{
				$db    = $this->db;
				$query = $db->getQuery(true)
					->select(['id', 'params'])
					->from($db->quoteName('#__template_styles'))
					->where($db->quoteName('template') . ' = ' . $db->quote('yootheme_bmws'));
				if (!$update = $db->setQuery($query, 0, 1)->loadObject())
				{
					return;
				}

				$update->params = new Registry($update->params);
				if (empty($update->params->get('config')))
				{
					$query = $db->getQuery(true)
						->select(['params'])
						->from($db->quoteName('#__template_styles'))
						->where($db->quoteName('template') . ' = ' . $db->quote('yootheme'));
					if (!$source = $db->setQuery($query, 0, 1)->loadResult())
					{
						return;
					}

					$source              = (new Registry($source));
					$config              = json_decode($source->get('config', '{}'));
					$config->child_theme = 'bmws';
					$config->style       = 'bmws';

					$update->params->set('config', json_encode($config));
					$update->params = $update->params->toString();

					$db->updateObject('#__template_styles', $update, 'id');
				}
			}
		});
	}
};