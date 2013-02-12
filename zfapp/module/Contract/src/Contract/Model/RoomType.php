<?php
namespace Contract\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class RoomType implements InputFilterAwareInterface
{
    public $id = 0;
    public $type;
    public $desc;



    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : 0;
        $this->type     = (isset($data['type'])) ? $data['type'] : null;
        $this->desc   = (isset($data['desc'])) ? $data['desc'] : null;
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
