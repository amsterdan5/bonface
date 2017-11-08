<?php
namespace App\Model;

class Banner
{
    // 表名
    protected $table = 'banner';

    public function addBanner(string $image, string $lang)
    {
        return app('db')->insert(
            'insert into ' . $this->table . '(`image`,`lang`) values(?,?)',
            [$image, $lang]
        );
    }

    public function editBanner(int $id, string $image, string $lang)
    {
        return app('db')->update(
            'update ' . $this->table . ' set `image`=?,`lang`=? where id=? limit 1',
            [$image, $lang, $id]
        );
    }

    public function getBanner(string $lang)
    {
        return app('db')->select('select id,image from ' . $this->table . ' where lang=?', [$lang]);
    }

    public function getBannerCount(string $lang)
    {
        $count = app('db')->selectOne('select count(*) as num from ' . $this->table . ' where lang=?', [$lang]);
        return $count->num;
    }

    public function delBanner(int $id)
    {
        return app('db')->delete('delete from ' . $this->table . ' where id=?', [$id]);
    }
}
