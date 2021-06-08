<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608114653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket (id INT AUTO_INCREMENT NOT NULL, sold_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_2246507BC8C84E7D (sold_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, pack_id INT DEFAULT NULL, user_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, note INT NOT NULL, INDEX IDX_9474526C1919B217 (pack_id), INDEX IDX_9474526CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pack (id INT AUTO_INCREMENT NOT NULL, basket_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, content LONGTEXT NOT NULL, categories LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', sales_volume INT NOT NULL, UNIQUE INDEX UNIQ_97DE5E231BE1FB52 (basket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sold (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, basket_id INT DEFAULT NULL, price VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, code VARCHAR(255) NOT NULL, in_progress TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_98D2DD99A76ED395 (user_id), UNIQUE INDEX UNIQ_98D2DD991BE1FB52 (basket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, age INT NOT NULL, tel VARCHAR(255) NOT NULL, pics VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, is_admin TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BC8C84E7D FOREIGN KEY (sold_id) REFERENCES sold (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C1919B217 FOREIGN KEY (pack_id) REFERENCES pack (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pack ADD CONSTRAINT FK_97DE5E231BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
        $this->addSql('ALTER TABLE sold ADD CONSTRAINT FK_98D2DD99A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sold ADD CONSTRAINT FK_98D2DD991BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pack DROP FOREIGN KEY FK_97DE5E231BE1FB52');
        $this->addSql('ALTER TABLE sold DROP FOREIGN KEY FK_98D2DD991BE1FB52');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C1919B217');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507BC8C84E7D');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE sold DROP FOREIGN KEY FK_98D2DD99A76ED395');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE pack');
        $this->addSql('DROP TABLE sold');
        $this->addSql('DROP TABLE user');
    }
}
