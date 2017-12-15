<?php
namespace App\Model;

use DB;

class Cates
{
    // 表名
    protected $table = 'cates';

    public function addCates(string $image, string $web_image)
    {
        // return app('db')->insertGetId(
        //     'insert into ' . $this->table . '(`image`) values(?)',
        //     [$image]
        // );
        return DB::table($this->table)->insertGetId(
            ['image' => $image, 'web_image' => $web_image]
        );
    }

    public function editCates(int $id, string $image, string $web_image)
    {
        return app('db')->update(
            'update ' . $this->table . ' set `image`=?,`web_image`=? where id=? limit 1',
            [$image, $web_image, $id]
        );
    }
}
