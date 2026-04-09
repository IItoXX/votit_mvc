<?php
namespace App\Repository;

use App\Db\Mysql;
use App\Entity\PollItem;
use PDO;

class PollItemRepository
{
    public function __construct() {}

    public function findByPollId(int $poll_id): array
    {
        $stmt = Mysql::getInstance()->getPdo()->prepare('SELECT * FROM poll_item WHERE poll_id = ?');
        $stmt->execute([$poll_id]);
        $items = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $items[] = new PollItem($data['id'], $data['name'], $data['poll_id']);
        }

        return $items;
    }

    public function find(int $id): ?PollItem
    {
        $stmt = Mysql::getInstance()->getPdo()->prepare('SELECT * FROM poll_item WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data)
        {
            return new PollItem($data['id'], $data['name'], $data['poll_id']);
        }
        return null;
    }

    public function create(PollItem $item): PollItem
    {
        $stmt = Mysql::getInstance()->getPdo()->prepare('INSERT INTO poll_item (name, poll_id) VALUES (?, ?)');
        $stmt->execute([$item->getName(), $item->getPollId()]);
        $item->setId(Mysql::getInstance()->getPdo()->lastInsertId());
        return $item;
    }

    public function update(PollItem $item): bool
    {
        $stmt = Mysql::getInstance()->getPdo()->prepare('UPDATE poll_item SET name = ?, poll_id = ? WHERE id = ?');
        return $stmt->execute([
            $item->getName(),
            $item->getPollId(),
            $item->getId()
        ]);
    }
}
