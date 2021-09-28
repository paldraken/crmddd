<?php

declare(strict_types=1);

namespace App\Shared\Domain\Bus\DomainEvent;

use App\Shared\Domain\Util;
use App\Shared\Domain\ValueObject\Uuid;

abstract class DomainEvent
{
    public function __construct(
        private string $aggregateId,
        private ?string $eventId = null,
        private ?string $occurredOn = null
    )
    {
        $this->eventId ?: Uuid::generate();
        $this->occurredOn ?: Util::dateToStr(new \DateTimeImmutable());
    }

    abstract public static function eventName(): string;

    abstract public static function fromArray(
        string $aggregateId,
        array $attributes,
        string $eventId,
        string $occurredOn
    ): self;

    abstract function toArray(): array;

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    public function eventId(): ?string
    {
        return $this->eventId;
    }

    public function occurredOn(): ?string
    {
        return $this->occurredOn;
    }
}