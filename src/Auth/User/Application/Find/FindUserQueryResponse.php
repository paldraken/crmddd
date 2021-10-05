<?php

declare(strict_types=1);

namespace App\Auth\User\Application\Find;

use App\Shared\Domain\Bus\Query\QueryResponse;

class FindUserQueryResponse implements QueryResponse
{
    public function __construct(private array $users)
    {
    }

    /**
     * @psalm-return  array<int, string>
     */
    public function users(): array
    {
        return $this->users;
    }


}