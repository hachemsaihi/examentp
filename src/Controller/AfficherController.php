<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\PFE;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AfficherController extends AbstractController
{
    #[Route('/', name: 'afficher')]
    public function index(ManagerRegistry $doc): Response
    {$repo=$doc->getRepository(PFE::class);
        $pfes=$repo->findByExampleField();
        dd($pfes);
        $names=array();
        $repo1=$doc->getRepository(Entreprise::class);


        for ($i=0;$i<count($pfes);$i++)
        { if($pfes[$i]["nbr"]!=0) {
            $entreprise = $repo1->findBy(["id" => $pfes[$i]["id"]]);
            $name = $repo->findBy(["entreprise" => $entreprise]);
            $names[]=$name;
        }
        }

        return $this->render('affichage/index.html.twig', [
            'pfes' => $pfes,
            'names'=>$names,
            'count'=>count($pfes)
        ]);
    }
}
