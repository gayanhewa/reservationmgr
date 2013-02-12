<?php
namespace Contract\Form;

use Zend\Form\Form;

class RoomRatesForm extends Form {

    protected $_sm = null;

    public function __construct($name = null,$serviceManager) {

        if ( $serviceManager != null ) {
            $this->_sm = $serviceManager;
        }

        // we want to ignore the name passed
        parent::__construct('room_rates');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-xlarge'
            ),
            'options' => array(
                'label' => 'Name',
            ),
        ));

        $this->add(array(
            'name' => 'contact',
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-xlarge'
            ),
            'options' => array(
                'label' => 'Contact',
            ),
        ));

        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-xlarge'
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));

        $this->add(array(
            'name' => 'address',
            'attributes' => array(
                'type' => 'text',
                'class' => 'cleditor'
            ),
            'options' => array(
                'label' => 'Address',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'email',
                'class' => 'input-xlarge',
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));

        $this->add(array(
            'name' => 'tel',
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-xlarge',
            ),
            'options' => array(
                'label' => 'Telephone',
            ),
        ));

        $this->add(array(
            'name' => 'fax',
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-xlarge',
            ),
            'options' => array(
                'label' => 'Fax',
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type' => 'text',
                'class' => 'cleditor'
            ),
            'options' => array(
                'label' => 'Description',
            ),
        ));

        $this->add(array(
            'name' => 'website',
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-xlarge',
            ),
            'options' => array(
                'label' => 'Website',
            ),
        ));

        $this->add(array(
            'name' => 'principal_id',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Principal',
                'options' => $this->getPrincipalOptions()
            ),
        ));


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-primary'
            ),
        ));


    }

    protected function getPrincipalOptions()
    {
        // or however you want to load the data in
        $mapper = $this->_sm->get('Contract\Model\PrincipalTable');

        return $mapper->getMapper();
    }

}

?>