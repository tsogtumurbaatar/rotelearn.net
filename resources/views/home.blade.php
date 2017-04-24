@extends('layouts.app')

@section('content')

<div id="contact" class="content-section-a">
    <div class="container">
        <div class="row">

            <div class="container question" style="margin-top: 10px;">
                <div class="col-md-2"></div>
                <div class="col-md-8">

        <h3>My achievements</h3>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Quiz type</th>
                                <th>Quiz difficulty level</th>
                                <th>Quiz count</th>
                             
                                <th>Percentage</th>
                                <th>Date</th>
                            </tr>
                            @foreach($scores as $score)
                            <tr>
                                <td>{{$score->quiz_type}}</td>
                                <td>{{$score->verb_numbers}}</td>
                                <td>{{$score->quiz_numbers}}</td>
                           
                                <td>{{$score->percentage}}%</td>
                                <td>{{$score->created_at}}</td>
                            </tr>
                            @endforeach

                        </table>
                        {{$scores->links()}}
                    </div>         


                </div>

                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</div>

@endsection

