<?php
namespace Contract\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Contract\Model\Principal;
use Contract\Form\PrincipalForm;

class PrincipalController extends AbstractActionController
{
    public function indexAction()
    {
        die('ee1e');
    }

    public function addAction()
    {
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

    public function editAction()
    {
        die('edit');
    }

    public function deleteAction()
    {
        die('delete');
    }
}
