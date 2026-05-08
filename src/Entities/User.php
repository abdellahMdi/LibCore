<?php
 
namespace LibCore\Entities;
 
abstract class User
{
    protected ?int $id;
    protected string $name;
    protected string $email;

    public function __construct(string $name, string $email, ?int $id = null) {
        $this->id = $id;
        $this->name  = $name;
        $this->email = $email;
    }

    public function getId(): ?int { return $this->id; }
 
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
 
    public function setName(string $name): void { $this->name = $name; }
    public function setEmail(string $email): void { $this->email = $email; }
}