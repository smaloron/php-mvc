<?php

namespace Framework;

use Framework\View;

class HttpResponse {

    public function sendError($message = ''){

        $data = ['message' => $message];
        $view = new View('errors/error');
        $view->render($data);
    }
} 