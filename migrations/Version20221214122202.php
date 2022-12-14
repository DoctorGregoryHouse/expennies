<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214122202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Category (id INT UNSIGNED NOT NULL, user_id INT UNSIGNED DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_FF3A7B97A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Receipt (id INT UNSIGNED NOT NULL, transaction_id INT UNSIGNED DEFAULT NULL, file_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_9C248FD92FC0CB0F (transaction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Transaction (id INT UNSIGNED NOT NULL, category_id INT UNSIGNED DEFAULT NULL, user_id INT UNSIGNED DEFAULT NULL, description VARCHAR(255) NOT NULL, date DATETIME NOT NULL, amount NUMERIC(13, 3) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_F4AB8A0612469DE2 (category_id), INDEX IDX_F4AB8A06A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT UNSIGNED NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Category ADD CONSTRAINT FK_FF3A7B97A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Receipt ADD CONSTRAINT FK_9C248FD92FC0CB0F FOREIGN KEY (transaction_id) REFERENCES Transaction (id)');
        $this->addSql('ALTER TABLE Transaction ADD CONSTRAINT FK_F4AB8A0612469DE2 FOREIGN KEY (category_id) REFERENCES Category (id)');
        $this->addSql('ALTER TABLE Transaction ADD CONSTRAINT FK_F4AB8A06A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Category DROP FOREIGN KEY FK_FF3A7B97A76ED395');
        $this->addSql('ALTER TABLE Receipt DROP FOREIGN KEY FK_9C248FD92FC0CB0F');
        $this->addSql('ALTER TABLE Transaction DROP FOREIGN KEY FK_F4AB8A0612469DE2');
        $this->addSql('ALTER TABLE Transaction DROP FOREIGN KEY FK_F4AB8A06A76ED395');
        $this->addSql('DROP TABLE Category');
        $this->addSql('DROP TABLE Receipt');
        $this->addSql('DROP TABLE Transaction');
        $this->addSql('DROP TABLE User');
    }
}
