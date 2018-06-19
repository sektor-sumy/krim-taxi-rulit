<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180619155456 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_car DROP INDEX UNIQ_3466A9FD773DE69D, ADD INDEX IDX_3466A9FD773DE69D (car)');
        $this->addSql('ALTER TABLE order_car CHANGE car car INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_car ADD CONSTRAINT FK_3466A9FD773DE69D FOREIGN KEY (car) REFERENCES transport_class (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_car DROP INDEX IDX_3466A9FD773DE69D, ADD UNIQUE INDEX UNIQ_3466A9FD773DE69D (car)');
        $this->addSql('ALTER TABLE order_car DROP FOREIGN KEY FK_3466A9FD773DE69D');
        $this->addSql('ALTER TABLE order_car CHANGE car car VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
