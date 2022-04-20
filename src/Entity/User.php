<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials()
    {

    }

    public function getUserIdentifier(): string
    {
        return '';
    }
}