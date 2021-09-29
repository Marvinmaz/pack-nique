<?php

namespace tests\App\Controller;
use App\Controller\SoldController;
use PHPUnit\Framework\TestCase;

class SoldControllerTest extends Testcase {
    public function testCreateSold() {
      $sold = new SoldController([
        "name" => "Campagnard",
        "picture" => null,
        "price" => "25",
        "categories" => "vegan",
        "content" => "super sandwich",
        "id" => 1,
        "quantity" => 1,
      ]);
    $this->assertSame(25, $sold->createSold());  
              
    }
}