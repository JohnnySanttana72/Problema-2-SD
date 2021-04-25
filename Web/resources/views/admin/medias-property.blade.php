@extends('adminlte::page')

@section('title', 'Mídias do Empreendimento')

@section('content_header')
    <h1><a href="{{route('admin.properties')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a> Mídias do Empreendimento {{ $property->name }}</h1>
@stop

@section('content')
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <i class="fas fa-image"></i> Imagem de Capa de Empreendimento
        </div>
        <div class="mb-2">
          <div class="float-right">
            @forelse ($property->media->where('type', 'imagem capa') as $cover)
              <div class="btn-group" style="color:#fff">
                <a class="btn btn-primary" data-toggle="modal" data-target="#modal-cover" data-file_id="{{ $cover->id }}" data-file_path="{{asset($cover->path)}}"> <i class="fa fa-edit"></i> Editar </a>
                <a href="{{ route('admin.delete_media', ['id' => $cover->id]) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Apagar </a>
              </div>
            @empty
              <a class="btn btn-primary" style="color:#fff" data-toggle="modal" data-target="#modal-create-cover" > Cadastrar </a>
            @endforelse
          </div>
        </div>
      </div>
      @forelse ($property->media->where('type', 'imagem capa') as $cover)
        <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-sm-5">
               
                <img src="{{asset($cover->path)}}" class="img-fluid mb-2" alt="white sample">
              </div>
             
          </div>
        </div>
      @empty

      @endforelse
    </div>

    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <i class="fas fa-image"></i> Imagem de Banner
        </div>
        <div class="mb-2">
          <div class="float-right">
            @forelse ($property->media->where('type', 'imagem banner') as $banner)
              <div class="btn-group" style="color:#fff">
                <a class="btn btn-primary" data-toggle="modal" data-target="#modal-banner" data-file_id="{{ $banner->id }}" data-file_path="{{asset($banner->path)}}"> <i class="fa fa-edit"></i> Editar </a>
                <a href="{{ route('admin.delete_media', ['id' => $banner->id]) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Apagar </a>
              </div>
            @empty
              <a class="btn btn-primary" style="color:#fff" data-toggle="modal" data-target="#modal-create-banner" > Cadastrar </a>
            @endforelse
          </div>
        </div>
      </div>
      @forelse ($property->media->where('type', 'imagem banner') as $banner)
        <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-sm-7">
               
                <img src="{{asset($banner->path)}}" class="img-fluid mb-2" alt="white sample">
              </div>
             
          </div>
        </div>
      @empty

      @endforelse
    </div>

    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <i class="fas fa-image"></i> Imagem de Planta do empreendimento
        </div>
        <div class="mb-2">
            <div class="float-right">
              @forelse ($property->media->where('type', 'imagem planta') as $plant)
                <div class="btn-group" style="color:">
                  <a class="btn btn-primary" style="color:#fff" data-toggle="modal" data-target="#modal-plant" data-file_id="{{ $plant->id }}" data-file_path="{{asset($plant->path)}}"> <i class="fa fa-edit"></i> Editar </a>
                  <a href="{{ route('admin.delete_media', ['id' => $plant->id]) }}" class="btn btn-danger"> <i class="fa fa-trash"></i> Apagar </a>
                </div>
              @empty
                <a class="btn btn-primary" style="color:#fff" data-toggle="modal" data-target="#modal-create-plant" > Cadastrar </a>
              @endforelse
            </div>
          </div>
      </div>

      @forelse ($property->media->where('type', 'imagem planta') as $plant)
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-sm-5">
              <img src="{{ asset($plant->path) }}" class="img-fluid mb-2" alt="white sample">
            </div>
          </div>
        </div>
      @empty

      @endforelse
    </div>

    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <i class="far fa-file-pdf"></i> Certificado do Empreendimento
        </div>
        <div class="mb-2">
            <div class="float-right">
              @forelse ($property->media->where('type', 'arquivo certificado') as $certified)
                <div class="btn-group" style="color:">
                  <a class="btn btn-primary" style="color:#fff" data-toggle="modal" data-target="#modal-certified" data-file_id="{{ $certified->id }}" data-file_path="{{asset($certified->path)}}"><i class="fa fa-edit"></i> Editar </a>
                  <a href="{{ route('admin.delete_media', ['id' => $certified->id]) }}" class="btn btn-danger"> <i class="fa fa-trash"></i> Apagar  </a>
                </div>
               @empty
                  <a class="btn btn-primary" style="color:#fff" data-toggle="modal" data-target="#modal-create-certified"> Cadastrar </a>
              @endforelse
            </div>
          </div>
      </div>

      @forelse ($property->media->where('type', 'arquivo certificado') as $certified)
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="embed-responsive embed-responsive-16by9" align="center">
              <iframe src="{{asset($certified->path)}}" class="embed-responsive-item" width="500" height="300" style="border: none; margin-top: 40px" id="preview-certified" type="application/pdf"></iframe>
            </div>
          </div>
        </div>
      @empty

      @endforelse
    </div>

    <div class="card">
      <div class="card-header">
        <div class="card-title">
            <i class="fas fa-file-upload"></i> Vídeo ou Imagem do Empreendimento
        </div>
        <div class="mb-2">
            <div class="float-right">
              @forelse ($property->media->where('type', 'video') as $video)
                <div class="btn-group" style="color:">
                  <a class="btn btn-primary" style="color:#fff" data-toggle="modal" data-target="#modal-video" data-file_id="{{ $video->id }}" data-file_path="{{asset($video->path)}}"> <i class="fa fa-edit"></i> Editar </a>
                  <a href="{{ route('admin.delete_media', ['id' => $video->id]) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Apagar  </a>
                </div>
              @empty
                <a class="btn btn-primary" style="color:#fff" data-toggle="modal" data-target="#modal-create-video"> Cadastrar</a>
              @endforelse
            </div>
          </div>
      </div>

      @forelse ($property->media->where('type', 'video') as $video)
        <div class="card-body">
          <div class="row justify-content-center">
              @if (strpos($video->path, 'youtube'))
                <div class="embed-responsive embed-responsive-16by9" align="center">
                    <iframe id="preview-video" src="{{asset($video->path)}}" class="embed-responsive-item" width="500" height="300" style="border: none; margin-top: 40px" type="video/mp4"></iframe>
                </div>
              @else
                <div class="col-sm-5">
                    <img src="{{ asset($video->path) }}" class="img-fluid mb-2" alt="white sample">
                </div>
              @endif
          </div>
        </div>
      @empty

      @endforelse
    </div>
  </div>

  <div class="card">
      <div class="card-header">
        <div class="card-title">
          <i class="fas fa-image"></i> Imagem do Mapa do empreendimento
        </div>
        <div class="mb-2">
            <div class="float-right">
              @forelse ($property->media->where('type', 'imagem mapa') as $map)
                <div class="btn-group" style="color:">
                  <a class="btn btn-primary" style="color:#fff" data-toggle="modal" data-target="#modal-map" data-file_id="{{ $map->id }}" data-file_path="{{asset($map->path)}}"> <i class="fa fa-edit"></i> Editar </a>
                  <a href="{{ route('admin.delete_media', ['id' => $map->id]) }}" class="btn btn-danger"> <i class="fa fa-trash"></i> Apagar </a>
                </div>
              @empty
                <a class="btn btn-primary" style="color:#fff" data-toggle="modal" data-target="#modal-create-map" > Cadastrar </a>
              @endforelse
            </div>
          </div>
      </div>

      @forelse ($property->media->where('type', 'imagem mapa') as $map)
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-sm-5">
              <img src="{{ asset($map->path) }}" class="img-fluid mb-2" alt="white sample">
            </div>
          </div>
        </div>
      @empty

      @endforelse
    </div>

  <!-- Modals Create -->

  <!-- Modal Criação de Imagem de Capa -->
  <div class="modal fade" id="modal-create-cover" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Imagem de Capa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form1" method="POST" action="{{ route('admin.create_media_cover')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="image-cover">
                <img src="https://via.placeholder.com/1400x1800/FFFFFF?text=Selecione uma Imagem de Capa" id="preview-cover1" class="img-fluid" style="width: 75%;">
                <input type="hidden" name="id" value="{{ $property->id }}">
                <div class="form-group" style="margin-top: 10px">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputCover1" name="image_cover" accept="image/*" required>
                      <label class="custom-file-label" for="inputCover1">Escolha a imagem</label>
                    </div>
                   <!--  <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Modal Criação de Imagem de Banner -->
  <div class="modal fade" id="modal-create-banner" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Imagem de Banner</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form1" method="POST" action="{{ route('admin.create_media_banner')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="image-cover">
                <img src="https://via.placeholder.com/1500x193/FFFFFF?text=Selecione uma Imagem de Banner" id="preview-banner1" class="img-fluid" style="width: 75%;">
                <input type="hidden" name="id" value="{{ $property->id }}">
                <div class="form-group" style="margin-top: 10px">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputBanner1" name="image_banner" accept="image/*" required>
                      <label class="custom-file-label" for="inputBanner1">Escolha a imagem</label>
                    </div>
                   <!--  <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Modal Criação de Imagem de Planta -->
  <div class="modal fade" id="modal-create-plant" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Imagem de Planta</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form1" method="POST" action="{{ route('admin.create_media_plant')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="image-cover">
                <img src="https://via.placeholder.com/3100x1800/FFFFFF?text=Selecione uma Imagem da Planta" id="preview-plant1" class="img-fluid" style="width: 75%;">
                <input type="hidden" name="id" value="{{ $property->id }}">
                <div class="form-group" style="margin-top: 10px">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputPlant1" name="image_plant" accept="image/*" required>
                      <label class="custom-file-label" for="inputPlant1">Escolha a imagem</label>
                    </div>
                   <!--  <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Modal Criação de Arquivo de Certificado -->
  <div class="modal fade" id="modal-create-certified" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Certificado</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form1" method="POST" action="{{ route('admin.create_media_certified')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail" style="font-size: 12px;">Proprietário</label>
                        <input type="text" name="owner" class="form-control" id="inputOwner" placeholder="Proprietário" value="{{old('owner')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="inputFacebook" style="font-size: 12px;">Dispensa Ambiental</label>
                        <input type="text" name="dispensation" class="form-control" id="inputDispensation" placeholder="Dispensa Ambiental" onkeypress="$(this).mask('00/0000 de 00/00/0000', {reverse: true})" required>
                    </div>

                    <div class="form-group">
                        <label for="inputFacebook" style="font-size: 12px;">Alvará de construção</label>
                        <input type="text" name="building_permit" class="form-control" id="inputBuilding" placeholder="Alvará de construção" value="{{old('building_permit')}}" onkeypress="$(this).mask('00000/0000 concedido em 00/00/0000', {reverse: true})" required>
                    </div>

                    <div class="form-group">
                        <label for="inputFacebook" style="font-size: 12px;">Registro no cartório do 1º Ofício com matrícula</label>
                        <input type="text" name="registry" class="form-control" id="inputRegistry" placeholder="Registro no cartório do 1º Ofício com matrícula" value="{{old('registry')}}" onkeypress="$(this).mask('00.000', {reverse: true})" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail" style="font-size: 12px;">CNPJ</label>
                        <input type="text" name="cnpj" class="form-control" id="inputCnpj" placeholder="CNPJ" value="{{old('cnpj')}}" onkeypress="$(this).mask('00.000.00/0000-00', {reverse: true})" required>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail" style="font-size: 12px;">Decreto de Aprovação do Loteamento</label>
                        <input type="text" name="approval_decree" class="form-control" id="inputDecree" placeholder="Decreto de Aprovação do Loteamento" value="{{old('approval_decree')}}" onkeypress="$(this).mask('0000 publicado em 00/00/0000', {reverse: true})" required>
                    </div>

                    <div class="form-group">
                        <label for="inputFacebook" style="font-size: 12px;">Termo de Acordo e Compromisso</label>
                        <input type="text" name="term" class="form-control" id="inputTerm" placeholder="Termo de Acordo e Compromisso" value="{{old('term')}}" onkeypress="$(this).mask('00/00/0000', {reverse: true})" required>
                    </div>

                    <div class="form-group">
                        <label for="inputFacebook" style="font-size: 12px;">Registro de Incorporação (R.I.) número</label>
                        <input type="text" name="ri" class="form-control" id="inputRi" placeholder="Valor do Empreendimento" value="{{old('ri')}}" onkeypress="$(this).mask('00.000', {reverse: true})" required>
                    </div>
                </div>
            </div>
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="image-cover">
                <div class="embed-responsive embed-responsive-16by9" align="center">
                  <iframe src="{{asset('certified-test.pdf')}}" class="embed-responsive-item" width="400" height="220" style="border: none; margin-top: 40px;" id="preview-certified1" type="application/pdf"></iframe>
                </div>
                
                <input type="hidden" name="id" value="{{ $property->id }}">
                <div class="form-group" style="margin-top: 10px">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputCertified1" name="certified" accept="application/pdf" required>
                      <label class="custom-file-label" for="inputCertified1">Escolha o arquivo</label>
                    </div>
                   <!--  <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Modal Criação de Arquivo de Vídeo -->
  <div class="modal fade" id="modal-create-video" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Video</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form1" method="POST" action="{{ route('admin.create_media_video')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="preview">
                <div class="embed-responsive embed-responsive-16by9" align="center" id="div-preview">
                  <iframe src="https://www.youtube.com/embed/C0DPdy98e4c" class="embed-responsive-item" width="400" height="220" style="border: none; margin-top: 40px;" id="preview-video1" type="video/mp4"></iframe>
                </div>
                <img src="https://via.placeholder.com/600x500/FFFFFF?text=Selecione uma Imagem" id="preview-image" class="img-fluid" style="width: 100%; display:none">
                <input type="hidden" name="id" value="{{ $property->id }}">
                <div class="row justify-content-between mt-3">
                    <div class="col text-center">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="video-button" name="customRadio" class="custom-control-input" value="video" checked>
                            <label class="custom-control-label" for="video-button">Cadastrar Vídeo</label>
                        </div>
                    </div>

                    <div class="col text-center">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="image-button" name="customRadio" class="custom-control-input" value="image">
                            <label class="custom-control-label" for="image-button">Cadastrar Imagem</label>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 10px">
                  <div class="input-group mb-3" id="input-video-or-image">
                    <div class="input-group-prepend" id="div-prepend">
                      <span class="input-group-text" id="url-name">https://</span>
                    </div>
                    <input type="text" class="form-control" id="inputVideo1" name="video" aria-describedby="basic-addon3" required>
                    <div class="custom-file" id="input-image-group" style="display: none">
                        <input type="file" class="custom-file-input" id="inputImage1" name="image" accept="image/*" required disabled>
                        <label class="custom-file-label" id="label-image" for="inputImage1"></label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
        </form>
      </div>
        <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
  </div>

  <!-- Modal Criação de Arquivo de Mapa -->
  <div class="modal fade" id="modal-create-map" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Mapa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form1" method="POST" action="{{ route('admin.create_media_map')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="image-map">
                <img src="https://via.placeholder.com/3100x1800/FFFFFF?text=Selecione a Imagem do Mapa" id="preview-map1" class="img-fluid" style="width: 100%;">
                <input type="hidden" name="id" value="{{ $property->id }}">
                <div class="form-group" style="margin-top: 10px">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputMap1" name="map" accept="image/*" required>
                      <label class="custom-file-label" for="inputMap1">Escolha o arquivo</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
        </form>
      </div>
        <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- end Modals Create -->

  <!-- Modals Edit -->

  <!-- Modal Editar de Imagem de Capa -->
  <div class="modal fade" id="modal-cover" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Imagem de Capa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form2" method="POST" action="{{ route('admin.update_media_cover')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="image-cover">
                <img src="" id="preview-cover2" class="img-fluid" style="width: 75%;">
                <div class="form-group" style="">
                  <strong>Caminho do Arquivo:</strong>
                  <p id="path_cover" style="text-align:center; margin-bottom: -1px; word-wrap: break-word;"></p>
                  <div class="input-group">
                    <input type="hidden" id="id_image" name="idCover" value="">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputCover2" name="image_cover" accept="image/*" required>
                      <label class="custom-file-label" for="inputCover2"></label>
                    </div>
                   <!--  <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Alterar</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Modal Editar de Imagem de Banner -->
  <div class="modal fade" id="modal-banner" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Imagem de Banner</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form2" method="POST" action="{{ route('admin.update_media_banner')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="image-cover">
                <img src="" id="preview-banner2" class="img-fluid" style="width: 75%;">
                <div class="form-group" style="margin-top: 10px">
                  <strong>Caminho do Arquivo:</strong>
                  <p id="path_banner" style="text-align:center;word-wrap: break-word;"></p>
                  <div class="input-group">
                    <input type="hidden" id="id_image" name="idBanner" value="">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputBanner2" name="image_banner" accept="image/*" required>
                      <label class="custom-file-label" for="inputBanner2"></label>
                    </div>
                   <!--  <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Alterar</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Modal Editar de Imagem de Planta -->
  <div class="modal fade" id="modal-plant" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Imagem de Planta</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form2" method="POST" action="{{ route('admin.update_media_plant')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="image-cover">
                <img src="" id="preview-plant2" class="img-fluid" style="width: 75%;">
                <div class="form-group" style="margin-top: 10px">
                  <strong>Caminho do Arquivo:</strong>
                  <p id="path_plant" style="text-align:center; word-wrap: break-word;"></p>
                  <div class="input-group">
                    <input type="hidden" id="id_image" name="idPlant" value="">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputPlant2" name="image_plant" accept="image/*" required>
                      <label class="custom-file-label" for="inputPlant2"></label>
                    </div>
                   <!--  <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Alterar</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Modal Editar de Arquivo de Certificado -->
  <div class="modal fade" id="modal-certified" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Certificado</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form2" method="POST" action="{{ route('admin.update_media_certified')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <!-- <div class="card-body"> -->
            @if(isset($property->property_approval) && $property->property_approval->count() > 0)
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="inputEmail" style="font-size: 12px;">Proprietário</label>
                          <input type="text" name="owner" class="form-control" id="inputOwner" placeholder="Proprietário" value="{{$property->property_approval->owner}}">
                      </div>

                      <div class="form-group">
                          <label for="inputFacebook" style="font-size: 12px;">Dispensa Ambiental</label>
                          <input type="text" name="dispensation" class="form-control" id="inputDispensation" placeholder="Dispensa Ambiental" value="{{$property->property_approval->dispensation}}" onkeypress="$(this).mask('00/0000 de 00/00/0000', {reverse: true})">
                      </div>

                      <div class="form-group">
                          <label for="inputFacebook" style="font-size: 12px;">Alvará de construção</label>
                          <input type="text" name="building_permit" class="form-control" id="inputBuilding" placeholder="Alvará de construção" value="{{$property->property_approval->building_permit}}" onkeypress="$(this).mask('00000/0000 concedido em 00/00/0000', {reverse: true})">
                      </div>

                      <div class="form-group">
                          <label for="inputFacebook" style="font-size: 12px;">Registro no cartório do 1º Ofício com matrícula</label>
                          <input type="text" name="registry" class="form-control" id="inputRegistry" placeholder="Registro no cartório do 1º Ofício com matrícula" value="{{$property->property_approval->registry}}" onkeypress="$(this).mask('00.000', {reverse: true})">
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="inputEmail" style="font-size: 12px;">CNPJ</label>
                          <input type="text" name="cnpj" class="form-control" id="inputCnpj" placeholder="CNPJ" value="{{$property->property_approval->CNPJ}}" onkeypress="$(this).mask('00.000.00/0000-00', {reverse: true})">
                      </div>

                      <div class="form-group">
                          <label for="inputEmail" style="font-size: 12px;">Decreto de Aprovação do Loteamento</label>
                          <input type="text" name="approval_decree" class="form-control" id="inputDecree" placeholder="Decreto de Aprovação do Loteamento" value="{{$property->property_approval->approval_decree}}" onkeypress="$(this).mask('0000 publicado em 00/00/0000', {reverse: true})">
                      </div>

                      <div class="form-group">
                          <label for="inputFacebook" style="font-size: 12px;">Termo de Acordo e Compromisso</label>
                          <input type="text" name="term" class="form-control" id="inputTerm" placeholder="Termo de Acordo e Compromisso" value="{{$property->property_approval->term}}" onkeypress="$(this).mask('00/00/0000', {reverse: true})">
                      </div>

                      <div class="form-group">
                          <label for="inputFacebook" style="font-size: 12px;">Registro de Incorporação (R.I.) número</label>
                          <input type="text" name="ri" class="form-control" id="inputRi" placeholder="Valor do Empreendimento" value="{{$property->property_approval->RI}}" onkeypress="$(this).mask('00.000', {reverse: true})">
                      </div>
                  </div>
              </div>
            @endif
            <!-- </div> -->
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="image-cover">
                <div class="embed-responsive embed-responsive-16by9" align="center">
                  <iframe src="" id="preview-certified2" class="embed-responsive-item" width="400" height="220" style="border: none; margin-top: 40px;" type="application/pdf"></iframe>
                </div>
                <div class="form-group" style="margin-top: 10px">
                  <strong>Caminho do Arquivo:</strong>
                  <p id="path_certified" style="text-align:center; word-wrap: break-word;"></p>
                  <div class="input-group">
                    <input type="hidden" id="id_image" name="idCertified" value="">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputCertified2" name="certified" accept="aplication/pdf">
                      <label class="custom-file-label" for="inputCertified2"></label>
                    </div>
                   <!--  <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Alterar</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Modal Editar de Arquivo de Video -->
  <div class="modal fade" id="modal-video" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Video ou Imagem</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form2" method="POST" action="{{ route('admin.update_media_video') }}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <input type="hidden" id="id_image" name="idVideo" value="">
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="preview">
                <div class="embed-responsive embed-responsive-16by9" align="center" id="div-preview-edit" @if ($type) style="display: block" @else style="display: none" @endif>
                  <iframe src="" class="embed-responsive-item" width="400" height="220" style="border: none; margin-top: 40px;" id="preview-video2" type="video/mp4"></iframe>
                </div>
                <img src="" id="preview-image-edit" class="img-fluid" @if (!$type) style="display: block; width: 100%;" @else style="display: none" @endif>
                <input type="hidden" name="id" value="{{ $property->id }}">
                <div class="row justify-content-between mt-3">
                    <div class="col text-center">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="video-button-edit" name="customRadioEdit" class="custom-control-input" value="video2" @if ($type) checked @endif>
                            <label class="custom-control-label" for="video-button-edit">Vídeo</label>
                        </div>
                    </div>

                    <div class="col text-center">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="image-button-edit" name="customRadioEdit" class="custom-control-input" value="image2" @if (!$type) checked @endif>
                            <label class="custom-control-label" for="image-button-edit">Imagem</label>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 10px">
                    <strong>Url:</strong>
                    <p id="path_video" style="text-align:center; word-wrap: break-word;"></p>
                  <div class="input-group mb-3" id="input-video-or-image">
                    <div class="input-group-prepend" id="div-prepend-edit" @if ($type) style="display: block" @else style="display: none" @endif>
                      <span class="input-group-text" id="url-name">https://</span>
                    </div>
                    <input type="text" class="form-control" id="inputVideo2" name="video" aria-describedby="basic-addon3" required @if ($type) style="display: block" @else style="display: none" disabled @endif>
                    <div class="custom-file" id="input-image-group-edit"  @if (!$type) style="display: block" @else style="display: none" @endif>
                        <input type="file" class="custom-file-input" id="inputImage2" name="image" accept="image/*" required @if ($type) disabled  @endif>
                        <label class="custom-file-label" id="label-image" for="inputImage2"></label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Alterar</button>
          </div>
        </form>
      </div>
        <!-- /.modal-content -->
    </div>
      <!-- /.modal-dialog -->
  </div>

  <!-- Modal Editar de Arquivo de Mapa -->
  <div class="modal fade" id="modal-map" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Mapa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form2" method="POST" action="{{ route('admin.update_media_map')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="image-cover">
                <img src="" id="preview-map2" class="img-fluid" style="width: 75%;">
                <div class="form-group" style="margin-top: 10px">
                  <strong>Caminho do Arquivo:</strong>
                  <p id="path_map" style="text-align:center; margin-bottom: -1px; word-wrap: break-word;"></p>
                 
                  <div class="input-group">
                    <input type="hidden" id="id_image" name="idMap" value="">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputMap2" name="map" accept="mp4" required>
                      <label class="custom-file-label" for="inputMap2"></label>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Alterar</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- end Modal Edit -->
@stop

@section('plugins.Select2', true)

@section('css')
    <link rel="stylesheet" href="{{asset('css/app_person.css')}}">
@stop

@section('js')
  <script type="text/javascript" src="{{asset('js/address.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
  </script>
  <script src="{{asset('js/jquery.mask.js')}}" type="text/javascript"></script>

  <script>
      $('input[name=customRadio]').on('change', function(){
          if($(this).val() == 'image'){
            $('input[name=video]').attr("disabled", 'disabled');
            $('input[name=video]').css('display', 'none');
            $('#div-prepend').css('display', 'none');
            $('#div-preview').css('display', 'none');

            $('input[name=image]').removeAttr('disabled');
            $('input[name=image]').css('display', 'block');
            $('#preview-image').css('display', 'block');
            $('#input-image-group').css('display', 'block');
          }
          else if($(this).val() == 'video') {
            $('input[name=image]').attr("disabled", 'disabled');
            $('input[name=image]').css('display', 'none');
            $('#div-prepend').css('display', 'block');
            $('#div-preview').css('display', 'block');

            $('input[name=video]').removeAttr('disabled');
            $('input[name=video]').css('display', 'block');
            $('#preview-image').css('display', 'none');
            $('#input-image-group').css('display', 'none');
          }
      });

    //   console.log($('input[name=customRadioEdit]'))

      $('input[name=customRadioEdit]').on('change', function(){
        console.log($(this).val())

          if($(this).val() == 'image2'){
            $('#inputVideo2').attr("disabled", 'disabled');
            $('#inputVideo2').css('display', 'none');
            $('#div-prepend-edit').css('display', 'none');
            $('#div-preview-edit').css('display', 'none');

            $('#inputImage2').removeAttr('disabled');
            $('#inputImage2').css('display', 'block');
            $('#preview-image-edit').css('display', 'block');
            $('#input-image-group-edit').css('display', 'block');
          }
          else if($(this).val() == 'video2') {
            $('#inputImage2').attr("disabled", 'disabled');
            $('#inputImage2').css('display', 'none');
            $('#div-prepend-edit').css('display', 'block');
            $('#div-preview-edit').css('display', 'block');

            $('#inputVideo2').removeAttr('disabled');
            $('#inputVideo2').css('display', 'block');
            $('#preview-image-edit').css('display', 'none');
            $('#input-image-group-edit').css('display', 'none');
          }
      });
  </script>
@stop
