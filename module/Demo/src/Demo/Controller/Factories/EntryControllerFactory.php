<?php
/**
 * Created by PhpStorm.
 * User: hellbreak
 * Date: 29/04/14
 * Time: 01:40
 */
namespace Demo\Controller;

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