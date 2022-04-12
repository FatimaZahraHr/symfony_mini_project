<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
     /**
     * @Route ("/categorie", name="create_categorie")
     *
     * @return Response
     */
    public function create(Request $request,ManagerRegistry $managerr){
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){   
        $manager=$managerr->getManager();
        $manager->persist($categorie);
        $manager->flush();
        $this->addFlash(
            'success',
            "La categorie a été bien enregistré !"
        );

        }
        return $this->render('category.html.twig',[
            'form'=> $form->createView()
        ]);   
    }
}
