<?php

namespace App\Controller;

use App\Model\Developer\Dto\Request\CreateDto;
use App\Model\Developer\Dto\Request\EditDto;
use App\Model\Developer\UseCase\CreateHandler;
use App\Model\Developer\UseCase\DismissHandler;
use App\Model\Developer\UseCase\EditHandler;
use App\Model\Developer\UseCase\ItemHandler;
use App\Model\Developer\UseCase\ItemListHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/developers')]
class DeveloperController extends AbstractController
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

    #[Route(path: '', methods: ['POST'])]
    public function add(#[MapRequestPayload] CreateDto $dto, CreateHandler $handler): Response
    {
        return $this->json($handler->handle($dto));
    }

    #[Route(path: '/{id}', methods: ['PATCH'])]
    public function edit(#[MapRequestPayload] EditDto $dto, int $id, EditHandler $handler): Response
    {
        return $this->json($handler->handle($id, $dto));
    }

    #[Route(path: '/{id}', methods: ['DELETE'])]
    public function dismiss(int $id, DismissHandler $handler): Response
    {
        return $this->json($handler->handle($id));
    }
}
