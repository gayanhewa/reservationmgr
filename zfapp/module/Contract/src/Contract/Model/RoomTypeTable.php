<?php
namespace Contract\Model;

use Zend\Db\TableGateway\TableGateway;

class RoomTypeTable
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

    public function getRoomType($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveRoomType(RoomType $roomtype)
    {
        $data = array(
            'type' => $roomtype->type,
            'desc' => $roomtype->desc,
        );

        $id = (int)$roomtype->id;

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getRoomType($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteRoomType($id)
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