<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Component\User\UserFactory;
use App\Component\User\UserManager;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserCreateAction extends AbstractController
{

    public function __construct(
        private UserFactory $userFactory,
        private UserManager $userManager,
        private ValidatorInterface $validator,
        private UserRepository $userRepository
    )
    {
    }

    public function __invoke(User $user): User
    {
        if ($this->userRepository->findOneBy(['email' => $user->getEmail()])) {
            throw new BadRequestHttpException('Ushbu email tizimda mavjud!');
        }

        $this->validator->validate($user);

        $newUser = $this->userFactory->create(
            $user->getEmail(),
            $user->getPassword(),
            $user->getAge(),
            $user->getGender(),
            $user->getPhone()
        );
        $this->userManager->save($newUser, isNeedFlush: true);

        return $newUser;
    }

}