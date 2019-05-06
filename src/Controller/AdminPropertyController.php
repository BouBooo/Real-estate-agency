<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{
    private $repository;

    public function __construct(PropertyRepository $repository, ObjectManager $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/admin", name="admin_property")
     */
    public function index()
    {
        $properties = $this->repository->findAll();

        return $this->render('admin_property/index.html.twig', [
            'properties' => $properties
        ]);
    }

    /**
     * @Route("/admin/new", name="admin_property_new")
     */
    public function new(Request $request)
    {
        $property = new Property();

        $createForm = $this->createForm(PropertyType::class, $property);
        $createForm->handleRequest($request);

        if($createForm->isSubmitted() && $createForm->isValid())
        {
            $this->manager->persist($property);
            $this->manager->flush();
            $this->addFlash('success', 'Bien créé avec succès');
            return $this->redirectToRoute('admin_property');
        }

        return $this->render('admin_property/new.html.twig', [
            'property' => $property,
            'createForm' => $createForm->createView()
        ]);
    }

    /**
     * @Route("/admin/edit/{id}", name="admin_property_edit")
     */
    public function edit(Property $property, Request $request) 
    {
        $editForm = $this->createForm(PropertyType::class, $property);

        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->manager->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin_property');
        }

        return $this->render('admin_property/edit.html.twig', [
            'property' => $property,
            'editForm' => $editForm->createView()
        ]);
    }

    /**
     * @Route("/admin/delete/{id}", name="admin_property_delete")
     */
    public function delete(Property $property, Request $request)
    {
        $this->manager->remove($property);
        $this->manager->flush();
        $this->addFlash('success', 'Bien supprimé avec succès');

        return $this->redirectToRoute('admin_property');
    }
}
