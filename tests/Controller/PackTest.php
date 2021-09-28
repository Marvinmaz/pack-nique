<?php

namespace App\tests\Controller;

use App\Controller\PackController;
use PHPUnit\Framework\TestCase;

class PackControllerTest extends Testcase {
    public function testNewPack() {
        $packController = new PackController();
        $nomPack = $packController->newPack;
        

        
    }
}


[
  "name" => "Campagnard",
  "price" => "25",
  "categories" => "vegan",
  "content" => "super sandwich",
  "_token" => "de5c.4y1XL6GAUrqszMiv1apEe3ieZMsC9cBu4utITW4rzkI.iV8uTZbhAt6ZqKzFnv12SU3UJ7FpjIoxraoveTZytHSHHnp95M8E_MKYnQ"
]
[
  "picture" => null,
]