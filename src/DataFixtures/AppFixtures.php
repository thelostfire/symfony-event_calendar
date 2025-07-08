<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Date;
use App\Entity\Event;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        $data = json_decode(file_get_contents(__DIR__.'/categories.json'), true);
        $categories = [];
        foreach($data['category'] as $categ) {
            $category = new Category();
            $category->setName($categ['name']);
            $manager->persist($category);
            $categories [] = $category;
        }
        $dates = [];
        $day = 4;
        for($i=0; $i<31; $i++) {
            $date = new Date();
            $date->setDate($faker->dateTimeInInterval('+'.$day.' days', '+1 hours'));
            $day++;
            $manager->persist($date);
            $dates[] = $date;
        }
        for($i=0; $i<10; $i++) {
            $event = new Event();
            $event->setTitle($faker->sentence)
                ->setDescription($faker->realText(80))
                ->setTime($faker->dateTimeBetween('+4 days', '+35 days'))
                ->setCategory($faker->randomElement($categories))
                ->setDate($faker->randomElement($dates));
                $manager->persist($event);
        }
        for($i=0; $i<8; $i++) {
            $tag = new Tag();
            $tag->setName($faker->hexColor);
            $manager->persist($tag);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
