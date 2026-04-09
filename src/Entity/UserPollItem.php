<?php
namespace App\Entity;

class UserPollItem
{
    private int $user_id;
    private int $poll_item_id;

    public function __construct(int $user_id, int $poll_item_id)
    {
        $this->user_id = $user_id;
        $this->poll_item_id = $poll_item_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getPollItemId(): int
    {
        return $this->poll_item_id;
    }

    public function setPollItemId(int $poll_item_id): void
    {
        $this->poll_item_id = $poll_item_id;
    }
}
