<?php

declare(strict_types=1);

namespace App\Auth\User\Domain\Events;

use App\Shared\Domain\Bus\DomainEvent\DomainEvent;

class UserWasCreatedDomainEvent extends DomainEvent
{
    public function __construct(
        string $aggregateId,
        private string $userFullName,
        private string $userEmail,
        ?string $eventId = null,
        ?string $occurredOn = null
    ) {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'auth.user.created';
    }

    public static function fromArray(string $aggregateId, array $attributes, string $eventId, string $occurredOn): DomainEvent
    {
        return new self(
            $aggregateId,
            (string) $attributes['full_name'],
            (string) $attributes['email'],
            $eventId,
            $occurredOn
        );
    }

    function toArray(): array
    {
        $attributes = [
            'full_name' => $this->fullName(),
            'email' => $this->email()
        ];
        return $this->baseToArray($attributes);
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return $this->userFullName;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->userEmail;
    }
}