<?php

declare(strict_types=1);

namespace App\Component\User;

use Symfony\Component\Serializer\Attribute\Groups;

class UserFullNameDto
{

    public function __construct(
        #[Groups(['user:write'])]
        private string $givenName,

        #[Groups(['user:write'])]
        private string $familyName,

        #[Groups(['user:write'])]
        private string $isMarried
    )
    {
    }

    public function getGivenName(): string
    {
        return $this->givenName;
    }

    public function getFamilyName(): string
    {
        return $this->familyName;
    }

    public function getIsMarried(): string
    {
        return $this->isMarried;
    }

}