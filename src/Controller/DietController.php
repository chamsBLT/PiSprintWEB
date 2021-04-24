<?php

namespace App\Controller;

use App\Entity\Diet;
use App\Form\DietType;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Dompdf\Dompdf;
use Dompdf\Options;
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

    public function DietStats()
    {
        $sql = "SELECT calories as c ,COUNT(*) as n  FROM `diet` GROUP BY calories";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data1 = $stmt->fetchAll();

        foreach ($data1 as $val)
        {
            $data[] = array($val['c'], (int) $val['n']);
        }

        $pieChart = new  PieChart();
        $pieChart->getData()->setArrayToDataTable([["Muscle","N"]]+$data);

        $pieChart->getOptions()->setTitle('Stats : Diet /Calories');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('diet/statsDiet.html.twig', array(
            'piechart' => $pieChart,
        ));
    }

    public function listPDF(Request $request): Response
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);

        $calories = $request->request->get('caloriesValue');
        $diets = $this->getDoctrine()
            ->getRepository(Diet::class)
            ->findByCalories($calories);

        $html = $this->renderView('front/Diet/dietPDFlist.html.twig', [
            'diets' => $diets,
        ]);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream("Mes_regimes.pdf", [
            "Attachment" => true
        ]);

    }
}
