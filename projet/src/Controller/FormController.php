<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FormController extends AbstractController
{
    /**
     * @Route("/api/form", name="form" , methods={"POST"} )
     */
    public function formc(Request $request , SerializerInterface $serializer , EntityManagerInterface $em)
    {
$jsonrec=$request->getContent();
$user=$serializer->deserialize($jsonrec,User::class ,'json');
$em->persist($user);
$em->flush();
//return $this->json($user,201);

dd($user);
    }
}
