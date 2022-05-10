<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\PFE;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Pfefixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker=Factory::create("fr_FR");
        for($i=0;$i<200;$i++)
        {   $id=$faker->numberBetween(101,150);
            $repo=$manager->getRepository(Entreprise::class);
            $entreprise=$repo->findBy(["id"=>$id]);
            $pfe=new PFE();
            $pfe->setEntreprise($entreprise[0]);
            $pfe->setStudentname($faker->name);
            $pfe->setTitle($faker->jobTitle);
            $manager->persist($pfe);
        }
        $manager->flush();
    }
}
