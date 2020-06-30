<?php

namespace App\Controller;

use App\Entity\Answer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\QuestionRepository;

use App\Entity\Question;



class ForumController extends AbstractController
{
    /**
     * @Route("/forum/form", name="forum_form")
     */
    public function forumPost(Request $request , EntityManagerInterface $em , SerializerInterface $serializer)
    {
        $jsonrecu=$request->getContent();
        $quest=$serializer->deserialize($jsonrecu,Question::class,'json');
        $em->persist($quest);
        $em->flush();
        return $this->json($quest,201);
    }
    /**
     * @Route("/get_forum", name="get_all_questions", methods={"GET"})
     */
    public function getAllQuestions(): JsonResponse
    {

        $questions = $this->getDoctrine()
            ->getRepository(Question::class)
            ->findAll();
        $data = [];

        foreach ($questions as $question) {
            $data[] = [
                'id' => $question->getId(),
                'description' => $question->getDescription(),
                'author' => $question->getAuthor(),
                'date' => $question->getDate(),
                'answers' => $question->getAnswers()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     * @Route("/get_question_by_id/{id}", name="get_question_by_id", methods={"GET"})
     */
    public function getQuestionById($id): JsonResponse
    {

        $question = $this->getDoctrine()
            ->getRepository(Question::class)
            ->find($id);
        $data = [];


            $data[] = [
                'id' => $question->getId(),
                'description' => $question->getDescription(),
                'author' => $question->getAuthor(),
                'date' => $question->getDate(),
                'answers' => $question->getAnswers()
            ];


        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     * @Route("/answer/form", name="answer_form")
     */
    public function answerPost(Request $request , EntityManagerInterface $em , SerializerInterface $serializer)
    {
        $jsonrecu=$request->getContent();
        $answ=$serializer->deserialize($jsonrecu,Answer::class,'json');
        $em->persist($answ);
        $em->flush();
        return $this->json($answ,201);
    }


    /**
     * @Route("/get_answers", name="get_all_answers", methods={"GET"})
     */
    public function getAllAnswers(): JsonResponse
    {

        $answers = $this->getDoctrine()
            ->getRepository(Answer::class)
            ->findAll();
        $data = [];

        foreach ($answers as $answer) {
            $data[] = [
                'id' => $answer->getId(),
                'description' => $answer->getDescription(),
                'author' => $answer->getAuthor(),
                'date' => $answer->getDate()
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
