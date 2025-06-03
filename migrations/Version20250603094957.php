<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250603094957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE alternance (id INT AUTO_INCREMENT NOT NULL, ref_entreprise_id INT NOT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, cout_contrat DOUBLE PRECISION DEFAULT NULL, tuteur_professeur VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_445F37B980FEF88A (ref_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE convocation (id INT AUTO_INCREMENT NOT NULL, ref_responsable_id INT NOT NULL, ref_etudiant_id INT DEFAULT NULL, date DATETIME NOT NULL, motif VARCHAR(255) NOT NULL, description VARCHAR(500) DEFAULT NULL, action_mise_en_place VARCHAR(255) NOT NULL, INDEX IDX_C03B3F5F1E53AC7D (ref_responsable_id), INDEX IDX_C03B3F5F27E3492F (ref_etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, ref_stage_id INT DEFAULT NULL, ref_alternance_id INT DEFAULT NULL, ref_promotion_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_717E22E3A48F1714 (ref_stage_id), UNIQUE INDEX UNIQ_717E22E3E34DBBDA (ref_alternance_id), UNIQUE INDEX UNIQ_717E22E3F7693767 (ref_promotion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE potentitel_eleve (id INT AUTO_INCREMENT NOT NULL, ref_responsable_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(20) NOT NULL, num_dossier_psup VARCHAR(100) DEFAULT NULL, filiere_envisage VARCHAR(255) DEFAULT NULL, ancien_etablissement VARCHAR(255) NOT NULL, INDEX IDX_C917C8A31E53AC7D (ref_responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, filiere VARCHAR(255) NOT NULL, annee VARCHAR(255) NOT NULL, places INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ref_entreprise (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE stage (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE alternance ADD CONSTRAINT FK_445F37B980FEF88A FOREIGN KEY (ref_entreprise_id) REFERENCES entreprise (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE convocation ADD CONSTRAINT FK_C03B3F5F1E53AC7D FOREIGN KEY (ref_responsable_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE convocation ADD CONSTRAINT FK_C03B3F5F27E3492F FOREIGN KEY (ref_etudiant_id) REFERENCES etudiant (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3A48F1714 FOREIGN KEY (ref_stage_id) REFERENCES stage (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3E34DBBDA FOREIGN KEY (ref_alternance_id) REFERENCES alternance (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3F7693767 FOREIGN KEY (ref_promotion_id) REFERENCES promotion (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE potentitel_eleve ADD CONSTRAINT FK_C917C8A31E53AC7D FOREIGN KEY (ref_responsable_id) REFERENCES `user` (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE alternance DROP FOREIGN KEY FK_445F37B980FEF88A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE convocation DROP FOREIGN KEY FK_C03B3F5F1E53AC7D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE convocation DROP FOREIGN KEY FK_C03B3F5F27E3492F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3A48F1714
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3E34DBBDA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3F7693767
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE potentitel_eleve DROP FOREIGN KEY FK_C917C8A31E53AC7D
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE alternance
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE convocation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE entreprise
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE etudiant
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE potentitel_eleve
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE promotion
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ref_entreprise
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE stage
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
