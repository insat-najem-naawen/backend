<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TokenController extends AbstractController
{
    /**
     * @Route("/api/tokens")
     */
    public function newTokenAction()
    {
        return new Response('TOKEN!');
    }
}
