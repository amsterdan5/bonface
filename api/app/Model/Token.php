<?php
namespace App\Model;

class Token
{
    // 表名
    protected $table = 'token';

    public function addToken(int $admin_id, string $token)
    {
        $validate = time() + 86400;
        return app('db')->affectingStatement('REPLACE INTO ' . $this->table . '(`admin_id`,`token`,`validate`) values(?,?,?)',
            [$admin_id, $token, $validate]
        );
    }

    public function getToken(string $token)
    {
        return app('db')->selectOne('select validate from ' . $this->table . ' where token=? limit 1',
            [$token]
        );
    }
}
