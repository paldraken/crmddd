<?php

declare(strict_types=1);

namespace App\Core\Stage\Domain;

use App\Core\Deal\Domain\Deal;
use App\Core\Pipeline\Domain\Pipeline;
use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\ValueObject\Uuid;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Stage extends AggregateRoot
{
    /**
     * @psalm-var Collection<int, Deal>
     */
    private Collection $deals;

    public function __construct(
        private StageId           $id,
        private StageName         $name,
        private Pipeline          $pipeline,
        private DateTimeImmutable $createdAt,
        private ?float            $rank = null,
    )
    {
        $this->deals = new ArrayCollection();
    }

    public static function create(StageId $id, StageName $name, Pipeline $pipeline): self
    {
        return new Stage($id, $name, $pipeline, new DateTimeImmutable());
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function name(): StageName
    {
        return $this->name;
    }

    public function setName(StageName $name): void
    {
        $this->name = $name;
    }

    public function rank(): float
    {
        return $this->rank;
    }

    public function setRank(float $rank): void
    {
        $this->rank = $rank;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @psalm-var Collection<int, Deal>
     */
    public function deals(): Collection
    {
        return $this->deals;
    }

    public function pipeline(): Pipeline
    {
        return $this->pipeline;
    }
}