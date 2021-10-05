<?php

declare(strict_types=1);

namespace App\Auth\Company\Domain\Events;

use App\Shared\Domain\Bus\DomainEvent\DomainEvent;

class CompanyWasRegisteredDomainEvent extends DomainEvent
{
    public function __construct(
        string $id,
        private string $companyName,
        ?string $eventId = null,
        ?string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'auth.company.registered';
    }

    public static function fromArray(string $aggregateId, array $attributes, string $eventId, string $occurredOn): DomainEvent
    {
        return new self(
            $aggregateId,
            (string) $attributes['company_name'],
            $eventId,
            $occurredOn
        );
    }

    function toArray(): array
    {
        $attributes = [
            'company_name' => $this->companyName
        ];
        return $this->baseToArray($attributes);
    }
}