<!DOCTYPE html>
<html lang="pt-PT">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <body>

        <div ng-app="minhaApp" ng-controller="meuControlador">
            Nome: <input type="text" ng-model="nome"><br>
            Idade: <input type="text" ng-model="idade"><br>
            <br>
            Apresentação: Chamo-me {{nome}} e tenho {{idade}} anos
            <br>
            <button ng-click="colocaNomeTeste()">Coloca nome de teste</button>
        </div>

        <script>
            var app = angular.module('minhaApp', []);
            app.controller('meuControlador', function ($scope) {
                $scope.nome = "";
                $scope.idade = "";
                $scope.colocaNomeTeste = function () {
                    $scope.nome = "Joao";
                    $scope.idade = 19;
                }
            });
        </script>
    </body>
</html>


