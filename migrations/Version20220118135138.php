<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220118135138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C35ED766068');
        $this->addSql('DROP INDEX IDX_7A853C35ED766068 ON bookings');
        $this->addSql('ALTER TABLE bookings CHANGE username_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C35A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_7A853C35A76ED395 ON bookings (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C35A76ED395');
        $this->addSql('DROP INDEX IDX_7A853C35A76ED395 ON bookings');
        $this->addSql('ALTER TABLE bookings CHANGE user_id username_id INT NOT NULL');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C35ED766068 FOREIGN KEY (username_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7A853C35ED766068 ON bookings (username_id)');
    }
}
