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
     * @var Motd\Service\Motd
     */
    protected $motdService;

    public function editAction()
    {
        if (($this->getRequest()->isPost())) {
            $this->getMotdService()->setMotd($this->getRequest()->getPost()->get('motd'));
            return $this->redirect()->toRoute('motd');
        }

        $viewModel       = new ViewModel();
        $form            = new MotdForm($this->getMotdService()->getEntity(), 'new-motd');
        $viewModel->form = $form;

        return $viewModel;
    }

    protected function getMotdService()
    {
        if (null === $this->motdService) {
            $this->motdService = $this->getServiceLocator()->get('Motd');
        }

        return $this->motdService;
    }
}
