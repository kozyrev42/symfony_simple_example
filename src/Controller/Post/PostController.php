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
use App\Validator\PostValidator;
use App\Repository\CategoryRepository;

class PostController extends AbstractController
{
    private PostRepository $postRepository;
    private PostValidator $postValidator;
    private CategoryRepository $categoryRepository;
    private SerializerInterface $serializer;

    public function __construct(
        PostRepository $postRepository,
        PostValidator $postValidator,
        CategoryRepository $categoryRepository,
        SerializerInterface $serializer
    ) {
        $this->postRepository = $postRepository;
        $this->postValidator = $postValidator;
        $this->categoryRepository = $categoryRepository;
        $this->serializer = $serializer;
    }

    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $errors = $this->postValidator->validate($data);

        if (!empty($errors)) {
            return new JsonResponse(['error' => $errors], Response::HTTP_BAD_REQUEST);
        }

        $post = new Post();
        $post->setTitle($data['title']);
        $post->setBody($data['body']);

        if (isset($data['category_id'])) {
            $category = $this->categoryRepository->find($data['category_id']);
            if ($category) {
                $post->setCategory($category);
            } else {
                return new JsonResponse(['error' => 'Category not found.'], Response::HTTP_BAD_REQUEST);
            }
        }

        $this->postRepository->save($post);

        return new JsonResponse(['success' => 'Пост создан успешно!'], Response::HTTP_CREATED);
    }

    public function getPost(int $id): JsonResponse
    {
        $post = $this->postRepository->find($id);

        if (!$post) {
            throw new NotFoundHttpException('Пост не найден');
        }

        $json = $this->serializer->serialize($post, 'json');

        return new JsonResponse($json, Response::HTTP_OK, [], true);
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

        if (isset($data['category_id'])) {
            $category = $this->categoryRepository->find($data['category_id']);
            if ($category) {
                $post->setCategory($category);
            } else {
                return new JsonResponse(['error' => 'Категория не существует.'], Response::HTTP_BAD_REQUEST);
            }
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
