<?php

//Classe servant d'interface d'appel à Panier pour le controleur
namespace App\Service;

use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Produit;
use App\Entity\Panier;

class PanierMaker{


  public function putProduct($product,$quantity,Session $session){

    $panier=new Panier();
    $panier->unserialize($session->get('Panier'));
    $panier->putProduct($product,$quantity);

    $session->set('Panier',$panier->serialize());
  }

  public function loadPanier(Session $session){
    $panier=new Panier();
    $panier->unserialize($session->get('Panier'));

    return $panier;
  }
  public function getNbofItem(Session $session){
    $panier=$this->loadPanier($session);
    return $panier->getNbofItem();
  }
  public function resetBasket(Session $session){
    $panier=new Panier();
    $session->set('Panier',$panier->serialize());
  }



}
