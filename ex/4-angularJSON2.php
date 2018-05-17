<!DOCTYPE html>
<html lang="pt-PT">
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    
    <body>

        <div ng-app="minhaApp" ng-controller="meuControlador">
            
           <p ng-repeat="e in pessoas">User {{e.nome}} com idade {{e.idade}}</p>
                
            Nome Novo<input type="text" ng-model="nomeNovo"><br>
            Idade Nova<input type="text" ng-model="idadeNova"><br><!--USAMOS O NG-MODEL PARA ASSOCIAR O INPUT À NOVA VARIÁVEL-->
            <button ng-click="adicionar()">Adicionar Pessoa</button>
        </div>

        <script>
            var app = angular.module('minhaApp', []);
            app.controller('meuControlador', function ($scope) {
                $scope.nomeNovo = ""; //DUAS NOVAS VARIAVEIS AUXILIARES PARA ASSOCIAR AOS INPUTS
                $scope.idadeNova = "";
                $scope.pessoas = [
                    {
                        "nome" : "joao",
                        "idade" : 19
                    },
                    {
                        "nome" : "joana",
                        "idade" : 20
                    }
                ];
                $scope.adicionar = function()
                {
                    //CRIAR UM OBJETO JSON É TÃO SIMPLES COMO ISTO
                    var novaPessoa = {
                        "nome" : $scope.nomeNovo,
                        "idade" : $scope.idadeNova
                    }
                    // A VARIAVEL PESSOAS É UM ARRAY DE JSON LOGO PODEMOS FAZER PUSH E COLOCAMOS UMA NOVA PESSOA NO ARRAY
                    $scope.pessoas.push(novaPessoa); 
                  }
            });
        </script>
    </body>
</html>


