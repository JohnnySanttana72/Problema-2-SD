@extends('adminlte::page')

@section('title', 'Etapas')

@section('content_header')
    <h1><a href="{{route('admin.properties')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a> Etapas do Empreendimento {{$property->name}}</h1>
@stop

@section('content')
	<div class="row">
        <div class="col-12">
        	<div class="card">
        		<div class="card-header">
	            	<h3 class="card-title">Etapas Cadastradas</h3>

		        	<div class="mb-2">
			            <div class="float-right">
			              <div class="btn-group" style="color:">
			                <a href="{{route('admin.create_month', ['property_id' => $property->id])}}" class="btn btn-primary" style="color:#fff"> Cadastrar Etapa </a>
			              </div>
			            </div>
			          </div>
		            </div>	
	            <div class="card-body">
					<div class="table-responsive">
			          <table class="table border table-hover" id="stage-table">
			            <thead align="center">
			              <tr>
			                <td width="18%">Imagens</td>
			                <td width="6%">Título</td>
			                <td width="27%">Descrição</td>
			                <td width="5%">Porcentagem</td>
			                <td width="4%">Ano</td>
			                <td width="30%">Ações</td>
			              </tr>
			            </thead>
			          </table>
			        </div>
			      </div>
				</div>
			</div>
		</div>
	</div>

	<div class="slideshow">
		<!-- <div class="slide-demo">
			<img src="https://picsum.photos/3142/1834" />
		</div> -->
	</div>


@stop

@section('plugins.Datatables', true)

@section('css')
    <link rel="stylesheet" href="{{asset('css/app_person.css')}}">
@stop

@section('js')
<script type="text/javascript" src="{{asset('js/loopit.js')}}"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<script>
		$(function () {
		    $('#stage-table').DataTable({
		      "paging": true,
		      "lengthChange": false,
		      "searching": true,
		      "ordering": true,
		      "info": true,
		      "autoWidth": false,
		      "ajax": {
					url: window.location.href,
				},
				"columns":[
					{
						"className": "text-center",
						"data": "image",
						"name": 'imagem',
						"orderable": false,
					},
					{
						"className": "text-center",
						"data": "title",
						"name": 'title',
					},
					{
						"data": "description",
						"name": 'description',
					},
					{
						"className": "text-center",
						"data": "percentage",
						"name": 'percentage',
					},
					{
						"className": "text-center",
						"data": "year",
						"name": 'year',
					},
					{
						"data": "action",
						"name": 'action',
						"orderable": false,
					}
				]
		    	});

		  });

		$(function() {
		  $(".slide-demo").loopItNow({
		    vertical:false, // vertical or horizontal
		    speed : 2000, // animation speed
		    effect:'easeInExpo', // easing options
		    captionTop:true,
		    captionBottom:true,
		    textbar: false
		  });     
		});
		// $(function() {
		// 	$('#properties-table').Datatable({
		// 	  "processing": true,
		// 	  "serverSide": true,
		// 	  "ajax": {
		// 	    url: "{{ route('admin.properties') }}",
		// 	  },
		// 	  "columns":[
		// 	    {
		// 	        data:'imagem',
		// 	        name: 'imagem',
		// 	        // render: function(data, type, full, meta){
		// 	        //     return "<img src={{URL::to('/')}}/imagens/" + data + "width='70' class='img-thumbnail' />"
		// 	        // },
		// 	        orderable: false,
		// 	    },
		// 	    {
		// 	      	className: "text-left",
		// 	        data: 'name', 
		// 	        name: 'name'
		// 	    },
		// 	    {
		// 	        data: 'status', 
		// 	        name: 'status'
		// 	    },
		// 	    {
		// 	        className: "text-center",
		// 	        data: 'price', 
		// 	        name: 'price'
		// 	    },
		// 	    {
		// 	        data: 'address', 
		// 	        name: 'address',
		// 	        orderable: false
		// 	    }
		// 	  ]
		// 	});
		// });
	</script>
	

	<script type="text/javascript">
		
	</script>
@stop