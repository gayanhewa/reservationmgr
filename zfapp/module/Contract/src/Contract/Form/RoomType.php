<?php
namespace Contract\Form;

use Zend\Form\Form;

class RoomTypeForm extends Form {

    protected $_sm = null;

    public function __construct($name = null,$serviceManager = null) {

        if ( $serviceManager != null ) {
            $this->_sm = $serviceManager;
        }

        // we want to ignore the name passed
        parent::__construct('room_type');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'type',
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-xlarge'
            ),
            'options' => array(
                'label' => 'Type',
            ),
        ));

        $this->add(array(
            'name' => 'desc',
            'attributes' => array(
                'type' => 'text',
                'class' => 'cleditor'
            ),
            'options' => array(
                'label' => 'Description',
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
}

?>