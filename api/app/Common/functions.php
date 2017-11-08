<?php

/**
 * ajax返回结构体
 */
if (!function_exists('jsonAjax')) {
    function jsonAjax(int $code = 0, string $msg = '', array $data = [])
    {
        $data = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ];
        return response()->json($data);
    }
}

/**
 * 请求
 */
if (!function_exists('request')) {
    function request()
    {
        return new \Illuminate\Http\Request;
    }
}

/**
 * 发送邮件
 */
if (!function_exists('send_mail')) {
    function send_mail($to, $subject, $body, array $params = null, $contentType = 'text/html')
    {
        if (!class_exists('\Swift_Mailer')) {
            return;
        }

        if (empty($to) ||
            empty($subject) ||
            empty($body)
        ) {
            return false;
        }

        $config = config('mail.smtp');

        // 创建 transport
        $transport = \Swift_SmtpTransport::newInstance($config['host'], $config['port']);

        // Set the auth
        if (isset($params['auth'])) {
            $transport->setUsername($params['auth']['username'])
                ->setPassword($params['auth']['password']);
        } else {
            $transport->setUsername($config['username'])
                ->setPassword($config['password']);
        }

        // 创建邮件消息
        $message = \Swift_Message::newInstance($subject, $body, $contentType);

        // 发件人
        if (isset($params['from'])) {
            $message->setFrom($params['from']);
        } else {
            $message->setFrom($config['from']['mail'], $config['from']['name']);
        }

        // 收件人
        if (isset($params['to'])) {
            $message->setTo($params['to']);
        } else {
            $message->setTo($to);
        }

        // 抄送
        if (isset($params['cc'])) {
            $message->setCc($params['cc']);
        }

        // 暗送
        if (isset($params['bcc'])) {
            $message->setBcc($params['bcc']);
        }

        // 回复
        if (isset($params['reply-to'])) {
            $message->setReplyTo($params['reply-to']);
        }

        // 添加附件
        if (isset($params['files'])) {
            $files = is_array($params['files']) ? $params['files'] : [$params['files']];
            foreach ($files as $file) {
                if (is_file($file)) {
                    $message->attach(\Swift_Attachment::fromPath($file));
                }
            }
        }

        // 发送邮件
        return \Swift_Mailer::newInstance($transport)->send($message);
    }
}
