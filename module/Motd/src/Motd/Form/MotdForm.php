<?php
namespace Motd\Form;


use Motd\Entity\Motd as MotdEntity;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class MotdForm extends Form
{
    public function __construct($hydrator, $name = null)
    {
        parent::__construct($name);

        $this->setHydrator($hydrator);

        if (null === $name) {
            $this->setName('edit-motd');
        }

        $this->add(array(
            'name' => 'message',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Message of the day:',
            ),
        ));

        $this->add(array(
            'name' => 'save',
            'type'  => 'Zend\Form\Element\Submit',
            'options' => array(
                'label' => 'Save',
            ),
            'attributes' => array(
                'class' => 'btn'
            ),
        ));
    }
}
