<?php
namespace Contract;

use Contract\Model\Principal;
use Contract\Model\PrincipalTable;
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
            ),
        );
    }
}