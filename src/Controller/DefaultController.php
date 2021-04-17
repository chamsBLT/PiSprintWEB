<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DefaultController extends AbstractController
{

    public function WorkoutandDiet(){
        return $this->render('front/choicePage.html.twig');
    }

    public function WorkoutF(){
        return $this->render('front/muscleList.html.twig');
    }
}
