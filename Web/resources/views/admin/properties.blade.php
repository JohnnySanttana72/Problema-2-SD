@extends('adminlte::page')

@section('title', 'Empreendimentos')

@section('content_header')
    <h1>Empreendimentos</h1>
@stop

@section('content')
	<div class="row">
        <div class="col-12">
        	<div class="card">
        		<div class="card-header">
	            	<h3 class="card-title">Empreendimentos Cadastrados</h3>

		        	<div class="mb-2">
			            <div class="float-right">
			              <div class="btn-group" style="color:">
			                <a href="{{url('/admin/create_property')}}" class="btn btn-primary" style="color:#fff"> Cadastrar Empreendimento </a>
			              </div>
			            </div>
			          </div>
		            </div>	
	            <div class="card-body">
					<div class="table-responsive">
			          <table class="table border table-hover" id="properties-table">
			            <thead align="center">
			              <tr>
			                <td width="13%">Imagem</td>
			                <td width="5%">Nome</td>
			                <td width="10%">Status</td>
			                <td width="5%">Preço</td>
			                <td width="21%">Endereço</td>
			                <td width="36%">Ações</td>
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
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "ajax": {
			    url: "{{ route('admin.properties') }}",
			  },
		"columns":[
			{
				"data": "image",
				"name": 'imagem',
				"orderable": false,
			},
			{
				"data": "name",
				"name": 'name',
			},
			{
				"className": "text-center",
				"data": "status",
				"name": 'status',
			},
			{
				"data": "price",
				"name": 'price',
			},
			{
				"data": "address",
				"name": 'address',
			},
			{
        "className": "text-center",
				"data": "action",
				"name": 'action',
				"orderable": false,
			}
		]
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
	<script src="{{asset('js/owl.carousel.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
		$('.owl-carousel').owlCarousel({
		    items:4,
		    lazyLoad:true,
		    loop:true,
		    margin:10
		});
	</script>
@stop