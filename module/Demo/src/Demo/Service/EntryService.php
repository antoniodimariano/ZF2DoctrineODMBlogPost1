<?php
/**
 * User   : Antonio Di Mariano
 * email  : antonio.dimariano@gmail.com
 * github : https://github.com/antoniodimariano
 * Date: 29/04/14
 * Time: 11:52
 */
namespace Demo\Service;

use Demo\Entity\Entry;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;


class EntryService implements EventManagerAwareInterface {

    /**
     * @var \Zend\EventManager\EventManager\Interface
     */

    private $eventManager;

    /**
     * @var \Demo\Mapper\EntryMapper Demo Mapper
     */
    private $I_mapper = null;

    /**
     * Constructs service
     * @params \Demo\Mapper\EntryMapper Demo Mapper
     *
     */
    public function __construct(\Demo\Mapper\EntryMapper $I_mapper) {
        $this->I_mapper = $I_mapper;
    }




    /**
     * Get Structures List
     *
     * @param empty
     * @return array List of Structure
     */
    public function getList() {
        return $this->I_mapper->findAll();
    }

    public function findById($id) {
        return $this->I_mapper->find($id);
    }

    public function save($entry) {
        return $this->I_mapper->save($entry);
    }

    public function delete($entry) {
        return $this->I_mapper->remove($entry);
    }


    /**
     * Injects Event Manager (ZF2 component) into this class
     *
     * @see \Zend\EventManager\EventManagerAwareInterface::setEventManager()
     */
    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(
            __CLASS__,
            get_called_class(),
        ));
        $this->eventManager = $events;
        return $this;
    }

    /**
     * Fetches Event Manager (ZF2 component) from this class
     *
     * @see \Zend\EventManager\EventsCapableInterface::getEventManager()
     */
    public function getEventManager()
    {
        if (null === $this->eventManager) {
            $this->setEventManager(new EventManager());
        }
        return $this->eventManager;
    }


}