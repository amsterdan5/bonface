<?php
namespace App\Model;

class Product
{
    // 表名
    protected $table = 'product';

    public function addProduct(string $name, string $image, string $detail_image, string $desc, string $lang)
    {
        return app('db')->insert(
            'insert into ' . $this->table . '(`name`,`image`,`detail_image`,`desc`,`lang`) values(?,?,?,?,?)',
            [$name, $image, $detail_image, $desc, $lang]
        );
    }

    public function editProduct(int $id, string $name, string $image, string $detail_image, string $desc, string $lang)
    {
        return app('db')->update(
            'update ' . $this->table . ' set `name`=?,`image`=?,`detail_image`=?,`desc`=?,`lang`=? where id=? limit 1',
            [$name, $image, $detail_image, $desc, $lang, $id]
        );
    }

    public function delProduct(int $id)
    {
        return app('db')->delete('delete from ' . $this->table . ' where id=?', [$id]);
    }

    public function getProductList(string $lang)
    {
        return app('db')->select('select id,name,image,detail_image from ' . $this->table . ' where lang=?', [$lang]);
    }

    public function getProductDetail(int $id)
    {
        return app('db')->selectOne('select `id`,`name`,`image`,`detail_image`,`desc`,`lang` from ' . $this->table . ' where id=' . $id);
    }
}
