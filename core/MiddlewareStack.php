<?php
namespace core;

//Criar uma pilha de middlewares que serão executadas em ordem específica.
//Primeiro passo criar uma classe para gerenciar a pilha de middlewares, onde teremos um array de middlewares e métodos para adicionar e executar os middlewares.
//Todas as classes de middlewares devem implementar a interface MiddlewareInterface.
class MiddlewareStack{
    private $middlewares = [];

    public function add(MiddlewareInterface $middleware){
        $this->middlewares[] = $middleware;
    }

    public function process(){
        foreach($this->middlewares as $middleware){
            $middleware->handle();
        }
    }
}


interface MiddlewareInterface{
    public function handle();
}