<?php

declare(strict_types=1);

namespace App\Controller;

use App\Component\User\UserMaxAgeDto;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserFindMaxAgeAction extends AbstractController
{
    public function __invoke(UserRepository $userRepository): UserMaxAgeDto
    {
        return new UserMaxAgeDto($userRepository->findOneMaxAge());
    }
}