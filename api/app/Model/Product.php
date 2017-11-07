<?php
namespace App\Model;

class Product
{
    // 表名
    protected $table = 'product';

    public function addProduct(string $name, string $image, string $desc)
    {
        return app('db')->insert(
            'insert into ' . $this->table . '(`name`,`image`,`detail_image`,`desc`) values(?,?,?)',
            [$name, $image, $desc]
        );
    }

    public function editProduct(int $id, string $name, string $image, string $detail_image, string $desc)
    {
        return app('db')->update(
            'update ' . $this->table . ' set `name`=?,`image`=?,`detail_image`,`desc`=? where id=? limit 1',
            [$name, $image, $detail_image, $desc, $id]
        );
    }

    public function delProduct(int $id)
    {
        return app('db')->delete('delete from ' . $this->table . ' where id=?', [$id]);
    }

    public function getProductList()
    {
        return app('db')->select('select id,name,image,detail_image from ' . $this->table);
    }

    public function getProductDetail(int $id)
    {
        return app('db')->selectOne('select `id`,`name`,`image`,`detail_image`,`desc` from ' . $this->table . ' where id=' . $id);
    }
}
