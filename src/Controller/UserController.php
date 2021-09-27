<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\DemandFormType;
use App\Service\DemandManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * create a new form, when the form is submitted, it creates the User and the Question associated
     *
     * @param Request $request
     * @param DemandManager $demandGenerator
     * @return Response
     */
    public function new(Request $request, DemandManager $demandGenerator): Response
    {
        $user = new User();
        $form = $this->createForm(DemandFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine();
            $demandGenerator->manageForm($form, $manager);
        }

        return $this->render('demand/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
