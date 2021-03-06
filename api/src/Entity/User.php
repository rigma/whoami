<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as PhoneNumberConstraint;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @var \Ramsey\Uuid\Uuid
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * The email of the user
     *
     * @var string
     * @Constraints\Email
     * @Constraints\NotBlank
     * @Constraints\NotNull
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * The hashed password of the user
     *
     * @var string
     * @Constraints\NotBlank
     * @Constraints\NotNull
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * The user's phone number
     *
     * @var \libphonenumber\PhoneNumber|string
     * @PhoneNumberConstraint(defaultRegion="FR")
     * @ORM\Column(type="phone_number")
     */
    private $phone_number;

    /**
     * The roles emboddied by the user
     *
     * @var string[]
     * @ORM\Column(type="json")
     */
    private $roles = [];

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return \libphonenumber\PhoneNumber
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param \libphonenumber\PhoneNumber|string $phone_number
     * @return self
     */
    public function setPhoneNumber($phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
