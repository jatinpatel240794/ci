var myapp = angular.module("crud_app",[]);

myapp.controller('listController',function($scope,$http,$compile){
  $http.get(baseURL+"index.php/crudmain/getEmployee")
  .then(function(res){
    $scope.employees=res.data;
  });

$scope.add_emp= function(){
  $http.get(baseURL+"index.php/crudmain/add_emp_view")
  .then(function(res){
    console.log(res);
    var div=document.getElementById('add_emp_div');
    var e1=angular.element(div);
    var htmlelment = angular.element(res.data);
    e1.append(htmlelment.innerHTML);
    $compile(e1)($scope);
  });
}

});