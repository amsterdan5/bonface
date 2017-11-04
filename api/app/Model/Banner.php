<?php
namespace App\Model;

class Banner
{
    // 表名
    protected $table = 'banner';

    public function addBnnner(string $image)
    {
        return app('db')->insert(
            'insert into ' . $this->banner . '(`image`) values(?)',
            [$image]
        );
    }
}
