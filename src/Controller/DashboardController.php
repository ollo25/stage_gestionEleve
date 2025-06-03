<?php
// src/Controller/DashboardController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard/{tab}', name: 'app_dashboard', defaults: ['tab' => 'overview'])]
    public function index(string $tab): Response
    {
        $tabs = [
            'overview' => 'Aperçu',
            'games' => 'Parties',
            'stats' => 'Statistiques',
            // Ajoutez d'autres onglets au besoin
        ];

        return $this->render('dashboard/index.html.twig', [
            'active_tab' => $tab,
            'tabs' => $tabs,
        ]);
    }
}
