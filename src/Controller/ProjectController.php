<?php

namespace App\Controller;

use App\Model\Project\Dto\Request\CreateDto;
use App\Model\Project\Dto\Request\EditDto;
use App\Model\Project\UseCase\CloseHandler;
use App\Model\Project\UseCase\CreateHandler;
use App\Model\Project\UseCase\EditHandler;
use App\Model\Project\UseCase\ItemHandler;
use App\Model\Project\UseCase\ItemListHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/projects')]
class ProjectController extends AbstractController
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
    public function close(int $id, CloseHandler $handler): Response
    {
        return $this->json($handler->handle($id));
    }
}
