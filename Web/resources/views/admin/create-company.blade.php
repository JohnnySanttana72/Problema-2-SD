@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Configurar Site</h1>
@stop

@section('content')
    <!-- form start -->
    <form method="POST" action="{{ route('admin.create_elo')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header" style="border-bottom: none;">
                <h3 class="card-title">Dados da Empresa</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{old('email')}}">
                        </div>

                        <div class="form-group">
                            <label for="inputPhone">Telefone</label>
                            <input type="text" onkeypress="$(this).mask('(00) 0000-0000')" name="phone" class="form-control" id="inputPhone" placeholder=" Telefone" value="{{old('phone')}}">
                        </div>

                        <div class="form-group">
                            <label for="inputWhatsapp">Whatsapp</label>
                            <input type="text" onkeypress="$(this).mask('(00) 00000-0000')" name="whatsapp" class="form-control" id="inputWhatsapp" placeholder="Whatsapp" value="{{old('whatsapp')}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputFacebook">Facebook</label>
                            <input type="text" name="facebook" class="form-control" id="inputFacebook" placeholder="Colocar Link do Facebook" value="{{old('facebook')}}">
                        </div>

                        <div class="form-group">
                            <label for="inputInstagram">Instagram</label>
                            <input type="text" name="instagram" class="form-control" id="inputInstagram" placeholder="Colocar link do Instagram" value="{{old('instagram')}}">
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="card-header" style="border-bottom: none;">
                <h3 class="card-title">Endereço da Empresa</h3>
            </div>
            
            <div class="card-body">
            <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputCep">Cep</label>
                            <input type="text" onkeypress="$(this).mask('00000-000')" name="cep" class="form-control" id="inputCep" placeholder="Cep da Empresa" value="{{old('cep')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="inputNeighborhood">Bairro</label>
                            <input type="text" name="neighborhood" class="form-control" id="inputNeighborhood" placeholder="Número" value="{{old('neighborhood')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="inputComplement">Complemento</label>
                            <input type="text" name="complement" class="form-control" id="inputComplement" placeholder="Complemento ex: Av, Lot, Conj" value="{{old('complement')}}">
                        </div>

                        <div class="form-group">
                            <label for="inputState">Estado</label>
                            <input type="text" name="state" class="form-control" id="inputState" placeholder="Cidade" value="{{old('state')}}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputStreet">Rua</label>
                            <input type="text" name="street" class="form-control" id="inputStreet" placeholder="Rua" value="{{old('street')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="inputNumber">Número</label>
                            <input type="text" name="number" class="form-control" id="inputNumber" placeholder="Número" value="{{old('number')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="inputCity">Cidade</label>
                            <input type="text" name="city" class="form-control" id="inputCity" placeholder="Estado" value="{{old('city')}}" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-lg btn-primary">Cadastrar</button>
            </div>
        </div>

       
    </form>
@stop

@section('plugins.Select2', true)

@section('css')
    <link rel="stylesheet" href="{{asset('css/app_person.css')}}">
@stop

@section('js')
    <script type="text/javascript" src="{{asset('js/address.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}" type="text/javascript"></script>
@stop
