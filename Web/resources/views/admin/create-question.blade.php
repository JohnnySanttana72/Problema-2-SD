@extends('adminlte::page')

@section('title', 'Cadastrar Dúvida')

@section('content_header')
    <h1><a href="{{route('admin.questions')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a> Cadastrar Dúvida</h1>
@stop

@section('content')
    <!-- form start -->
    <form method="POST" action="{{ route('admin.create_question')}}" enctype="multipart/form-data">
      @csrf
      <div class="card">
          <div class="card-header" style="border-bottom: none;">
              <h3 class="card-title">Dados da Dúvida</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
          </div>

          <!-- /.card-header -->
          <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="inputTitle">Título</label>
                          <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título da Dúvida" required>
                      </div>

                      <div class="form-group">
                          <label for="inputResponse">Resposta</label>
                          <textarea name="response" class="form-control" id="textResponse" cols="30" rows="10" placeholder="Resposta da Dúvida" required></textarea>
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
