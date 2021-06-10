<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostImgRepository;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(PostImgRepository $postImgRepository): Response
    {
        
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'post_imgs' => $postImgRepository->findAll(),
        ]);
    }
}
