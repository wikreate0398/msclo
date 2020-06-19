@extends('layouts.admin')

@section('content') 
    <div class="row">
        @if(Auth::user()->type == 'admin')
            <div class="col-md-12">
                
                <button class="btn btn-primary btn-sm" onclick="$('.hide__container').slideToggle();" style="margin-bottom: 20px;">
                    <i class="fa fa-user" aria-hidden="true"></i> Добавить пользователя
                </button>

                <div class="widget hide__container" style="display: none; margin-bottom: 20px;">
                    <div class="widget-header">
                        <h4>Добавить пользователя</h4>
                    </div>
                    <div class="widget-content">
                        <!-- BEGIN FORM-->
                        <form action="/{{ config('admin.path') }}/profile/addNewUser" method="POST" class="form-horizontal ajax__submit">

                            {{ csrf_field() }}

                            <div class="form-body">
                                <div class="form-group">
                                    <label for="">Имя</label>
                                    <div>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">E-mail</label>
                                    <div>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label for="">Тип</label>
                                    <div>
                                        <select name="type" class="form-control">
                                            <option value="admin">Администратор</option>
                                            <option value="manager">Менеджер</option>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label for="">Новый пароль</label>
                                    <div>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Повторить пароль</label>
                                    <div>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                    </div>
                            </div>
                            <button type="submit" class="btn btn-success submit-btn">Добавить</button>
                        </form> 
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        @endif

    <div class="col-md-12" style="margin-bottom: 20px;">
        <div class="widget">
            <div class="widget-header">
                <h4>Персональные данные</h4>
            </div>
            <div class="widget-content-area">
                <!-- BEGIN FORM-->
                <form action="/{{ config('admin.path') }}/profile/edit" class="form-horizontal ajax__submit" method="POST">

                    {{ csrf_field() }}

                    <div class="form-body">
                         
                        <div class="form-group">
                            <labe>E-mail</labe>
                            <div>
                                <input type="email" class="form-control" id="disabledInput" value="{{ Auth::user()->email }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Имя</label>
                            <div>
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Новый пароль</label>
                            <div>
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Повторить пароль</label>
                            <div>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success submit-btn">Сохранить</button>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div> 

@if(count($users) && Auth::user()->type == 'admin')
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h4>Пользователи</h4>
                </div>
                <div class="widget-content">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <td></td>
                                <th style="width: 50px;">Имя</th>
                                <th>Логин/E-mail</th>
                                <th>Тип</th>
                                <th style="width: 50px;"><i class="fa fa-cogs" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td style="width: 1%;">
                                        <label class="switch s-success" style="margin: 0">
                                            <input type="checkbox"
                                                   {{ !empty($user['active']) ? 'checked' : '' }}
                                                   onchange="Ajax.buttonView(this, '{{ $table }}', '{{ $user["id"] }}', 'active')">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td style="white-space: nowrap;">{{ ucfirst($user['name']) }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user->type == 'admin' ? 'Администратор' : 'Менеджер' }}</td>
                                    <td style="white-space: nowrap;">
                                        <a style="margin-left: 5px;" href="/{{ $method }}/{{ $user['id'] }}/edit-user/" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-xs" data-toggle="modal" href="#deleteModal_{{ $table }}_{{ $user['id'] }}"><i class="far fa-trash"></i></a>
                                        <!-- Modal -->
                                            @include('admin.utils.delete', ['id' => $user['id'], 'table' => $table])
                                        <!-- Modal -->
                                        </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
@stop