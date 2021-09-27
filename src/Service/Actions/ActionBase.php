<?php

namespace App\Service\Actions;

use App\Entity\Question;

abstract class ActionBase
{
    protected $data;
    protected $question;

    public function __construct(string $data, Question $question)
    {
        $this->data = $data;
        $this->question = $question;
    }

    public function run(): void
    {
    }
}
