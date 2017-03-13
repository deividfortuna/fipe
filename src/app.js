(function(angular){
	'use strict';

	const app = angular.module('app', ['jsonFormatter']);

	app.service('FipeService', ['$http', function($http){
		const url = 'https://fipe-parallelum.rhcloud.com/api/v1';

		return {
			getMarcas: () => {
				return $http.get(url + '/carros/marcas');
			},
			getModelos: () => {
				return $http.get(url + '/carros/marcas/59/modelos');
			},
			getAnos: () => {
				return $http.get(url + '/carros/marcas/59/modelos/5940/anos');
			},
			getVeiculo: () => {
				return $http.get(url + '/carros/marcas/59/modelos/5940/anos/2014-3');	
			}
		}
	}]);

	app.controller('Controller', ['FipeService', function(FipeService){
		this.marcas = [];
		this.modelos = [];
		this.anos =[];
		this.veiculo = {};

		FipeService.getMarcas().then(results => {
			this.marcas = results.data.slice(0, 5);
		});

		FipeService.getModelos().then(results => {
			const modelos = results.data.modelos;
			const anos = results.data.anos;
			const data = {
				anos: anos.slice(0, 5),
				modelos: modelos.slice(0, 5)
			}

			this.modelos = data;
		});

		FipeService.getAnos().then(results => {
			this.anos = results.data;
		});

		FipeService.getVeiculo().then(results => {
			this.veiculo = results.data;
		});

	}]);
})(window.angular);
