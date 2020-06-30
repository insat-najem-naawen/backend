<?php

namespace App\Controller;

use App\Entity\Opportunity;
use App\Repository\OpportunityRepository;
use Doctrine\ORM\EntityManagerInterface;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class OpportunityFormController extends AbstractController
{
    /**
     * @Route("/opportunity/form", name="opportunity_form")
     */
    public function oppformc(Request $request , EntityManagerInterface $em , SerializerInterface $serializer)
    {
$jsonrecu=$request->getContent();
$oppor=$serializer->deserialize($jsonrecu,Opportunity::class,'json');
$em->persist($oppor);
$em->flush();
        return $this->json($oppor,201);
    }

    /**
     * @Route("/opportunity/formfilter/job", name="opportunity_form_filter")
     * @param OpportunityRepository $opportunityRepository
     * @return JsonResponse
     */
    public function joboppor( OpportunityRepository $opportunityRepository ){

$response=$this->json($opportunityRepository->findBy(['category' => 'job']));
return $response;
    }
    /**
     * @Route("/opportunity/formfilter/training", name="opportunity_form_filter")
     * @param OpportunityRepository $opportunityRepository
     * @return JsonResponse
     */
    public function trainingoppor( OpportunityRepository $opportunityRepository ){

        $response=$this->json($opportunityRepository->findBy(['category' => 'training']));
        return $response;
    }
    /**
     * @Route("/opportunity/formfilter/internship", name="opportunity_form_filter")
     * @param OpportunityRepository $opportunityRepository
     * @return JsonResponse
     */
    public function internshipoppor( OpportunityRepository $opportunityRepository ){

        $response=$this->json($opportunityRepository->findBy(['category' => 'internship']));
        return $response;
    }
    /**
     * @Route("/get_oppor/internship", name="get_all_opportunities_int", methods={"GET"})
     */
    public function getAllInt(): JsonResponse
    {

        $opportunities = $this->getDoctrine()
            ->getRepository(Opportunity::class)
            ->findBy(['category' => 'internship']);
        $data = [];

        foreach ($opportunities as $opportunity) {
            $data[] = [
                'id' => $opportunity->getId(),
                'description' => $opportunity->getDescription(),
                'user' => $opportunity->getUser(),
                'published_on' => $opportunity->getPublishedOn(),
                'domain' => $opportunity->getDomain(),
                'link' => $opportunity->getLink(),
                'title' => $opportunity->getTitle(),
                'category' => $opportunity->getCategory()

            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
    /**
     * @Route("/get_oppor/job", name="get_all_opportunities_job", methods={"GET"})
     */
    public function getAllJob(): JsonResponse
    {

        $opportunities = $this->getDoctrine()
            ->getRepository(Opportunity::class)
            ->findBy(['category' => 'job']);
        $data = [];

        foreach ($opportunities as $opportunity) {
            $data[] = [
                'id' => $opportunity->getId(),
                'description' => $opportunity->getDescription(),
                'user' => $opportunity->getUser(),
                'published_on' => $opportunity->getPublishedOn(),
                'domain' => $opportunity->getDomain(),
                'link' => $opportunity->getLink(),
                'title' => $opportunity->getTitle(),
                'category' => $opportunity->getCategory()

            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/get_oppor/training", name="get_all_opportunities_taining", methods={"GET"})
     */
    public function getAllTraining(): JsonResponse
    {

        $opportunities = $this->getDoctrine()
            ->getRepository(Opportunity::class)
            ->findBy(['category' => 'training']);
        $data = [];

        foreach ($opportunities as $opportunity) {
            $data[] = [
                'id' => $opportunity->getId(),
                'description' => $opportunity->getDescription(),
                'user' => $opportunity->getUser(),
                'published_on' => $opportunity->getPublishedOn(),
                'domain' => $opportunity->getDomain(),
                'link' => $opportunity->getLink(),
                'title' => $opportunity->getTitle(),
                'category' => $opportunity->getCategory()

            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
    /**
     * @Route("/get_oppor_by_id/{id}", name="get_oppor", methods={"GET"})
     */
    public function getById($id): JsonResponse
    {

        $opportunity = $this->getDoctrine()
            ->getRepository(Opportunity::class)
            ->find($id);
        $data = [];


        $data[] = [
            'id' => $opportunity->getId(),
            'description' => $opportunity->getDescription(),
            'user' => $opportunity->getUser(),
            'published_on' => $opportunity->getPublishedOn(),
            'domain' => $opportunity->getDomain(),
            'link' => $opportunity->getLink(),
            'title' => $opportunity->getTitle(),
            'category' => $opportunity->getCategory()

        ];


        return new JsonResponse($data, Response::HTTP_OK);
    }
}
