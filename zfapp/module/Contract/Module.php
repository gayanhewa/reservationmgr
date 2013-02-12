<?php
namespace Contract;

use Contract\Model\Principal;
use Contract\Model\PrincipalTable;
use Contract\Model\Resort;
use Contract\Model\ResortTable;
use Contract\Model\RoomType;
use Contract\Model\RoomTypeTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }


    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Contract\Model\PrincipalTable' =>  function($sm) {
                    $tableGateway = $sm->get('PrincipalTableGateway');
                    $table = new PrincipalTable($tableGateway);
                    return $table;
                },
                'PrincipalTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Principal());
                    return new TableGateway('principal', $dbAdapter, null, $resultSetPrototype);
                },
                'Contract\Model\ResortTable' =>  function($sm) {
                    $tableGateway = $sm->get('ResortTableGateway');
                    $table = new ResortTable($tableGateway);
                    return $table;
                },
                'ResortTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Resort());
                    return new TableGateway('resort', $dbAdapter, null, $resultSetPrototype);
                },
                'Contract\Model\RoomTypeTable' =>  function($sm) {

                    $tableGateway = $sm->get('RoomTypeTableGateway');
                    $table = new RoomTypeTable($tableGateway);
                    return $table;
                },
                'RoomTypeTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new RoomType());
                    return new TableGateway('room_type', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}