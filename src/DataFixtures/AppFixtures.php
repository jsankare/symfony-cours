<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Classic PDO way to do it

        //$movie = new Movie();
        //$movie->setTitle('The Godfather');
        //$movie->setReleaseDate(new \DateTime('1972-03-24'));


        //Faker way to do it

        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $movie = new Movie();
            $movie->setTitle($faker->sentence(3));
            $movie->setShortDescription($faker->text(100));
            $movie->setLongDescription($faker->text(300));
            $movie->setReleaseDate($faker->dateTimeBetween('-50 years', 'now'));
            $movie->setCoverImage($faker->imageUrl(640, 480, 'movies'));
            $movie->setStaff([
                "Director" => $faker->name,
                "Producer" => $faker->name
            ]);
            $movie->setCast([
                $faker->name,
                $faker->name,
                $faker->name
            ]);

            // Persist the object
            $manager->persist($movie);
        }
        // Flush the persisted object
        $manager->flush();
    }
}
