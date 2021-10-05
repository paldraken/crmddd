<?php

declare(strict_types=1);

namespace App\Controller;

use App\Auth\Company\Application\Register\RegisterCommand;
use App\Auth\Company\Application\Register\RegisterHandlerResponse;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Doctrine\BaseCollectionRelation;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CompanyController
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus $queryBus
    )
    {
    }

    public function register(Request $request): JsonResponse
    {
        $jsonArr = json_decode((string) $request->getContent(), true);

        $command = new RegisterCommand(
            $jsonArr['companyName'] ?? null,
            $jsonArr['contactName'] ?? null,
            $jsonArr['email'] ?? null,
            $jsonArr['password'] ?? null,
            $jsonArr['phone'] ?? null
        );

        /** @var RegisterHandlerResponse $commandResult */
        $commandResult = $this->commandBus->dispatch($command);

        return new JsonResponse(['id' => $commandResult->id()]);
    }
}