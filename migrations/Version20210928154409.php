<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210928154409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pack DROP FOREIGN KEY FK_97DE5E23C8C84E7D');
        $this->addSql('ALTER TABLE pack CHANGE picture picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE pack ADD CONSTRAINT FK_97DE5E23C8C84E7D FOREIGN KEY (sold_id) REFERENCES sold (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pack DROP FOREIGN KEY FK_97DE5E23C8C84E7D');
        $this->addSql('ALTER TABLE pack CHANGE picture picture VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pack ADD CONSTRAINT FK_97DE5E23C8C84E7D FOREIGN KEY (sold_id) REFERENCES pack (id) ON DELETE CASCADE');
    }
}
