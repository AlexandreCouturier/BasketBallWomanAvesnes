<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\Team;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_home")
     */
    public function index(UsersRepository $repo): Response
    {
        $users = $repo->findAll();
        return $this->render('home/dashboard.html.twig', compact('users'));
    }
  
                /**
     * @Route("/dashboard/equipe/id/{id}", name="app_team_by_id")method={"GET"}
     */
    public function showPlayerById(Team $team): Response{
        
        return $this->render('home/equipeById.html.twig', compact('team'));
    }
                /**
            * @Route("/dashboard/equipe", name="app_allteam_in_dashboard")
            */
            public function showAllTeamInDashboard(TeamRepository $repo): Response{

                $team = $repo->findAll();

                return $this->render('home/equipeDashboard.html.twig', compact('team'));
            }
                                        /**
     * @Route("/Dashboard/equipe/delete/{id}", name="app_team_delete")method={"GET","POST"}
     */

    public function deleteTeam(ManagerRegistry $doctrine, int $id): Response{
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Team::class)->find($id);

           if(!$product) {
               throw $this->createNotFoundException(
                   "La team n'hesite pas" .$id
               );
           }

           $entityManager->remove($product);
           $entityManager->flush();

           return $this->redirectToRoute('app_allteam_in_dashboard');
    }
                                            /**
     * @Route("/dashboard/equipe/deletePlayer/{id}", name="app_playerteam_delete")method={"GET","POST"}
     */

    public function deletegame(ManagerRegistry $doctrine, int $id): Response{
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Player::class)->find($id);

           if(!$product) {
               throw $this->createNotFoundException(
                   "le player n'a pas été trouvé" .$id
               );
           }

           $entityManager->remove($product);
           $entityManager->flush();

           return $this->redirectToRoute('app_allteam_in_dashboard');
    }
                           /**
     * @Route("/dashboard/equipe/update/{id}", name="app_team_update")method={"GET","POST"}
     */

    public function updateTeam(Request $request,EntityManagerInterface $em, Team $team, ManagerRegistry $doctrine, int $id): Response{
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Team::class)->find($id);

           if(!$product) {
               throw $this->createNotFoundException(
                   "le produit n'a pas été trouvé" .$id
               );
           }

           if($request->isMethod('POST')){
               $data = $request->request->all();
               $team->setTeamName($data["teamname"]);
               $team->setYear($data["year"]);
               $em->persist($team);
               $em->flush();
   
               return $this->redirectToRoute('app_allteam_in_dashboard');
           }



           return $this->render('team/UpdateTeam.html.twig', compact('team'));
    }
}
