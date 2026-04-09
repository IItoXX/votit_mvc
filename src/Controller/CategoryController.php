<?php
namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\PollRepository;

class CategoryController extends Controller
{
    public function list()
    {
        $repo = new CategoryRepository();
        $categories = $repo->findAll();
        $this->render('category/list', ['categories' => $categories]);
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;

        if (!$id)
        {
            header('Location: /categories');
            exit;
        }

        $catRepo = new CategoryRepository();
        $category = $catRepo->findById((int) $id);

        if (!$category)
        {
            header('Location: /categories');
            exit;
        }

        $pollRepo = new PollRepository();
        $polls = $pollRepo->findByCategoryId((int) $id);

        $this->render('category/show', ['category' => $category, 'polls' => $polls]);
    }
}
