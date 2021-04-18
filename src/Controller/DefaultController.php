<?php
namespace App\Controller;

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
}
