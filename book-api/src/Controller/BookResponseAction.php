<?php

declare(strict_types=1);

namespace App\Controller;

use App\Component\Book\BookResponseDto;
use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class BookResponseAction extends AbstractController
{

    public function __invoke(#[MapRequestPayload] BookResponseDto $bookResponseDto)
    {
        print_r($bookResponseDto);

        exit();
    }

}