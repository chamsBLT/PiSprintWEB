<?php

namespace App\Controller;

use App\Entity\Workout;
use App\Form\WorkoutType;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/workout")
 */
class WorkoutController extends AbstractController
{
    /**
     * @Route("/", name="workout_index", methods={"GET"})
     */
    public function index(): Response
    {
        $workouts = $this->getDoctrine()
            ->getRepository(Workout::class)
            ->findAll();

        return $this->render('workout/index.html.twig', [
            'workouts' => $workouts,
        ]);
    }

    /**
     * @Route("/new", name="workout_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $workout = new Workout();
        $form = $this->createForm(WorkoutType::class, $workout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($workout);
            $entityManager->flush();

            return $this->redirectToRoute('workout_index');
        }

        return $this->render('workout/new.html.twig', [
            'workout' => $workout,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="workout_show", methods={"GET"})
     */
    public function show(Workout $workout): Response
    {
        return $this->render('workout/show.html.twig', [
            'workout' => $workout,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="workout_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Workout $workout): Response
    {
        $form = $this->createForm(WorkoutType::class, $workout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workout_index');
        }

        return $this->render('workout/edit.html.twig', [
            'workout' => $workout,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="workout_delete", methods={"POST"})
     */
    public function delete(Request $request, Workout $workout): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workout->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($workout);
            $entityManager->flush();
        }

        return $this->redirectToRoute('workout_index');
    }

    /**
     * @Route("/searchWorkout ", name="searchWorkout")
     */
    public function searchWorkout(Request $request,NormalizerInterface $Normalizer)
    {
        $repository = $this->getDoctrine()->getRepository(Workout::class);
        $requestString=$request->get('searchValue');
        $workout = $repository->findByBodyPart($requestString);
        $jsonContent = $Normalizer->normalize($workout, 'json',['groups'=>'workout:read']);
        $retour=json_encode($jsonContent);
        return new Response($retour);

    }

    public function WorkoutStats()
    {
        $sql = "SELECT body_part as b ,COUNT(*) as n FROM workout GROUP BY body_part";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data1 = $stmt->fetchAll();

        foreach ($data1 as $val)
        {
            $data[] = array($val['b'], (int) $val['n']);
        }

        $pieChart = new  PieChart();
        $pieChart->getData()->setArrayToDataTable([["Muscle","N"]]+$data);

        $pieChart->getOptions()->setTitle('Stats : Workout /Muscle');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('workout/statsWorkout.html.twig', array(
            'piechart' => $pieChart,
        ));
    }

}
