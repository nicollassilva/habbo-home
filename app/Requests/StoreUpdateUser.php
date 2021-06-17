<?php

namespace App\Requests;

abstract class StoreUpdateUser
{
    public static function validate($filters)
    {
        return \GUMP::is_valid($filters, [
            'username' => 'required|min_len,2|max_len,30|regex,/^([À-üA-Za-z\.:_\-0-9\!\@]+)$/',
            'password' => 'required|min_len,6|max_len,255',
            'confirm-password' => 'required|equalsfield,password'
        ], [
            'username' => [
                'required' => 'Preencha todos os campos',
                'min_len' => 'Digite um usuário válido',
                'max_len' => 'O nome de usuário precisa ter menos de 30 caracteres',
                'regex' => 'Existem caracteres inválidos no nome'
            ],
            'password' => [
                'required' => 'Preencha todos os campos',
                'min_len' => 'Digite uma senha válida',
                'max_len' => 'O tamanho máximo de uma senha é 255 caracteres',
            ],
            'confirm-password' => [
                'required' => 'Preencha todos os campos',
                'equalsfield' => 'As duas senhas não são iguais'
            ]
        ]);
    }
}