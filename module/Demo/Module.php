<?php
/**
 * User   : Antonio Di Mariano
 * email  : antonio.dimariano@gmail.com
 * github : https://github.com/antoniodimariano
 * Date: 29/04/14
 * Time: 11:52
 */
namespace Demo;

use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(


            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }
    public function onBootstrap(MvcEvent $e)
    {
        /*
         *   You may not need to do this if
         *   you're doing it elsewhere in your application
         *
         */

        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getControllerConfig() {

        return array(
            'factories' => array(
                /*
                 * Our controller has some dependencies which can be injected in.
                 * We use a Factory to do the job
                 */
                'Demo\Controller\Entry' => 'Demo\Controller\Factories\EntryControllerFactory',
            ),
        );

    }

    public function getServiceConfig()
    {
        return array(
            //Our Entry takes not parameters

            'invokables' => array(
                'DemoEntry' => 'Demo\Entity\Entry',
            ),

            /*
             * Our service and mapper have some dependencies which can be injected in.
             * We use the a Factory for each ones
             */

            'factories' => array(

                'Demo\Service\EntryService'  => 'Demo\Service\Factories\EntryServiceFactory',
                'Demo\Mapper\EntryMapper'    => 'Demo\Mapper\Factories\EntryMapperFactory',

            ),

            //The Entry entity should be unique

            'shared' => array(
                'DemoEntry' => false
            ),

        );
    }
}
