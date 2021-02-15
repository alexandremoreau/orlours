<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<100; $i++) {
            $user = new User();
            $user->setEmail("prenom.nom" . $i . "@m.fr");
            $user->setRoles(["ROLE_MEMBER"]);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $i
            ));
            $manager->persist($user);
        }

        for ($i=0; $i<20; $i++) {
            $user = new User();
            $user->setEmail("prenom.nom" . $i . "@a.fr");
            $user->setRoles(["ROLE_ADMIN"]);
            $user->setPassword($this->passwordEncoder->encodePassword(
                             $user,
                             $i
                         ));
            $manager->persist($user);
        }

        $user = new User();
        $user->setEmail("prenom.nom" . $i . "@sa.fr");
        $user->setRoles(["ROLE_SUPER_ADMIN"]);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $i
        ));
        $manager->persist($user);

        $manager->flush();
    }
}
