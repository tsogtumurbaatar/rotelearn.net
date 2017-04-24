@extends('layouts.app')

@section('content')

<div id="contact" class="content-section-a">
	<div class="container">
		<div class="row">

			<div class="container question" style="margin-top: 60px;">
				<div class="col-md-2"></div>
				<div class="col-md-8">
These 200 common phrasal verbs are taken from <b><a style="color:Teal" href="https://www.englishclub.com/vocabulary/phrasal-verbs-list.htm">www.englishclub.com</a></b>, you can visit this site and get full information of phrasal verbs. And all the phrasal verb credits are belong to <b><a style="color:Teal" href="https://www.englishclub.com/">www.englishclub.com</a></b><br> <br>

					<form role="form" action="{{url('/list')}}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-xs-10 form-group">
								<div class="input-group">
									<input type="text" class="form-control" name="search" id="InputName" placeholder="Search" @if(! empty($search)) value="{{$search}}" @endif >
									<span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
								</div>
							</div>
							<div class="col-xs-2 form-group">
								<input type="submit" name="submit" id="submit" value="Search" class="btn wow tada btn-embossed btn-primary pull-right">
							</div>
						</div>
					</form>	

					<div class="table-responsive">
						<table class="table">
							<tr>
								<th>ID</th>
								<th>Verb</th>
								<th>Meaning</th>
								<th>Example sentence</th>
							</tr>
							@foreach($verbs as $verb)
							<tr>
								<td>{{$verb->id}}</td>
								<td>{{$verb->verb}}</td>
								<td>{{$verb->verb_desc}}</td>
								<td>{{$verb->verb_example}}</td>
							</tr>
							@endforeach

						</table>
						{{$verbs->links()}}
					</div> 

				</div>

				<div class="col-md-2"></div>
			</div>
		</div>
	</div>
</div>

@endsection

