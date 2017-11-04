<?php
namespace App\Model;

class Token
{
    // 表名
    protected $table = 'token';

    public function addToken(string $token)
    {
        $validate = time() + 86400;
        return app('db')->insert(
            'insert into ' . $this->table . '(`token`,`validate`) values(?,?)',
            [$token, $validate]
        );
    }

    public function getToken(string $token)
    {
        return app('db')->selectOne('select validate from ' . $this->table . ' where token=? limit 1',
            [$token]
        );
    }
}
