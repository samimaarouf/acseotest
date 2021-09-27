<?php

namespace App\Controller;

use App\Service\DemandManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * get the list of all users in database
     * Only usable by users with admin Role
     *
     * @param DemandManager $demandManager
     * @return Response
     */
    public function getUsers(DemandManager $demandManager): Response
    {
        $users = $demandManager->getUsers();
        return $this->render('demand/demandList.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * Set the list of questions sent by ajax to marked = true
     * Only usable by users with admin Role
     *
     * @param Request $request
     * @param DemandManager $demandManager
     * @return JsonResponse
     */
    public function setQuestionsMarked(Request $request, DemandManager $demandManager): JsonResponse
    {
        $listMarkedQuestions = $request->get('markedQuestions');

        foreach ($listMarkedQuestions as $idQuestion) {
            $demandManager->setMarkedQuestion($idQuestion);
        }
        return new JsonResponse(
            array(
                'status' => 'OK',
            ),
            200
        );
    }

    /**
     * login the user
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('demandList');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * logout the user
     * Can be null, intercepted by the firewall
     *
     * @return void
     */
    public function logout()
    {
    }
}
