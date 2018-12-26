<?php

namespace ChristmasShopBundle\Controller;

use ChristmasShopBundle\Entity\User;
use ChristmasShopBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin")
 * Class AdminController
 * @package ChristmasShopBundle\Controller
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin_allUsers")
     */
    public function viewUsersAction()
    {
        $users=$this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('admin/viewUsers.html.twig',['users'=>$users]);
    }

    /**
     * @Route("/user/{id}", name="admin_user")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewSingleUser($id)
    {
        $singleUser=$this->getDoctrine()->getRepository(User::class)->find($id);

        if (null === $singleUser){
           return $this->redirectToRoute('admin_allUsers');
        }

        return $this->render('admin/singleUser.html.twig',['user'=>$singleUser]);
    }
    /**
     * @Route("/delete/{id}", name="admin_delete")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function removeUserAction($id,Request $request)
    {
        $user=$this->getDoctrine()->getRepository(User::class)->find($id);

        if (null===$user) {
            return $this->redirectToRoute('admin_allUsers');
        }

        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->render('admin/deleteUsers.html.twig',
            ['form'=>$form->createView(), 'user'=>$user]);
    }
}
