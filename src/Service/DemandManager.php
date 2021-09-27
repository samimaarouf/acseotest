<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Question;
use App\Service\DataSerializer\DataSerializorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;



class DemandManager
{
    private $entityManager;
    private $dataSerializor;
    private $actionManager;

    /**
     * Constructor
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, DataSerializorInterface $dataSerializor, ActionManager $actionManager)
    {
        $this->entityManager = $entityManager;
        $this->dataSerializor = $dataSerializor;
        $this->actionManager = $actionManager;
    }

    /**
     * this method create a form and perform all the actions done after the form submission
     *
     * @param FormInterface $form
     * @return void
     */
    public function manageForm(FormInterface $form): void
    {
        $email = $form["email"]->getData();
        $arrayQuestion = $form["questions"]->getData();
        $question = $arrayQuestion[0];
        $user = $this->entityManager->getRepository(User::class)->findOneBy(["email" => $email]);
        if ($user) {
            $user->addQuestion($question);
        } else {
            $user = $form->getData();
        }
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $data = $this->dataSerializor->serializeData($question);
        $this->actionManager->callActions($question, $data);
    }

    /**
     * return an array of all the users stored in database 
     *
     * @return array
     */

    public function getUsers(): array
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
        return $users;
    }

    /**
     * set the field marked for a question to true
     *
     * @param [int] $idQuestion
     * @return void
     */
    public function setMarkedQuestion($idQuestion): void
    {
        try {
            $question = $this->entityManager->getRepository(Question::class)->findOneBy(array("id" => $idQuestion));
            $question->setMarked(true);
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
        $this->entityManager->persist($question);
        $this->entityManager->flush();
    }
}
