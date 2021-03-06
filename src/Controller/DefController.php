<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;
use Screen\Capture;
use Symfony\Component\Routing\Annotation\Route;

class DefController extends AbstractController
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



    
    public function ScreenShotWorkout(Request $request){
        $url = 'http://localhost/ProjetS2/Projet/public/index.php/WorkoutStats';

        $screenCapture = new Capture($url);
        $fileLocation = 'C:/Users/balti/Desktop/ESPRIT/3A/S2/PI_dev/SprintWeb/Demo/AppStats/StatsWorkout.png';
        $screenCapture->save($fileLocation);

        return $this->redirect('http://localhost/ProjetS2/Projet/public/index.php/workout');
    }



    public function ScreenShotDiet(Request $request){
        $url = 'http://localhost/ProjetS2/Projet/public/index.php/DietStats';

        $screenCapture = new Capture($url);
        $fileLocation = 'C:/Users/balti/Desktop/ESPRIT/3A/S2/PI_dev/SprintWeb/Demo/AppStats/StatsDiet.png';
        $screenCapture->save($fileLocation);

        return $this->redirect('http://localhost/ProjetS2/Projet/public/index.php/diet');
    }



    public function ScreenShotIngredient(Request $request){
        $url = 'http://localhost/ProjetS2/Projet/public/index.php/IngredientStats';

        $screenCapture = new Capture($url);
        $fileLocation = 'C:/Users/balti/Desktop/ESPRIT/3A/S2/PI_dev/SprintWeb/Demo/AppStats/StatsIndredient.png';
        $screenCapture->save($fileLocation);

        return $this->redirect('http://localhost/ProjetS2/Projet/public/index.php/ingredient');
    }


    public function WorkoutSMS(Request $request): Response
    {
        $sql = "SELECT quote FROM `motivation` ORDER BY RAND() LIMIT 1";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data1 = $stmt->fetchAll();

        $data = json_encode($data1);

        $PhoneNumber = $request->request->get('phoneNumber');

        $sid = 'AC5828257557665ce4a42bb6bc9eb918d8';
        $token = 'afbafc0cf225f0036b907463a9866a4f';

        $client = new Client($sid, $token);

        $client->messages->create(

            $PhoneNumber,
            [
                'from' => '+15866666580',
                'body' => $data
            ]
        );


        return $this->render('front/workout/smsConfirmation.html.twig', array(
        'data' => $PhoneNumber,
    ));
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
        $sql = "select id,breakfast,lunch,dinner,snacks,calories from diet WHERE calories LIKE '1600'";

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
        $sql = "select id,breakfast,lunch,dinner,snacks,calories from diet WHERE calories LIKE '1800'";

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
        $sql = "select  id,breakfast,lunch,dinner,snacks,calories from diet WHERE calories LIKE '2000'";

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
        $sql = "select id ,breakfast,lunch,dinner,snacks,calories from diet WHERE calories LIKE '2200'";

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
        $sql = "select id,breakfast,lunch,dinner,snacks,calories from diet WHERE calories LIKE '2400'";

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
        $sql = "select id,breakfast,lunch,dinner,snacks,calories from diet WHERE calories LIKE '2600'";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll();

        return $this->render('front/diet/dietByCalories.html.twig', array(
            'data' => $data,
        ));
    }
}
