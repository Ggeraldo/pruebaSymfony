<?php

namespace App\Controller;

use App\Entity\PostImg;
use App\Form\PostImgType;
use App\Repository\PostImgRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/post/img')]
class PostImgController extends AbstractController
{
    #[Route('/', name: 'post_img_index', methods: ['GET'])]
    public function index(PostImgRepository $postImgRepository): Response
    {
        return $this->render('post_img/index.html.twig', [
            'post_imgs' => $postImgRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'post_img_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $postImg = new PostImg();
        $form = $this->createForm(PostImgType::class, $postImg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $request->files->get('post_img')['uri_img'];
            $uploads_directory = $this->getParameter('uploads_directory');

            $filename = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move(
                $uploads_directory,
                $filename
            );
            $postImg->setUriImg($filename);
            $userId = $this->getUser()->getId();
            $postImg->setUserId($userId);
            // echo '<pre>';
            // var_dump($userId); die;
            // this save to BD
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($postImg);
            $entityManager->flush();

            return $this->redirectToRoute('post_img_index');
        }

        return $this->render('post_img/new.html.twig', [
            'post_img' => $postImg,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'post_img_show', methods: ['GET'])]
    public function show(PostImg $postImg): Response
    {
        return $this->render('post_img/show.html.twig', [
            'post_img' => $postImg,
        ]);
    }

    #[Route('/{id}/edit', name: 'post_img_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PostImg $postImg): Response
    {
        $form = $this->createForm(PostImgType::class, $postImg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_img_index');
        }

        return $this->render('post_img/edit.html.twig', [
            'post_img' => $postImg,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'post_img_delete', methods: ['POST'])]
    public function delete(Request $request, PostImg $postImg): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postImg->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($postImg);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_img_index');
    }


}
