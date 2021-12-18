<?php

namespace App\Controller;

use App\Entity\Membres;
use App\Entity\Soiree;
use App\Entity\Transactions;
use App\Form\AddSoireeType;
use App\Repository\TransactionsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
    public function soirees_list(Request $request, ManagerRegistry $doctrine)
    {
        $soirees = $doctrine->getRepository(Soiree::class)->findAll();


        return $this->render('soirees/list.html.twig', [
            'soirees' => $soirees,
        ]);
    }

    #[Route('soirees/manage/{id}', name:'soirees_manage')]
    public function soirees_manage($id, Request $request, ManagerRegistry $doctrine, TransactionsRepository $tr){

        $membres = $doctrine->getRepository(Membres::class)->findBy(['id_soiree' => $id]);

        $party = $doctrine->getRepository(Membres::class)->find($id);

        $transactions = $doctrine->getRepository(Transactions::class)->findBy(['id_soiree' => $id]);
        /*$em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('SELECT transactions.id,transactions.montant,membres.name FROM transactions JOIN membres ON membres.id = transactions.id_membre WHERE transactions.id = :id');
        $query->setParameter(':id', $id);
        $transactions = $query->getResult();
*/

        $totalTransactions = $this->getDoctrine()
            ->getRepository(Transactions::class)
            ->getTotalTransactions($id);


        return $this->render('soirees/manage.html.twig', [
            'membres' => $membres,
            'party' => $party,
            'transactions' => $transactions,
            'totalTransactions' => $totalTransactions
        ]);

    }

    #[Route('soirees/manage-post', name:'soirees_manage_post')]
    public function soirees_manage_post(Request $request){

        $em = $this->getDoctrine()->getManager();
        $transaction = new Transactions;

        //post input (soirees/manage.html.twig)
        $transaction->setIdMembre(filter_input(INPUT_POST, 'idM'));
        $transaction->setIdSoiree(filter_input(INPUT_POST, 'idP'));
        $transaction->setMontant(filter_input(INPUT_POST, 'montant'));

        $em->persist($transaction);

        $em->flush();

        return $this->redirectToRoute("soirees_list");
    }

    #[Route('soirees/delete/{id}', name:'soirees_delete')]
    public function soiree_delete($id,ManagerRegistry $doctrine){

        $em = $doctrine->getManager();
        $soiree = $em->getRepository(Soiree::class)->find($id);

        $em->remove($soiree);
        $em->flush();

        return $this->redirectToRoute("soirees_list");

    }
}
