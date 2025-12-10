<?php

class UserController {

    public function handle() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->testMessage();
        } else {
            Response::json(['error' => 'Method not allowed'], 405);
        }
    }

    private function testMessage() {
        Response::json([
            'status' => 'success',
            'message' => 'API is working'
        ]);
    }
}
