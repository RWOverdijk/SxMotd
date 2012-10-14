<?php

namespace Motd\Controller;

use Motd\Form\MotdForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class MotdController extends AbstractActionController
{
    /**
     * @var EntityRepository
     */
    protected $repository;

    public function editAction()
    {
        $motd = $this->getRepository()->find(1);

        $viewModel       = new ViewModel();
        $form            = new MotdForm('new-motd');
        $viewModel->form = $form;

        return $viewModel;
    }

    protected function getRepository()
    {
        if (null === $this->repository) {
            $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $this->repository = $em->getRepository('Motd\Entity\Motd');
        }

        return $this->repository;
    }
}
