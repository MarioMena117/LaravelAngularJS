import './bootstrap'; 
import 'angular';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 var app = angular.module('LaravelCRUD', []
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);

app.controller('TareaController', ['$scope', '$http', function ($scope, $http) {

	$scope.tareas = [];

    // List de Tareas .GET
    $scope.loadTareas = function () {
        $http.get('/tarea')
            .then(function success(e) {
                $scope.tareas = e.data.tareas;
            });
    };
    $scope.loadTareas();


    $scope.errors = [];

    $scope.tarea = {
        nombre: '',
        descripcion: ''
    };
    $scope.initTarea = function () {
        $scope.resetForm();
        $("#añadir_nueva_tarea").modal('show');
    };

    // Añadir tareas .POST
    $scope.addTarea = function () {
        $http.post('/tarea', {
            nombre: $scope.tarea.nombre,
            descripcion: $scope.tarea.descripcion
        }).then(function success(e) {
            $scope.resetForm();
            $scope.tareas.push(e.data.tareas);
            $("#añadir_nueva_tarea").modal('hide');

        }, function error(error) {
            $scope.recordErrors(error);
        });
    };

    $scope.recordErrors = function (error) {
        $scope.errors = [];
        if (error.data.errors.nombre) {
            $scope.errors.push(error.data.errors.nombre[0]);
        }

        if (error.data.errors.descripcion) {
            $scope.errors.push(error.data.errors.descripcion[0]);
        }
    };

    $scope.resetForm = function () {
        $scope.tarea.nombre = '';
        $scope.tarea.descripcion = '';
        $scope.errors = [];
    };

    $scope.edit_tarea = {};
    // Iniciar actualizar
    $scope.initEdit = function (index) {
        $scope.errors = [];
        $scope.edit_tarea = $scope.tareas[index];
        $("#edit_tarea").modal('show');
    };

    // Actualizar tareas 
    $scope.updateTarea = function () {
        $http.patch('/tarea/' + $scope.edit_tarea.id, {
            nombre: $scope.edit_tarea.nombre,
            descripcion: $scope.edit_tarea.descripcion
        }).then(function success(e) {
            $scope.errors = [];
            $("#edit_tarea").modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };


     $scope.deleteTarea = function (index) {

        var conf = confirm("¿Estas seguro que quieres eliminar esta tarea?");

        if (conf === true) {
            $http.delete('/tarea/' + $scope.tareas[index].id)
                .then(function success(e) {
                    $scope.tareas.splice(index, 1);
                });
        }
    };

}]);