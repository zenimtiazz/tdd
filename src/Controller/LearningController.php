<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LearningController extends AbstractController
{
    #[Route('/learning', name: 'learning')]
    public function index(): Response
    {
        return $this->render('learning/index.html.twig', [
            'controller_name' => 'LearningController',
        ]);
    }

    #[Route('/about-becode', name: 'about')]

    public function about(): Response
    {
         return $this->render('showMyName.html.twig', [
       'name' => 'User'
             ]);
    }

    /**
     * @Route("/", name="showMyName")
     * @param SessionInterface $session
     * @return Response
     */

    public function showMyName(SessionInterface $session): Response
    {
        if ($session->get('name')) {
            $name = $session->get('name');
        } else {
            $name = 'Unknown';

        }
        return $this->render('showMyName.html.twig', [
            'name' => $name
        ]);
    }
    /**
     * @Route("/changeMyName", name="changeMyName", methods={"POST"})
     * @param Request $request
     * @param SessionInterface $session
     * @return RedirectResponse
     */
    public function changeMyName(Request $request,SessionInterface $session):RedirectResponse
    {
        $name= $request->request->get('name');
        $session->set('name',$name);
        return $this->redirectToRoute('showMyName');
    }





}
