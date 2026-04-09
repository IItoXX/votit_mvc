<?php
namespace App\Repository;

use App\Db\Mysql;
use App\Entity\User;
use PDO;

class UserRepository
{
    public function __construct() {}

    public function findByEmail(string $email): ?User
    {
        $stmt = Mysql::getInstance()->getPdo()->prepare('SELECT * FROM user WHERE email = ?');
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data)
        {
            return new User($data['id'], $data['nickname'], $data['password'], $data['email']);
        }
        return null;
    }

    public function findByNickname(string $nickname): ?User
    {
        $stmt = Mysql::getInstance()->getPdo()->prepare('SELECT * FROM user WHERE nickname = ?');
        $stmt->execute([$nickname]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data)
        {
            return new User($data['id'], $data['nickname'], $data['password'], $data['email']);
        }
        return null;
    }

    public function findById(int $id): ?User
    {
        $stmt = Mysql::getInstance()->getPdo()->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data)
        {
            return new User($data['id'], $data['nickname'], $data['password'], $data['email']);
        }
        return null;
    }

    public function findAll(): array
    {
        $stmt = Mysql::getInstance()->getPdo()->query('SELECT * FROM user');
        $users = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $users[] = new User($data['id'], $data['nickname'], $data['password'], $data['email']);
        }

        return $users;
    }

    public function create(User $user): User
    {
        $stmt = Mysql::getInstance()->getPdo()->prepare('INSERT INTO user (nickname, password, email) VALUES (?, ?, ?)');
        $stmt->execute([
            $user->getNickname(),
            $user->getPassword(),
            $user->getEmail()
        ]);
        $user->setId(Mysql::getInstance()->getPdo()->lastInsertId());
        return $user;
    }

    public function update(User $user): bool
    {
        $stmt = Mysql::getInstance()->getPdo()->prepare('UPDATE user SET nickname = ?, password = ?, email = ? WHERE id = ?');
        return $stmt->execute([
            $user->getNickname(),
            $user->getPassword(),
            $user->getEmail(),
            $user->getId()
        ]);
    }
}
