<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
   /**
     * @Route ("/client", name="client_create")
     *
     * @return Response
     */
    public function create(Request $request,ManagerRegistry $managerr){
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){   
        $manager=$managerr->getManager();
        $manager->persist($client);
        $manager->flush();
        $this->addFlash(
            'success',
            "Le client <strong>{$client->getNom()}</strong> a été bien enregistré !"
        );
        }
        return $this->render('client.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    /**
    * 
     * Permet de modifier un client
     * @Route("/client/{nom}/edit", name="client_edit")
     * @return Response
     */
    public function editclient(Client $client,Request $request,ManagerRegistry $managerr){
        $form=$this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
          $manager=$managerr->getManager();
          $manager->persist($client);
          $manager->flush();
            $this->addFlash(
                'success',
                "Les Modifications du client <strong>{$client->getNom()}</strong> ont bien été bien enregistrés !"
            );
     }
     return $this->render('editclient.html.twig', [
        'form'=>$form->createView(),
        'projet'=> $client
    ]);
    }
}
