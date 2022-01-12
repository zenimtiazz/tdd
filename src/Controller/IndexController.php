<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Service\Master;
use App\Service\Capitalize;
use App\Service\Log;
use App\Service\Change;


class IndexController extends AbstractController
{
    /**
     * @Route("/master", name="master")
     * @param Request $request

     * @return Response
     */
    public function index(Request $request): Response
    {
        $capitalize = new Capitalize();
        $change= new Change();
        $log = new Log();
        $message = "";
        // Request::createFromGlobals(); method initializes a new Request Obj.
        $request = Request::createFromGlobals();
        if ($request->isMethod('POST')) {
            if ($request->request->get('message')) {
                $message = $request->request->get('message');
                $className = $request->request->get('classNames');
                if($className === 'Capitalize'){
                    $master = new Master($capitalize,$log);
                 $message=  $master->transform($message);
                 $master->log($message);


                }

               elseif($className === 'Change'){
                    $master = new Master($change,$log);
                 $message= $master->transform($message);
                   $master->log($message);

               }
            }
        }
        return $this->render('/about.html.twig', [
            'message' => $message,
        ]);
    }
}
