(function() {

	'use strict';

	angular
		.module('authApp')
		.controller('AuthController', AuthController);


	function AuthController($auth, $state, $http, $rootScope) {

		var vm = this;

		vm.loginError = false;
		vm.loginErrorText;

		vm.login = function() {

			var credentials = {
				email: vm.email,
				password: vm.password
			}

			$auth.login(credentials).then(function() {

				
				return $http.get('api/authenticate/user').then(function(response) {

				
					var user = JSON.stringify(response.data.user);

					
					localStorage.setItem('user', user);

					
					$rootScope.authenticated = true;

					
					$rootScope.currentUser = response.data.user;

					$state.go('users');
				});

		
			}, function(error) {
				vm.loginError = true;
				vm.loginErrorText = error.data.error;
			});
		}
	}

})();