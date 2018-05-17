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
            //styleTableSorters();
        });
    </script>
    
    <style>
        .ist 
        {
            background-color: lightcyan;
        }
        .ipp
        {
            background-color: khaki;
        }
        .modificado
        {
            border: 2px dashed orange;
        }
        
    </style>
        
        

    <body>

        <div id="minhaApp" ng-app="minhaApp" ng-controller="meuControlador">
            <div ng-show="msg" class="alert alert-success">
                {{msg}}
            </div>
            Deleted <input type="checkbox" ng-model="deleted">
            <div class="col-md-6">
                 <table> 
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Idade</th>
                            <th>Escola</th>
                            <th>Atualizado</th>
                            <th></th> <!--NOVO-->
                        </tr>
                    </thead>
                    <tbody>
                        <tr  ng-class="{modificado: e.modified, ist: e.escola == 1, ipp: e.escola == 2}" ng-repeat="e in pessoas">
                            <td><input ng-model="e.nome" ng-change="setModified(e)"></td>
                            <td><input ng-model="e.idade" ng-change="setModified(e)"></td>
                            <td>
                                <select ng-model="e.escola" ng-options="escola.id as escola.label 
                                    for escola in escolas track by escola.id"></select>
                                
                                <select ng-if="e.escola" ng-model="e.escolaSub" 
                                        ng-options="unidade.nome as unidade.nome 
                                            for unidade in listaSubEscolas(e.escola) track by unidade.nome"></select>
                                
                              
                                <!--
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
                                </select>-->
                            </td>
                            <td>
                                {{e.updateDate}}
                            </td>
                            <td>
                                <button type="button" ng-click="remover($index)" class="btn btn-sm btn-danger">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                                <button ng-show="e.modified" type="button" ng-click="cleanModified(e)" class="btn btn-sm btn-success">
                                    <span class="glyphicon glyphicon-save"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                Nome Novo<input type="text" ng-model="nomeNovo"><br>
                Idade Nova<input type="text" ng-model="idadeNova"><br><!--USAMOS O NG-MODEL PARA ASSOCIAR O INPUT À NOVA VARIÁVEL-->
                <button ng-click="adicionar()">Adicionar Pessoa</button>
            </div>
            <div class="col-md-12">
                <div ng-repeat="escola in escolas">
                    Escola : <input ng-model="escola.label" type="text"></br>
                </div>
                <p class="well well-sm">Variável pessoas impressa com a declaração <code ng-non-bindable>{{ pessoas | json}}</code></p>
                <pre>{{pessoas | json}}</pre>
                <h2>Escolas</h2>
                <pre>{{escolas | json}}</pre>
                
                <h2>Deleted</h2>
                <pre>{{deleted | json}}</pre>
            </div>


        </div>

        <script>
            $.postJSON = function(url, data, func)
            {
                $.post(url, data, func, 'json');
            };
            var app = angular.module('minhaApp', []);
            
            function limpaMsg()
            {
                $scope = angular.element($("#minhaApp")).scope();
                $scope.limpaMsg();
                $scope.$apply();
            }
            
            app.controller('meuControlador', function ($scope) {
                $scope.nomeNovo = ""; //DUAS NOVAS VARIAVEIS AUXILIARES PARA ASSOCIAR AOS INPUTS
                $scope.idadeNova = "";
                $scope.msg = "";
                $scope.limpaMsg = function(){
                    $scope.msg = "";   
                }
                $scope.setModified = function(obj)
                {
                    obj.modified = true;
                }
                $scope.cleanModified = function(obj,$index)
                {
                    
                    $.postJSON("salvarEstudante.php",
                            {
                                "id" : obj.id,
                                "idade" : obj.idade,
                                "nome" : obj.nome,
                                "escola" : obj.escola,
                            },
                            function(json)
                            {
                                //obj.updateDate = json.updateDate;
                                $scope.pessoas.splice($index,1);
                                $scope.pessoas.push(json);
                                
                                $scope.msg = "Atualizado com sucesso";
                                delete obj.modified;
                                $scope.$apply();
                                setTimeout("limpaMsg()",4000);
                            }        
                    );
                }
                $scope.escolas = [
                    {
                        'id': 1,
                        'label': 'ist',
                        'unidades' : [
                            {
                                'nome' : 'DNL'
                            },
                            {
                                'nome' : 'DEC'
                            },
                            {
                                'nome' : 'DEQ'
                            },
                            {
                                'nome' : 'BIO'
                            }
                        ]
                    }, 
                    {
                        'id': 2,
                        'label': 'ipp',
                        'unidades' : [
                            {
                                'nome' : 'ESTG'
                            },
                            {
                                'nome' : 'ESAE'
                            },
                            {
                                'nome' : 'ESAE'
                            },
                            {
                                'nome' : 'ESS'
                            }
                        ]
                    }
                ];
                $scope.pessoas = [
                    {
                        "nome": "joao",
                        "idade": 19
                    },
                    {
                        "nome": "joana",
                        "idade": 20
                    }
                ];
                $scope.listaSubEscolas = function(id)
                {
                    var i;
                    for(i in $scope.escolas)
                    {
                        if($scope.escolas[i].id == id)
                        {
                            return $scope.escolas[i].unidades;
                        }
                    }
                    
                    return [];
                };
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
                $scope.remover = function(index)
                {
                    $scope.pessoas.splice(index,1);
                }
            });
        </script>
    </body>
</html>


