<?php
namespace Contract\Form;

use Zend\Form\Form;

class ResortForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('resort');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'class'=>'input-xlarge'
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));
        $this->add(array(
            'name' => 'tel',
            'attributes' => array(
                'type'  => 'text',
                'class'=>'input-xlarge'
            ),
            'options' => array(
                'label' => 'Telephone',
                'label_attributes'=>array(
                    'class'=>'control-label'
                ),
            ),
        ));
        $this->add(array(
            'name' => 'fax',
            'attributes' => array(
                'type'  => 'text',
                'class'=>'input-xlarge'
            ),
            'options' => array(
                'label' => 'Fax',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'email',
                'class'=>'input-xlarge'
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));
        $this->add(array(
            'name' => 'website',
            'attributes' => array(
                'type'  => 'text',
                'class'=>'input-xlarge'
            ),
            'options' => array(
                'label' => 'Website',
            ),
        ));
        $this->add(array(
            'name' => 'address',
            'attributes' => array(
                'type'  => 'textarea',
                'class'=>'cleditor',
            ),
            'options' => array(
                'label' => 'Address',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-primary'
            ),
        ));
    }
}
?>