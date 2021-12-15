<?php

namespace App\Controller;

use App\Entity\Soiree;
use App\Form\AddSoireeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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


    #[Route('/soirees/add', name:'soirees_add')]
    public function soirees_add(Request $request)
    {
        $soirees = new Soiree;

        $form = $this->createForm(AddSoireeType::class, $soirees);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($soirees);

            $em->flush();

            return $this->redirectToRoute("home");
        }


        return $this->render('soirees/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/soirees/list', name:'soirees_list')]
    public function soirees_list(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Soiree::class);

        $soirees = $repo->findAll();


        return $this->render('soirees/list.html.twig', [
            'soirees' => $soirees,
        ]);
    }
}
