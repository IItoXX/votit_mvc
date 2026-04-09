<?php
namespace App\Entity;

class User
{
    private ?int $id;
    private string $nickname;
    private string $password;
    private string $email;

    public function __construct(?int $id = null, string $nickname = '', string $password = '', string $email = '')
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->password = $password;
        $this->email = $email;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
