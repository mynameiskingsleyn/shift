<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190603025904 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE denom_money (denom_id INT NOT NULL, money_id INT NOT NULL, INDEX IDX_476A00BD91DDAF20 (denom_id), INDEX IDX_476A00BDBF29332C (money_id), PRIMARY KEY(denom_id, money_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE denom_money ADD CONSTRAINT FK_476A00BD91DDAF20 FOREIGN KEY (denom_id) REFERENCES denom (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE denom_money ADD CONSTRAINT FK_476A00BDBF29332C FOREIGN KEY (money_id) REFERENCES money (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE denom_money');
    }
}
