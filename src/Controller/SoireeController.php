<?php

namespace App\Controller;

use App\Form\AjoutPersonneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;

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
    public function ajouter(Request $request)
    {
        $personne = new Personne();

        $form = $this->createForm(AjoutPersonneType::class, $personne);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //récupération de l'entityManager
            $em = $this->getDoctrine()->getManager();

            $em->persist($personne);

            $em->flush();

            return $this->redirectToRoute("personne", ["idPersonne"=>$personne->getNom()->getId()]);
        }

        return $this->render("soiree/index.html.twig", [
            "formulaire" => $form->createView()
        ]);
    }
}
