@extends('layouts.app')

@section('content')

 <div id="contact" class="content-section-a">
		<div class="container">
			<div class="row">
			
			<div class="col-md-6 col-md-offset-3 text-center wrap_title">
				<h2>Quiz</h2>
				<p class="lead" style="margin-top:0">Let's learn pharsal verbs by new way.</p>
			</div>
			
			<form role="form" action="{{url('/quiz')}}" method="post" >
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input id="jsval1" name="jsval1" type="hidden">
			<input id="jsval2" name="jsval2" type="hidden">
		
			
				<div class="col-md-6">
					<div class="form-group">
						<label for="InputName">Quiz type : </label>
						<div class="input-group">
							<select class="form-control" name="quiztype">
							<option value="1" selected="">Quiz by pharsal verbs</option>
							<option value="2">Quiz by meaninigs</option>
							</select>
							<span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
						</div>
					</div>
					<div class="form-group">
						<label for="InputName">Quiz difficulty level : </label>
						<br><br><br>

						<div class="slider" id="slider"></div>	
					
					<br><br>

						
					</div>
					<div class="form-group">
						<label for="InputName">Quiz count : </label>
						<div class="input-group">
							<select class="form-control" name="quiznumbers">
							<option value="5" selected>5</option>
							<option value="10" >10</option>
							<option value="20" >20</option>
							<option value="30" >30</option>
							<option value="50" >50</option>
							
							</select>
							<span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
						</div>
					</div>
					
					<input type="submit" name="submit" id="submit" value="Start the quiz" class="btn wow tada btn-embossed btn-primary pull-right">
				</div>
			</form>
			
			<hr class="featurette-divider hidden-lg">
				<div class="col-md-5 col-md-push-1 address">
					
					<h3>The most common pharsal verbs </h3>
					<p class="lead">
					by www.englishclub.com</p>
					<p class="lead">
					By Quiz difficulty level you can set the range of Pharsal verbs. For example: 10 - 30 this means the quiz will pick pharsal verbs starting from 10th and ending to 30th.    
					</p>
					<p class="lead">
					If you register to the website, you can track your achievements and it is useful to learn the pharasel verbs easily - <b><a style="color:Teal" href="{{ url('/register') }}">Register</a></b></p>

					<h3>It's All Free</h3>
				

				
				</div>
			</div>
		</div>
	</div>

@endsection
