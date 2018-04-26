<?php

namespace App\Tests\Entity;

use App\Entity\Panier;
use App\Entity\Produit;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
class PanierTest extends TestCase
{
  public function testcheckcheckOutPrice(){
    $panier=new Panier();
    $product1=new Produit(20,'test1','laDescription1',1200);
    $product2=new Produit(21,'test2','laDescription2',200);
    $product3=new Produit(22,'test3','laDescription3',12345);
    $product= array($product1,$product2,$product3);
    $price=array($product[0]->getPrix(),$product[1]->getPrix(),$product[2]->getPrix());
    $quantity=array(3,7,8);
    $panier->putProduct($product[0],$quantity[0]);
    $panier->putProduct($product[1],$quantity[1]);
    $panier->putProduct($product[2],$quantity[2]);

    $result=$panier->checkOutPrice();
    $testResult=0;
    for($i=0;$i<3;$i++){
      $testResult+=$price[$i]*$quantity[$i];
    }
    $this->assertEquals($testResult,$result);

  }


}
