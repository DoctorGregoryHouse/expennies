<?php

declare(strict_types=1);

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Console\Helper\Table;


#[Entity, Table('categories')]
class Category
{
    #[Id, Column(options: ['unsigned' => true])]
    private int $id;
    #[Column]
    private string $name;

    #[Column(name: 'created_at')]
    private DateTime $createdAt;

    #[Column(name: 'updated_at')]
    private DateTime $updatedAd;

    #[OneToMany(mappedBy: 'transaction', targetEntity: Transaction::class)]
    private Collection $transactions;

    #[ManyToOne(inversedBy: 'categories')]
    private User $user;


    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAd(): DateTime
    {
        return $this->updatedAd;
    }
    public function setUpdatedAd(DateTime $updatedAd): self
    {
        $this->updatedAd = $updatedAd;
        return $this;
    }

    public function getTransactions(): Collection
    {
        return $this->transactions;
    }
    public function addTransaction(Transaction $transaction): self
    {
        $this->transactions->add($transaction);
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }
    public function setUser(User $user): self
    {
        $user->addCategory($this);
        $this->user = $user;
        return $this;
    }
}