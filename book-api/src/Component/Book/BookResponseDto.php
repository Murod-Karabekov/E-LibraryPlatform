<?php

declare(strict_types=1);

namespace App\Component\Book;

use Symfony\Component\Serializer\Attribute\Groups;

class BookResponseDto
{

    public function __construct(
        #[Groups('user:write')]
        private string $categoryNAme,

        #[Groups('user:write')]
        private string $bookName,

        #[Groups('user:write')]
        private string $description,

        #[Groups('user:write')]
        private string $givenName,

        #[Groups('user:write')]
        private int $price
    )
    {
    }

    public function getCategoryNAme(): string
    {
        return $this->categoryNAme;
    }

    public function getBookName(): string
    {
        return $this->bookName;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getGivenName(): string
    {
        return $this->givenName;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

}