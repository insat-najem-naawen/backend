<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class FormController extends AbstractController
{
    /**
     * @Route("/api/form", name="form" , methods={"POST"} )
     */
    public function formc(Request $request , SerializerInterface $serializer , EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
$jsonrec=$request->getContent();
$user=$serializer->deserialize($jsonrec,User::class ,'json');

$hash = $encoder->encodePassword($user, $user->getPassword());
$user->setPassword($hash);

$em->persist($user);
$em->flush();
//return $this->json($user,201);

dd($jsonrec);
    }

    /**
     * @Route("/api/login_check"  , name = "security_login")
     */
    public function login(){

        return(true);

    }
    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout() {}
}
