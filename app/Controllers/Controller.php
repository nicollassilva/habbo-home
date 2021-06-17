<?php

namespace App\Controllers;

class Controller {
    private $responseType = ['warning', 'error', 'success', 'info', 'question'];

    private $responseCode = [
        'success' => 200,
        'info' => 200,
        'question' => 202,
        'warning' => 202,
        'error' => 400
    ];

    private $responseTitle = [
        'success' => 'Yeah',
        'info' => 'Hey',
        'question' => 'Hmm',
        'warning' => 'Oops',
        'error' => 'Stop'
    ];

    private $currentResponseType;

    public function response(String $responseMessage, String $responseType = 'error', ?String $redirect = null, $respondeData = [])
    {
        if(!in_array($responseType, $this->responseType, true)) {
            $responseType = 'error';
        }

        $this->currentResponseType = $responseType;

        return $this->sendResponse([
            'status' => $responseType,
            'statusCode' => $this->getResponseCode(),
            'message' => $responseMessage,
            'title' => $this->getResponseTitle(),
            'redirect' => $redirect,
            'data' => $respondeData
        ]);
    }

    public function json(String $responseType = 'error', $respondeData, ?String $redirect = null)
    {
        return $this
            ->setHeader('application/json')
            ->response('', $responseType, $redirect, $respondeData);
    }

    public function setHeader(String $header): Controller
    {
        header("Content-Type: {$header}");

        return $this;
    }

    private function sendResponse(Array $response)
    {
        echo json_encode($response);
    }

    private function getResponseCode()
    {
        return $this->responseCode[$this->currentResponseType];
    }

    private function getResponseTitle() {
        return $this->responseTitle[$this->currentResponseType];
    }
}