<?php

declare(strict_types=1);

namespace App\Shared\Domain;

use App\Shared\Domain\Bus\DomainEvent\DomainEvent;
use App\Shared\Domain\ValueObject\Uuid;

abstract class AggregateRoot
{
    /** @var DomainEvent[] */
    private array $recordedEvents = [];

    abstract public function id(): Uuid;

    public function record(DomainEvent $domainEvent): void
    {
        $this->recordedEvents[] = $domainEvent;
    }

    /**
     * @return DomainEvent[]
     */
    public function releaseEvents(): array
    {
        $stored = $this->recordedEvents;
        $this->recordedEvents = [];
        return $stored;
    }
}