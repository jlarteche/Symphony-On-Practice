<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/post', name: 'post.')] /* annotations */
class PostController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        #dump($posts);
        
        return $this->render('post/index.html.twig', compact('posts'));
    }

    #[Route('/create', name: 'create')]
    public function create(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        //create a new post with title
        $post = new Post();
        $post ->setTitle('Título Post4');
        
        //insert into database
        $entityManager->persist($post);
        $entityManager->flush();
        //return a response
        return new Response('Saved new post with id '.$post->getId());
    }

    #[Route('/show/{id}', name: 'show')]
    
    /* Esto no va y no sé por qué : era por "composer require sensio/framework-extra-bundle" en lugar de annotations*/
    public function show(Post $post){
        /* dump($post);die; */
        return $this->render('post/show.html.twig', compact('post'));
    }
    /* public function show($id, PostRepository $postRepository){
        $post = $postRepository->find($id);
        #dump($post);die;
        //crear la vista
        return $this->render('post/show.html.twig', compact('post'));
    } */
}
