<?php
/**
 * User   : Antonio Di Mariano
 * email  : antonio.dimariano@gmail.com
 * github : https://github.com/antoniodimariano
 * Date: 29/04/14
 * Time: 01:40
 */
namespace Demo\Controller\Factories;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class EntryControllerFactory implements FactoryInterface {

    /**
     * Default method to be used in a Factory Class
     *
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {

        // Create Object graph
        $eventService = $serviceLocator->getServiceLocator()->get('Demo\Service\EntryService');



        // Controller is constructed, dependencies are injected (IoC inb action )
        $controller = new \Demo\Controller\EntryController($eventService);
        return $controller;


    }



}