<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Query;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\QueryResponse;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Traversable;
use function Functional\group;

class MySymfonyQueryBus implements QueryBus
{
    private MessageBus $bus;

    public function __construct(Traversable $queryHandlers)
    {
        $groupedHandlers = group($queryHandlers, fn(QueryHandler $item) => $item::forQuery());
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator($groupedHandlers)),
        ]);
    }

    public function dispatch(Query $query): QueryResponse
    {
        $envelope = $this->bus->dispatch($query);

        /** @var ?HandledStamp $stamp */
        $stamp = $envelope->last(HandledStamp::class);

        return $stamp?->getResult();
    }

}