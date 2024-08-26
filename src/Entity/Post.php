<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'posts')]
#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue] // означает что это поле будет автоинкрементироваться
    #[ORM\Column(type: 'integer')]
    private ?int $id = null; // любое значение типа int, или по умолчанию null

    #[ORM\Column(type: 'string', length: 255)] // означает что в БД это varchar(255)
    #[Assert\NotBlank] // означает что поле не может быть пустым
    private string $title;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    private string $body;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }
}
