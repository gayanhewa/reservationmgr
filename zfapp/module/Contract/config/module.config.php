<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Contract\Controller\Contract' => 'Contract\Controller\ContractController',
             'Contract\Controller\Principal' => 'Contract\Controller\PrincipalController',
            'Contract\Controller\Resort' => 'Contract\Controller\ResortController',
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
            'principal' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/principal[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Contract\Controller\Principal',
                        'action'     => 'index',
                    ),
                ),
            ),
            'resort' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/resort[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Contract\Controller\Resort',
                        'action'     => 'index',
                    ),
                ),
            ),
            'paginator' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/[:controller]/index/[page/:page]',
                   'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'page' => 1,
                    ),
//                    'defaults' => array(
//                        'controller' => 'Contract\Controller\Principal',
//                        'action'     => 'index',
//                    ),
                ),
        ),
        ),
    ),


    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/contract'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);