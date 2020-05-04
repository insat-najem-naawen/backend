<?php

namespace App\Controller;



use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MessageController extends AbstractController
{
    /**
     * @Route("/api/message", name="message")
     */
    public function recieve(Request $request, SerializerInterface $serializer , EntityManagerInterface $em)
    {
      $jsonrecu=$request->getContent();
      $msg=$serializer->deserialize($jsonrecu,Message::class,'json');
      $em->persist($msg);
      $em->flush();
        return $this->json($msg,201);
    }
}
