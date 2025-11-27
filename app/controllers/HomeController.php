<?php

class HomeController extends ApplicationController {

    public function indexAction() {

        $userModel = new User();
        $users = $userModel->getAll();

        if(empty($users)) {
            header("Location: ".WEB_ROOT."/users/register");
            exit;
        }

        header("Location: ".WEB_ROOT."/users/login");
        exit;
    }
}
?>