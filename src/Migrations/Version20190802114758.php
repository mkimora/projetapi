<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190802114758 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE operations DROP FOREIGN KEY FK_28145348FB88E14F');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP INDEX IDX_28145348FB88E14F ON operations');
        $this->addSql('ALTER TABLE operations DROP utilisateur_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, partenaire_id INT DEFAULT NULL, compte_id INT NOT NULL, username VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, adresse_u VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, roles VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, etat_u VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_1D1C63B398DE13AC (partenaire_id), INDEX IDX_1D1C63B3F2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B398DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE operations ADD utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE operations ADD CONSTRAINT FK_28145348FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_28145348FB88E14F ON operations (utilisateur_id)');
    }
}
