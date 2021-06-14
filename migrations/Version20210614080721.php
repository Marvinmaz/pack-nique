<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210614080721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pack DROP FOREIGN KEY FK_97DE5E231BE1FB52');
        $this->addSql('ALTER TABLE sold DROP FOREIGN KEY FK_98D2DD991BE1FB52');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP INDEX UNIQ_97DE5E231BE1FB52 ON pack');
        $this->addSql('ALTER TABLE pack CHANGE basket_id sold_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pack ADD CONSTRAINT FK_97DE5E23C8C84E7D FOREIGN KEY (sold_id) REFERENCES pack (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_97DE5E23C8C84E7D ON pack (sold_id)');
        $this->addSql('DROP INDEX UNIQ_98D2DD991BE1FB52 ON sold');
        $this->addSql('ALTER TABLE sold DROP basket_id');
        $this->addSql('ALTER TABLE user CHANGE pics name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket (id INT AUTO_INCREMENT NOT NULL, sold_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_2246507BC8C84E7D (sold_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BC8C84E7D FOREIGN KEY (sold_id) REFERENCES sold (id)');
        $this->addSql('ALTER TABLE pack DROP FOREIGN KEY FK_97DE5E23C8C84E7D');
        $this->addSql('DROP INDEX IDX_97DE5E23C8C84E7D ON pack');
        $this->addSql('ALTER TABLE pack CHANGE sold_id basket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pack ADD CONSTRAINT FK_97DE5E231BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_97DE5E231BE1FB52 ON pack (basket_id)');
        $this->addSql('ALTER TABLE sold ADD basket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sold ADD CONSTRAINT FK_98D2DD991BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_98D2DD991BE1FB52 ON sold (basket_id)');
        $this->addSql('ALTER TABLE user CHANGE name pics VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
