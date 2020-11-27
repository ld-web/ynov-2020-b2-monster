<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
  const NB_CATEGORIES = 15;

  public function load(ObjectManager $manager)
  {
    $faker = Faker\Factory::create('fr_FR');
    
    $categories = [];
    $maxIndexCategories = self::NB_CATEGORIES - 1;

    for ($i = 0; $i < self::NB_CATEGORIES; $i++) {
      $category = new Category();

      $category->setName($faker->word)
        ->setColor($faker->hexColor)
        ->setVisible($faker->boolean(80));

      $manager->persist($category);

      $categories[] = $category;
    }

    for ($i = 0; $i < 50; $i++) {
      $product = new Product();

      $product->setName($faker->words(4, true))
        ->setDescription($faker->text(500))
        ->setImage('https://source.unsplash.com/random/900x500')
        ->setPromo($faker->boolean(15))
        ->setVisible($faker->boolean(90))
        ->setPriceHT($faker->randomFloat(1, 20, 800))
        ->setCreated($faker->dateTimeBetween('-2 months'))
        ->setCategory($categories[$faker->numberBetween(0, $maxIndexCategories)]);

      $manager->persist($product);
    }

    $manager->flush();
  }
}
