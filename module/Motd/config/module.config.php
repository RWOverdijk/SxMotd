<?php
namespace Motd;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Motd\Controller\MotdController;
use Motd\Form\MotdForm;
use Motd\Entity\Motd as MotdEntity;

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
    'service_manager' => array(
        'invokables' => array(
            'Motd' => 'Motd\Service\Motd',
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Motd\Controller\Motd' => function($sm) {
                $entityManager  = $sm->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $form           = new MotdForm(new DoctrineEntity($entityManager));
                $controller     = new MotdController;

                $form->bind($sm->getServiceLocator()->get('Motd')->getEntity());
                $controller->setForm($form);

                return $controller;
            },
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Motd' => __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'motd-edit' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/edit',
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
