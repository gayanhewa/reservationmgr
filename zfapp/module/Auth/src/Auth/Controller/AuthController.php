<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    protected $authTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'auth' => $this->getAuthTable()->fetchAll(),
            'a'=>'aaaa'
        ));
    }

    public function getAuthTable()
    {
        if (!$this->authTable) {
            $sm = $this->getServiceLocator();
            $this->authTable = $sm->get('Auth\Model\AuthTable');

        }
        return $this->authTable;
    }

}
