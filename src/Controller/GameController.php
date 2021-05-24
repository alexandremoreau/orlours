<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameFormType;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $answers = [
            "chateau d'amboise",
            "château d'amboise",
            "chateau amboise",
            "château amboise",
            "chateaux d'amboise",
            "châteaux d'amboise",
            "chateaux amboise",
            "châteaux amboise",
            "le chateau d'amboise",
            "le château d'amboise",
            "le chateau amboise",
            "le château amboise",
            "le chateaux d'amboise",
            "le châteaux d'amboise",
            "le chateaux amboise",
            "le châteaux amboise"
        ];

        $answer = false;
        $form = $this->createForm(GameFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() AND $form->isValid()){
            $game = new Game();
            $game = $form->getData();
            if (in_array(strtolower($game->getAnswer()), $answers)) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($game);
                $entityManager->flush();
                return $this->redirectToRoute('answer_submitted');
            } else {
                $answer = true;
            }
        }
        return $this->render('game/index.html.twig', [
            'form' => $form->createView(), 'answer' => $answer
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

    /**
     * @Route("/game/participants", name="participants")
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @param GameRepository $gameRepository
     * @return Response
     */
    public function participants(Request $request, GameRepository $gameRepository): Response
    {
        $participants = $gameRepository->findAllByDateOfSubmissionASC();
        return $this->render('game/participants.html.twig', [
            'participants' => $participants
        ]);
    }
}
