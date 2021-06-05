<?php

namespace App\Controller;

use App\Entity\GameHouse;
use App\Entity\House;
use App\Repository\GameHouseRepository;
use App\Repository\GameRepository;
use App\Repository\HouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HouseGameController extends AbstractController
{
    /**
     * @Route("/housegame", name="housegame")
     */
    public function index(GameHouseRepository $gameHouseRepository): Response
    {
        $nbQuestion = $gameHouseRepository->countQuestion();
        $gameHouse = $gameHouseRepository->findOneById(1);

        return $this->render('house_game/index.html.twig', [
            'controller_name' => 'HouseGameController',
            'gameHouse' => $gameHouse,
            'nbQuestion' => $nbQuestion
        ]);
    }

    /**
     * @Route("/housegame/ajax/{page}", requirements={"page"="\d+"})
     * @param Request $request
     * @param GameHouseRepository $gameHouseRepository
     * @param int $page
     * @return JsonResponse|Response
     */
    public function ajaxCallForQuestion(Request $request, GameHouseRepository $gameHouseRepository, int $page) {
        $data = $request->request->get('request');
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $response = $gameHouseRepository->findOneById($page);
            $gameHouse = [
                'question'  => $response->getQuestion(),
                'answera'   => $response->getAnswera(),
                'answerb'   => $response->getAnswerb(),
                'answerc'   => $response->getAnswerc(),
                'answerd'   => $response->getAnswerd(),
                'answers'   => $data
            ];
            return new JsonResponse($gameHouse);
        } else {
            return $this->render('house_game/index.html.twig');
        }

    }

    /**
     * @Route("/housegame/result/{houseName}", name="house")
     * @param string $houseName
     * @param HouseRepository $houseRepository
     * @return JsonResponse|Response
     */
    public function result(string $houseName, HouseRepository $houseRepository) {
        $house = new House();
        $house = $houseRepository->findOneBy(['name' => $houseName]);
        return $this->render('house_game/result.html.twig', [
            'house' => $house
        ]);
    }

}

