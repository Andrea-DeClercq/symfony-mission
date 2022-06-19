<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class QuestionController extends AbstractController
{
    //Formulaire pour posé une question
    #[Route('/question', name: 'app_question')]
    public function show(Environment $twig, Request $request, EntityManagerInterface $entityManager)
    {
        $question = new Question(); 
        $form = $this->createForm(QuestionFormType::class, $question);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($question);
            $entityManager->flush();
            
        //return new Response('Question posé !');
        return $this->redirectToRoute('app_main');
        }

        return new Response($twig->render('question/index.html.twig', [
            'question_form' => $form->createView()
        ]));
    }
}
