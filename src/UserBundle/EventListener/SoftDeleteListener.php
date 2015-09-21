<?php

namespace UserBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use FOS\UserBundle\Model\UserInterface;

class SoftDeleteListener
{
    public function preSoftDelete(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        if ($entity instanceof UserInterface) {
            $time = time();
            if (strpos($entity->getUsername(), "_deleted_") === false) {
                $entity
                    ->setUsername($entity->getUsername()."_deleted_".$time)
                    ->setUsernameCanonical($entity->getUsernameCanonical()."_deleted_".$time)
                    ->setEmail($entity->getEmail()."_deleted_".$time)
                    ->setEmailCanonical($entity->getEmailCanonical()."_deleted_".$time)
                ;
                $em->persist($entity);
                $em->flush($entity);
            }
        }
    }
}
