<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Entity\Client;
use App\Entity\Project;
use App\Form\TacheType;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectController extends AbstractController
{
    /**
     * la page de l'accueil oû il s'affiche les produits
     * @Route("index/{page<\d+>?1}", name="homepage")
     */
    public function home($page){
        $limit = 10;
        $start = $page * $limit - $limit;
        $repo=$this->getDoctrine()->getRepository(Project::class);
        $total = count($repo->findAll());
        $pages = ceil($total / $limit);
        return $this->render('index.html.twig', [
            'projects' => $repo->findBy([], [], $limit, $start),
            'pages' => $pages,
            'page' => $page
        ]);
      }

    /**
    * 
     *Permet d'afficher un seul projet
     * @Route("/projet/{nomprojet}", name="projet_show")
     * @return Response
     * @param Project $project
     */
    public function show($nomprojet, ProjectRepository $repo,Project $project, Request $request,ManagerRegistry $manager)
    {
        $projects=$repo->findOneByNomprojet($nomprojet);
        ///
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){   
        $manager=$this->getDoctrine()->getManager();
        $tache->setProjet($project);
            // $tache->setProjet($project->getId());
        // $project->setProjet($project- >getProject());
        $manager->persist($tache);
        $manager->flush(); 
        $this->addFlash(
            'success',
            "Le projet <strong></strong> a été bien enregistré !"
        );
        }
         ///
         return $this->render('show.html.twig',[
            'projects'=>$projects,
            'form'=>$form->createView()
        ]);
    }
    /**
      * permet d'afficher les clients
     * @Route("/clients",name="clients_show")
     */
    public function client(){
        $repo=$this->getDoctrine()->getRepository(Client::class);
        $clients=$repo->findAll();
        return $this->render('clients.html.twig', [
            'clients' => $clients
        ]);
    }

    /**
     * Permet d'ajouter un projet
     * @Route("/projet", name="projet")
     */
    public function create(Request $request,ManagerRegistry $managerr)
    {
        $Projet = new Project();
        $form = $this->createForm(ProjectType::class, $Projet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){   
        $manager=$managerr->getManager();
        $Projet->setIduser($this->getuser());
        $manager->persist($Projet);
        $manager->flush(); 
        $this->addFlash(
        'success',
        "Le projet <strong>{$Projet->getNomprojet()}</strong> a été bien enregistré !"
        );
    }
        return $this->render('project/projet.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    /**
    * 
     * Permet de modifier un projet
     * @Route("/projet/{nomprojet}/edit", name="projet_edit")
     * @return Response
     */
    public function edit(Project $projet,Request $request,ManagerRegistry $manager_registry){
        $form=$this->createForm(ProjectType::class, $projet);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
       $fmanager=$manager_registry->getManager();
       $manager->persist($projet);
       $manager->flush();
       $this->addFlash(
           'success',
           "Les Modifications de l'annonce <strong>{$projet->getNomprojet()}</strong> ont bien été bien enregistrés !"
       );
    }
        return $this->render('edit.html.twig', [
            'form'=>$form->createView(),
            'projet'=> $projet
        ]);
    }

     /**
     * permet de supprimer une tache
     * @Route("/tache/{id}/delete", name="delete_tache")
     * @param Tache $tache
     */
    public function delete($id)
    {
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        //$form->handleRequest($request);
            $entityManager = $this->getDoctrine()->getManager();
            $tache= $entityManager->getRepository(Tache::class)->find($id);  
            if (!$tache) {
                throw $this->createNotFoundException(
                    'No tache found for id '.$id
                );
            }
            $entityManager->remove($tache);   
            $entityManager->flush();
    //
     
    return $this->redirectToRoute('homepage');   
}
}
