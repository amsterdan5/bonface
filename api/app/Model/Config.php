<?php
namespace App\Model;

class Config
{
    //  表名
    protected $table = 'config';

    public function getConfigByType(string $type)
    {
        return app('db')->selectOne('select `id`,`type`,`value` from ' . $this->table . ' where `type`=?', [$type]);
    }

    public function changeConfig(string $type, string $value)
    {
        return app('db')->update('update ' . $this->table . ' set `value`=? where `type`=?', [$value, $type]);
    }

    public function addConfig(string $type, string $value)
    {
        return app('db')->update('inset into  ' . $this->table . '(`type`,`value`) values(?,?)', [$type, $value]);
    }
}
