<?php
namespace App\Entity;

use App\Entity\Category;

class Poll
{
    private ?int $id;
    private string $title;
    private string $description;
    private int $user_id;
    private int $category_id;
    private ?Category $category = null;

    public function __construct(
        ?int $id = null,
        string $title = '',
        string $description = '',
        int $user_id = 0,
        int $category_id = 0,
        ?Category $category = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->category = $category;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }
}
