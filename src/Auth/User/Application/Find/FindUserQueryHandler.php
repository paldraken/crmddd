<?php

declare(strict_types=1);

namespace App\Auth\User\Application\Find;

use App\Shared\Domain\Bus\Query\QueryHandler;

class FindUserQueryHandler implements QueryHandler
{
    public function __invoke(FindUserQuery $query): FindUserQueryResponse
    {
        return new FindUserQueryResponse(['user1', 'user2', 'user3']);
    }

    public static function forQuery(): string
    {
        return FindUserQuery::class;
    }
}