<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PropertyRepository $repository)
    {
        $properties = $repository->findAllVisible();

        return $this->render('home/index.html.twig', [
            'properties' => $properties,
            'controller_name' => 'HomeController',
        ]);
    }
}
