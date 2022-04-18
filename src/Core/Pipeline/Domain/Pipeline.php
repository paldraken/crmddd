<?php

declare(strict_types=1);

namespace App\Core\Pipeline\Domain;

use App\Auth\Company\Domain\CompanyId;
use App\Core\Pipeline\Domain\Errors\AddStageToPipelineDomainError;
use App\Core\Pipeline\Domain\Errors\CantRemoveStageDomainError;
use App\Core\Stage\Domain\Stage;
use App\Shared\Domain\AggregateRoot;
use App\Shared\Domain\Util;
use App\Shared\Domain\ValueObject\Uuid;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use function Functional\map;
use function Functional\maximum;
use function Functional\some;

class Pipeline extends AggregateRoot
{
    /**
     * @psalm-var Collection<int, Stage>
     */
    private Collection $stages;

    /**
     * @param PipelineId $id
     * @param CompanyId $companyId
     * @param PipelineName $name
     * @param DateTimeImmutable $createdAt
     * @param Collection|null $stages
     */
    public function __construct(
        private PipelineId $id,
        private CompanyId $companyId,
        private PipelineName $name,
        private DateTimeImmutable $createdAt,
        ?Collection $stages = null
    )
    {
        $this->stages = $stages ?? new ArrayCollection();
    }

    public static function create(PipelineId $id, CompanyId $companyId, PipelineName $name): self
    {
        return new Pipeline($id, $companyId, $name, new DateTimeImmutable());
    }

    public function removeStage(Stage $stage): void
    {
        if (count($stage->deals())  > 0) {
            throw new CantRemoveStageDomainError("Can't remove stage {$stage->name()} while it contains deals");
        }
        $this->stages()->removeElement($stage);
    }

    public function addStage(
        Stage $newStage,
        ?Stage $moveAfter = null,
        ?Stage $moveBefore = null,
    ): void
    {
        if(some($this->stages, fn(Stage $st) => $st->equals($newStage))) {
            throw new AddStageToPipelineDomainError();
        }
        $stageOrder = Util::calculateOrder($moveAfter?->rank(), $moveBefore?->rank());
        $newStage->setRank($stageOrder);
    }

    public function changeStagePosition(
        Stage $stage,
        ?Stage $moveBefore = null,
        ?Stage $moveAfter = null
    ): void
    {
        $this->addStageBefore($stage, $moveBefore);
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function companyId(): CompanyId
    {
        return $this->companyId;
    }

    public function name(): PipelineName
    {
        return $this->name;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @psalm-return Collection|
     */
    public function stages(): Collection
    {
        return $this->stages;
    }
}