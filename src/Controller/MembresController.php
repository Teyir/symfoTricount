<?php

namespace App\Controller;

use App\Entity\Membres;
use App\Form\AddMembersType;
use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembresController extends AbstractController
{

    #[Route('/membres', name: 'home')]
    public function index(MembresRepository $repo, ManagerRegistry $doctrine): Response
    {

        $membresInactifs = $doctrine->getRepository(Membres::class)->findBy(['id_soiree' => NULL]);


        return $this->render('membres/index.html.twig', [
            'membres' => $membresInactifs,
        ]);

    }

    #[Route('/membres/select/{id}', name: 'membres_select')]
    public function membres_select($id, Request $request){
        $repo = $this->getDoctrine()->getRepository(Membres::class);
        $membre = $repo->find($id);

        return $this->render("membres/select.html.twig", [
           "membre" => $membre
        ]);
    }

    #[Route('/membres/add', name:'membres_add')]
    public function membres_add(Request $request)
    {
        $membres = new Membres;

        $form = $this->createForm(AddMembersType::class, $membres);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($membres);

            $em->flush();

            return $this->redirectToRoute("home");
        }


        return $this->render('membres/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }




}
