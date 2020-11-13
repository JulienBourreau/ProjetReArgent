<?php

namespace App\Controller;

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
}
