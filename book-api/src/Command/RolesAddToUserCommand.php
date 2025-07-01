<?php

namespace App\Command;

use App\Component\User\UserManager;
use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'roles:add-to-user',
    description: 'Add roles to User',
)]
class RolesAddToUserCommand extends Command
{
    public function __construct(private UserRepository $userRepository, private UserManager $userManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $askId = new Question("Foydalanuvchi id'sini kiriting");
        $askRole = new Question("Foydalanuvchi roli'ni kiriting");
        $questionHelper = $this->getHelper('question');

        $user = null;
        $role = null;

        while (!$user) {
            // Ushbu qatorda id kiritishini so'rayapmiz va kiritilgan ma'lumotni id o'zgaruvchanida saqlayabmiz
            $id = $questionHelper->ask($input, $output, $askId);

            // Bu yerda esa kiritilgan id null emasmi deb tekshiryapmmiz
            if ($id === null) {
                $io->warning("Iltimos id'ni kiriting");
            } else {
                // Kiritilgan id'ga mos user'ni bazadan topyabmiz
                $user = $this->userRepository->find($id);

                // Agar foydalanuvchi topilmasa xato chiqaryabmiz
                if ($user === null) {
                    $io->warning("Foydalanuvchi topilmadi");
                }
            }
        }

        // Toki to'g'ri formatdagi role kiritilmaguncha role kiritishni so'rayabmiz
        while (!preg_match("/^ROLE_[A-Z]{4,20}$/", $role)) {
            // Bu yerda role so'rayabmiz
            $role = $questionHelper->ask($input, $output, $askRole);

            // Kiritilgan role noto'g'ri bo'lsa xato chiqaryapmiz
            if (!preg_match("/^ROLE_[A-Z]{4,20}$/", $role)) {
                $io->warning("Noto'g'ri role kiritdingiz!");
            }
        }

        // User'ni role massivini yangi massivga olib oldik
        $roles = $user->getRoles();

        // Agarda roles massivida kiritilayotgan yangi role mavjud bo'lmasa if ishlasin
        if (!in_array($role, $roles, true)) {
            // Ushbu massivga qo'shimcha yangi kiritilgan role'ni qo'shdik
            $roles[] = $role;

            // yangi yaratilgan massivni user'ni roles xususiyatiga set qildik
            $user->setRoles($roles);

            // User'ni saqladik
            $this->userManager->save($user, true);

            $io->section("Foydalanuvchiga rol biriktirish jarayoni");
            $io->success("Amal bajarildi.");

            $io->success("Role muvaffaqiyatli biriktirildi");
        } else {
            $io->warning("Bu rol foydalanuvchiga allaqachon biriktirilgan.");
        }

        return Command::SUCCESS;
    }
}
