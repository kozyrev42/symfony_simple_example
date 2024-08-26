<?php

namespace App\Controller\Post;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PostController extends AbstractController
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $title = $data['title'] ?? null;
        $body = $data['body'] ?? null;

        if (!$title || !$body) {
            return new JsonResponse(['error' => 'Название и содержание обязательны для заполнения'], Response::HTTP_BAD_REQUEST);
        }

        $post = new Post();
        $post->setTitle($title);
        $post->setBody($body);

        $this->postRepository->save($post);

        return new JsonResponse(['success' => 'Пост создан успешно!'], Response::HTTP_CREATED);
    }
}
