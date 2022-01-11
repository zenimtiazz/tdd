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
     * @param Master $master
     * @return Response
     */
    public function index(Master $master): Response
    {
        $message = "";
        $request = Request::createFromGlobals();
        if ($request->isMethod('POST')) {
            if ($request->request->get('message')) {
                $message = $request->request->get('message');
                $className = $request->request->get('classNames');
                $master->setMessage($message);
                $message = $master->transform($message, $className);
                $master->log();
            }
        }
        return $this->render('/about.html.twig', [
            'message' => $message,
        ]);
    }
}
