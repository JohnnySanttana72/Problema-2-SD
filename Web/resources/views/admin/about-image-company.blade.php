@extends('adminlte::page')

@section('title', 'Imagens Sobre a Empresa')

@section('content_header')
    <h1>Imagens Sobre a Empresa</h1>
@stop

@section('content')
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <i class="fas fa-image"></i> Imagens Sobre a Empresa
        </div>
        <div class="mb-2">
            <div class="float-right">
              <div class="btn-group" style="color:">
                <a class="btn btn-primary" style="color:#fff" data-toggle="modal" data-target="#modal-create"> Adicionar </a>
                <!-- <a class="btn btn-danger" href="javascript:void(0)" data-sortdesc=""> Apagar todos </a> -->
              </div>
            </div>
          </div>
      </div>
      <div class="card-body">
        @if(isset($images) && $images->count() > 0)
        <div class="row justify-content-center">
          @foreach($images as $image)
            <div class="col-sm-3">
            <div class="thumbnail-wrapper" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
              <img src="{{asset($image->path)}}" class="img-fluid mb-2" alt="white sample">
              
              <div class="btn-group">
                <a style="color:#fff" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit" data-image_id="{{ $image->id }}" data-image_path="{{asset($image->path)}}"><i class="fas fa-edit"></i></a>
                <a href="{{ route('admin.delete_image', ['id' => $image->id]) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @endif
      </div>
      <hr>
        <div class="card-footer text-center">
            <p style="color: red; font-weight: bold">A medida padrão indicada das imagens é: 878x801</p>
        </div>
    </div>
  </div>

  <div class="modal fade" id="modal-create" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Imagem</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form1" method="POST" action="{{ route('admin.create_image_about')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="image-cover" style="max-width:500px;max-height:420px;width: auto;height: auto;" >
                <img src="https://via.placeholder.com/300/FFFFFF?text=Selecione uma Imagem sobre a empresa" id="preview-image1" class="img-fluid" style="width: 75%;">
                <div class="form-group" style="margin-top: 10px">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputImage1" name="image" accept="image/*" required>
                      <label class="custom-file-label" for="exampleInputFile">Escolha a imagem</label>
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

  <div class="modal fade" id="modal-edit" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Imagem Sobre a Empresa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form2" method="POST" action="{{ route('admin.update_image_about')}}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="ekko-lightbox-container" style="height: auto;">
              <div class="ekko-lightbox-item fade"></div>
              <div class="ekko-lightbox-item fade in show" id="image-cover">
                <img src="" id="preview-image2" class="img-fluid" style="width: 75%;">
                <div class="form-group" style="margin-top: 10px">
                  <strong>Caminho do Arquivo:</strong>
                  <p id="path" style="text-align:center;"></p>
                  <div class="input-group">
                    <input type="hidden" id="id_image" name="id" value="">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputImage2" name="image" accept="image/*" required>
                      <label class="custom-file-label" for="exampleInputFile"></label>
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

          <!-- <div id="ekkoLightbox-598" class="ekko-lightbox modal fade in show" tabindex="-1" role="dialog" style="padding-right: 17px; display: block;" aria-modal="true">
            <div class="modal-dialog" role="document" style="display: block; flex: 1 1 1px; max-width: 502px;">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">sample 2 - black</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                  <div class="ekko-lightbox-container" style="height: 468px;">
                    <div class="ekko-lightbox-item fade"></div>
                    <div class="ekko-lightbox-item fade in show">
                      <img src="https://via.placeholder.com/1200/000000.png?text=2" class="img-fluid" style="width: 100%;">
                    </div>
                    <div class="ekko-lightbox-nav-overlay">
                      <a href="#"><span>❮</span></a><a href="#"><span>❯</span></a>
                    </div>
                </div>
                </div><div class="modal-footer hide" style="display: none;">&nbsp;</div>
            </div>
          </div>
        </div> -->
@stop

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

    $('#modal-create').on('hidden.bs.modal', function () {
        // limpa o inpute file
        var fileInput = document.getElementById('inputImage1')
        fileInput.value = ''
        fileInput.dispatchEvent(new Event('change'))

        // limpa o caminho da imagem do src
        $('#form1 img').each(function() {
           $(this).attr('src', 'https://via.placeholder.com/300/FFFFFF?text=elecione uma Imagem sobre a empresa'); 
        });
    });
  </script>
@stop
