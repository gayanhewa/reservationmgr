<?php
namespace Contract\Model;

use Zend\Db\TableGateway\TableGateway;

class PrincipalTable
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

    public function getPrincipal($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function savePrincipal(Principal $principal)
    {
        $data = array(
            'name' => $principal->name,
            'tel'  => $principal->tel,
            'fax'  => $principal->fax,
            'address'  => $principal->address,
            'email'  => $principal->email,
            'website'  => $principal->website
        );

        $id = (int)$principal->id;

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getPrincipal($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deletePrincipal($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }

    public function getAdapter()
    {
        return $this->tableGateway->getAdapter();
    }
}