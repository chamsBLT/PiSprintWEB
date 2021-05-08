<?php


namespace App\Controller;

use App\Entity\Diet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DietControllerM extends AbstractController
{
    /**
     * @Route("/AllDietsJSON", name="AllDietsJSON")
     */
    public function AllDietsJSON(NormalizerInterface $Normalizer){
        $repository= $this->getDoctrine()->getRepository(Diet::class);
        $diet =$repository->findAll();

        $jsonContent = $Normalizer->normalize($diet,'json',['groups'=>'diet:read']);

        return new Response(json_encode($jsonContent));

    }

    /**
     * @Route("/DietByidJSON/{id}", name="DietByidJSON")
     */
    public function DietByidJSON(Request $request,$id,NormalizerInterface $Normalizer){

        $em= $this->getDoctrine()->getManager();
        $diet = $em->getRepository(Diet::class)->findByid($id);

        $jsonContent = $Normalizer->normalize($diet,'json',['groups'=>'diet:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/DietByCaloriesJSON/{calories}", name="DietByCaloriesJSON")
     */
    public function DietByCaloriesJSON(Request $request,$calories,NormalizerInterface $Normalizer){

        $em= $this->getDoctrine()->getManager();
        $diet = $em->getRepository(Diet::class)->findByCalories($calories);

        $jsonContent = $Normalizer->normalize($diet,'json',['groups'=>'diet:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/AddDietJSON/new", name="AddDietJSON")
     */
    public function AddDietJSON(Request $request,NormalizerInterface $Normalizer){
        $em= $this->getDoctrine()->getManager();
        $diet = new Diet();

        $diet->setCalories($request->get('calories'));
        $diet->setBreakfast($request->get('breakfast'));
        $diet->setLunch($request->get('lunch'));
        $diet->setDinner($request->get('dinner'));
        $diet->setSnacks($request->get('snacks'));
        $em->persist($diet);
        $em->flush();

        $jsonContent = $Normalizer->normalize($diet,'json',['groups'=>'diet:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/UpdateDietJSON/{id}", name="UpdatedietJSON")
     */
    public function UpdateDietJSON(Request $request,$id,NormalizerInterface $Normalizer){
        $em= $this->getDoctrine()->getManager();
        $diet = $em->getRepository(Diet::class)->find($id);

        $diet->setCalories($request->get('calories'));
        $diet->setBreakfast($request->get('breakfast'));
        $diet->setLunch($request->get('lunch'));
        $diet->setDinner($request->get('dinner'));
        $diet->setSnacks($request->get('snacks'));
        $em->persist($diet);
        $em->flush();

        $jsonContent = $Normalizer->normalize($diet,'json',['groups'=>'diet:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/DeleteDietJSON/{id}", name="DeleteDietJSON")
     */
    public function DeleteDietJSON(Request $request,NormalizerInterface $Normalizer,$id){
        $em= $this->getDoctrine()->getManager();
        $diet = $em->getRepository(Diet::class)->find($id);

        $em->remove($diet);
        $em->flush();

        $jsonContent = $Normalizer->normalize($diet,'json',['groups'=>'diet:read']);
        return new Response("Diet deleted successfully !");
    }
}