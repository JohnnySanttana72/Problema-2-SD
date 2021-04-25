@extends('adminlte::page')

@section('title', 'Cadastrar Etapa')

@section('content_header')
    <h1><a href="{{route('admin.stage_property',['id' => $property_id])}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a> Cadastrar Etapa</h1>
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
    <form method="POST" action="{{ url('/admin/create_month')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="property_id" value="{{ $property_id }}">
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
                        <div class="form-group">
                            <x-dg-select2 id="monthId" name="month" label="Mês">
                                @php $date = Carbon\Carbon::now(); @endphp
                                @foreach(range(1,12) as $month)
                                    @if (old('month') == (utf8_encode(ucfirst($date->copy()->addMonth($month)->formatLocalized('%b')))))
                                        <x-dg-option value="{{ (utf8_encode(ucfirst($date->copy()->addMonth($month)->formatLocalized('%b')))) }}" selected>{{ (utf8_encode(ucfirst($date->copy()->addMonth($month)->formatLocalized('%b')))) }}</x-dg-option>
        
                                    @else
                                        <x-dg-option value="{{ (utf8_encode(ucfirst($date->copy()->addMonth($month)->formatLocalized('%b')))) }}" >{{ (utf8_encode(ucfirst($date->copy()->addMonth($month)->formatLocalized('%b')))) }}</x-dg-option>
                                    @endif
                                    
                                 @endforeach
                            </x-dg-select2>
                        </div>

                        <div class="form-group">
                            <label for="inputFacebook">Descrição</label>
                            <input type="text" name="description" class="form-control" id="inputDescription" placeholder="Descrição da Etapa" value="{{old('description')}}" required>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <x-dg-select2 id="yearId" name="year" label="Ano" required>
                                @for ($year = date('Y'); $year > date('Y') - 100; $year--)
                                    @if (old('year') == $year)
                                        <x-dg-option value="{{$year}}" selected>{{$year}}</x-dg-option>
                                    @else
                                        <x-dg-option value="{{$year}}">{{$year}}</x-dg-option>
                                    @endif
                                    
                                @endfor
                            </x-dg-select2>
                        </div>

                        <div class="form-group">
                            <label for="inputFacebook">Porcentagem</label>
                            <input type="text" name="percentage" class="form-control" id="inputPrice" placeholder="Valor do Empreendimento" onkeypress="$(this).mask('000.00', {reverse: true})" value="{{old('percentage')}}" required>
                        </div>

                    </div>
                </div>
            </div>

            <hr>

            <div class="card-header" style="border-bottom: none;">
                <h3 class="card-title">Imagens da Etapa </h3>
            </div>
            
            <div class="card-body">
                <span style="color: #ffab17">Obs: Escolha multiplas imagens</span>
            <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="inputImage" name="image[]" accept="image/*" multiple required>
                                  <label class="custom-file-label" for="inputImage" style="overflow: hidden !important;text-overflow: ellipsis;">Escolha a imagem</label>
                                </div>
                               <!--  <div class="input-group-append">
                                  <span class="input-group-text" id="">Upload</span>
                                </div> -->
                            </div>
                        </div>
                        
                    </div>
                </div>

                <output class="row" id="preview_images" />
                    <!-- <output  alt="your image" /> -->
            </div>


            <div class="card-footer">
              <button type="submit" class="btn btn-lg btn-primary">Cadastrar</button>
            </div>
        </div>

       <!--  <div class="thumbnail-wrapper" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
              <img src="http://localhost:8000/images_system/img-section-one.jpg" class="img-fluid mb-2" alt="white sample">
              
              <div class="btn-group">
                <a style="color:#fff" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit" data-image_id="1" data-image_path="http://localhost:8000/images_system/img-section-one.jpg"><i class="fas fa-edit"></i></a>
                <a href="http://localhost:8000/admin/delete_image/1" class="btn btn-danger"><i class="fas fa-trash"></i></a>
              </div>
            </div> -->

       
    </form>
@stop

<!-- @section('plugins.Select2', true) -->

@section('css')
    <link rel="stylesheet" href="{{asset('css/app_person.css')}}">
@stop

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
          bsCustomFileInput.init();
        });
    </script>
    <script src="{{asset('js/main.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.mask.js')}}" type="text/javascript"></script>
@stop
