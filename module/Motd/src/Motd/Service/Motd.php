<?php

namespace Motd\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Motd\Entity\Motd as MotdEntity;

class Motd implements ServiceLocatorAwareInterface
{
    /**
     * @var string
     */
    protected $entity = 'Motd\Entity\Motd';

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Get the message of the day.
     *
     * @return string Message of the day
     */
    public function getMessage()
    {
        $motd = $this->getRepository()->find(1);

        return null === $motd ? '' : $motd->getMessage();
    }

    public function getEntity()
    {
        $entity = $this->getRepository()->find(1);

        if (null === $entity) {
            $entity = $this->createMotd('');
        }

        return $entity;
    }

    /**
     * Set the message of the day.
     *
     * @param string $message message of the day
     */
    public function setMotd($message)
    {
        $motd = $this->getEntity();

        $motd->setMessage($message);

        $this->getEntityManager()->flush($motd);
    }

    /**
     * Creates a new Motd.
     *
     * @param   string  $message
     *
     * @return  Motd\Entity\Motd
     */
    protected function createMotd($message)
    {
        $motd = new MotdEntity($message);

        $this->getEntityManager()->persist($motd);

        return $motd;
    }

    /**
     * Get the EntityRepository
     *
     * @return EntityRepository
     */
    protected function getRepository()
    {
        if (null === $this->repository) {
            $this->repository = $this->getEntityManager()->getRepository($this->entity);
        }

        return $this->repository;
    }

    /**
     * Get the entity manager
     *
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->entityManager;
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * {@inheritDoc}
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}
