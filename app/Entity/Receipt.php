<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Console\Helper\Table;


#[Entity, Table('transactions')]
class Receipt
{
    #[Id, Column(options: ['unsigned' => true])]
    private int $id;

    #[Column(name: 'file_name')]
    private string $fileName;

    #[Column(name: 'created_at')]
    private DateTime $createdAt;

    #[Column(name: 'updated_at')]
    private DateTime $updatedAd;

    #[ManyToOne(inversedBy: 'receipts')]
    private Transaction $transaction;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;
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


    public function getTransaction(): Transaction
    {
        return $this->transaction;
    }
    public function setTransaction(Transaction $transaction): self
    {
        $transaction->addReceipt($this);
        $this->transaction = $transaction;
        return $this;
    }
}