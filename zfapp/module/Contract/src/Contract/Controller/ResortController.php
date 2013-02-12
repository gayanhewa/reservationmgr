<?php

namespace Contract\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Contract\Model\Resort;
use Contract\Model\ResortTable;
use Contract\Form\ResortForm;
use Zend\Paginator\Adapter\Iterator;
use Zend\Paginator\Paginator;
use Zend\View\Helper\PaginationControl;

class ResortController extends AbstractActionController {

    protected $resortTable;

    public function getResortTable() {

        if (!$this->resortTable) {
            $sm = $this->getServiceLocator();
            $this->resortTable = $sm->get('Contract\Model\ResortTable');
        }

        return $this->resortTable;
    }

    public function indexAction() {

        $iteratorAdapter = new \Zend\Paginator\Adapter\Iterator($this->getResortTable()->fetchAll());
        $paginator = new \Zend\Paginator\Paginator($iteratorAdapter);

        $paginator->setCurrentPageNumber($this->params()->fromRoute('id'));
        $paginator->setItemCountPerPage(1);

        return new ViewModel(array(
                    'list' => $paginator
                ));
    }

    public function addAction() {

        $form = new ResortForm(null,$this->getServiceLocator());

        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $resort = new Resort();
            $form->setInputFilter($resort->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $resort->exchangeArray($form->getData());

                $this->getResortTable()->saveResort($resort);

                // Redirect to list of resorts
                return $this->redirect()->toRoute('resort');
            }
        }
        return array('form' => $form);
    }

    public function editAction() {

        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('resort', array(
                        'action' => 'add'
                    ));
        }

        $resort = $this->getResortTable()->getResort($id);

        $form = new ResortForm(null,$this->getServiceLocator());
        $form->bind($resort);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($resort->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getResortTable()->saveResort($form->getData());

                // Redirect to list of resorts
                return $this->redirect()->toRoute('resort');
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
            return $this->redirect()->toRoute('resort');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getResortTable()->deleteResort($id);
            }

            // Redirect to list of resorts
            return $this->redirect()->toRoute('resort');
        }

        return array(
            'id' => $id,
            'resort' => $this->getResortTable()->getResort($id)
        );
    }


}
