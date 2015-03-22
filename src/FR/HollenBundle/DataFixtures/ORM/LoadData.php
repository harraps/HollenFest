<?php

// pour executer le script, il faut utiliser la commande
// php app/console doctrine:fixtures:load

namespace FR\HollenBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FR\HollenBundle\Entity\User;
use FR\HollenBundle\Entity\Stage;
use FR\HollenBundle\Entity\RunningOrder;
use FR\HollenBundle\Entity\Rockband;
use FR\HollenBundle\Entity\Genre;
use FR\HollenBundle\Entity\Concert;

class LoadData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPassword('admin');

        $manager->persist($userAdmin);
        $manager->flush();
    }
}