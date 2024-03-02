<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


class TestController extends AbstractController
{

    private $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    #[Route('/test/add/{a}/{b}', name: 'app_test_add')]
    public function addition($a, $b): Response
    {
        if (!$this->authorizationChecker->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_login');
        }
        // isGranted est une méthode fournie par Symfony pour vérifier si un utilisateur a ou non accès à une certaine ressource ou fonctionnalité dans une application Symfony

        $result = $a + $b;
        return $this->render('test/index.html.twig', [
            'a' => $a,
            'b' => $b,
            'result' => $result
        ]);
    }

    #[Route('/test/mul/{a}/{b}', name: 'app_test')]

    public function multiplication($a, $b): Response
    {
        if (!$this->authorizationChecker->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_login');
        }
        
        $result = $a * $b;
        return $this->render('test/index.html.twig', [
            'a' => $a,
            'b' => $b,
            'result' => $result
        ]);
    }
}
