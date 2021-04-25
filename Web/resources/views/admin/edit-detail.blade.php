@extends('adminlte::page')

@section('title', 'Editar Detalhe')

@section('content_header')
    <h1><a href="{{route('admin.detail/',['property_id' => $detail->property_id])}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a> Editar Detalhe do Empreendimento: {{ $property->name }}</h1>
@stop

@section('content')
    <!-- form start -->
    <form method="POST" action="{{ route('admin.update_detail')}}" enctype="multipart/form-data">
      @csrf
      <div class="card">
          <div class="card-header" style="border-bottom: none;">
              <h3 class="card-title">Dados do Detalhe</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
          </div>

          <!-- /.card-header -->
          <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <input type="hidden" name="id" value="{{ $detail->id }}">
                        <input type="hidden" name="property_id" value="{{ $detail->property_id }}">
                        <label for="textDescription">Descrição</label>
                        <textarea name="description" class="form-control" id="textDescription" cols="30" rows="10" placeholder="Descrição do detalhe" required>{{ $detail->description }}</textarea>
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
    <script type="text/javascript">
        $(document).ready(function () {
          bsCustomFileInput.init();
        });
    </script>
@stop
