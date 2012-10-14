<?php
namespace Motd\Form;

use Motd\Entity\Motd as MotdEntity;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class MotdForm extends Form
{
    public function __construct(MotdEntity $motd, $name = null)
    {


        $this->setHydrator(new ClassMethodsHydrator(false))->setObject($motd);

        parent::__construct($name);
        $this->init();
    }

    public function init()
    {
        $name = $this->getName();

        if (null === $name) {
            $this->setName('edit-motd');
        }

        $this->add(array(
            'name' => 'motd',
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
