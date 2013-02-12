<?php
namespace Contract\Model;

use Zend\Db\TableGateway\TableGateway;

class ResortTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        $resultSet->buffer();
        $resultSet->next();

        return $resultSet;
    }

    public function getResort($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveResort(Resort $resort)
    {
        $data = array(
            'principal_id' => $resort->principal_id,
            'name' => $resort->name,
            'contact' => $resort->contact,
            'title'  => $resort->title,
            'address'  => $resort->address,
            'email'  => $resort->email,
            'tel'  => $resort->tel,
            'fax'  => $resort->fax,
            'description' => $resort->description,
            'website' => $resort->website,
        );

        $id = (int)$resort->id;

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getResort($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteResort($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }

    public function getAdapter()
    {
        return $this->tableGateway->getAdapter();
    }

    public function getMapper()
    {
        $mapper = array();
        foreach($this->fetchAll() as $row)
        {
            $mapper[$row->id] = $row->name;
        }

        return $mapper;
    }
}