<?php

namespace App\Service;

use App\Entity\Question;
use App\Service\Actions\ActionBase;
use App\Service\Actions\StoreDataAction;

class ActionManager
{
    private array $actions;

    /**
     * run all the actions
     *
     * @param Question $question
     * @param string $data
     * @return void
     */
    public function callActions(Question $question, string $data): void
    {
        $this->addActions($data, $question);
        foreach ($this->actions as $action) {
            try {
                $action instanceof ActionBase;
            } catch (\Exception $e) {
                dump($e->getMessage());
            }
            $action->run();
        }
    }

    /**
     * add all the actions to call in callActions()
     * Actions have to extend ActionBase
     * 
     * @param string $data
     * @param Question $question
     * @return void
     */
    private function addActions(string $data, Question $question): void
    {
        $action = new StoreDataAction($data, $question);
        $this->actions[] = $action;
    }

    /**
     * Return the list of actions
     *
     * @return array
     */
    public function getActions(): array
    {
        return $this->actions;
    }
}
