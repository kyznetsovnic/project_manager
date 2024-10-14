<?php

namespace App\Controller;

use App\Model\Customer\UseCase\ItemHandler;
use App\Model\Customer\UseCase\ItemListHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/customers')]
class CustomerController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function list(ItemListHandler $handler): Response
    {
        return $this->json($handler->handle());
    }

    #[Route(path: '/{id}', methods: ['GET'])]
    public function item(int $id, ItemHandler $handler): Response
    {
        return $this->json($handler->handle($id));
    }
}
