<?php

namespace App\Controller;
use App\Entity\Bookings;
use App\Entity\Room;
use App\Entity\User;
use phpDocumentor\Reflection\Types\Integer;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class RoomController extends AbstractController
{
    #[Route('', name: 'home')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controllers' => 'RoomController',
        ]);
    }
    /**
     * @Route("/booking_list", name= "booking_list")
     * Method({"GET"})
     */
    public function home(ManagerRegistry $doctrine): Response
    {
        $bookings = $doctrine->getRepository(
            Bookings::class)->findAll();
        $users = $doctrine->getRepository(
            Bookings::class)->findAll();
        return $this->render('room/index.html.twig', [
            'bookings' => $bookings,'users'=>$users
        ]);
    }
    /**
     * @Route("/booking/{id}", name= "booking_show")

     */
    public function show(ManagerRegistry $doctrine,$id): Response
    {
        $booking = $doctrine->getRepository(
            Bookings::class
        )->find($id);
        return $this->render('room/show.html.twig',[
            'booking'=>$booking
        ]);
    }
    /**
     * @Route{"/booking/delete/{id}")
     * Method({"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine,Request $request, $id)
    {
        $booking = $doctrine->getRepository(
            Bookings::class
        )->find($id);
        $entityManager = $doctrine->getManager();
        $entityManager->remove($booking);
        $entityManager->flush();
        $response = new Response();
        $response->send();

    }
//   /**
//    * @Route("/room/save", name="save_room")
//     */
//    public function save(ManagerRegistry $doctrine): Response
//    {
//        $user = new User();
//        $user->setUsername('zain');
//        $user->setEmail('zain@gmail.com');
//        $user->setPassword('1234z');
//        $user->setCredit(150);
//        $user->setPremiumMember(true);
//
//        $em= $doctrine->getManager();
//       $booking = new Bookings();
//        $dob = new \DateTime("2022-01-12");
//        $booking->setStartdate($dob);
//       $booking->setEnddate($dob);
//        $booking->setUser($user);
//        $em->persist($user);
//       $em->persist($booking);
//        $em->flush();
//       return new Response('saved an room with id of'.$booking->getId());
//
//    }


    /**
     * @Route("/room/new", name="new_room")
     * Method({"GET","POST"})
     */
    public function new(ManagerRegistry $doctrine,Request $request): Response
    {
        $booking = new Bookings();


        $form = $this->createFormBuilder($booking)
            ->add('Startdate',DateType::class,
                array('attr'=>array('class'=>'form-control','required' => true)))
            ->add('Enddate',DateType::class,
            array('attr'=>array('class'=>'form-control p-10','required'=>true)
            ))
//          ->add('user',EntityType::class,array('attr'=>array('class'=>'form-control p-10')
//
//               ))

            ->add('save',SubmitType::class,array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-4 ','required' => true)
            ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $booking =$form->getData();
     var_dump($booking);
            return $this->render('room/new.html.twig',array(
            ));
//            $entityManager = $doctrine->getManager();
//            $entityManager->persist($booking);
//
//            $entityManager->flush();
//            return $this->redirectToRoute('booking_list');
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
