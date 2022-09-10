<?php

namespace App\Http\Facades;

use Illuminate\Http\Request;
use Validator;

use App\Models\Pessoa;
use App\Models\Resposta;

use App\Rules\NomeValida;

class PessoasFacade 
{

    public function obterPessoas() {
        $resposta = new Resposta();
    }

    public function obterPessoa($codigoPessoa) {
        $resposta = new Resposta();

        $pessoa = Pessoa::find($codigoPessoa);
        if($pessoa != null) {
            $resposta->status = 200;
            $resposta->data = $pessoa->toJson();
        } else {
            $resposta->status = 404;
            $resposta->data = "Pessoa não encontrada.";
        }

        return $resposta;
    }

    public function cadastrarPessoa(Request $request) {
        $resposta = new Resposta();

        $validator = Validator::make($request->all(), [
            'nome' => [new NomeValida()]
        ]);

        $mensagens = $validator->errors()->all();

        if (!$validator->fails()) {
            $pessoa = new Pessoa();
            $pessoa->nome = $request->nome;
            $pessoa->email = $request->email;
            $pessoa->categoria = $request->categoria;

            $pessoa->save();

            $resposta->status = 201;
            array_push($mensagens, "Pessoa cadastrada com sucesso!");
        } else {
            $resposta->status = 404;
        }

        $resposta->data = $mensagens;

        return $resposta;
    }

}