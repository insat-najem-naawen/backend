<?php
namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    /**
     * @Route("/get_users", name="get_all_users", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'last_name' => $user->getLastName(),
                'first_name' => $user->getFirstName(),
                'username' => $user->getUsername()
            ];

        }
        return new JsonResponse($data, Response::HTTP_OK);

    }
    /**
     * @Route("/get_user/{id}", name="get_user_by_id", methods={"GET"})
     */
    public function getUserById($id) : JsonResponse
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);
        $data = [];
        $data[] = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'last_name' => $user->getLastName(),
            'first_name' => $user->getFirstName(),
            'username' => $user->getUsername()];
        return new JsonResponse($data, Response::HTTP_OK);
    }
    /**
     * @Route("/get_user_email/{email}", name="get_user_by_email", methods={"GET"})
     */
    public function getUserbyEmail($email): JsonResponse
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['email'=> $email]);
        $data = [];
        $data[] = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'last_name' => $user->getLastName(),
            'first_name' => $user->getFirstName(),
            'username' => $user->getUsername()];
        return new JsonResponse($data, Response::HTTP_OK);
    }
}