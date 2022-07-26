<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    private static $phoneBrands = [
        'Apple',
        'Samsung',
        'Xiaomi',
        'Nokia'
    ];

    private static $phoneDesciption = [
        "Son écran LCD Liquid Retina 6.1’’et son design en verre ultra
         résistant vous offre un style à la fois élégant et robuste,
          puisqu'il est conçu pour être résistant aux chocs et à l’immersion dans l’eau.",

        'Téléphone portable haut de gamme, un véritable bijou de technologie qui saura satisfaire 
        les utilisateurs à la recherche d’un mobile très performant. Doté d’une puce Exynos 2200, 
        couplée à une mémoire vive de 8 Go, ',

        'Elégant et léger, le Smartphone possède un écran Amoled Full HD+, recouvrant 
        l’intégralité de la dalle, ainsi que 2 haut-parleurs stéréo, pour une sensation
         d’immersion totale. Côté autonomie, ce smartphone dispose d’une batterie 3700 mAh 
         qui lui permet de rester actif tout au long d’une journée',

        'Rapide ? Non, très rapide ! Grâce à la technologie 5G et son 
        processeur Octo-core, elle vous offre une vitesse
         d’utilisation inégalable. Ce que vous apprécierez d’autre ?',

        "La polyvalence de son quadruple capteur photo, l’élégance de 
        son design soigné et l’ultra-connectivité de l’écosystème, le tout dans le creux de votre main.",

        "Comme toujours avec ce fabriquant, l’objectif avec le 11T 5G est de vous offrir un portable 
        performant au meilleur prix. Et on peut dire que c’est réussi.",

        "Avec sa batterie de 5000 mAh, le Xiaomi 11T est utilisable pendant plus d’une journée et
         se recharge totalement en à peine une heure. Disponible à petit prix",

        " Il est suffisamment puissant pour vous apporter un maximum de sécurité et de protection des 
        données personnelles, grâce à sa puce Titan M2",

        "Rapide et fluide, il traite les informations et exécute ses différentes tâches en un éclair grâce 
        son processeur Google Tensor",

        "Doté d’un module photo double objectif, il réalise d’excellents clichés avec son capteur principal 
        grand angle 12,2 MP, ainsi qu’un traitement de l’image excellent vous permettant d’en profiter de jour 
        comme de nuit"
    ];

    private static $customersEmail = [
        'useremail@hotmail.com',
        'useremail2@gmail.fr',
        'useremail3@gmail.fr',
    ];

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for($j = 1; $j <= 3; $j++) {
            $customer = new Customer();
            $customer->setPassword($this->hasher->hashPassword($customer, 'azerty123456'));
            $customer->setEmail($faker->randomElement(self::$customersEmail));
            $manager->persist($customer);

            $user = new User();

            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setCustomer($customer);

            $manager->persist($user);
        }

        for($j = 1; $j <= 5; $j++){

                $product = new Product();

                $product->setName($faker->randomElement(self::$phoneBrands));

                $product->setPrice($faker->numberBetween(50,1000));
                $product->setDescription($faker->randomElement(self::$phoneDesciption));

                $manager->persist($product);
            }
            $manager->flush();
    }
}