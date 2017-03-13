'use strict';

(function (angular) {
	'use strict';

	var app = angular.module('app', ['jsonFormatter']);

	app.service('FipeService', ['$http', function ($http) {
		var url = 'https://fipe-parallelum.rhcloud.com/api/v1';

		return {
			getMarcas: function getMarcas() {
				return $http.get(url + '/carros/marcas');
			},
			getModelos: function getModelos() {
				return $http.get(url + '/carros/marcas/59/modelos');
			},
			getAnos: function getAnos() {
				return $http.get(url + '/carros/marcas/59/modelos/5940/anos');
			},
			getVeiculo: function getVeiculo() {
				return $http.get(url + '/carros/marcas/59/modelos/5940/anos/2014-3');
			}
		};
	}]);

	app.controller('Controller', ['FipeService', function (FipeService) {
		var _this = this;

		this.marcas = [];
		this.modelos = [];
		this.anos = [];
		this.veiculo = {};

		FipeService.getMarcas().then(function (results) {
			_this.marcas = results.data.slice(0, 5);
		});

		FipeService.getModelos().then(function (results) {
			var modelos = results.data.modelos;
			var anos = results.data.anos;
			var data = {
				anos: anos.slice(0, 5),
				modelos: modelos.slice(0, 5)
			};

			_this.modelos = data;
		});

		FipeService.getAnos().then(function (results) {
			_this.anos = results.data;
		});

		FipeService.getVeiculo().then(function (results) {
			_this.veiculo = results.data;
		});
	}]);
})(window.angular);