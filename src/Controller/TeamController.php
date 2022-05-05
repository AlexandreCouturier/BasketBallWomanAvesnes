<?php

namespace App\Controller;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    /**
     * @Route("/team", name="app_team")
     */
    public function index(): Response
    {
        return $this->render('team/index.html.twig', [
            'controller_name' => 'TeamController',
        ]);
    }
        /**
 * @Route("/team/allteam", name="app_allteams")
 */
public function showAllTeam(TeamRepository $repo): Response{
    $team = $repo->findAll();
    return $this->render('team/index.html.twig', compact('team'));
}
        /**
 * @Route("/team/id/{id}", name="app_team_by_id")method={"GET"}
 */
public function showTeamById(Team $team): Response{
    return $this->render('team/teamById.html.twig', compact('team'));
}
        /**
     * @Route("/team/create", name="app_team_create")
     */
    public function createteam(Request $request,EntityManagerInterface $em): Response {

        if($request->isMethod('POST')){
            $data = $request->request->all();
            $team = new Team();
            $team->setTeamName($data["teamname"]);
            $team->setYear($data["year"]);
            $em->persist($team);
            $em->flush();

            return $this->redirectToRoute('app_allteams');
        }
        return $this->render('team/FormTeam.html.twig');
    }
}
