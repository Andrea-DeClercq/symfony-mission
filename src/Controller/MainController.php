<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\ReponsesController;
use App\Entity\Reponse;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReponseRepository;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function show(ManagerRegistry $doctrine,ReponseRepository $repoReponse){
        $entityManager = $doctrine->getManager();
        $show = $entityManager->getRepository(Question::class)->findAll();
 
        //Boucle foreach qui rajoute dans le tableau objet de $show le nombre de réponse lié a l'id
        foreach($show as $key => $rep){                                
            $count= $repoReponse->nbr($doctrine,$rep->getId()); //Envoie l'id de la question pour la fonction nbr qui compte le nombre de réponse si idQuestion = id
            $show[$key]->count=$count;                          //Incrémente + écrit dans le tableau
        }                    
        //dd($show); Dump permatent de voir les donnés du tableau de $show

        return $this->render('main/index.html.twig',['show' => $show]);
    }
}
