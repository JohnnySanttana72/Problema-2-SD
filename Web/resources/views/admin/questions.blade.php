@extends('adminlte::page')

@section('title', 'Dúvidas Frequentes')

@section('content_header')
    <h1>Dúvidas Frequentes</h1>
@stop

@section('content')
	<div class="row">
        <div class="col-12">
        	<div class="card">
        		<div class="card-header">
	            	<h3 class="card-title">Dúvidas Cadastradas</h3>

		        	<div class="mb-2">
			            <div class="float-right">
			              <div class="btn-group" style="color:">
			                <a href="{{url('/admin/create_question')}}" class="btn btn-primary" style="color:#fff"> Cadastrar Dúvida </a>
			              </div>
			            </div>
			          </div>
		            </div>	
	            <div class="card-body">
					<div class="table-responsive">
			          <table class="table border table-hover" id="properties-table">
			            <thead align="center">
			              <tr>
			                <td width="20%">Título</td>
                      <td width="50%">Resposta</td>
			                <td width="20%">Ações</td>
			              </tr>
			            </thead>
			          </table>
			        </div>
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
			    url: "{{ route('admin.questions') }}",
			  },
		"columns":[
			{
				"data": "title",
				"name": 'title',
			},
			{
        "className": "text-center",
				"data": "response",
				"name": 'response',
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