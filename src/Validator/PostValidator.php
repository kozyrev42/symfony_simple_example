<?php

namespace App\Validator;

use App\Entity\Post;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors[] = 'Title обязательно для заполнения.';
        }

        if (empty($data['body'])) {
            $errors[] = 'Body обязательно для заполнения.';
        }

        if (!empty($errors)) {
            return $errors;
        }

        $post = new Post();
        $post->setTitle($data['title']);
        $post->setBody($data['body']);

        $validationErrors = $this->validator->validate($post);
        foreach ($validationErrors as $error) {
            $errors[] = $error->getMessage();
        }

        return $errors;
    }
}
