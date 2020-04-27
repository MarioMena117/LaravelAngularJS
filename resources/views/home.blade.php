@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="TareaController">



        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button class="btn btn-primary btn-xs pull-right" ng-click="initTarea()">Añadir Tarea</button>
                        Lista De Tareas
                    </div>



                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table class="table table-bordered table-striped" ng-if="tareas.length > 0">
                            <tr>
                                <th>No.</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Opciones</th>
                            </tr>
                            <tr ng-repeat="(index, tarea) in tareas">
                                <td>
                                    @{{ index + 1 }}
                                </td>
                                <td>@{{ tarea.nombre }}</td>
                                <td>@{{ tarea.descripcion }}</td>
                                <td>
                                    <button class="btn btn-success btn-xs" ng-click="initEdit(index)">Editar</button>
                                    <button class="btn btn-danger btn-xs" ng-click="deleteTarea(index)" >Eliminar</button>
                                </td>
                            </tr>
                        </table>


                        <div class="modal fade" tabindex="-1" role="dialog" id="añadir_nueva_tarea">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Añadir Tarea</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" ng-if="errors.length > 0">
                            <ul>
                                <li ng-repeat="error in errors">@{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" ng-model="tarea.nombre">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea name="descripcion" rows="5" class="form-control"
                                      ng-model="tarea.descripcion"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" ng-click="addTarea()">Aceptar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="edit_tarea">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Actualizar Tarea</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" ng-if="errors.length > 0">
                            <ul>
                                <li ng-repeat="error in errors">@{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" ng-model="edit_tarea.nombre">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea name="descripcion" rows="5" class="form-control"
                                      ng-model="edit_tarea.descripcion"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" ng-click="updateTarea()">Aceptar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
