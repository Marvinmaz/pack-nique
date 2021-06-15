<?php

namespace App\Controller;

use App\Entity\Pack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BasketController extends AbstractController {

    /**
     * @Route("/basket", name="cart_index")
     */

    public function index(SessionInterface $session){
        $repository = $this->getDoctrine()->getRepository(Pack::class);
        $basket = $session->get('basket');

        $basketWithData= [];
        if ($basket) {
            foreach ($basket as $id => $quantity) {
                $basketWithData[] = [
                    'pack' => $repository->find($id),
                    'quantity' => $quantity, 
                ];
            }
        }

        $total = 0;

        foreach ($basketWithData as $item) {
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

    public function add($id, SessionInterface $session){

        $basket = $session->get('basket', []);

        if(!empty($basket[$id])) {
            $basket[$id]++;
        } else {            
            $basket[$id] = 1;
        }

        $session->set('basket', $basket);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/delete-pack-basket/{id}", name ="delete_Basket")
     */

    public function delete($id, SessionInterface $session) : Response{

        $basket = $session->get('basket', []);

        if (!empty($basket[$id])) {
            unset($basket[$id]);
        }

        $session->set('basket', $basket);

        return $this->redirectToRoute("cart_index");
    }

}