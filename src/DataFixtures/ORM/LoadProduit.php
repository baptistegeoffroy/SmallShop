<?php

namespace App\DataFixtures\ORM;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProduit extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $produitArr = array(new Produit(1,'RazorKeyboard','Un clavier surcoté',8000),
          new Produit(2,'Logitech Low-Profile','Un clavier pour les petits doigts',2000),
          new Produit(3,'Logitech Mechanical Low-Profile','Un clavier pour les petits doigts,mécanique',9000),
          new Produit(4,'RazorKeyboard MX700','Un clavier très surcoté',18000),
          new Produit(5,'RazorKeyboard MX800','Certainement le clavier le plus surcoté',25000),
          new Produit(6,'WoW Keyboard GM','Un clavier pour muter ses mates,ça n\'a pas de prix',80000),
          new Produit(7,'The Ring Keyboard','Un clavier pour les gouverner tous!',100000),
          new Produit(8,'Random Keyboard 1','Un clavier simple',8000),
          new Produit(9,'Random Keyboard 2','Un clavier simple',8000),
          new Produit(10,'Random Keyboard 3','Un clavier simple',8800),
          new Produit(11,'DJ Keyboard','Un clavier avec des touches volumes et next track!',3500),
          new Produit(12,'COMPAQ Keyboard','Un clavier PS2',80));

        foreach($produitArr as $produit){
            $manager->persist($produit);
        }

        $manager->flush();


    }

    public function getOrder()
    {
        return 1;
    }
}
