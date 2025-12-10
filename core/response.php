<?php

class Response {
    public static function json($data, int $status = 200): void {
        http_response_code($status);
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Origin: *");
        echo json_encode($data);
        exit;
    }
}
