<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\Team;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
    /**
     * @Route("/player", name="app_player")
     */
    public function index(): Response
    {
        return $this->render('player/index.html.twig', [
            'controller_name' => 'PlayerController',
        ]);
    }
            /**
            * @Route("/playerall/create", name="app_allteam_in_player")
            */
            public function showAllTeamInPlayer(TeamRepository $repo): Response{
                $team = $repo->findAll();
                return $this->render('player/FormPlayer.html.twig', compact('team'));
            }
            /**
             * @Route("/player/allplayer", name="app_allplayers")
             */
            public function showAllPlayer(PlayerRepository $repo): Response{
                $player = $repo->findAll();
                return $this->render('player/index.html.twig', compact('player'));
            }
        /**
         * @Route("/player/id/{id}", name="app_player_by_id")method={"GET"}
         */
        public function showPlayerById(Player $player): Response{
            return $this->render('player/playerById.html.twig', compact('player'));
        }
        /**
     * @Route("/player/create", name="app_player_create")
     */
    public function createPlayer(Request $request,EntityManagerInterface $em): Response {

        if($request->isMethod('POST')){

            $data = $request->request->all();

            $teamname = $em->find(Team::class,$data["teamname"]);
            $player = new Player();

            $player->setFirstName($data["firstname"]);
            $player->setLastName($data["lastname"]);
            $player->setAge($data["age"]);
            $player->setPost($data["postgame"]);
            $player->setTeamName($teamname);
            $em->persist($player);
            $em->flush();

            return $this->redirectToRoute('app_allplayers');
        }

        return $this->render('player/FormPlayer.html.twig');
    }
}
