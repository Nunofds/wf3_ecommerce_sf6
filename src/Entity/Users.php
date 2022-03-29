<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass:UsersRepository::class)]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]// cella vaut dire que c'est un eclé primaire
#[ORM\GeneratedValue]// cella vaut dire que va faire un auto increment
#[ORM\Column(type:'integer')]// cella donne le type, dans ce cas un intier
private $id;

#[ORM\Column(type:'string', length:180, unique:true)]
private $email;

#[ORM\Column(type:'json')]
private $roles = [];

#[ORM\Column(type:'string')]
private $password;

function getId(): ?int
    {
    return $this->id;
}

function getEmail(): ?string
    {
    return $this->email;
}

function setEmail(string $email): self
    {
    $this->email = $email;

    return $this;
}

/**
 * A visual identifier that represents this user.
 *
 * @see UserInterface
 */
function getUserIdentifier(): string
    {
    return (string) $this->email;
}

/**
 * @see UserInterface
 */
function getRoles(): array
{
    $roles = $this->roles;
    // guarantee every user at least has ROLE_USER
    $roles[] = 'ROLE_USER';

    return array_unique($roles);
}

function setRoles(array $roles): self
    {
    $this->roles = $roles;

    return $this;
}

/**
 * @see PasswordAuthenticatedUserInterface
 */
function getPassword(): string
    {
    return $this->password;
}

function setPassword(string $password): self
    {
    $this->password = $password;

    return $this;
}

/**
 * @see UserInterface
 */
function eraseCredentials()
    {
    // If you store any temporary, sensitive data on the user, clear it here
    // $this->plainPassword = null;
}
}
