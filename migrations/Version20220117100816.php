<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220117100816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bookings (id INT AUTO_INCREMENT NOT NULL, username_id INT NOT NULL, startdate DATETIME NOT NULL, enddate DATETIME NOT NULL, INDEX IDX_7A853C35ED766068 (username_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, booking_id INT NOT NULL, name VARCHAR(255) NOT NULL, only_for_premium_members TINYINT(1) NOT NULL, INDEX IDX_729F519B3301C60 (booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C35ED766068 FOREIGN KEY (username_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B3301C60 FOREIGN KEY (booking_id) REFERENCES bookings (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B3301C60');
        $this->addSql('DROP TABLE bookings');
        $this->addSql('DROP TABLE room');
    }
}
