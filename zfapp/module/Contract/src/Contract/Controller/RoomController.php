<?php

namespace Contract\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Contract\Model\RoomType;
use Contract\Model\RoomTypeTable;
use Contract\Form\RoomTypeForm;
use Zend\Paginator\Adapter\Iterator;
use Zend\Paginator\Paginator;
use Zend\View\Helper\PaginationControl;

class RoomController extends AbstractActionController {

    protected $roomtypeTable;

    public function getRoomTypeTable() {

        if (!$this->roomtypeTable) {
            $sm = $this->getServiceLocator();
            $this->roomtypeTable = $sm->get('Contract\Model\RoomTypeTable');

        }

        return $this->roomtypeTable;
    }

    public function indexAction() {

        $iteratorAdapter = new \Zend\Paginator\Adapter\Iterator($this->getRoomTypeTable()->fetchAll());
        $paginator = new \Zend\Paginator\Paginator($iteratorAdapter);

        $paginator->setCurrentPageNumber($this->params()->fromRoute('id'));
        $paginator->setItemCountPerPage(1);

        return new ViewModel(array(
                    'list' => $paginator
                ));
    }

    public function addAction() {

        $form = new RoomTypeForm(null,$this->getServiceLocator());

        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $roomtype = new RoomType();
            $form->setInputFilter($roomtype->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $roomtype->exchangeArray($form->getData());

                $this->getRoomTypeTable()->saveRoomType($roomtype);

                // Redirect to list of roomtypes
                return $this->redirect()->toRoute('room');
            }
        }
        return array('form' => $form);
    }

    public function editAction() {

        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('room', array(
                        'action' => 'add'
                    ));
        }

        $roomtype = $this->getRoomTypeTable()->getRoomType($id);

        $form = new RoomTypeForm(null,$this->getServiceLocator());
        $form->bind($roomtype);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($roomtype->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getRoomTypeTable()->saveRoomType($form->getData());

                // Redirect to list of roomtypes
                return $this->redirect()->toRoute('room');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction() {

        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('room');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getRoomTypeTable()->deleteRoomType($id);
            }

            // Redirect to list of roomtypes
            return $this->redirect()->toRoute('room');
        }

        return array(
            'id' => $id,
            'roomtype' => $this->getRoomTypeTable()->getRoomType($id)
        );
    }


}
