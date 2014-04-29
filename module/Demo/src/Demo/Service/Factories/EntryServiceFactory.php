<?php
/**
 * User   : Antonio Di Mariano
 * email  : antonio.dimariano@gmail.com
 * github : https://github.com/antoniodimariano
 * Date: 29/04/14
 * Time: 01:42
 */
namespace Demo\Service\Factories;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class EntryServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $mapper = $serviceLocator->get('Demo\Mapper\EntryMapper');
        return new \Demo\Service\EntryService($mapper);
    }
}