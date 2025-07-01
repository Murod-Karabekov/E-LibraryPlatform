<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FindBookAction extends AbstractController
{
    public function  __invoke(BookRepository $bookRepository)
    {
        //id'si 3 bo'lgan kitobni topishni buyurdik
        //javob sifatida Book sifiga mansub obyekt qaytaradi
        //agar bu id topilmasa --null qaytaradi
        return $bookRepository->findOneByText("str");
    }
}