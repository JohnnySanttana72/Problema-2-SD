@extends('adminlte::page')

@section('title', 'Editar Etapa')

@section('content_header')
    <h1><a href="{{route('admin.stage_property',['id' => $property_id])}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a> Editar Etapa</h1>
@stop

@section('content')
    @if (Session::has('error-message'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Erro!</strong> {{ Session::get('error-message') }}
        </div>
    @endif

    <!-- form start -->
    <form method="POST" action="{{ url('/admin/update_month')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $month_edit->id }}">
        <div class="card">
            <div class="card-header" style="border-bottom: none;">
                <h3 class="card-title">Dados da Etapa</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <x-dg-select2 id="monthId" name="month" label="Mês">
                                @php $date = Carbon\Carbon::now(); @endphp
                                @foreach(range(1,12) as $month)
                                    @if((utf8_encode(ucfirst($date->copy()->addMonth($month)->formatLocalized('%b')))) == $month_edit->title)
                                         <x-dg-option value="{{ (utf8_encode(ucfirst($date->copy()->addMonth($month)->formatLocalized('%b')))) }}" selected>{{ (utf8_encode(ucfirst($date->copy()->addMonth($month)->formatLocalized('%b')))) }}</x-dg-option>
                                    @else
                                        <x-dg-option value="{{ (utf8_encode(ucfirst($date->copy()->addMonth($month)->formatLocalized('%b')))) }}" >{{ (utf8_encode(ucfirst($date->copy()->addMonth($month)->formatLocalized('%b')))) }}</x-dg-option>
                                    @endif
                                 @endforeach
                            </x-dg-select2>
                        </div>

                        <div class="form-group">
                            <label for="inputFacebook">Descrição</label>
                            <input type="text" name="description" class="form-control" id="inputDescription" placeholder="Descrição da Etapa" value="{{$month_edit->description}}">
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <x-dg-select2 id="yearId" name="year" label="Ano">
                                @for ($year = date('Y'); $year > date('Y') - 100; $year--)
                                    @if($month_edit->year == $year)
                                        <x-dg-option value="{{$year}}" selected>{{$year}}</x-dg-option>
                                    @else
                                        <x-dg-option value="{{$year}}" >{{$year}}</x-dg-option>
                                    @endif
                                @endfor
                            </x-dg-select2>
                        </div>

                        <div class="form-group">
                            <label for="inputFacebook">Porcentagem</label>
                            <input type="text" name="percentage" class="form-control" id="inputPrice" placeholder="Valor do Empreendimento" onkeypress="$(this).mask('000.00', {reverse: true})" value="{{number_format($month_edit->percentage, 2, '.', '')}}">
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
    <script src="{{asset('js/main.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.mask.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
          bsCustomFileInput.init();
        });
    </script>
@stop
