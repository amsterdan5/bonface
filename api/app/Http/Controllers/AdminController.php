<?php

namespace App\Http\Controllers;

use App\Libs\StatusNo;
use App\Model\Admin;
use App\Model\Token;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

/**
 * 后台控制器
 */
class AdminController extends BackBaseController
{
    protected $request = '';

    public function __construct(Request $request)
    {
        $this->middleware('auth', ['except' => 'login']);
        $this->request = $request;
    }

    // 登录
    public function login()
    {
        $admin  = $this->request->post('admin', '');
        $passwd = $this->request->post('password', '');

        if (!$admin || !$passwd) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::NO_ACCOUNT_PASSWD));
        }

        $adminModel = new Admin();
        $admin_info = $adminModel->getAdminByName($admin);

        if (!$admin_info) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::ACCOUNT_PASSWD_FAILED));
        }

        if (!$this->checkPasswd($passwd, $admin_info->salt, $admin_info->password)) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::ACCOUNT_PASSWD_FAILED));
        }

        do {
            $token      = $this->getToken($admin);
            $tokenModel = new Token();
        } while (!$tokenModel->addToken($token));

        return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::LOGIN_SUCCESS), ['token' => $token]);
    }

    public function changePwd()
    {
        $admin            = $this->request->post('admin', '');
        $passwd           = $this->request->post('password', '');
        $confirm_password = $this->request->post('confirm_password', '');

        if (!$admin || !$passwd || !$confirm_password) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::NO_ACCOUNT_PASSWD));
        }

        if ($passwd !== $confirm_password) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::PASSWD_IS_DIFF));
        }

        $adminModel = new Admin();
        $salt       = $this->salt();
        $passwd     = $this->getPassSign($passwd, $salt);

        if ($adminModel->updatePasswd($admin, $passwd, $salt)) {
            return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::CHANGE_PASSWD_SUCCESS));
        }
        return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::CHANGE_PASSWD_FAILED));
    }

    public function addAdmin()
    {
        $admin  = $this->request->post('admin', '');
        $passwd = $this->request->post('password', '');

        if (!$admin || !$passwd) {
            return jsonAjax(StatusNo::NO_ACCOUNT_PASSWD, StatusNo::getStatusMsg(StatusNo::NO_ACCOUNT_PASSWD));
        }

        $adminModel = new Admin();
        $salt       = $this->salt();
        $passwd     = $this->getPassSign($passwd, $salt);

        $result = $adminModel->addAdmin($admin, $passwd, $salt);

        if ($result) {
            return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::ADD_ADMIN_SUCCESS));
        }
        return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::ADD_ADMIN_FAILED));

    }

    // 添加 banner 图
    public function addBanner()
    {
        $image = $this->request->post('image', '');
    }

    // 上传图片
    public function uploadImage()
    {
        $images = $this->request->file('image', []);
        $type   = $this->request->post('type', 0);

        if (empty($images)) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::NO_FILE));
        }

        if (!in_array($type, [1, 2])) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::NO_FILE_TYPE));
        }

        $upload_path = $type == 1 ? '/product' : '/banner';

        $file_path  = [];
        $tmp_images = $_FILES['image']['tmp_name'];

        foreach ($images as $key => $image) {
            $filename                       = md5(uniqid());
            $file_full_path                 = $this->storageImage($image, $upload_path . '/' . $filename, $tmp_images[$key]);
            $file_full_path && $file_path[] = $file_full_path;
        }

        if (empty($file_path)) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::FILE_UPLOAD_FAILED));
        }
        return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::FILE_UPLOAD_SUCCESS), ['images' => $file_path]);
    }

    /**
     * 保存图片
     * @return [type] [description]
     */
    private function storageImage(UploadedFile $image, string $path, string $tmp_content)
    {
        switch (strtolower($image->getClientOriginalExtension())) {
            case 'jpeg':
            case 'jpg':
                $path .= '.jpeg';
                break;
            case 'png':
                $path .= '.png';
                break;
            case 'bmp':
                $path .= '.bmp';
                break;
        }
        $full_path = IMAGE_PATH . $path;

        // if (Storage::putFile($path, $content)) {
        //     return $path;
        // }

        if (file_put_contents($full_path, file_get_contents($tmp_content))) {
            return $path;
        }
        return '';
    }

    /**
     * 生成登录token
     * @return string
     */
    private function getToken(string $admin)
    {
        return md5(uniqid($admin));
    }

    /**
     * 密码 salt
     * @param  int|integer $num [长度]
     * @return string
     */
    private function salt(int $num = 5)
    {
        $str    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $strlen = strlen($str) - 1;
        $salt   = '';
        for ($i = 0; $i < $num; $i++) {
            $salt .= $str[mt_rand(0, $strlen)];
        }
        return $salt;
    }

    /**
     * 获取加密串
     * @param  string $passwd [密码]
     * @param  string $salt   [salt]
     * @return string
     */
    protected function getPassSign(string $passwd, string $salt)
    {
        return md5(md5($passwd) . $salt);
    }

    /**
     * 比对密码
     * @param  string $passwd    [输入的密码]
     * @param  string $salt      [salt]
     * @param  string $db_passwd [数据库密码]
     * @return bool
     */
    private function checkPasswd(string $passwd, string $salt, string $db_passwd)
    {
        return md5(md5($passwd) . $salt) == $db_passwd;
    }
}
