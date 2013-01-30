<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

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
        $auth = new AuthenticationService();
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
                 if($result->isValid()){
                     $storage = $auth->getStorage();
                        $storage->write($authAdapter->getResultRowObject(array(
                            'username',
                            'lastlogin',
                        )));
                 }
                 return $this->redirect()->toRoute('auth',array('action'=>'success'));
                break;

            default:
                /** do stuff for other failure **/
                break;
        }

    }

    public function successAction(){
        $auth = new AuthenticationService();
        if($auth->hasIdentity()){
            var_dump($auth->getIdentity());
        }
        die('success');
    }
}
