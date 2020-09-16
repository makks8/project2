<?php

namespace models;

use core\ActiveRecord;
use core\HttpClient;
use core\Model;
use core\Util;
use Exception;

/**
 * Class Client
 * @property string $portal
 */
class Client extends Model
{
    public $name;
    public $email;
    public $register_date;

    public static function tableName()
    {
        return 'client';
    }

    public function add($name, $email)
    {
        $registerDate = date('d.m.y');
        $client = new Client();
        $client->email = $email;
        $client->name = $name;
        $client->register_date = $registerDate;
        $isSaved = $client->save();

        if (!$isSaved) {
            echo "Пользователь с таким email уже существует";
        } else {
            echo "Пользователь успешно добавлен";
        }
    }

    public static function getByEmail($email)
    {
        return self::find()->where(['email' => $email])->one();
    }
}