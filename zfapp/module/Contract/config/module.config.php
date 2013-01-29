<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Contract\Controller\Contract' => 'Contract\Controller\ContractController',
        ),
    ),

   'router' => array(
        'routes' => array(
            'contract' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/contract[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Contract\Controller\Contract',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),
);