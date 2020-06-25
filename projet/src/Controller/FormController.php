<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
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
//        dd("temchi");
return $this->json($user,200);



    }

    /**
     * @Route("/api/login_check"  , name = "security_login")
     */
    public function login(Request $request, SerializerInterface $serializer,UserRepository $userRepository ){
        $jsonrec=$request->getContent();
        $user=$serializer->deserialize($jsonrec,User::class ,'json');
            $user=$userRepository->findOneBy(['email'=>$user->getEmail()]);
        if(!$user){
            throw $this->createNotFoundException();
        }

        $token=$this->get('lexik_jwt_authentication.encoder')
            ->encode([
                'email'=>$user->getEmail(),
            'exp'=>time()+3600
            ]);

   return new JsonResponse(['token'=>$token]);






/*$jsonrec=$request->getContent();
$user=$serializer->deserialize($jsonrec,User::class ,'json');
        $token = $this->getService('lexik_jwt_authentication.encoder')
            ->encode(['email' =>$user.getEmail() ]);
        $response = $this->client->post('/api/login_check', [
            'body' => json_encode($user),
            'headers' => [
                'Authorization' => 'Bearer '.$token
            ]
        ]);
        return $response;*/
    }
    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout() {}
}
