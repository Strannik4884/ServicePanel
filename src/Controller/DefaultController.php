<?php

namespace App\Controller;

use App\Entity\Position;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index()
    {
        $positions = $this->getDoctrine()
            ->getRepository(Position::class)
            ->findBy([
                'userId' => $this->getUser()
            ]);

        return $this->render('base.html.twig', [
            'controller_name' => 'DefaultController',
            'positions' => $positions,
        ]);
    }
}
