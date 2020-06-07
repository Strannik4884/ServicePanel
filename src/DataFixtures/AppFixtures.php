<?php

namespace App\DataFixtures;

use App\Entity\Document;
use App\Entity\Position;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->passwordEncoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // create user
        $user = new User();
        $user->setName('Тестов Тест Тестович');
        $user->setEmail('test@test.ru');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'Test123!'));
        $user->setRoles(array('ROLE_USER'));
        $user->setPosition('Коммерческий агент');
        // create admin
        $admin = new User();
        $admin->setName('Admin');
        $admin->setEmail('admin@test.ru');
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'Odmin123!'));
        $admin->setRoles(array('ROLE_ADMIN'));
        $admin->setPosition('Специалист тех. обслуживания');
        // insert users to database
        $manager->persist($user);
        $manager->persist($admin);
        // create position
        $position = new Position();
        $position->setName('Коммерческий агент');
        $position->setUserId(1);
        // insert position to database
        $manager->persist($position);
        // create document
        $position = new Document();
        $position->setSrcRtf('../public/uploads/docs/001-5edc9b266578a.rtf');
        $position->setSrcHtml('uploads/001.html');
        $position->setPositionId(1);
        // insert position to database
        $manager->persist($position);
        // flush manager
        $manager->flush();
    }
}
