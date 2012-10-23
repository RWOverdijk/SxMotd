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

    /**
     * @var MotdForm
     */
    protected $form;

    /**
     * @var string The message to show once updated
     */
    protected $updateMessage = 'Message of the day saved!';

    /**
     * The edit action. This page allows you to edit your MOTD!
     *
     * @return ViewModel
     */
    public function editAction()
    {
        $request        = $this->getRequest();
        $flashMessenger = $this->flashMessenger()->setNamespace(__NAMESPACE__);

        if ($request->isPost()) {
            $this->getForm()->setData($request->getPost())->isValid();
            $this->getMotdService()->save();
            $flashMessenger->addMessage($this->updateMessage);

            return $this->redirect()->toRoute('motd-edit');
        }

        $viewModel          = new ViewModel();
        $viewModel->form    = $this->getForm();
        $viewModel->updated = false;

        if ($flashMessenger->hasMessages()) {
            $messages = $flashMessenger->getMessages();
            $viewModel->updated = $messages[0];
        }

        return $viewModel;
    }

    /**
     * Get the motd service.
     *
     * @return  Motd\Service\Motd
     */
    protected function getMotdService()
    {
        if (null === $this->motdService) {
            $this->motdService = $this->getServiceLocator()->get('Motd');
        }

        return $this->motdService;
    }

    /**
     * Set the MotdForm
     *
     * @param   MotdForm    $form
     */
    public function setForm(MotdForm $form)
    {
        $this->form = $form;
    }

    /**
     * Get the MOTD form.
     *
     * @return MotdForm
     */
    protected function getForm()
    {
        return $this->form;
    }
}
