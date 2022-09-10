<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Facades\PessoasFacade;

// Aqui vai ter tudo que for controlar o Pessoa, tipo, pra não colocar tudo dentro de um só controller
class PessoasController extends Controller
{

    private $pessoasFacade;
    
    public function __construct() {
        $this->pessoasFacade = new PessoasFacade();
    }

    // Obter pessoas (paginaçao futura?)
    public function obterPessoas() {
      $resposta = $this->pessoasFacade->obterPessoas();

      return response($resposta->data, $resposta->status);
    }

    // Obter pessoa via código
    public function obterPessoa($codigoPessoa) {
      $resposta = $this->pessoasFacade->obterPessoa($codigoPessoa);

      return response($resposta->data, $resposta->status);
    }

    // Cadastrar nova pessoa
    public function cadastrarPessoa(Request $request) {
        $resposta = $this->pessoasFacade->cadastrarPessoa($request);

        return response()->json($resposta->data, $resposta->status);
    }
    
}
