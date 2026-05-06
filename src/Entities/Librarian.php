<?php

namespace LibCore\Entities;

class Librarian extends User
{
    private string $employeeId;

    public function __construct(string $name, string $email, string $employeeId)
    {
        parent::__construct($name, $email);
        $this->employeeId = $employeeId;
    }

    public function getEmployeeId(): string { return $this->employeeId; }
    public function setEmployeeId(string $employeeId): void { $this->employeeId = $employeeId; }
}