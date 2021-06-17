<?php

namespace App\Controller;

use App\Entity\Pack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BasketController extends AbstractController {

    /**
     * @Route("/basket", name="cart_index")
     */

    public function index(SessionInterface $session){
        $repository = $this->getDoctrine()->getRepository(Pack::class);
        $basket = $session->get('basket');          // On récupère le panier qu'il y a dans la session

        $basketWithData= [];          // Pour avoir plus de détails sur les objets que l'on récupère
        if ($basket) {
            foreach ($basket as $id => $quantity) { 
                $basketWithData[] = [
                    'pack' => $repository->find($id),
                    'quantity' => $quantity, 
                ];
            }
        }

        $total = 0;

        foreach ($basketWithData as $item) {         // On boucle pour faire le calcul qui permet de faire le total et de l'afficher dans le template twig
            $totalItem = $item['pack']->getPrice() * $item['quantity'];
            $total += $totalItem;
        }
        $session->set("totalPrice", $total);

        return $this->render('basket/basket.html.twig', [
            'items' => $basketWithData,
            'total' => $total 
        ]);
    }

    /**
     * @Route("/basket/add/{id}", name="cart_add")
     */

    public function add($id, SessionInterface $session){   // on accède à la session
        
        $basket = $session->get('basket', []);   // on créer un panier avec un tableau vide représentant les objets

        if(!empty($basket[$id])) {         // si le panier n'est pas vide et que l'objet existe déjà, on rajoute une quantité
            $basket[$id]++;
        } else {            
            $basket[$id] = 1;            // si le panier est vide , On rajoute le produit dans le panier
        }

        $session->set('basket', $basket);  // on sauvegarde notre panier avec les nouveaux objets

        return $this->redirectToRoute("cart_index");   
    }

    /**
     * @Route("/delete-pack-basket/{id}", name ="delete_Basket")
     */

    public function delete($id, SessionInterface $session) : Response{

        $basket = $session->get('basket', []);      // On récupère le panier de la session

        if (!empty($basket[$id])) {        // Si le panier n'est pas vide, on supprime l'objet du panier
            unset($basket[$id]);
        }

        $session->set('basket', $basket);   // On remet le nouveau panier dans la session

        return $this->redirectToRoute("cart_index");  // On retourne dans la page du panier
    }

    /**
     * @Route("/error", name="error")
     */
    public function error(){
        return $this->render("error/errorId.html.twig");
    }

}