<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class DoctorUserProvider implements UserProviderInterface
{
    public function loadUserByIdentifier(string $username): UserInterface
    {
        if ($username !== 'doctor') {
            throw new UserNotFoundException('Doctor user not found.');
        }

        return new User();
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof User) {
            throw new \Exception('Invalid user type.');
        }

        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class;
    }
}
