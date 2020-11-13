<?php

namespace App\Controller;

use App\Form\AjoutPersonneType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Symfony\Component\HttpFoundation\Request;

class SoireeController extends AbstractController
{
    /**
     * @Route("/soiree", name="soiree")
     */
    public function index(): Response
    {
        return $this->render('soiree/index.html.twig', [
            'controller_name' => 'SoireeController',
        ]);
    }
    /**
    * @Route("/", name="home")
    */
    public function home()
    {

        $repo = $this->getDoctrine()->getRepository(Personne::class);

        $personnes = $repo->findAll();

    	return $this->render('soiree/home.html.twig', [
    	    'controller_name' => 'SoireeController',
            'personnes' => $personnes
        ]);
    }

    /**
     * @Route("/soiree",name="personne_ajouter")
     */
    public function ajouter(Request $request, EntityManagerInterface $entityManager)
    {
        $personne = new Personne();

        $form = $this->createFormBuilder($personne)
                     ->add('nom')
                     ->add('prenom')
                     ->add('argentDepense')
                     ->getForm();

        return $this->render('soiree/home', [
            'formPersonne' => $form->createView()
        ]);
/*
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $personne->setNom($request->request->get('Nom'))
                     ->setPrenom($request->request->get('Prenom'))
                     ->setArgentDepense($request->request->get('ArgentDepense'));

            $manager->persist($personne);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render("soiree/home.html.twig", [
            "form" => $form->createView()
        ]);*/
    }
}
