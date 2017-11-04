<?php
namespace App\Model;

class Product
{
    // 表名
    protected $table = 'product';

    public function addProduct(string $image)
    {
        return app('db')->insert(
            'insert into ' . $this->banner . '(`image`) values(?)',
            [$image]
        );
    }
}
