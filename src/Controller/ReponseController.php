<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Reponse;
use App\Entity\Question;
use App\Repository\ReponseRepository;
use App\Repository\QuestionRepository;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ReponseFormType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ReponseController extends AbstractController
{
    
    //Affiche la question et ses donnés tel que date, util, réponses, etc...
    #[Route('/reponse/{id}', name: 'app_reponse')]
    public function showQuestion(QuestionRepository $questionRepository,ReponseRepository $reponseRepository, int $id): Response
    {
        $question = $questionRepository->find($id);
        $sujet = $question->getSujet();
        $util = $question->getUtilisateur();
        $idQuest = $question->getId();
        $datetime = $question->getDate();
        if ($datetime instanceof \Datetime){
            $stringDate = $datetime->format('Y-m-d H:i:s');
        }

        $reponse = $reponseRepository->getAllReponse($id);
        //dd($reponse); Dump pour afficher les résultats de getAllReponse

        return $this->render('reponse/index.html.twig',['question' => $sujet,'util' => $util,
            'date' => $stringDate, 'reponse' => $reponse, 'idQuest' => $idQuest]);
    }

    #[Route('/reponse/{id}/repondre', name: 'app_repondre')]
    public function formRepondreQuestion(Request $request, EntityManagerInterface $em, int $id): Response
    {
        //dd($id);
        //Création du formulaire de réponse
        $form = $this->createFormBuilder()
        ->add('reponse')
        ->add('utilisateur')
        ->add('date',DateTimeType::class, [             //To do: Setup date automatique
            'placeholder' => [
                'year' => 'Year', 'month' => 'Month', 'day' => 'Day','hour' =>'Hour','minute' =>'Minute'],
        ])
        ->add('idQuestion',HiddenType::class,['empty_data' => $id]) //Set up le champ idQuestion sans être visible et par défaut obtient la valeur de $id
        ->add('Save',SubmitType::class)
        ->getForm()
        ;

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            $data = $form->getData();
            
            //dd($form->getData());
            //Création du nouvelle objet Reponse avec les données du tableau obtenu dans formulaire
            $reponse = new Reponse;
            $reponse->setReponse($data['reponse']);
            $reponse->setUtilisateur($data['utilisateur']);
            $reponse->setDate($data['date']);
            $reponse->setIdQuestion($data['idQuestion']);

            //dd($reponse);

            $em->persist($reponse);
            $em->flush();
            return $this->redirectToRoute('app_main');

        }
        return $this->render('reponse/formReponse.html.twig', ['reponse_form' => $form->createView()]);
    }

}
