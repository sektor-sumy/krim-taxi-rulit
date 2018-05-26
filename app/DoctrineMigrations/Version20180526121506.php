<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180526121506 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transport_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7044BE675E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2D5B02345E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport_intercity (id INT AUTO_INCREMENT NOT NULL, city_from INT DEFAULT NULL, city_in INT DEFAULT NULL, transport_class INT DEFAULT NULL, price_type VARCHAR(255) DEFAULT NULL, price INT DEFAULT NULL, INDEX IDX_8A7813155A549C18 (city_from), INDEX IDX_8A7813156B798BB1 (city_in), INDEX IDX_8A7813157044BE67 (transport_class), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transport_intercity ADD CONSTRAINT FK_8A7813155A549C18 FOREIGN KEY (city_from) REFERENCES city (id)');
        $this->addSql('ALTER TABLE transport_intercity ADD CONSTRAINT FK_8A7813156B798BB1 FOREIGN KEY (city_in) REFERENCES city (id)');
        $this->addSql('ALTER TABLE transport_intercity ADD CONSTRAINT FK_8A7813157044BE67 FOREIGN KEY (transport_class) REFERENCES transport_class (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transport_intercity DROP FOREIGN KEY FK_8A7813157044BE67');
        $this->addSql('ALTER TABLE transport_intercity DROP FOREIGN KEY FK_8A7813155A549C18');
        $this->addSql('ALTER TABLE transport_intercity DROP FOREIGN KEY FK_8A7813156B798BB1');
        $this->addSql('DROP TABLE transport_class');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE transport_intercity');
    }
}
