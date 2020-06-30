<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Resume;



class ResumeController extends AbstractController
{
    /**
     * @Route("/post_resume", name="post_resume")
     */
    public function postResume(Request $request , EntityManagerInterface $em , SerializerInterface $serializer)
    {
        $jsonrecu=$request->getContent();
        $res=$serializer->deserialize($jsonrecu,Resume::class,'json');
        $em->persist($res);
        $em->flush();
        return $this->json($res,201);
    }
    /**
     * @Route("/get_resumes", name="get_all_resumes", methods={"GET"})
     */
    public function getAllResumes(): JsonResponse
    {

        $resumes = $this->getDoctrine()
            ->getRepository(Resume::class)
            ->findAll();
        $data = [];

        foreach ($resumes as $resume) {
            $data[] = [
                'id' => $resume->getId(),
                'name' => $resume->getName(),
                'firstName' => $resume->getFirstName(),
                'job' => $resume->getJob(),
                'location' => $resume->getLocation(),
                'email' => $resume->getEmail(),
                'phoneNumber' => $resume->getPhoneNumber(),
                'skills' => $resume->getSkills(),
                'languages' => $resume->getLanguages(),
                'workExperience' => $resume->getWorkExperience(),
                'education' => $resume->getEduction()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/get_resume/{id}", name="get_resume", methods={"GET"})
     */
    public function getResumeById($id): JsonResponse
    {

        $resume = $this->getDoctrine()
            ->getRepository(Resume::class)
            ->find($id);
        $data = [];

            $data[] = [
                'id' => $resume->getId(),
                'name' => $resume->getName(),
                'firstName' => $resume->getFirstName(),
                'job' => $resume->getJob(),
                'location' => $resume->getLocation(),
                'email' => $resume->getEmail(),
                'phoneNumber' => $resume->getPhoneNumber(),
                'skills' => $resume->getSkills(),
                'languages' => $resume->getLanguages(),
                'workExperience' => $resume->getWorkExperience(),
                'education' => $resume->getEducation()
            ];


        return new JsonResponse($data, Response::HTTP_OK);
    }


}
