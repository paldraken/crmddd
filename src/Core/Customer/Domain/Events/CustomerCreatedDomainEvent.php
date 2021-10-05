<?php

declare(strict_types=1);

namespace App\Core\Customer\Domain\Events;

use App\Shared\Domain\Bus\DomainEvent\DomainEvent;

final class CustomerCreatedDomainEvent extends DomainEvent
{
    public function __construct(
        string $id,
        private string $name,
        private string $email,
        private string $phone,
        ?string $eventId = null,
        ?string $occurredOn = null
    )
    {

        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'core.customer.created';
    }

    public static function fromArray(string $aggregateId, array $attributes, string $eventId, string $occurredOn): self
    {
        return new self(
            $aggregateId,
            (string) $attributes['name'],
            (string) $attributes['email'],
            (string) $attributes['phone'],
            $eventId,
            $occurredOn
        );
    }

    /**
     * @psalm-type _Attrs = array{name: string, email: string, phone: string}
     * @psalm-return array{id: string, attributes: _Attrs, event_id: ?string, occurred_on: ?string}
     */
    function toArray(): array
    {
        $attributes = [
            'name' => $this->name(),
            'email' => $this->email(),
            'phone' => $this->phone()
        ];
        return $this->baseToArray($attributes);
    }

    public function email(): string
    {
        return $this->email;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function name(): string
    {
        return $this->name;
    }
}