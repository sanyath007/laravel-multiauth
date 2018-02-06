(function() {
	'use strict';

	angular
		.module('authApp')
		.controller('AuthController', AuthController);

	function AuthController($auth, $state) {
		var vm = this;
		vm.login = function() {
			var credentials = {
				email: vm.email,
				password: vm.password
			}

			$auth.login(credentials)
			.then(function(res) {
				//if login is successful, redirect to the users state
				$state.go('users', {});
			});
		}
	}
})();