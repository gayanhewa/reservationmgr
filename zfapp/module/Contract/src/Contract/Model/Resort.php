<?php
namespace Contract\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Resort implements InputFilterAwareInterface
{
    public $id = 0;
    public $principal_id;
    public $name;
    public $contact;
    public $title;
    public $address;
    public $email;
    public $tel;
    public $fax;
    public $description;
    public $website;


    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : 0;
        $this->principal_id     = (isset($data['principal_id'])) ? $data['principal_id'] : null;
        $this->name     = (isset($data['name'])) ? $data['name'] : null;
        $this->contact     = (isset($data['contact'])) ? $data['contact'] : null;
        $this->address     = (isset($data['address'])) ? $data['address'] : null;
        $this->email     = (isset($data['email'])) ? $data['email'] : null;
        $this->tel     = (isset($data['tel'])) ? $data['tel'] : null;
        $this->fax     = (isset($data['fax'])) ? $data['fax'] : null;
        $this->description     = (isset($data['description'])) ? $data['description'] : null;
        $this->website     = (isset($data['website'])) ? $data['website'] : null;

    }

    // Add content to this method:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
//            $factory     = new InputFactory();

//            $inputFilter->add($factory->createInput(array(
//                'name'     => 'name',
//                'required' => true,
//                'filters'  => array(
//                    array('name' => 'StripTags'),
//                    array('name' => 'StringTrim'),
//                ),
//                'validators' => array(
//                    array(
//                        'name'    => 'StringLength',
//                        'options' => array(
//                            'encoding' => 'UTF-8',
//                            'min'      => 1,
//                            'max'      => 100,
//                        ),
//                    ),
//                ),
//            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }


    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}
