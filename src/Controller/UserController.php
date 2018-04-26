<?php


//Unique Controlleur, vu sa taille j'ai préféré ne pas le diviser en pages/requêtes notamment pour simplifier les tests
namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produit;
use App\Entity\Panier;
use App\Service\PanierMaker;

class UserController extends Controller
{
    /**
     * @Route("/home", name="main")
     */
    public function index(Session $session,PanierMaker $panier)
    {


      $productArray=$this->getDoctrine()->getRepository(Produit::class)->sendData();
      //sorting array by name
      usort($productArray, function($a, $b)
        {
            return strcmp(strtolower($a->getNom()),strtolower( $b->getNom()));
        });


      return $this->render('main/index.html.twig', [
          'tw_Products'=> $productArray,
          'tw_nbItemShop'=>count($productArray)

      ]);
    }
    /**
     * @Route("/product/{id}", name="product",requirements={"id"="\d+"})
     */
    public function seeProduct($id,Session $session,PanierMaker $panier){

      $product = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->find($id);
        if (!$product) {
          throw $this->createNotFoundException('No product found for id '.$id);
        }
        $addUrl='addProduct/'.$id;
        return $this->render('main/viewProduct.html.twig', [
            'tw_Title' => $product->getNom(),
            'tw_Description' => $product->getDescription(),
            'tw_Prix' =>$product->getPrix(),
            'tw_id'=>$product->getId(),
            'tw_addUrl'=>$addUrl //url de la page de requête d'ajout produit concerné
        ]);
    }

    /**
     * @Route("/panier", name="basketpage")
     */
    public function pagePanier(PanierMaker $panierMaker,Session $session){
      $panier=$panierMaker->loadPanier($session);
      $arr_panier=$panier->getarr_prodAndQty();

      return $this->render('main/viewBasket.html.twig', [
          'tw_Products' =>$arr_panier ,
          'tw_nbDiffProducts' => count($panier->getarr_prodAndQty())-1,
          'tw_totalPrice' => $panier->checkOutPrice()
      ]);
    }


    /**
     * @Route("/panier/reset", name="resetbasketpage")
     */
    public function resetBasket(PanierMaker $panierMaker,Session $session){
      $panierMaker->resetBasket($session);
      return $this->redirectToRoute('basketpage');
    }

    /**
     * @Route("/nbItem", name="nbItem")
     */
    public function getNbofItem(PanierMaker $panierMaker,Session $session){

      return new Response($panierMaker->getNbofItem($session));
    }

    /**
     * @Route("/product/addProduct/{id}", name="addproduct",requirements={"id"="\d+"})
     */
    public function addProduct(PanierMaker $panierMaker,Session $session,$id){
      $product = $this->getDoctrine()->getRepository(Produit::class)->find($id);
      $request=Request::createFromGlobals();
      $quantity=$request->request->get('quantity');
      $panierMaker->putProduct($product,$quantity,$session);
      return new Response($panierMaker->getNbofItem($session));
    }


}
