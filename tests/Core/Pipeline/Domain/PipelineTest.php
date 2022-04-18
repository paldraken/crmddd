<?php

declare(strict_types=1);

namespace App\Tests\Core\Pipeline\Domain;

use App\Auth\Company\Domain\CompanyId;
use App\Core\Pipeline\Domain\Pipeline;
use App\Core\Pipeline\Domain\PipelineId;
use App\Core\Pipeline\Domain\PipelineName;
use App\Core\Stage\Domain\Stage;
use App\Core\Stage\Domain\StageId;
use App\Core\Stage\Domain\StageName;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class PipelineTest extends TestCase
{
    public function test_it_should_move_stage_correctly()
    {
        $pipeline = new Pipeline(
            PipelineId::generate(),
            CompanyId::generate(),
            new PipelineName('xxxx'),
            new DateTimeImmutable()
        );

        $stage1 = new Stage(StageId::generate(), new StageName('st1'), new DateTimeImmutable(), 1);
        $stage2 = new Stage(StageId::generate(), new StageName('st2'), new DateTimeImmutable(), 2);

        $stageTOAdd = new Stage(StageId::generate(), new StageName('st3'), new DateTimeImmutable());

        $stageCollection = new ArrayCollection();
        $stageCollection->add($stage1);
        $stageCollection->add($stage2);

        $pipeline->setStages($stageCollection);


        $pipeline->addStage($stageTOAdd, $stage2);

        self::assertEquals(2, $stageTOAdd->order());
    }

}