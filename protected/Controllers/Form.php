<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Message;

class Form extends Controller
{
    public function index()
    {
        return $this->view->display(__DIR__ . '/../../templates/index.php');
    }

    public function add()
    {
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['text']) ) {
           header('Location: /');
           die;
        }
        $message = new Message();
        $message->name  = htmlspecialchars($_POST['name']);
        $message->email = htmlspecialchars($_POST['email']);
        $message->text  = htmlspecialchars($_POST['text']);
        $message->send_at = date('Y-m-d h:i:s');
        $message->insert();
    }
}