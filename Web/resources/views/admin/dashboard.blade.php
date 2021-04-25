@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <!-- <p>Welcome to this beautiful admin panel.</p> -->

    <!-- <section class="content"> -->
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Empreendimentos adicionados Recentemente</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Status</th>
                      <th>Preço</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($properties as $property)
                      <tr>
                        <td>{{$property->id}}</td>
                        <td>{{$property->name}}</td>
                        @if($property->status == 'lançamento')
                          <td><span class="badge" style="font-weight: bold; background-color: #4a8600; color:#fff">Lançamento</span></td>
                        @elseif($property->status == 'pré-lançamento')
                          <td><span class="badge" style="font-weight: bold; background-color: #00b1ff; color:#fff">Pré-Lançamento</span></td>
                        @elseif($property->status == 'em construção')
                          <td><span class="badge" style="font-weight: bold; background-color: #ffad00; color:#fff">Em Construção</span></td>
                        @else
                          <td><span class="badge" style="font-weight: bold; background-color: #841631; color:#fff">Entregue</span></td>
                        @endif
                        
                        <td>
                          <div class="sparkbar" data-color="#00a65a" data-height="20">R$ {{$property->price}}</div>
                        </td>
                      </tr>
                    @endforeach
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{url('/admin/properties')}}" class="btn btn-sm btn-secondary float-right">Ver todos os Empreendimentos</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3" style="background-color: #4a8600;color: #fff">
              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Lançamento</span>
                <span class="info-box-number">{{$count_launch}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3" style="background-color: #00b1ff;color: #fff">
              <span class="info-box-icon"><i class="fa fa-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pré-Lançamento</span>
                <span class="info-box-number">{{$count_pre_launch}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3" style="background-color: #ffad00;color: #fff">
              <span class="info-box-icon"><i class="fas fa-spinner"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Em Construção</span>
                <span class="info-box-number">{{$count_in_construction}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3" style="background-color: #841631;color: #fff">
              <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Entregue</span>
                <span class="info-box-number">{{$count_delivered}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Etapas adicionadas Recentemente</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  @foreach($stages as $stage)
                    <li class="item">
                      <div class="product-img">
                        @forelse($stage->images as $image)
                          @if($loop->first)
                            <img src="{{asset($image->path)}}" alt="Product Image" class="img-size-50">
                          @endif
                        @empty
                        @endforelse
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">{{$stage->title}}
                          <span class="badge float-right" style="background-color: #ffab17; color: #fff">{{$stage->year}}</span></a>
                        <span class="product-description">
                          {{$stage->property->name}}
                        </span>
                      </div>
                    </li>
                    <!-- /.item -->
                  @endforeach
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    <!-- </section> -->
@stop

@section('plugins.Select2', true)
@section('plugins.Chartjs', true)
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('css')
    <link rel="stylesheet" href="{{asset('css/app_person.css')}}">
@stop