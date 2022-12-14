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


#[Entity, Table('transactions')]
class Transaction
{
    #[Id, Column(options: ['unsigned' => true])]
    private int $id;
    #[Column]
    private string $description;

    #[Column]
    private DateTime $date;

    #[Column(name: 'amount', type: Types::DECIMAL, precision: 13, scale: 3)]
    private float $amount;

    #[Column(name: 'created_at')]
    private DateTime $createdAt;

    #[Column(name: 'updated_at')]
    private DateTime $updatedAd;

    #[ManyToOne(inversedBy: 'transactions')]
    private Category $category;

    #[ManyToOne(inversedBy: 'transactions')]
    private User $user;

    # the mapping refers to the Attribute of the Receipt class
    #[OneToMany(mappedBy: 'transaction', targetEntity: Receipt::class)]
    private Collection $receipts;

    public function __construct()
    {
        $this->receipts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }
    public function setDate(DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
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

    public function getCategory(): Category
    {
        return $this->category;
    }
    public function setCategory(Category $category): self
    {
        $category->addTransaction($this);
        $this->category = $category;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }
    public function setUser(User $user): self
    {
        //set user since this is the owning site of the relationship 
        $user->addTransaction($this);
        $this->user = $user;
        return $this;
    }

    public function getReceipts(): Collection
    {
        return $this->receipts;
    }
    public function addReceipt(Receipt $receipt): self
    {
        $this->receipts->add($receipt);
        return $this;
    }
}