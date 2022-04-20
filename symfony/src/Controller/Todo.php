<?php

namespace App\Controller;

use App\Entity\TodoItem;
use App\Repository\TodoItemRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/todo/item')]
class Todo extends AbstractController
{
    #[Route('/new/{name}', name: 'app_todo_new', methods: ['POST', 'GET'])]
    public function new(Request $request, string $name, TodoItemRepository $repo, ValidatorInterface $validator): Response
    {
        $td = new TodoItem();
        $td->setCreatedAt(time());
        $td->setIsFinished(false);
        $td->setText($name);

        $errors = $validator->validate($td);

        if (count($errors) > 0) {
            return $this->json(["error" => (string) $errors]);
        }

        $repo->add($td);

        return $this->json(["items" => $repo->listAll()]);
    }

    #[Route('/edit/{id}', name: 'app_todo_edit', methods: ['POST'])]
    public function edit(Request $request, int $id, TodoItemRepository $repo, ManagerRegistry $doctrine): Response
    {
        $td = $repo->find($id);
        $td->setIsFinished(!$td->getIsFinished());

        $entityManager = $doctrine->getManager();
        $entityManager->flush();

        return $this->json(["items" => $repo->listAll()]);
    }


    #[Route('/list', name: 'app_todo_list', methods: ['GET'])]
    public function list(Request $request, TodoItemRepository $repo): Response
    {
        return $this->json(["items" => $repo->listAll()]);
    }
}
