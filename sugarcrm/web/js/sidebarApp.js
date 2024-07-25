var app = angular.module('modulesList', []);
app.controller("ModuleController", function ($scope, $http, $timeout) {

    function httpGet(url, success_func, error_func) {
        $http.get(url, {}).success(success_func).error(error_func);
    }

    function httpPost(url, data, success_func, error_func) {
        if (typeof success_func === 'undefined') {
            success_func = function () {}
        }
        if (typeof error_func === 'undefined') {
            error_func = function () {}
        }
        $http.post(url, data, {}).success(success_func).error(error_func);
    }

    function httpPut(url, data, success_func, error_func) {
        $http.put(url, data, {}).success(success_func).error(error_func);
    }

    $scope.caseNumber = null;
    $scope.shownCase = null;
    $scope.requestPage = function(url) {
        window.parent.sugar.location.href = url;
    }

    $scope.findAndShowCase = function() {
        httpGet('/api/module/lt_case/get/' + $scope.caseNumber, function(res){
            $scope.caseNumber = null;
        }, function(){
            alert("Something went wrong while fetching case.");
        });
    }

    $scope.clearShownCase = function() {
        $scope.shownCase = null;
    }

});
function getCaseScope() {
    var appElement = document.querySelector('[ng-app=modulesList] [ng-controller=ModuleController]');
    return angular.element(appElement).scope();
}