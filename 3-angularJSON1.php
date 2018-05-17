<!DOCTYPE html>
<html lang="pt-PT">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <body>

        <div ng-app="minhaApp" ng-controller="meuControlador">
            
            <p ng-repeat="e in pessoas">User {{e.nome}} com idade {{e.idade}}</p>
            
        </div>

        <script>
            var app = angular.module('minhaApp', []);
            app.controller('meuControlador', function ($scope) {
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
            });
        </script>
    </body>
</html>


