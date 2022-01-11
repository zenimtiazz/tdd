<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


use App\Service\Master;

class IndexController extends AbstractController
{
    /**
     * @Route("/master", name="master")
     * @param Master $transform
     * @return Response
     */
    public function index(Master $transform): Response
    {
        $message = "";
        $request = Request::createFromGlobals();
        if ($request->isMethod('POST')) {
            if ($request->request->get('message')) {
                $message = $request->request->get('message');
                $className = $request->request->get('classNames');
                $transform->setMessage($message);
                $message = $transform->transform($message, $className);
                $transform->log();
            }
        }
        return $this->render('/about.html.twig', [
            'message' => $message,
        ]);
    }
}
