<?php

namespace Demo\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
//use Demo\Mapper\EntryMapper;
use Demo\Entity\Entry;
use Zend\Mvc\Controller\AbstractActionController;


/**
 * Basic action controller which will return json responses instead of
 * html views 
 * 
 * @author Steve
 * @review Antonio Di Mariano
 *
 * email  : antonio.dimariano@gmail.com
 * github : https://github.com/antoniodimariano
 *
 */
class EntryController extends AbstractActionController
{
    private $entryService = null;


    public function __construct(\Demo\Service\EntryService $entryService) {

        $this->entryService = $entryService;
    }


    /*
     * If an id is passed to the route, then this will return an array containing only that entry
     * If no id, all entry will be listed
     */
    public function listAction()
    {
        $id = $this->params()->fromRoute('id');
        $result = [];
        if($id != null)
        {
            //$result = [$this->getEntryMapper()->find($id)];
            $result = [$this->entryService->findById($id)];
        }
        else 
        {
            //$result = $this->getEntryMapper()->findAll();
            $result = $this->entryService->getList();

        }


       return new JsonModel($result);
    }
    
    /*
     * Remove the entry represented by the id given
     */
    public function removeAction()
    {
        $id = $this->params()->fromRoute('id');
        $result = [];
        if($id != null)
        {
            $entry = $this->entryService->findById($id);
            if($entry != null)
            {
                $this->entryService->delete($entry);
                $result = [$entry];
            }
        }
        return new JsonModel($result);

    }

    /*
     * Add a new entry given the POST "text" parameter
     * No validation happens for simplicity sake
     */
    public function addAction()
    {
       /*
        * If you want to print the RAW incoming POST data
        *  $data = $this->getRequest()->getContent();
        *  var_dump($data);
       */
        /* @var $entry Entry */
        $entry = new Entry();
        $entry->text = "NATHAN";
        $this->entryService->save($entry);
        return new JsonModel([$entry]);

    }
    


}

