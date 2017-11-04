<?php
namespace App\Model;

class Admin
{
    //  表名
    protected $table = 'admin';

    /**
     * 通过账号名获取记录
     * @param  string $admin_name [账号名]
     * @return object
     */
    public function getAdminByName(string $admin_name)
    {
        return app('db')->selectOne('select id,name,password,salt from ' . $this->table . ' where name=? limit 1',
            [$admin_name]
        );
    }

    /**
     * 增加管理员
     */
    public function addAdmin(string $admin, string $passwd, string $salt)
    {
        return app('db')->insert(
            'insert into ' . $this->table . '(`name`,`password`,`salt`,`ctime`) values(?,?,?,?)',
            [$admin, $passwd, $salt, time()]
        );
    }

    /**
     * 修改密码
     */
    public function updatePasswd(string $admin, string $passwd, string $salt)
    {
        return app('db')->update(
            'update ' . $this->table . ' set `password`=?,`salt`=?,`ctime`=? where admin=?',
            [$passwd, $salt, time(), $admin]
        );
    }
}
