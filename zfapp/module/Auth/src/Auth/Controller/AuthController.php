<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;

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

    public function loginAction(){
        $request = $this->getRequest();
        $dbAdapter = $this->getAuthTable()->getAdapter();
        $authAdapter = new AuthAdapter($dbAdapter,'auth','username','password','sha1(?)');
        $authAdapter->setIdentity($request->getPost('username'));
        $authAdapter->setCredential($request->getPost('password'));

        $result = $authAdapter->authenticate();
        var_dump($result);

    }

}
