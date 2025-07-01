<?php

declare(strict_types=1);

namespace App\Component\User;

use Symfony\Component\Serializer\Attribute\Groups;

class UserMaxAgeDto
{
    public function __construct(
        #[Groups('user:read')]
        private int $maxAge,
    )
    {
    }

    public function getMaxAge(): int
    {
        return $this->maxAge;
    }
}