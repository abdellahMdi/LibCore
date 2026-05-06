<?php

namespace LibCore\Entities;

class Member extends User
{
    private string $role; // 'Étudiant' ou 'Professeur'

    public function __construct(string $name, string $email, string $role)
    {
        parent::__construct($name, $email);
        $this->role = $role;
    }

    public function getRole(): string { return $this->role; }
    public function setRole(string $role): void { $this->role = $role; }
}