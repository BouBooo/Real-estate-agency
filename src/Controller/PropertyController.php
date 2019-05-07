<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Form\ContactType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Controller\ContactController;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{
    private $repository;

    public function __construct(PropertyRepository $repository, ObjectManager $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/biens", name="properties")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request); 


        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('property/index.html.twig', [
            'properties' => $properties,
            'form' => $form->createView()
        ]);
    }

    
    /**
     * @Route("/biens/{slug}-{id}", name="property_show", requirements={"slug":"[a-z0-9\-]*"})
     */
    public function show(Property $property, string $slug, Request $request, ContactController $contactController)
    {
        if($property->getSlug() !== $slug)
        {
            return $this->redirectToRoute('property_show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }

        // Contact View and Treatment
        $contact = new Contact();
        $contact->setProperty($property);
        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactForm->handlerequest($request);

        if($contactForm->isSubmitted() && $contactForm->isValid())
        {
            $contactController->notify($contact);
            $this->addFlash('success','Votre message a bien été envoyé');
            return $this->redirectToRoute('property_show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ]);
        }

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'form' => $contactForm->createView()
        ]);
    }
}
