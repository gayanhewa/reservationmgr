<?php

namespace Contract\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Contract\Model\Principal;
use Contract\Model\PrincipalTable;
use Contract\Form\PrincipalForm;
use Zend\Paginator\Adapter\Iterator;
use Zend\Paginator\Paginator;
use Zend\View\Helper\PaginationControl;

class PrincipalController extends AbstractActionController {

    protected $principalTable;

    public function getPrincipalTable() {

        if (!$this->principalTable) {
            $sm = $this->getServiceLocator();
            $this->principalTable = $sm->get('Contract\Model\PrincipalTable');
        }

        return $this->principalTable;
    }

    public function indexAction() {

        $iteratorAdapter = new \Zend\Paginator\Adapter\Iterator($this->getPrincipalTable()->fetchAll());
        $paginator = new \Zend\Paginator\Paginator($iteratorAdapter);

        $paginator->setCurrentPageNumber($this->params()->fromRoute('page'));
        $paginator->setItemCountPerPage(1);

        return new ViewModel(array(
                    'list' => $paginator
                ));
    }

    public function addAction() {

        $form = new PrincipalForm();

        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $principal = new Principal();
            $form->setInputFilter($principal->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {

                $principal->exchangeArray($form->getData());

                $this->getPrincipalTable()->savePrincipal($principal);

                // Redirect to list of principals
                return $this->redirect()->toRoute('principal');
            }
        }
        return array('form' => $form);
    }

    public function editAction() {

        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('principal', array(
                        'action' => 'add'
                    ));
        }

        $principal = $this->getPrincipalTable()->getPrincipal($id);

        $form = new PrincipalForm();
        $form->bind($principal);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($principal->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getPrincipalTable()->savePrincipal($form->getData());

                // Redirect to list of principals
                return $this->redirect()->toRoute('principal');
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
            return $this->redirect()->toRoute('principal');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getPrincipalTable()->deletePrincipal($id);
            }

            // Redirect to list of principals
            return $this->redirect()->toRoute('principal');
        }

        return array(
            'id' => $id,
            'principal' => $this->getPrincipalTable()->getPrincipal($id)
        );
    }

}
