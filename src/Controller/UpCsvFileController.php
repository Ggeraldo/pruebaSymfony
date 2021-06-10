<?php

namespace App\Controller;

use App\Entity\PostImg;
use App\Form\PostImgType;
use App\Form\PostCsvType;
use App\Repository\PostImgRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/up/csv/file')]
class UpCsvFileController extends AbstractController
{
    #[Route('/', name: 'up_csv_file')]
    public function index(): Response
    {
        return $this->render('up_csv_file/index.html.twig', [
            'controller_name' => 'UpCsvFileController',
        ]);
    }
    #[Route('/newCsv', name: 'post_csv', methods: ['GET', 'POST'])]
    public function newCsv(Request $request): Response
    {
        $postImg = new PostImg();
        $form = $this->createForm(PostCsvType::class, $postImg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $file = $request->files->get('post_img')['csv'];
            // echo '<pre>';
            // var_dump($request); die;
            $file = $form->get('csv')->getData();   
            // $uploads_directory = $this->getParameter('uploads_directory');

            if (($handle = fopen($file->getPathname(), "r")) !== false) {
                // Read and process the lines. 
                // Skip the first line if the file includes a header
                while (($data = fgetcsv($handle)) !== false) {
                    // Do the processing: Map line to entity, validate if needed
                    // echo '<pre>';
                    //     var_dump($data);
                    // echo '<pre>';
                    // die;
                    $postImg = new postImg();
                    // Assign fields
                    $postImg->setUriImg($data[2]);
                    $postImg->setTitulo($data[0]);
                    $postImg->setDescripcion($data[1]);
                    $userId = $this->getUser()->getId();
                    $postImg->setUserId($userId);
                    $postImg->setEstado(1);
                    $postImg->setPulse(1);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($postImg);
                }
                fclose($handle);
                $entityManager->flush();
            }
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('post_img/new.html.twig', [
            'post_img' => $postImg,
            'control' => 'o archivo CSV',
            'form' => $form->createView(),
        ]);
    }
}
