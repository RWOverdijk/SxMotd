<?php
return array(
    'doctrine' => array(
        'driver' => array(
            'motd' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/Motd/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Motd\Entity' => 'motd',
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Motd\Controller\Motd' => 'Motd\Controller\MotdController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Motd' => __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'motd' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/motd',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Motd\Controller',
                        'controller'    => 'Motd',
                        'action'        => 'edit',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
);
