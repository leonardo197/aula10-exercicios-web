<!DOCTYPE html>
<html lang="pt-PT">

    <!--Scripts para o tablesorter-->
    <script src="bootstrap/jquery.min.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!--Scripts para o tablesorter-->
    <link rel="stylesheet" href="tablesorter/css/theme.default.min.css">
    <link rel="stylesheet" href="tablesorter/css/theme.blue.css">
    <script type="text/javascript" src="tablesorter/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="/tablesorter/js/jquery.tablesorter.widgets.js"></script>
    <!--Angular-->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

    <script>
        function styleTableSorters() {
            $("table").tablesorter(
                    {
                        theme: 'blue',
                        widgets: ["zebra", "filter"]
                    }
            );
        }
        $(document).ready(function () {
            // O selector apanha a table porque não há mais table nenhuma
            //se quisessemos ter uma tabela sem este estilo teriamos de dar um ID
            //a tabela e mudar o selector para #idDadoPorNos
            styleTableSorters();
        });
    </script>

    <body>

        <div ng-app="minhaApp" ng-controller="meuControlador">
            <div class="col-md-6">
                 <table> 
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Idade</th>
                            <th>Escola</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="e in pessoas">
                            <td><input ng-model="e.nome"></td>
                            <td><input ng-model="e.idade"></td>
                            <td>
                                <select ng-model="e.escola">
                                    <option value=""></option>
                                    <option value="ipp">IPP</option>
                                    <option value="ist">IST</option>
                                </select>
                                <select ng-model="e.escolaIPP" ng-if="e.escola == 'ipp'">
                                    <option value=""></option>
                                    <option value="estg">ESTG</option>
                                    <option value="esecs">ESECS</option>
                                    <option value="ess">ESS</option>
                                    <option value="esae">ESAE</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                Nome Novo<input type="text" ng-model="nomeNovo"><br>
                Idade Nova<input type="text" ng-model="idadeNova"><br><!--USAMOS O NG-MODEL PARA ASSOCIAR O INPUT À NOVA VARIÁVEL-->
                <button ng-click="adicionar()">Adicionar Pessoa</button>
            </div>
            <div class="col-md-6">
                <p class="well well-sm">Variável pessoas impressa com a declaração <code ng-non-bindable>{{ pessoas | json}}</code></p>
                <pre>{{pessoas | json}}</pre>
            </div>


        </div>

        <script>
            var app = angular.module('minhaApp', []);
            app.controller('meuControlador', function ($scope) {
                $scope.nomeNovo = ""; //DUAS NOVAS VARIAVEIS AUXILIARES PARA ASSOCIAR AOS INPUTS
                $scope.idadeNova = "";
                $scope.pessoas = [
                    {
                        "nome": "joao",
                        "idade": 19,
                        "escola" : "ipp",
                        "escolaIPP" : "estg"
                    },
                    {
                        "nome": "joana",
                        "idade": 20,
                        "escola" : "ist"
                    }
                ];
                $scope.adicionar = function ()
                {
                    //CRIAR UM OBJETO JSON É TÃO SIMPLES COMO ISTO
                    var novaPessoa = {
                        "nome": $scope.nomeNovo,
                        "idade": $scope.idadeNova
                    }
                    // A VARIAVEL PESSOAS É UM ARRAY DE JSON LOGO PODEMOS FAZER PUSH E COLOCAMOS UMA NOVA PESSOA NO ARRAY
                    $scope.pessoas.push(novaPessoa);
                }
            });
        </script>
    </body>
</html>


