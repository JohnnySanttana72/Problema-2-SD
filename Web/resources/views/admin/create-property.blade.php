@extends('adminlte::page')

@section('title', 'Cadastrar Empreendimento')

@section('content_header')
    <h1><a href="{{route('admin.properties')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a> Cadastrar Empreendimento</h1>
@stop

@section('content')
    <!-- form start -->
    <form method="POST" action="{{ route('admin.create_property')}}" enctype="multipart/form-data">
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
                        <div class="form-group">
                            <label for="inputEmail">Nome</label>
                            <input type="text" name="name" class="form-control" id="inputEmail" placeholder="Nome do Empreendimento" value="{{old('email')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="inputFacebook">Preço</label>
                            <input type="text" name="price" class="form-control" id="inputPrice" placeholder="Valor do Empreendimento" value="{{old('price')}}" onkeypress="$(this).mask('##00.00', {reverse: true})" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <x-dg-select2 id="myID" name="status" label="Status" required>
                                <x-dg-option value="lançamento" >Lançamento</x-dg-option>
                                <x-dg-option value="pré-lançamento">Pré-Lançamento</x-dg-option>
                                <x-dg-option value="em construção">Em construção</x-dg-option>
                                <x-dg-option value="entregue">Entregue</x-dg-option>
                            </x-dg-select2>
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
                            <label for="inputReferencePoint">Ponto de Referência</label>
                            <input type="text" name="reference_point" class="form-control" id="inputReferencePoint" placeholder="Ponto de Referência" value="{{old('reference_point')}}">
                        </div>

                        <div class="form-group">
                            <label for="inputCity">Cidade</label>
                            <input type="text" name="city" class="form-control" id="inputCity" placeholder="Estado" value="{{old('city')}}" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <hr>

            <div class="card-header" style="border-bottom: none;">
                <h3 class="card-title">Imagens e Arquivos empreendimento</h3>
            </div> -->
            
            <!-- <div class="card-body"> -->
            <!-- /.card-header -->
                <!-- <div class="row">
                    <div class="col-md-6" id="image-cover">
                        <img src="https://via.placeholder.com/5000x3000/FFFFFF?text=Imagem de Capa" id="preview-cover" class="img-fluid" style="width: 75%;">
                        
                        <div class="form-group" style="margin-top: 10px">
                          <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputCover" name="image_cover" accept="image/*" required>
                                <label class="custom-file-label" for="inputCover">Escolha uma imagem de Capa</label>
                            </div>
                          </div>
                        </div>

                        <iframe src="{{asset('storage/certified-test.pdf')}}" width="500" height="300" style="border: none; margin-top: 40px" id="preview-certified" type="application/pdf"></iframe>

                        <div class="form-group" style="margin-top: 10px">
                           <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputCertified" name="certified" accept="application/pdf" required>
                                <label class="custom-file-label" for="inputCertified">Selecione um arquivo</label>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="col-md-6" id="image-cover">
                        <img src="https://via.placeholder.com/5000x3000/FFFFFF?text=Imagem de Planta" id="preview-plant" class="img-fluid" style="width: 75%;">

                        <div class="form-group" style="margin-top: 10px">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputPlant" name="image_plant" accept="image/*" required>
                                    <label class="custom-file-label" for="inputPlant">Escolha uma Imagem da planta</label>
                                </div>
                            </div>
                        </div>

                        <iframe id="preview-video" src="https://www.youtube.com/embed/C0DPdy98e4c" width="500" height="300" style="border: none; margin-top: 40px" type="video/mp4"></iframe>

                        <div class="form-group" style="margin-top: 10px">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputVideo" name="video" accept="video/mp4">
                                    <label class="custom-file-label" for="inputVideo">Selecione o vídeo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

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
    <script src="{{asset('js/jquery.mask.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
          bsCustomFileInput.init();
        });
    </script>
@stop
