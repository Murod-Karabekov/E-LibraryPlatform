<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FindCategoryAction extends AbstractController
{
    public function __invoke(CategoryRepository $categoryRepository)
    {
        //findAll metodini chaqirdik bu biron narsa qabu qilmaydi,barcha categoryalarni chiqaradi
        return $categoryRepository->findAll();
    }
}