@extends('adminlte::page')

@section('title', 'Detalhes do Empreendimento')

@section('content_header')
  <h1><a href="{{route('admin.properties')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a> Detalhes do Empreendimento: {{ $property->name }}</h1>
@stop

@section('content')
	<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detalhes Cadastrados</h3>

          <div class="mb-2">
            <div class="float-right">
              <div class="btn-group" style="color:">
                <a href="{{url('/admin/create_detail/'. $property_id)}}" class="btn btn-primary" style="color:#fff"> Cadastrar Detalhe </a>
              </div>
            </div>
          </div>
        </div>	
        <div class="card-body">
					<div class="table-responsive">
            <table class="table border table-hover" id="properties-table">
              <thead align="center">
                <tr>
                  <td width="50%">Descrição</td>
                    <td width="15%">Ações</td>
                  </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


@stop

@section('plugins.Datatables', true)

@section('css')
    <link rel="stylesheet" href="{{asset('css/app_person.css')}}">
@stop

@section('js')


	<script>
		 $(function () {
      $('#properties-table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "ajax": {
          url: "{{ route('admin.detail/',['property_id' => $property_id]) }}",
        },
        "columns":[
          {
            "className": "text-center",
            "data": "description",
            "name": 'description',
          },
          {
            "className": "text-center",
            "data": "action",
            "name": 'action',
          }
        ]
    	});
    });
	</script>
@stop