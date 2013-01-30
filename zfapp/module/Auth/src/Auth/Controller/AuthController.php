<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Result;

class AuthController extends AbstractActionController
{
    protected $authTable;

    public function indexAction()
    {

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

        switch ($result->getCode()) {

            case Result::FAILURE_IDENTITY_NOT_FOUND:
                return $this->redirect()->toRoute('auth',array('action'=>'index'));
                break;

            case Result::FAILURE_CREDENTIAL_INVALID:
                return $this->redirect()->toRoute('auth',array('action'=>'index'));
                break;

            case Result::SUCCESS:
                 return $this->redirect()->toRoute('auth',array('action'=>'success'));
                break;

            default:
                /** do stuff for other failure **/
                break;
        }

    }

    public function successAction(){
        die('success');
    }
}
