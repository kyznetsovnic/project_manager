<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241014084302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developers (id INT AUTO_INCREMENT NOT NULL, position_id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, patronymic VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, age SMALLINT NOT NULL, UNIQUE INDEX UNIQ_BB14EDAE7927C74 (email), INDEX IDX_BB14EDADD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developer_project (developer_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_412D364564DD9267 (developer_id), INDEX IDX_412D3645166D1F9C (project_id), PRIMARY KEY(developer_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE positions (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_5C93B3A49395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE developers ADD CONSTRAINT FK_BB14EDADD842E46 FOREIGN KEY (position_id) REFERENCES positions (id)');
        $this->addSql('ALTER TABLE developer_project ADD CONSTRAINT FK_412D364564DD9267 FOREIGN KEY (developer_id) REFERENCES developers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE developer_project ADD CONSTRAINT FK_412D3645166D1F9C FOREIGN KEY (project_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A49395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE developers DROP FOREIGN KEY FK_BB14EDADD842E46');
        $this->addSql('ALTER TABLE developer_project DROP FOREIGN KEY FK_412D364564DD9267');
        $this->addSql('ALTER TABLE developer_project DROP FOREIGN KEY FK_412D3645166D1F9C');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A49395C3F3');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE developers');
        $this->addSql('DROP TABLE developer_project');
        $this->addSql('DROP TABLE positions');
        $this->addSql('DROP TABLE projects');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
