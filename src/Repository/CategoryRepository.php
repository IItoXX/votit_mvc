<?php
namespace App\Repository;

use App\Db\Mysql;
use App\Entity\Category;
use PDO;

class CategoryRepository
{
    public function __construct() {}

    public function findAll(): array
    {
        $stmt = Mysql::getInstance()->getPdo()->query('SELECT * FROM category');
        $categories = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $categories[] = new Category($data['id'], $data['name']);
        }

        return $categories;
    }

    public function findById(int $id): ?Category
    {
        $stmt = Mysql::getInstance()->getPdo()->prepare('SELECT * FROM category WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data)
        {
            return new Category($data['id'], $data['name']);
        }
        return null;
    }
}
