<?php
namespace App\Controller;

use App\Repository\PollRepository;
use App\Repository\PollItemRepository;
use App\Repository\UserPollItemRepository;
use App\Repository\CategoryRepository;
use App\Entity\Poll;
use App\Entity\PollItem;
use App\Entity\UserPollItem;

class PollController extends Controller
{
    public function list()
    {
        $repo = new PollRepository();
        $polls = $repo->findAll();
        $this->render('poll/list', ['polls' => $polls]);
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;

        if (!$id)
        {
            header('Location: /');
            exit;
        }

        $repo = new PollRepository();
        $poll = $repo->find($id);

        if (!$poll)
        {
            header('Location: /');
            exit;
        }

        $itemRepo = new PollItemRepository();
        $items = $itemRepo->findByPollId($id);

        $voteRepo = new UserPollItemRepository();
        $results = $voteRepo->countVotes($id);

        $this->render('poll/show', [
            'poll' => $poll,
            'items' => $items,
            'results' => $results
        ]);
    }

    public function create()
    {
        if (empty($_SESSION['user']))
        {
            header('Location: /login');
            exit;
        }

        $catRepo = new CategoryRepository();
        $categories = $catRepo->findAll();
        $this->render('poll/create', ['categories' => $categories]);
    }

    public function createPost()
    {
        if (empty($_SESSION['user']))
        {
            header('Location: /login');
            exit;
        }

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $categoryId = (int) ($_POST['category_id'] ?? 0);
        $options = $_POST['options'] ?? '';
        $userId = $_SESSION['user']->getId();

        $poll = new Poll(null, $title, $description, $userId, $categoryId);
        $pollRepo = new PollRepository();
        $poll = $pollRepo->create($poll);

        $itemRepo = new PollItemRepository();
        $lines = array_filter(array_map('trim', explode("\n", $options)));

        foreach ($lines as $line)
        {
            if ($line !== '')
            {
                $item = new PollItem(null, $line, $poll->getId());
                $itemRepo->create($item);
            }
        }

        header('Location: /poll/?id=' . $poll->getId());
        exit;
    }

    public function vote()
    {
        if (empty($_SESSION['user']))
        {
            header('Location: /login');
            exit;
        }

        $pollId = $_GET['id'] ?? null;

        if (!$pollId)
        {
            header('Location: /');
            exit;
        }

        $userId = $_SESSION['user']->getId();
        $optionId = (int) ($_POST['option'] ?? 0);

        $voteRepo = new UserPollItemRepository();
        $voteRepo->removeVotesForUserAndPoll($userId, (int) $pollId);

        if ($optionId > 0)
        {
            $vote = new UserPollItem($userId, $optionId);
            $voteRepo->addVote($vote);
        }

        header('Location: /poll/?id=' . $pollId);
        exit;
    }
}
