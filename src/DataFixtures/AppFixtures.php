<?php
#src/DataFixtures/appFixtures.php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture {
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    { 
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i <= 5; $i++) {
            $user = new User($this->passwordHasher);

            $user->setUsername($faker->username())
                ->setMail($faker->email())
                ->setPassword($this->passwordHasher->hashPassword($user, "password"));

            $manager->persist($user);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
