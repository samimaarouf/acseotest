<?php

namespace App\Form\DataTransformer;

use App\Entity\Question;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DemandToQuestionTransformer implements DataTransformerInterface
{

    /**
     * Transforms an object (question) to a string (text).
     *
     * @param  Question|null $question
     */
    public function transform($question): string
    {
        return "";
    }

    /**
     * Transforms a string (text) to an object (question).
     *
     * @param  string $question
     * @throws TransformationFailedException if object (questions) is not found.
     */
    public function reverseTransform($questionText)
    {
        $array = new ArrayCollection();
        $question = new Question();
        $question->setContent($questionText);
        $array[] = $question;
        return $array;
    }
}
