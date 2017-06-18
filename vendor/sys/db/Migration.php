<?php
namespace sys\db;

/**
 * Created by PhpStorm.
 * User: taiki
 * Date: 2017/06/13
 * Time: 21:06
 */
use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;


class Migration extends AbstractMigration {
    /** @var \Illuminate\Database\Capsule\Manager $capsule */
    public $capsule;
    /** @var \Illuminate\Database\Schema\Builder $capsule */
    public $schema;

    public function init()
    {
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => "localhost",
            'database'  => "webAPI",
            'username'  => "root",
            'password'  => "",
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);

        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema();
    }
}