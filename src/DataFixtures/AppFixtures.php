<?php

namespace App\DataFixtures;

use App\Entity\Phonebook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $phonebook = new Phonebook();
        $phonebook->setFirstName('John');
        $phonebook->setLastName('Doe');
        $phonebook->setPhone('+441632960562');
        $manager->persist($phonebook);

        $phonebook = new Phonebook();
        $phonebook->setFirstName('Katherine');
        $phonebook->setLastName('Smith');
        $phonebook->setPhone('+441632960092');
        $manager->persist($phonebook);

        $phonebook = new Phonebook();
        $phonebook->setFirstName('Sue');
        $phonebook->setLastName('Buckland');
        $phonebook->setPhone('+441632960958');
        $manager->persist($phonebook);

        $phonebook = new Phonebook();
        $phonebook->setFirstName('Adrian');
        $phonebook->setLastName('Ferguson');
        $phonebook->setPhone('+441632960112');
        $manager->persist($phonebook);

        $phonebook = new Phonebook();
        $phonebook->setFirstName('Piers');
        $phonebook->setLastName('Parsons');
        $phonebook->setPhone('+441632960228');
        $manager->persist($phonebook);

        $phonebook = new Phonebook();
        $phonebook->setFirstName('Kylie');
        $phonebook->setLastName('Davies');
        $phonebook->setPhone('+441632960033');
        $manager->persist($phonebook);

        $phonebook = new Phonebook();
        $phonebook->setFirstName('Connor');
        $phonebook->setLastName('Sharp');
        $phonebook->setPhone('01632960432');
        $manager->persist($phonebook);

        $phonebook = new Phonebook();
        $phonebook->setFirstName('Austin');
        $phonebook->setLastName('McLean');
        $phonebook->setPhone('01632960294');
        $manager->persist($phonebook);

        $phonebook = new Phonebook();
        $phonebook->setFirstName('Yvonne');
        $phonebook->setLastName('Slater');
        $phonebook->setPhone('01632960506');
        $manager->persist($phonebook);

        $phonebook = new Phonebook();
        $phonebook->setFirstName('Penelope');
        $phonebook->setLastName('Thomson');
        $phonebook->setPhone('01632960786');
        $manager->persist($phonebook);

        $phonebook = new Phonebook();
        $phonebook->setFirstName('Rebecca');
        $phonebook->setLastName('Morrison');
        $phonebook->setPhone('01632960406');
        $manager->persist($phonebook);

        $manager->flush();
    }
}
