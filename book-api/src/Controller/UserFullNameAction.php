<?php

declare(strict_types=1);

namespace App\Controller;

use App\Component\User\UserFullNameDto;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class UserFullNameAction extends AbstractController
{

    public function __invoke(#[MapRequestPayload] UserFullNameDto $fullNameDto)
    {
        print "Salom ". $fullNameDto->getGivenName(). " ". $fullNameDto->getFamilyName();

        exit();
    }

}