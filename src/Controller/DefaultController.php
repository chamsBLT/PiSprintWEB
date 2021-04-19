<?php
namespace App\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DefaultController extends AbstractController
{

    public function WorkoutandDiet(){
        return $this->render('front/choicePage.html.twig');
    }

    public function WorkoutList(){
        return $this->render('front/workout/muscleList.html.twig');
    }

    public function DietList(){
        return $this->render('front/diet/caloriesList.html.twig');
    }





    public function ArmsWlist()
    {
        $sql = "select name,nbr_series,duree_serie,description from workout WHERE body_part LIKE 'arms'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/workout/workoutByMuscle.html.twig', array(
            'data' => $data,
        ));
    }

    public function ShouldersWlist()
    {
        $sql = "select name,nbr_series,duree_serie,description from workout WHERE body_part LIKE 'shoulders'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/workout/workoutByMuscle.html.twig', array(
            'data' => $data,
        ));
    }

    public function ChestWlist()
    {
        $sql = "select name,nbr_series,duree_serie,description from workout WHERE body_part LIKE 'chest'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/workout/workoutByMuscle.html.twig', array(
            'data' => $data,
        ));
    }

    public function AbsWlist()
    {
        $sql = "select name,nbr_series,duree_serie,description from workout WHERE body_part LIKE 'abdominals'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/workout/workoutByMuscle.html.twig', array(
            'data' => $data,
        ));
    }

    public function BackWlist()
    {
        $sql = "select name,nbr_series,duree_serie,description from workout WHERE body_part LIKE 'back'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/workout/workoutByMuscle.html.twig', array(
            'data' => $data,
        ));
    }

    public function LegsWlist()
    {
        $sql = "select name,nbr_series,duree_serie,description from workout WHERE body_part LIKE 'legs'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/workout/workoutByMuscle.html.twig', array(
            'data' => $data,
        ));
    }

    public function GlutesWlist()
    {
        $sql = "select name,nbr_series,duree_serie,description from workout WHERE body_part LIKE 'glutes'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/workout/workoutByMuscle.html.twig', array(
            'data' => $data,
        ));
    }





    public function D1600list()
    {
        $sql = "select breakfast,lunch,dinner,snacks from diet WHERE calories LIKE '1600'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/diet/dietByCalories.html.twig', array(
            'data' => $data,
        ));
    }

    public function D1800list()
    {
        $sql = "select breakfast,lunch,dinner,snacks from diet WHERE calories LIKE '1800'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/diet/dietByCalories.html.twig', array(
            'data' => $data,
        ));
    }

    public function D2000list()
    {
        $sql = "select breakfast,lunch,dinner,snacks from diet WHERE calories LIKE '2000'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/diet/dietByCalories.html.twig', array(
            'data' => $data,
        ));
    }

    public function D2200list()
    {
        $sql = "select breakfast,lunch,dinner,snacks from diet WHERE calories LIKE '2200'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/diet/dietByCalories.html.twig', array(
            'data' => $data,
        ));
    }

    public function D2400list()
    {
        $sql = "select breakfast,lunch,dinner,snacks from diet WHERE calories LIKE '2400'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/diet/dietByCalories.html.twig', array(
            'data' => $data,
        ));
    }

    public function D2600list()
    {
        $sql = "select breakfast,lunch,dinner,snacks from diet WHERE calories LIKE '2600'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/diet/dietByCalories.html.twig', array(
            'data' => $data,
        ));
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

        $pieChart->getOptions()->setTitle('Stats : Workout');
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



    public function IngredientStats()
    {
        $sql = "SELECT category as c ,COUNT(*) as n  FROM `ingredient` GROUP BY category";

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

        $pieChart->getOptions()->setTitle('Stats : Ingredients ');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('ingredient/statsIngredient.html.twig', array(
            'piechart' => $pieChart,
        ));
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

        $pieChart->getOptions()->setTitle('Stats : Diet ');
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
}
