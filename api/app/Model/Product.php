<?php
namespace App\Model;

class Product
{
    // 表名
    protected $table = 'product';

    public function addProduct(string $name, string $image, string $web_image, string $detail_image, string $desc, string $lang, int $cid)
    {
        return app('db')->insert(
            'insert into ' . $this->table . '(`name`,`image`,`web_image`,`detail_image`,`desc`,`lang`,`cid`) values(?,?,?,?,?,?,?)',
            [$name, $image, $web_image, $detail_image, $desc, $lang, $cid]
        );
    }

    public function editProduct(int $id, string $name, string $image, string $web_image, string $detail_image, string $desc, string $lang, int $cid)
    {
        return app('db')->update(
            'update ' . $this->table . ' set `name`=?,`image`=?,`web_image`=?,`detail_image`=?,`desc`=?,`lang`=?,`cid`=? where id=? limit 1',
            [$name, $image, $web_image, $detail_image, $desc, $lang, $cid, $id]
        );
    }

    public function delProduct(int $id)
    {
        return app('db')->delete('delete from ' . $this->table . ' where id=?', [$id]);
    }

    public function getProductList(string $lang)
    {
        return app('db')->select('select p.id,p.name,p.web_image,p.detail_image,c.image,c.id cid from ' . $this->table . ' p left join cates c on p.cid=c.id where lang=?', [$lang]);
    }

    public function getProductDetail(int $id)
    {
        return app('db')->selectOne('select `id`,`name`,`image`,`web_image`,`detail_image`,`desc`,`lang` from ' . $this->table . ' where id=' . $id);
    }
}
