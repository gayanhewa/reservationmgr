<?php
namespace Contract\Form;

use Zend\Form\Form;

class ContractDefinitionForm extends Form {

    protected $_sm = null;

    public function __construct($name = null,$serviceManager) {

        if ( $serviceManager != null ) {
            $this->_sm = $serviceManager;
        }

        // we want to ignore the name passed
        parent::__construct('contract_definition');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));



        $this->add(array(
            'name' => 'resort_id',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Resort',
                'options' => $this->getResortOptions()
            ),
        ));

        $this->add(array(
            'name' => 'gst',
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-xlarge'
            ),
            'options' => array(
                'label' => 'GST',
            ),
        ));

        $this->add(array(
            'name' => 'servicecharge',
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-xlarge'
            ),
            'options' => array(
                'label' => 'Service Charge',
            ),
        ));

        $this->add(array(
            'name' => 'bed_tax',
            'attributes' => array(
                'type' => 'text',
                'class' => 'input-xlarge'
            ),
            'options' => array(
                'label' => 'Bed Tax',
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

    protected function getResortOptions()
    {
        // or however you want to load the data in
        $mapper = $this->_sm->get('Contract\Model\ResortTable');

        return $mapper->getMapper();
    }

}

?>