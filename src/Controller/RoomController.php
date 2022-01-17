<?php

namespace App\Controller;
use App\Entity\Room;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RoomController extends AbstractController
{
    #[Route('/', name: 'n')]
    public function index(): Response
    {
        return $this->render('room/index.html.twig', [
            'controller_name' => 'RoomController',
        ]);
    }
    #[Route('/home', name: 'home')]

    public function home(): Response
    {
        return $this->render('room/index.html.twig', [
            'hey'
        ]);
    }

    /**
     * @Route("/room/new", name="new_room")
     * Method({"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $room = new Room();
        $form = $this->createFormBuilder($room)
            ->add('name',TextType::class,
                array('attr'=>array('class'=>'form-control','id'=>'ex3')))
            ->add('onlyForPremiumMembers',TextareaType::class,
            array('required'=>false,
                'attr'=>array('class'=>'form-control p-10')))
            ->add('save',SubmitType::class,array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-4 ')
            ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $room =$form->getData();
            $entityManager = $this->getDoctrine->getManager();
            $entityManager->persist($room);
            $entityManager->flush();
            return $this->redirectToRoute('/home');
        }
        return $this->render('room/new.html.twig',array(
            'form' => $form->createView()
        ));

    }
    #[Route('/book', name: 'book')]

    public function book(): Response
    {
        return $this->render('book.html.twig', [
            'hey'
        ]);
    }

}
