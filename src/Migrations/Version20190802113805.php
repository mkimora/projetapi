<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190802113805 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur ADD partenaire_id INT DEFAULT NULL, ADD compte_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B398DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B398DE13AC ON utilisateur (partenaire_id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3F2C56620 ON utilisateur (compte_id)');
        $this->addSql('ALTER TABLE compte ADD operation_id INT NOT NULL, ADD partenaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526044AC3583 FOREIGN KEY (operation_id) REFERENCES operations (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526098DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('CREATE INDEX IDX_CFF6526044AC3583 ON compte (operation_id)');
        $this->addSql('CREATE INDEX IDX_CFF6526098DE13AC ON compte (partenaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526044AC3583');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526098DE13AC');
        $this->addSql('DROP INDEX IDX_CFF6526044AC3583 ON compte');
        $this->addSql('DROP INDEX IDX_CFF6526098DE13AC ON compte');
        $this->addSql('ALTER TABLE compte DROP operation_id, DROP partenaire_id');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B398DE13AC');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3F2C56620');
        $this->addSql('DROP INDEX IDX_1D1C63B398DE13AC ON utilisateur');
        $this->addSql('DROP INDEX IDX_1D1C63B3F2C56620 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP partenaire_id, DROP compte_id');
    }
}
