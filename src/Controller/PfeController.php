<?php

namespace App\Controller;

use App\Entity\PFE;
use App\Form\FormpfeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PfeController extends AbstractController
{
    #[Route('/pfe', name: 'app_pfe')]
    public function index(ManagerRegistry $doc,Request $request): Response
    {   $pfe=new PFE();
        $form=$this->createForm(FormpfeType::class,$pfe);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $manager=$doc->getManager();
            $manager->persist($pfe);
            $manager->flush();
            return $this->redirectToRoute("app_show");
        }
        return $this->render('pfe/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
