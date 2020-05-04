<?php

namespace App\Controller;

use App\Entity\Opportunity;
use App\Repository\OpportunityRepository;
use Doctrine\ORM\EntityManagerInterface;

use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class OpportunityFormController extends AbstractController
{
    /**
     * @Route("api/opportunity/form", name="opportunity_form")
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
     * @Route("api/opportunity/formfilter", name="opportunity_form_filter")
     * @param OpportunityRepository $opportunityRepository
     * @return JsonResponse
     */
    public function joboppor( OpportunityRepository $opportunityRepository ){

$response=$this->json($opportunityRepository->findBy(['category' => 'job']));
return $response;
    }
    /**
     * @Route("api/opportunity/formfilter", name="opportunity_form_filter")
     * @param OpportunityRepository $opportunityRepository
     * @return JsonResponse
     */
    public function trainingoppor( OpportunityRepository $opportunityRepository ){

        $response=$this->json($opportunityRepository->findBy(['category' => 'training']));
        return $response;
    }
    /**
     * @Route("api/opportunity/formfilter", name="opportunity_form_filter")
     * @param OpportunityRepository $opportunityRepository
     * @return JsonResponse
     */
    public function internshipoppor( OpportunityRepository $opportunityRepository ){

        $response=$this->json($opportunityRepository->findBy(['category' => 'internship']));
        return $response;
    }

}
