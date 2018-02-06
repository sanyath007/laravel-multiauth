(function() {
	'use strict';

	angular
		.module('authApp')
		.controller('UserController', UserController);

	function UserController($http) {
		var vm = this;

		vm.users;
		vm.error;

		vm.getUsers = function() {
			$http.get('api/users')
			.then(function(res) {
				console.log(res);
				vm.users = res.data;
			}, function(error) {
				vm.error = error;
			});
		}
	}
})();