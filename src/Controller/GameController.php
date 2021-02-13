<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $game = new Game();
        $form = $this->createForm(GameFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() AND $form->isValid()){
            $game = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($game);
            $entityManager->flush();
            return $this->redirectToRoute('answer_submitted');
        }
        return $this->render('game/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/game/answer", name="answer_submitted")
     * @param Request $request
     * @return Response
     */
    public function answerSubmitted(Request $request): Response
    {
        return $this->render('game/answer_submitted.html.twig', [
        ]);
    }
}
