<?php
use Migrations\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('first_name', 'string', ['limit' => 100])
              ->addColumn('last_name', 'string', ['limit' => 100])
              ->addColumn('email', 'string', ['limit' => 100])
              ->addColumn('password', 'string')
              ->addColumn('role', 'enum', ['values' => 'admin, user'])
              ->addColumn('active', 'boolean')
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->create();
    }
}
