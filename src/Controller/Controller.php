<?php
namespace App\Controller;

use Exception;

class Controller
{
    protected function render(string $path, array $params = []): void
    {
        $filePath = APP_ROOT . "/templates/$path.php";

        if (!file_exists($filePath))
        {
            throw new Exception("Le fichier $filePath n'existe pas");
        }
        else
        {
            extract($params);
            require_once $filePath;
        }
    }

    protected function renderJson(string $status, mixed $data): void
    {
        echo json_encode([
            "status" => $status,
            "data" => $data
        ]);
    }
}
