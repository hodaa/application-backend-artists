<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180902093105 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE songs (id INT AUTO_INCREMENT NOT NULL, album_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, length VARCHAR(100) NOT NULL, INDEX IDX_BAECB19B1137ABCF (album_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artists (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, token VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_68D3801E5F37A13B (token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE albums (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, cover VARCHAR(255) NOT NULL, token VARCHAR(20) NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_F4E2474F5F37A13B (token), INDEX IDX_F4E2474FB7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE songs ADD CONSTRAINT FK_BAECB19B1137ABCF FOREIGN KEY (album_id) REFERENCES albums (id)');
        $this->addSql('ALTER TABLE albums ADD CONSTRAINT FK_F4E2474FB7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE albums DROP FOREIGN KEY FK_F4E2474FB7970CF8');
        $this->addSql('ALTER TABLE songs DROP FOREIGN KEY FK_BAECB19B1137ABCF');
        $this->addSql('DROP TABLE songs');
        $this->addSql('DROP TABLE artists');
        $this->addSql('DROP TABLE albums');
    }
}
