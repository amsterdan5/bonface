<?php
namespace App\Model;

class Banner
{
    // 表名
    protected $table = 'banner';

    public function addBanner(string $image)
    {
        return app('db')->insert(
            'insert into ' . $this->table . '(`image`) values(?)',
            [$image]
        );
    }

    public function editBanner(int $id, string $image)
    {
        return app('db')->update(
            'update ' . $this->table . ' set image=? where id=? limit 1',
            [$image, $id]
        );
    }

    public function getBanner()
    {
        return app('db')->select('select id,image from ' . $this->table);
    }

    public function getBannerCount()
    {
        $count = app('db')->selectOne('select count(*) as num from ' . $this->table);
        return $count->num;
    }

    public function delBanner(int $id)
    {
        return app('db')->delete('delete from ' . $this->table . ' where id=?', [$id]);
    }
}
