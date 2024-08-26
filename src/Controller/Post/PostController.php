<?php

namespace App\Controller\Post;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function getAllPosts(SerializerInterface $serializer): JsonResponse
    {
        $posts = $this->postRepository->findAll();

        $json = $serializer->serialize($posts, 'json');
    
        return new JsonResponse($json, Response::HTTP_OK, ['Content-Type' => 'application/json'], true);
    }

    public function updatePost(int $id, Request $request, SerializerInterface $serializer): JsonResponse
    {
        $post = $this->postRepository->find($id);

        if (!$post) {
            throw new NotFoundHttpException('Пост не найден');
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['title'])) {
            $post->setTitle($data['title']);
        }

        if (isset($data['body'])) {
            $post->setBody($data['body']);
        }

        $this->postRepository->save($post);

        $json = $serializer->serialize($post, 'json');

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    public function deletePost(int $id): JsonResponse
    {
        $post = $this->postRepository->find($id);

        if (!$post) {
            throw new NotFoundHttpException('Пост не найден');
        }
    
        $this->postRepository->remove($post);
    
        return new JsonResponse(['message' => 'Пост успешно удален'], Response::HTTP_OK);
    }
}
