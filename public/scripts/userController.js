(function() {

	'use strict';

	angular
		.module('authApp')
		.controller('UserController', UserController);

	function UserController($http, $auth, $rootScope, $state) {

		var vm = this;

		vm.users;
		vm.error;

		vm.getUsers = function() {

			
			$http.get('api/authenticate').success(function(users) {
				vm.users = users;
			}).error(function(error) {
				vm.error = error;
			});
		}

	
		vm.logout = function() {

			$auth.logout().then(function() {

				
				localStorage.removeItem('user');

				
				$rootScope.authenticated = false;

			
				$rootScope.currentUser = null;

				
				$state.go('auth');
			});
		}
	}
	
})();