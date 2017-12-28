<?php


use Phinx\Migration\AbstractMigration;

class CreateTest extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('test', array('id' => false, 'collation' => 'utf8mb4_unicode_ci'));

        $table->addColumn('id', 'char', array(
            'limit' => 30,
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => 'ID'
        ))
            ->addColumn('name','char', array(
                'limit' => 30,
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '名字'
            ))
            ->addColumn('created_time', 'biginteger', array(
                'limit' => 20,
                'signed' => false,
                'default' => 0,
                'comment' => '建立時間'
            ))
            ->addIndex('id')
            ->create();
    }
}
