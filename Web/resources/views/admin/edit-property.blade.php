@extends('adminlte::page')

@section('title', 'Editar Empreendimento')

@section('content_header')
    <h1><a href="{{route('admin.properties')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a> Editar Empreendimento: {{ $property->name }}</h1>
@stop

@section('content')
    <!-- form start -->
    <form method="POST" action="{{ route('admin.update_property')}}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header" style="border-bottom: none;">
                <h3 class="card-title">Dados do Empreendimento</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="id" value="{{ $property->id }}">
                        <div class="form-group">
                            <label for="inputEmail">Nome</label>
                            <input type="text" name="name" class="form-control" id="inputEmail" placeholder="Nome do Empreendimento" value="{{$property->name}}">
                        </div>

                        <div class="form-group">
                            <label for="inputFacebook">Preço</label>
                            <input type="text" name="price" class="form-control" id="inputPrice" placeholder="Valor do Empreendimento" value="{{ number_format($property->price, 2, '.', '')}}" onkeypress="$(this).mask('##00.00', {reverse: true})">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- <div class="form-group"> -->
                            
                          <!--   <x-dg-select2 id="myID" name="status" label="Status">
                                <x-dg-option value="lançamento">Lançamento</x-dg-option>

                                <x-dg-option value="pré-lançamento">Pré-Lançamento</x-dg-option>

                                <x-dg-option value="em construção">Em construção</x-dg-option>

                                <x-dg-option value="entregue">Entregue</x-dg-option>
                            </x-dg-select2> -->

                        <!-- </div> -->
                        <div class="form-group ">
                            <label for="myID">Status</label>
                            <select class="form-control select2-hidden-accessible" id="myID" name="status" style="width:100%" tabindex="-1" aria-hidden="true">
                                <option value="lançamento" {{ $property->status =='lançamento' ? 'selected' : '' }}>Lançamento</option>
                                <option value="pré-lançamento" {{ $property->status =='pré-lançamento' ? 'selected' : '' }}>Pré-Lançamento</option> 
                                <option value="em construção" {{ $property->status =='em construção' ? 'selected' : '' }}>Em construção</option> 
                                 <option value="entregue" {{ $property->status =='entregue' ? 'selected' : '' }}>Entregue</option>
                             </select>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="card-header" style="border-bottom: none;">
                <h3 class="card-title">Endereço da Empreendimento</h3>
            </div>
            
            <div class="card-body">
            <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputCep">Cep</label>
                            <input type="text" onkeypress="$(this).mask('00000-000')" name="cep" class="form-control" id="inputCep" placeholder="Cep da Empresa" value="{{$property->address->CEP}}">
                        </div>

                        <div class="form-group">
                            <label for="inputNeighborhood">Bairro</label>
                            <input type="text" name="neighborhood" class="form-control" id="inputNeighborhood" placeholder="Número" value="{{$property->address->neighborhood->name}}">
                        </div>

                        <div class="form-group">
                            <label for="inputComplement">Complemento</label>
                            <input type="text" name="complement" class="form-control" id="inputComplement" placeholder="Complemento ex: Av, Lot, Conj" value="{{$property->address->complement}}">
                        </div>

                        <div class="form-group">
                            <label for="inputState">Estado</label>
                            <input type="text" name="state" class="form-control" id="inputState" placeholder="Cidade" value="{{$property->address->neighborhood->city->state->name}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputStreet">Rua</label>
                            <input type="text" name="street" class="form-control" id="inputStreet" placeholder="Rua" value="{{$property->address->street}}">
                        </div>

                        <div class="form-group">
                            <label for="inputNumber">Número</label>
                            <input type="text" name="number" class="form-control" id="inputNumber" placeholder="Número" value="{{$property->address->number}}">
                        </div>

                        <div class="form-group">
                            <label for="inputReferencePoint">Ponto de Referência</label>
                            <input type="text" name="reference_point" class="form-control" id="inputReferencePoint" placeholder="Ponto de Referência" value="{{$property->reference_point}}">
                        </div>

                        <div class="form-group">
                            <label for="inputCity">Cidade</label>
                            <input type="text" name="city" class="form-control" id="inputCity" placeholder="Estado" value="{{$property->address->neighborhood->city->name}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-lg btn-primary">Alterar</button>
            </div>
        </div>

       
    </form>
@stop

<!-- @section('plugins.Select2', true) -->

@section('css')
    <link rel="stylesheet" href="{{asset('css/app_person.css')}}">
@stop

@section('js')
    <script type="text/javascript" src="{{asset('js/address.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
          bsCustomFileInput.init();
        });
    </script>
@stop
