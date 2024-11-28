@extends('admin.layouts.app')

@section('styles')
<style>
    .table th,
    .table td {
        padding: 8px;
        max-width: 200px; 
    }
</style>
@endsection

@section('title')
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<i class="bi bi-stickies"></i>
	</li>
	<li class="breadcrumb-item breadcrumb-active" aria-current="Sizes">Sizes</li>
</ol>
@endsection

@section('search-content')
<form action="" method="get">
	<div class="input-group">
		<input type="text" name="keyword" class="form-control" value="{{Request::get('keyword')}}" placeholder="Search">
		<button class="btn" type="submit">
			<i class="bi bi-search"></i>
		</button>
	</div>
</form>
@endsection

@section('content')
	<!-- Content wrapper start -->
	<div class="content-wrapper">

		<!-- Row start -->
		<div class="row gx-3">
			<div class="col-sm-12 col-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">View
							<button onclick="window.location.href='{{ route("sizes.index")}}'" style="margin-left: 32px; border: 1px solid; padding: 0px 10px; font-size: 16px; border-radius: 12px;">refesh</button>
						</div>
						<div>
							<a href="{{route('sizes.create')}}">
								<button type="button" class="w-40 btn btn-success btn-rounded" style="color: black;">New size</button>
							</a>
						</div>

					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table v-middle m-0">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Create At</th>
										<th>Update At</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@if ($sizes->isNotEmpty())
										@foreach ($sizes as $size)
										<tr>
											<td>
												<p>{{$size->id}}</p>
											</td>
											<td>
												<p>{{$size->name}}</p>
											</td>									
											<td>{{$size->created_at}}</td>
											<td>{{$size->updated_at}}</td>
											<td>
												<div class="actions">
													<div class="icon">
														<a href="{{ route('sizes.edit',$size->id)}}"><i class="bi bi-pencil-square"></i></a>
													</div>
													<div class="icon">
														<a href="#" onclick = "deleteSizes({{$size->id}})"><i class="bi bi-x-square" style="color: red"></i></a>
													</div>
												</div>
											</td>
										</tr>
										@endforeach
									@else
										<tr>
											<td colspan="6">Records not found</td>
										</tr>
									@endif

								</tbody>
							</table>
							<nav aria-label="Page Navigation" style="margin-top: 40px">
								{{ $sizes->links()}}
								
							</nav>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!-- Row end -->

	</div>
	<!-- Content wrapper end -->
@endsection

@section('customJs')
<script>
	function deleteSizes(id)
	{
		var url = '{{route("sizes.delete","ID")}}';
		var newUrl = url.replace("ID",id);
		if(confirm("Are you sure you want to delete"))
		{
			$.ajax({
				url: newUrl,
				type: 'delete',
				data: {},
				dataType: 'json',
				headers: {
            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        		},
				success: function(response) {
					$("button[type=submit]").prop('disabled', false);
					if (response["status"] == true) {
						alert("size deleted successfully");
						window.location.href="{{route('sizes.index')}}";
					}
					else
					{
						alert("size not found");
						window.location.href="{{route('sizes.index')}}";
					}
				}
			});


		}
	}

</script>

@endsection