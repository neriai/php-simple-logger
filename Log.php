<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\NativeMailerHandler;
use Monolog\Formatter\LineFormatter;

/**
 * ログの基底クラスです
 */
class Log
{

    /**
     * @var object container for the Monolog instance
     */
    private static $logger;

    /**
     * @var array $levels ログレベル情報
     */
    private static $levels = array(
        'DEBUG' => Logger::DEBUG,
        'INFO' => Logger::INFO,
        'NOTICE' => Logger::NOTICE,
        'WARNING' => Logger::WARNING,
        'ERROR' => Logger::ERROR,
        'CRITICAL' => Logger::CRITICAL,
        'ALERT' => Logger::ALERT,
        'EMERGENCY' => Logger::EMERGENCY,
    );

    /**
     * セットアップをします
     *
     * @return void
     */
    public static function setup($config)
    {
        self::$logger = new Logger('gnlp');

        $format = "%datetime% [%level_name%] %message%\n";
        $formatter = new LineFormatter($format);

        $file = $config['path'] . date('Ymd', strtotime('now')) . '.log';

        $stream = new StreamHandler($file, $config['level']);
        $stream->setFormatter($formatter);

        self::$logger->pushHandler($stream);
    }

    /**
     * ログ情報を出力します
     *
     * @param mixed $content 出力内容
     * @param string $level ログレベル
     */
    public static function output($content, $level = 'INFO')
    {
        if (is_null(self::$logger)) {
            return;
        }

        self::$logger->log(self::$levels[$level], $content);
    }
}
