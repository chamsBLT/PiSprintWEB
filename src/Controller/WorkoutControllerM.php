<?php


namespace App\Controller;

use App\Entity\Workout;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class WorkoutControllerM extends AbstractController
{
    /**
     * @Route("/AllWorkoutsJSON", name="AllWorkoutsJSON")
     */
    public function AllWorkoutsJSON(NormalizerInterface $Normalizer){
        $repository= $this->getDoctrine()->getRepository(Workout::class);
        $workout =$repository->findAll();

        $jsonContent = $Normalizer->normalize($workout,'json',['groups'=>'workout:read']);

        return new Response(json_encode($jsonContent));

    }

    /**
     * @Route("/WorkoutByIdJSON/{id}", name="WorkoutByIdJSON")
     */
    public function WorkoutIdJSON(Request $request,$id,NormalizerInterface $Normalizer){

        $em= $this->getDoctrine()->getManager();
        $workout = $em->getRepository(Workout::class)->findByid($id);

        $jsonContent = $Normalizer->normalize($workout,'json',['groups'=>'workout:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/WorkoutByMuscleJSON/{bodyPart}", name="WorkoutByMuscleJSON")
     */
    public function WorkoutBodyPartJSON(Request $request,$bodyPart,NormalizerInterface $Normalizer){

        $em= $this->getDoctrine()->getManager();
        $workout = $em->getRepository(Workout::class)->findByBodyPart($bodyPart);

        $jsonContent = $Normalizer->normalize($workout,'json',['groups'=>'workout:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/AddWorkoutJSON/new", name="AddWorkoutJSON")
     */
    public function AddWorkoutJSON(Request $request,NormalizerInterface $Normalizer){
        $em= $this->getDoctrine()->getManager();
        $workout = new Workout();

        $workout->setName($request->get('name'));
        $workout->setNbrSeries($request->get('nbrSeries'));
        $workout->setDureeSerie($request->get('dureeSerie'));
        $workout->setBodyPart($request->get('bodyPart'));
        $workout->setDescription($request->get('description'));
        $em->persist($workout);
        $em->flush();

        $jsonContent = $Normalizer->normalize($workout,'json',['groups'=>'workout:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/UpdateWorkoutJSON/{id}", name="UpdateWorkoutJSON")
     */
    public function UpdateWorkoutJson(Request $request,NormalizerInterface $Normalizer,$id){
        $em= $this->getDoctrine()->getManager();
        $workout = $em->getRepository(Workout::class)->find($id);

        $workout->setName($request->get('name'));
        $workout->setNbrSeries($request->get('nbrSeries'));
        $workout->setDureeSerie($request->get('dureeSerie'));
        $workout->setBodyPart($request->get('bodyPart'));
        $workout->setDescription($request->get('description'));
        $em->persist($workout);
        $em->flush();

        $jsonContent = $Normalizer->normalize($workout,'json',['groups'=>'workout:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/DeleteWorkoutJSON/{id}", name="DeleteWorkoutJSON")
     */
    public function DeleteWorkoutJSON(Request $request,NormalizerInterface $Normalizer,$id){
        $em= $this->getDoctrine()->getManager();
        $workout = $em->getRepository(Workout::class)->find($id);

        $em->remove($workout);
        $em->flush();

        $jsonContent = $Normalizer->normalize($workout,'json',['groups'=>'workout:read']);
        return new Response("Workout deleted successfully !");
    }
}