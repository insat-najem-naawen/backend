<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


use App\Entity\Ressource;



class RessourceController extends AbstractController
{
    /**
     * @Route("/post_ressources", name="ressource")
     */
    public function post_ressource(Request $request , EntityManagerInterface $em , SerializerInterface $serializer)
    {
        $jsonrecu=$request->getContent();
        $ress=$serializer->deserialize($jsonrecu,Ressource::class,'json');
        $em->persist($ress);
        $em->flush();
        return $this->json($ress,201);
    }
    /**
     * @Route("/get_ressources/formation", name="get_ressources_formation", methods={"GET"})
     */
    public function getRessourcesFormation(): JsonResponse
    {

        $ressources = $this->getDoctrine()
            ->getRepository(Ressource::class)
            ->findBy(['category' => 'formation']);
        $data = [];

        foreach ($ressources as $ressource) {
                $data[] = [
                    'id' => $ressource->getId(),
                    'description' => $ressource->getDescription(),
                    'title' => $ressource->getTitle(),
                    'category' => $ressource->getCategory(),
                    'link' => $ressource->getLink(),
                    'university' => $ressource->getUniversity()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }




    /**
     * @Route("/get_ressources/News", name="get_ressources_News", methods={"GET"})
     */
    public function getRessourcesNews(): JsonResponse
    {

        $ressources = $this->getDoctrine()
            ->getRepository(Ressource::class)
            ->findBy(['category' => 'News']);
        $data = [];

        foreach ($ressources as $ressource) {
            $data[] = [
                'id' => $ressource->getId(),
                'description' => $ressource->getDescription(),
                'title' => $ressource->getTitle(),
                'category' => $ressource->getCategory(),
                'link' => $ressource->getLink(),
                'university' => $ressource->getUniversity()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     * @Route("/get_ressources/documents", name="get_ressources_documents", methods={"GET"})
     */
    public function getRessourcesDocuments(): JsonResponse
    {

        $ressources = $this->getDoctrine()
            ->getRepository(Ressource::class)
            ->findBy(['category' => 'documents']);
        $data = [];

        foreach ($ressources as $ressource) {
            $data[] = [
                'id' => $ressource->getId(),
                'description' => $ressource->getDescription(),
                'title' => $ressource->getTitle(),
                'category' => $ressource->getCategory(),
                'link' => $ressource->getLink(),
                'university' => $ressource->getUniversity()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     * @Route("/get_ressource/{id}", name="get_ressource", methods={"GET"})
     */
    public function getRessourceById($id): JsonResponse
    {

        $ressource = $this->getDoctrine()
            ->getRepository(Ressource::class)
            ->find($id);
        $data = [];

            $data[] = [
                'id' => $ressource->getId(),
                'description' => $ressource->getDescription(),
                'title' => $ressource->getTitle(),
                'category' => $ressource->getCategory(),
                'link' => $ressource->getLink(),
                'university' => $ressource->getUniversity()
            ];


        return new JsonResponse($data, Response::HTTP_OK);
    }
}