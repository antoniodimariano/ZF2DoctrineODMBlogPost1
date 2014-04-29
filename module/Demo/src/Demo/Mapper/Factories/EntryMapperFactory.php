<?php
/**
 * User   : Antonio Di Mariano
 * email  : antonio.dimariano@gmail.com
 * github : https://github.com/antoniodimariano
 * Date: 29/04/14
 * Time: 15:25
 */



/*
 *
 * Old way to use the DocumentManager
 *
'DemoEntryMapper' => function($sm) {
    $dm = $sm->get('doctrine.documentmanager.odm_default');
    return new EntryMapper($dm, $dm->getRepository('Demo\Entity\Entry'));
*/

namespace Demo\Mapper\Factories;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntryMapperFactory implements FactoryInterface {


        public function createService(ServiceLocatorInterface $serviceLocator) {
            //Dependencies are fetched from Service Manager
            $documentManager = $serviceLocator->get('doctrine.documentmanager.odm_default');
            return new \Demo\Mapper\EntryMapper($documentManager, $documentManager->getRepository('Demo\Entity\Entry'));

        }
    }