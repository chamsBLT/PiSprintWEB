<?php


namespace App\Controller;


use App\Entity\Ingredient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class IngredientControllerM extends AbstractController
{
    /**
     * @Route("/AllIngredientsJSON", name="AllIngredientsJSON")
     */
    public function AllIngredientsJSON(NormalizerInterface $Normalizer){
        $repository= $this->getDoctrine()->getRepository(Ingredient::class);
        $ingredients =$repository->findAll();

        $jsonContent = $Normalizer->normalize($ingredients,'json',['groups'=>'ingredient:read']);

        return new Response(json_encode($jsonContent));

    }

    /**
     * @Route("/AddIngredientJSON/new", name="AddIngredientJSON")
     */
    public function AddIngredientJSON(Request $request,NormalizerInterface $Normalizer){
        $em= $this->getDoctrine()->getManager();
        $ingredient = new Ingredient();

        $ingredient->setName($request->get('name'));
        $ingredient->setCategory($request->get('category'));
        $ingredient->setCaloriesCategory($request->get('caloriesCategory'));

        $em->persist($ingredient);
        $em->flush();

        $jsonContent = $Normalizer->normalize($ingredient,'json',['groups'=>'ingredient:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/UpdateIngredientJSON/{id}", name="UpdateIngredientJSON")
     */
    public function UpdateIngredientJSON(Request $request,NormalizerInterface $Normalizer,$id){
        $em= $this->getDoctrine()->getManager();
        $ingredient = $em->getRepository(Ingredient::class)->find($id);

        $ingredient->setName($request->get('name'));
        $ingredient->setCategory($request->get('category'));
        $ingredient->setCaloriesCategory($request->get('caloriesCategory'));

        $em->persist($ingredient);
        $em->flush();

        $jsonContent = $Normalizer->normalize($ingredient,'json',['groups'=>'ingredient:read']);
        return new Response(json_encode($jsonContent));
    }

    /**
     * @Route("/DeleteIngredientJSON/{id}", name="DeleteIngredientJSON")
     */
    public function DeleteIngredientJSON(Request $request,NormalizerInterface $Normalizer,$id){
        $em= $this->getDoctrine()->getManager();
        $ingredient = $em->getRepository(Ingredient::class)->find($id);

        $em->remove($ingredient);
        $em->flush();

        $jsonContent = $Normalizer->normalize($ingredient,'json',['groups'=>'ingredient:read']);
        return new Response("Ingredient deleted successfully !");
    }

}