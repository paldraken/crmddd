<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Command;

use App\Shared\Domain\Bus\Command\Command;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\Bus\Command\CommandResponse;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Traversable;
use function Functional\group;

final class MySymfonyCommandBus implements CommandBus
{
    private MessageBus $bus;

    public function __construct(
        Traversable $handlers
    )
    {
        $groupedHandlers = group($handlers, fn(CommandHandler $item) => $item::command());

        $this->bus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator($groupedHandlers)),
        ]);
    }

    public function dispatch(Command $command): CommandResponse
    {
        $envelope = $this->bus->dispatch($command);

        /** @var ?HandledStamp $stamp */
        $stamp = $envelope->last(HandledStamp::class);

        return $stamp?->getResult();
    }

}