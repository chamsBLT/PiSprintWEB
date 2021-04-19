<?php

namespace App\Controller;

use App\Entity\Diet;
use App\Form\DietType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/diet")
 */
class DietController extends AbstractController
{
    /**
     * @Route("/", name="diet_index", methods={"GET"})
     */
    public function index(): Response
    {
        $diets = $this->getDoctrine()
            ->getRepository(Diet::class)
            ->findAll();

        return $this->render('diet/index.html.twig', [
            'diets' => $diets,
        ]);
    }

    /**
     * @Route("/new", name="diet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $diet = new Diet();
        $form = $this->createForm(DietType::class, $diet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($diet);
            $entityManager->flush();

            return $this->redirectToRoute('diet_index');
        }

        return $this->render('diet/new.html.twig', [
            'diet' => $diet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="diet_show", methods={"GET"})
     */
    public function show(Diet $diet): Response
    {
        return $this->render('diet/show.html.twig', [
            'diet' => $diet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="diet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Diet $diet): Response
    {
        $form = $this->createForm(DietType::class, $diet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('diet_index');
        }

        return $this->render('diet/edit.html.twig', [
            'diet' => $diet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="diet_delete", methods={"POST"})
     */
    public function delete(Request $request, Diet $diet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$diet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($diet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('diet_index');
    }

    /**
     * @Route("/searchDiet ", name="searchDiet")
     */
    public function searchDiet(Request $request,NormalizerInterface $Normalizer)
    {
        $repository = $this->getDoctrine()->getRepository(Diet::class);
        $requestString=$request->get('searchValue');
        $diet = $repository->findByCalories($requestString);
        $jsonContent = $Normalizer->normalize($diet, 'json',['groups'=>'diet:read']);
        $retour=json_encode($jsonContent);
        return new Response($retour);

    }
}
