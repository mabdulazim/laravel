@extends('layouts.app')
@section('title', __('messages.edit').' '.__('messages.menu.admin'))

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('messages.edit').' '.__('messages.menu.admin') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/admins/{{ request()->route('admin') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.name') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="name" value="{{ $user->name }}" placeholder="{{ __('messages.name') }}" />
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.email') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="email" value="{{ $user->email }}" placeholder="{{ __('messages.email') }}" />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.password') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="password" placeholder="{{ __('messages.password') }}" />
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.password_confirmation') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="password_confirmation" placeholder="{{ __('messages.password_confirmation') }}" />
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.permissions') }}</label>
                        <div class="col-9">
                            <table class="table table-striped m-table">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>{{ __('messages.create') }}</td>
                                        <td>{{ __('messages.read') }}</td>
                                        <td>{{ __('messages.edit') }}</td>
                                        <td>{{ __('messages.delete') }}</td>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td>{{ __('messages.menu.users') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_USERS" {{ in_array('CREATE_USERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_USERS" {{ in_array('READ_USERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_USERS" {{ in_array('UPDATE_USERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_USERS" {{ in_array('DELETE_USERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>

                                    <tr>
                                    <td>{{ __('messages.menu.admins') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_ADMINS" {{ in_array('CREATE_ADMINS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_ADMINS" {{ in_array('READ_ADMINS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_ADMINS" {{ in_array('UPDATE_ADMINS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_ADMINS" {{ in_array('DELETE_ADMINS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-primry" value="{{ __('messages.edit') }}" />
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        <!--end::Portlet-->
	</div>


</div>
@endsection