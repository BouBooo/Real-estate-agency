<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     *
     * @param PropertyRepository $repository
     * 
     * @return Response
     */
    public function index(PropertyRepository $repository)
    {
        $properties = $repository->findLatest();

        return $this->render('home/index.html.twig', [
            'properties' => $properties
        ]);
    }
}
