@extends('adminlte::page')

@section('title', 'Mudar Senha')

@section('content')
	<div class="row">
      <div class="col-12">
        <form method="POST" action="{{ route('admin.settings.change_password') }}" enctype="multipart/form-data">
          @csrf
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Mudar Senha</h3>
            </div>
              
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                      type="email" 
                      name="email" 
                      class="form-control" 
                      id="email"
                      placeholder="Email"
                      value="{{ $admin->email }}"
                      disabled
                    >
                  </div>

                  <div class="form-group">
                    <label for="inputCurrentPassword">Senha Atual</label>
                    <input 
                      type="password" 
                      name="current_password" 
                      class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}" 
                      id="inputCurrentPassword" 
                      placeholder="Senha Atual"
                      minlength="8"
                    >
                    @if($errors->has('current_password'))
                      <div class="invalid-feedback">
                        {{ $errors->first('current_password') }}
                      </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="inputPassword">Nova Senha</label>
                    <input 
                      type="password" 
                      name="password" 
                      class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                      id="inputPassword" 
                      placeholder="Nova Senha"
                      minlength="8"
                    >
                    @if($errors->has('password'))
                      <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                      </div>
                    @endif
                  </div>
                </div>

                <div class="col-md-6 align-self-end">
                  <div class="form-group">
                    <label for="inputConfirmPassword">Confirmar Senha</label>
                    <input 
                      type="password" 
                      name="confirm_password" 
                      class="form-control {{ $errors->has('confirm_password') ? 'is-invalid' : '' }}" 
                      id="inputConfirmPassword" 
                      placeholder="Confirmar Senha"
                      minlength="8"
                    >
                    @if($errors->has('confirm_password'))
                      <div class="invalid-feedback">
                        {{ $errors->first('confirm_password') }}
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-lg btn-primary">Salvar</button>
            </div>
          </div>
        </form>
			</div>
  </div>

  @if (Session::has('error-message'))
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>Erro!</strong> {{ Session::get('error-message') }}
    </div>
  @endif
  
  @if (Session::has('success-message'))
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>Sucesso!</strong> {{ Session::get('success-message') }}
    </div>
  @endif


@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/app_person.css')}}">
@stop