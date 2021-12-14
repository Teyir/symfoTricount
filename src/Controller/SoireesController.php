<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SoireesController extends AbstractController
{
    /**
     * @Route("/soirees", name="soirees")
     */
    public function index(): Response
    {
        return $this->render('soirees/index.html.twig', [
            'controller_name' => 'SoireesController',
        ]);
    }
}
