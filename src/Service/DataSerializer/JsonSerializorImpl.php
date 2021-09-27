<?php

namespace App\Service\DataSerializer;

use App\Entity\Question;
use App\Service\DataSerializer\DataSerializorInterface;
use Symfony\Component\Serializer\SerializerInterface;


class JsonSerializorImpl implements DataSerializorInterface
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serializeData(Question $question): String
    {
        $jsonContent = $this->serializer->serialize($question, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        return $jsonContent;
    }
}
