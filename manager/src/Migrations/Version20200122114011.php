<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200122114011 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE work_projects_tasks_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE work_projects_tasks (id INT NOT NULL, project_id UUID NOT NULL, author_id UUID NOT NULL, parent_id INT DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, plan_date DATE DEFAULT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, name VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, type VARCHAR(16) NOT NULL, progress SMALLINT NOT NULL, priority SMALLINT NOT NULL, status VARCHAR(16) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E42D1865166D1F9C ON work_projects_tasks (project_id)');
        $this->addSql('CREATE INDEX IDX_E42D1865F675F31B ON work_projects_tasks (author_id)');
        $this->addSql('CREATE INDEX IDX_E42D1865727ACA70 ON work_projects_tasks (parent_id)');
        $this->addSql('CREATE INDEX IDX_E42D1865AA9E377A ON work_projects_tasks (date)');
        $this->addSql('COMMENT ON COLUMN work_projects_tasks.id IS \'(DC2Type:work_projects_task_id)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_tasks.project_id IS \'(DC2Type:work_projects_project_id)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_tasks.author_id IS \'(DC2Type:work_members_member_id)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_tasks.parent_id IS \'(DC2Type:work_projects_task_id)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_tasks.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_tasks.plan_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_tasks.start_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_tasks.end_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_tasks.type IS \'(DC2Type:work_projects_task_type)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_tasks.status IS \'(DC2Type:work_projects_task_status)\'');
        $this->addSql('CREATE TABLE work_projects_tasks_executors (task_id INT NOT NULL, member_id UUID NOT NULL, PRIMARY KEY(task_id, member_id))');
        $this->addSql('CREATE INDEX IDX_6291D08E8DB60186 ON work_projects_tasks_executors (task_id)');
        $this->addSql('CREATE INDEX IDX_6291D08E7597D3FE ON work_projects_tasks_executors (member_id)');
        $this->addSql('COMMENT ON COLUMN work_projects_tasks_executors.task_id IS \'(DC2Type:work_projects_task_id)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_tasks_executors.member_id IS \'(DC2Type:work_members_member_id)\'');
        $this->addSql('ALTER TABLE work_projects_tasks ADD CONSTRAINT FK_E42D1865166D1F9C FOREIGN KEY (project_id) REFERENCES work_projects_projects (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_projects_tasks ADD CONSTRAINT FK_E42D1865F675F31B FOREIGN KEY (author_id) REFERENCES work_members_members (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_projects_tasks ADD CONSTRAINT FK_E42D1865727ACA70 FOREIGN KEY (parent_id) REFERENCES work_projects_tasks (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ADD CONSTRAINT FK_6291D08E8DB60186 FOREIGN KEY (task_id) REFERENCES work_projects_tasks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ADD CONSTRAINT FK_6291D08E7597D3FE FOREIGN KEY (member_id) REFERENCES work_members_members (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_users ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE user_users ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER role TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER role DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER new_email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER new_email DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN user_users.id IS \'(DC2Type:user_user_id)\'');
        $this->addSql('COMMENT ON COLUMN user_users.email IS \'(DC2Type:user_user_email)\'');
        $this->addSql('COMMENT ON COLUMN user_users.role IS \'(DC2Type:user_user_role)\'');
        $this->addSql('COMMENT ON COLUMN user_users.new_email IS \'(DC2Type:user_user_email)\'');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN user_user_networks.user_id IS \'(DC2Type:user_user_id)\'');
        $this->addSql('ALTER TABLE work_projects_project_memberships ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_memberships ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_memberships ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_memberships ALTER member_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_projects_project_memberships.project_id IS \'(DC2Type:work_projects_project_id)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_project_memberships.member_id IS \'(DC2Type:work_members_member_id)\'');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ALTER department_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ALTER department_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_projects_project_membership_departments.department_id IS \'(DC2Type:work_projects_project_department_id)\'');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ALTER role_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ALTER role_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_projects_project_membership_roles.role_id IS \'(DC2Type:work_projects_role_id)\'');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER project_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_projects_project_departments.id IS \'(DC2Type:work_projects_project_department_id)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_project_departments.project_id IS \'(DC2Type:work_projects_project_id)\'');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_projects_projects.id IS \'(DC2Type:work_projects_project_id)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_projects.status IS \'(DC2Type:work_projects_project_status)\'');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions TYPE JSON');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_projects_roles.id IS \'(DC2Type:work_projects_role_id)\'');
        $this->addSql('COMMENT ON COLUMN work_projects_roles.permissions IS \'(DC2Type:work_projects_role_permissions)\'');
        $this->addSql('ALTER TABLE work_members_members ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work_members_members ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_members_members ALTER status DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_members_members.id IS \'(DC2Type:work_members_member_id)\'');
        $this->addSql('COMMENT ON COLUMN work_members_members.group_id IS \'(DC2Type:work_members_group_id)\'');
        $this->addSql('COMMENT ON COLUMN work_members_members.email IS \'(DC2Type:work_members_member_email)\'');
        $this->addSql('COMMENT ON COLUMN work_members_members.status IS \'(DC2Type:work_members_member_status)\'');
        $this->addSql('ALTER TABLE work_members_groups ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_groups ALTER id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_members_groups.id IS \'(DC2Type:work_members_group_id)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE work_projects_tasks DROP CONSTRAINT FK_E42D1865727ACA70');
        $this->addSql('ALTER TABLE work_projects_tasks_executors DROP CONSTRAINT FK_6291D08E8DB60186');
        $this->addSql('DROP SEQUENCE work_projects_tasks_seq CASCADE');
        $this->addSql('DROP TABLE work_projects_tasks');
        $this->addSql('DROP TABLE work_projects_tasks_executors');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN user_user_networks.user_id IS NULL');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_projects_projects.id IS NULL');
        $this->addSql('COMMENT ON COLUMN work_projects_projects.status IS NULL');
        $this->addSql('ALTER TABLE user_users ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE user_users ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER new_email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER new_email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER role TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER role DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN user_users.id IS NULL');
        $this->addSql('COMMENT ON COLUMN user_users.email IS NULL');
        $this->addSql('COMMENT ON COLUMN user_users.new_email IS NULL');
        $this->addSql('COMMENT ON COLUMN user_users.role IS NULL');
        $this->addSql('ALTER TABLE work_members_groups ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_groups ALTER id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_members_groups.id IS NULL');
        $this->addSql('ALTER TABLE work_members_members ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work_members_members ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_members_members ALTER status DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_members_members.id IS NULL');
        $this->addSql('COMMENT ON COLUMN work_members_members.group_id IS NULL');
        $this->addSql('COMMENT ON COLUMN work_members_members.email IS NULL');
        $this->addSql('COMMENT ON COLUMN work_members_members.status IS NULL');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER project_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_projects_project_departments.id IS NULL');
        $this->addSql('COMMENT ON COLUMN work_projects_project_departments.project_id IS NULL');
        $this->addSql('ALTER TABLE work_projects_project_memberships ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_memberships ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_memberships ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_memberships ALTER member_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_projects_project_memberships.project_id IS NULL');
        $this->addSql('COMMENT ON COLUMN work_projects_project_memberships.member_id IS NULL');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ALTER department_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ALTER department_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_projects_project_membership_departments.department_id IS NULL');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ALTER role_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ALTER role_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_projects_project_membership_roles.role_id IS NULL');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions TYPE JSON');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN work_projects_roles.id IS NULL');
        $this->addSql('COMMENT ON COLUMN work_projects_roles.permissions IS NULL');
    }
}
