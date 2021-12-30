<?php

use Phinx\Migration\AbstractMigration;

final class CreateCategoryCosts extends AbstractMigration
{
    public function up()
    {
        $this->table('category_costs')
            ->addColumn('name', 'string')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->save();
    }

    public function down()
    {
        $this->table('category_costs')->drop()->save();
    }
}
