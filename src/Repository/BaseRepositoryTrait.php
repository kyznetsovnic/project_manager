<?php

namespace App\Repository;

trait BaseRepositoryTrait
{
    public function save(object $entity): void
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }
}