<?php
/*
 * @package     Autosvet Site Package
 * @version     __DEPLOY_VERSION__
 * @author      CaveDesign Studio - cavedesign.ru
 * @copyright   Copyright (c) 2009 - 2025 CaveDesign Studio. All Rights Reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link        https://cavedesign.ru/
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Joomla\Plugin\System\Bmws\Extension\Bmws;

return new class implements ServiceProviderInterface {

	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function register(Container $container)
	{
		$container->registerServiceProvider(new MVCFactory('Joomla\\Component\\RadicalMart'));

		$container->set(PluginInterface::class,
			function (Container $container) {
				$plugin     = PluginHelper::getPlugin('system', 'bmws');
				$subject    = $container->get(DispatcherInterface::class);

				$plugin = new Bmws($subject, (array) $plugin);
				$plugin->setApplication(Factory::getApplication());

				return $plugin;
			}
		);
	}
};
