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
        $pessoa = Pessoa::paginate(10);
        
        return $pessoa;
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

        $mensagens = $this->validarCampos($request);

        if (count($mensagens) == 0) {
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

    public function editarPessoa(Request $request) {
        $resposta = new Resposta();

        $mensagens = $this->validarCampos($request);

        if(count($mensagens) == 0) {
            $pessoa = Pessoa::find($request->codigoPessoa);
            if($pessoa != null) {
                $pessoa->nome = $request->nome;
                $pessoa->email = $request->email;
                $pessoa->categoria = $request->categoria;
                $pessoa->update(["nome" => $pessoa->nome, "email" => $pessoa->email, "categoria"  => $pessoa->categoria]);
    
                $resposta->status = 200;
                array_push($mensagens, "salvo com sucesso no banco");
            } else {
                $resposta->status = 404; 
                array_push($mensagens, "Pessoa não encontrada.");
            }

        } else {
            $resposta->status = 404;
        }

        $resposta->data = $mensagens;

        return $resposta;
        

        
    }

    public function deletarPessoa($codigoPessoa) {
        $resposta = new Resposta();

        $pessoa = Pessoa::find($codigoPessoa);
        if($pessoa != null) {
            $pessoa->delete();
            $resposta->status = 200;
            $resposta->data = "Pessoa removida com sucesso.";
        } else {
            $resposta->status = 404;
            $resposta->data = "Pessoa não encontrada.";
        }

        return $resposta;
        
    }

    private function validarCampos(Request $request) {
        $validator = Validator::make($request->all(), [
            'nome' => [new NomeValida()]
        ]);

        return $validator->errors()->all();
    }
}