<?php

namespace App\Shared\Domain\Bus\Query;

interface QueryBus
{
    public function dispatch(Query $query): QueryResponse;
}