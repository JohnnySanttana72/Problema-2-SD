@extends('adminlte::page')

@section('title', 'Dados da Empresa')

@section('content_header')
    <h1>Dados da Empresa</h1>
@stop

@section('content')
 
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12">
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-building"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ELO Empreendimentos
                  </font></font>
                </h4>
              </div>
              <!-- /.col -->
            </div>

            @if(isset($ELO) && $ELO->count() > 0)
              <!-- Data row -->
              <div class="row">
                <div class="card-body">
                  @if($ELO->phone)
                    <strong><i class="fas fa-phone mr-1"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Telefone</font></font></strong>

                    <p class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $ELO->phone }}
                    </font></font></p>

                    <hr>
                  @endif

                  @if($ELO->whatsapp)
                    <strong><i class="fab fa-whatsapp mr-1"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Whatsapp</font></font></strong>

                    <p class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $ELO->whatsapp }}</font></font></p>

                    <hr>
                  @endif

                  @if($ELO->facebook)
                    <strong><i class="fab fa-facebook-f mr-1"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> facebook</font></font></strong>

                    <p class="text-muted">
                      <span class="tag tag-danger"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $ELO->facebook }} </font></font></span>
                      <!-- <span class="tag tag-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Codificação </font></font></span>
                      <span class="tag tag-info"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Javascript </font></font></span>
                      <span class="tag tag-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">PHP </font></font></span>
                      <span class="tag tag-primary"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Node.js</font></font></span> -->
                    </p>

                    <hr>
                  @endif

                   @if($ELO->instagram)
                    <strong><i class="fab fa-instagram mr-1"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Instagram</font></font></strong>

                    <p class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $ELO->instagram }} </font></font></p>

                    <hr>
                  @endif

                  @if($ELO->email)
                    <strong><i class="far fa-envelope mr-1"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Email</font></font></strong>

                    <p class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $ELO->email }} </font></font></p>

                    <hr>
                  @endif

                  @if($ELO->address->street)
                    <strong><i class="far fa-envelope mr-1"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Endereço</font></font></strong>
                      
                    <p class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $ELO->address->street }}, nº {{ $ELO->address->number }} {{ $ELO->address->complement }} {{$ELO->address->neighborhood->name}}, CEP - {{$ELO->address->CEP}}, {{$ELO->address->neighborhood->city->name}} - {{$ELO->address->neighborhood->city->state->name}}</font></font></p>
                  @endif
                </div>
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                 <!--  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Editar dados</font></font></a> -->
                  <a href="{{route('admin.delete_elo', ['id' => $ELO->id])}}" type="button" class="btn btn-danger float-right"><i class="fa fa-trash"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Deletar
                  </font></font></a>
                  <a href="{{route('admin.edit_elo', ['id' => $ELO->id])}}" type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-edit"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Editar
                  </font></font></a>
                </div>
              </div>
            @else
             <div class="row  col-xs-12 col-sm-12 col-md-12 col-lg-12 justify-content-md-center" align="center" style="margin: 20px 0 20px 0">
              <div class="col-12"  align="center">
                <a href="{{url('/admin/create_elo')}}" class="btn btn-primary" style="margin-right: 5px;color:#fff">
                  <i class="fas fa-plus"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Cadastre os dados da Empresa
                </font></font></a>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
  </div>
  
@stop

 @section('footer')

@section('css')
    <link rel="stylesheet" href="{{asset('css/app_person.css')}}">
@stop