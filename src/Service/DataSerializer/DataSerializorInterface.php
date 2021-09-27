<?php

namespace App\Service\DataSerializer;

use App\Entity\Question;

interface DataSerializorInterface
{
    public function serializeData(Question $question);
}
