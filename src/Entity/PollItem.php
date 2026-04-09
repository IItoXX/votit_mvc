<?php
namespace App\Entity;

class PollItem
{
    private ?int $id;
    private string $name;
    private int $poll_id;

    public function __construct(?int $id = null, string $name = '', int $poll_id = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->poll_id = $poll_id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPollId(): int
    {
        return $this->poll_id;
    }

    public function setPollId(int $poll_id): void
    {
        $this->poll_id = $poll_id;
    }
}
