<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Question;



class ForumController extends AbstractController
{
    /**
     * @Route("api/forum", name="forum")
     */
    public function forum(Request $request , EntityManagerInterface $em , SerializerInterface $serializer)
    {
        $jsonrecu=$request->getContent();
        $quest=$serializer->deserialize($jsonrecu,Question::class,'json');
        $em->persist($quest);
        $em->flush();
        return $this->json($quest,201);
    }
}
