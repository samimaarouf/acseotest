<?php

namespace App\Tests\Service;

use App\Entity\Question;
use PHPUnit\Framework\TestCase;
use App\Service\ActionManager;
use App\Service\Actions\ActionBase;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNotEmpty;

class ActionManagerTest extends TestCase
{
    public function testAddActions()
    {
        $actionManager = new ActionManager();
        $question = new Question();

        $actionManager->callActions($question, "test");
        $actions = $actionManager->getActions();
        assertNotEmpty($actions);
        foreach ($actions as $action) {
            assertInstanceOf(ActionBase::class, $action);
        }
    }
}
