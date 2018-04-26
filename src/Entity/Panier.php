<?php

//Classe panier, non enregistré dans le Doctrine ORM,accessible depuis le service PanierMaker dans le controlleur
namespace App\Entity;



class Panier extends GenericEvent implements \Serializable
{

  private $arr_prodAndQty;

  public function __construct(){
    $this->arr_prodAndQty=array();
  }

  public function setarr_prodAndQty($arr_prodAndQty){
    $this->arr_prodAndQty=$arr_prodAndQty;
  }
  public function getarr_prodAndQty(){
    return $this->arr_prodAndQty;
  }

  public function serialize()
  {
    return serialize(
      [
        $this->arr_prodAndQty
      ]
    );
  }

  public function unserialize($serialized)
  {
    $data = unserialize($serialized);
    list(
      $this->arr_prodAndQty
      ) = $data;
  }

  public function checkOutPrice(){
    $totalPrice=0;
    if(!is_null($this->arr_prodAndQty)){
      foreach($this->arr_prodAndQty as $prodQty){
        $totalPrice+=$prodQty[0]->getPrix()*$prodQty[1];
      }
    }
    return $totalPrice;
  }

  public function putProduct($product,$quantity){
    if($quantity>0){
      $exist=false;
      if(!is_null($this->arr_prodAndQty)){
        $i=0;
        foreach($this->arr_prodAndQty as $prodQty){
          if($prodQty[0]->getId()==$product->getId()){
            $this->arr_prodAndQty[$i][1]+=$quantity;
            $exist=true;
            break;
          }
          $i++;
        }
      }
      if(!$exist){
          $this->arr_prodAndQty[]=array($product,$quantity);
      }
    }


  }

  public function getProduct($i){
    return $this->arr_prodAndQty[$i][0];
  }

  //Renvoie le nombres d'items achetés
  public function getNbofItem(){
    $sum=0;
    if(!is_null($this->arr_prodAndQty)){
      foreach($this->arr_prodAndQty as $prodQty){
        $sum+=$prodQty[1];
      }
  }
    return $sum;
  }


}
