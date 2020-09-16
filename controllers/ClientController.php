<?php


namespace controllers;


use models\Client;

class ClientController
{

    public function get()
    {
        if (!empty($_GET['email'])) {
            $email = $_GET['email'];
            $client = Client::getByEmail($email);
            if (!empty($client)) {
                echo var_export($client, true);
            } else {
                echo 'Пользователь не найден';
            }
        }
    }

    public function add()
    {
        if (!empty($_GET['name']) && !empty($_GET['email'])) {
            $name = $_GET['name'];
            $email = $_GET['email'];

            $client = new Client();
            $client->add($name, $email);
        }
    }

    public function delete()
    {
        if (!empty($_GET['email'])) {
            $email = $_GET['email'];
            $client = Client::getByEmail($email);
            if (!empty($client)) {
                $client->delete();
                echo 'Пользователь успешно удален';
            } else {
                echo 'Пользователь не найден';
            }
        }
    }
}