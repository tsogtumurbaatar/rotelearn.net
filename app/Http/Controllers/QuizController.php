<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;


class QuizController extends Controller
{

	function randomGen($min, $max, $quantity) {
		$numbers = range($min, $max);
		shuffle($numbers);
		return array_slice($numbers, 0, $quantity);
	}

	public function verblist()
	{
		$search = \Request::get('search');

		if ($search <> '')
		{
			$verbs = DB::table('verbs')
			->where('verb','like','%'.$search.'%')
			->orwhere('verb_desc','like','%'.$search.'%')
			->orderby('id')
			->paginate(25)
			->appends(['search' => $search]);
		}
		else
		{
			$verbs = DB::table('verbs')
			->orderby('id')
			->paginate(25);

		}

		return view('list',[
			'verbs' =>$verbs,
			'search' => $search
			]);

	}

	public function index(Request $request)
	{
		if($request['jsval1'] != "")
			$jsval1 = $request['jsval1'];
		else
			$jsval1 = 0;
		
		if($request['jsval2'] != "")
			$jsval2 = $request['jsval2'];
		else
			$jsval2 = 25;

		
		
		$input_quiz_count = $request['quiznumbers'];
		$input_quiz_type = $request['quiztype'];

		if(($jsval2 - $jsval1) < $input_quiz_count)
			$input_quiz_count = 10;			

		$verbs = DB::table('verbs')
		->where([
			['id','<=',$jsval2],
			['id','>',$jsval1]			
			])		
		->inRandomOrder()
		->get();
		

		$verbs_count = $jsval2 - $jsval1;


		$verbs_ids = "";
		$counter_tmp = 0;
		foreach ($verbs as $verb) {
			$counter_tmp ++;
			if($counter_tmp == 1)
				$verbs_ids = $verb->id;
			else
				$verbs_ids = $verbs_ids.",".$verb->id;
			if($counter_tmp == $input_quiz_count) break;
		}	
		
		$quizs =array();
		$val = array();

		for($i=0;$i<$input_quiz_count;$i++)
		{
			$val=$this->randomGen(0,$verbs_count-1,4);
			if(!(($val[0] == $i) or ($val[1] == $i) or ($val[2] == $i) or ($val[3] == $i)))
			{
				$val[0] = $i;
				shuffle($val);
			} 

			$answer = 0;
			if($val[0] == $i) $answer = 1;
			if($val[1] == $i) $answer = 2;
			if($val[2] == $i) $answer = 3;
			if($val[3] == $i) $answer = 4;
			
			if($input_quiz_type == 1)
			{
				$quizs[$i]['question'] = $verbs[$i]->verb;
				$quizs[$i]['option1'] = $verbs[$val[0]]->verb_desc;
				$quizs[$i]['option2'] = $verbs[$val[1]]->verb_desc;
				$quizs[$i]['option3'] = $verbs[$val[2]]->verb_desc;
				$quizs[$i]['option4'] = $verbs[$val[3]]->verb_desc;
			}
			else
			{
				$quizs[$i]['question'] = $verbs[$i]->verb_desc;
				$quizs[$i]['option1'] = $verbs[$val[0]]->verb;
				$quizs[$i]['option2'] = $verbs[$val[1]]->verb;
				$quizs[$i]['option3'] = $verbs[$val[2]]->verb;
				$quizs[$i]['option4'] = $verbs[$val[3]]->verb;
			}

			$quizs[$i]['answer'] = $answer;
			$quizs[$i]['id'] = $verbs[$i]->verb_example;
		}

		return view('quiz',[
			'verbs_ids' => $verbs_ids,
			'quizs' => $quizs,
			'quiz_count' => $input_quiz_count,
			'verbs_count' => $verbs_count,
			'quiz_type' => $input_quiz_type
			]);
	}

	public function result(Request $request)
	{

		$val = array();
		$answer = array();
		$string ="";
		$counter = 0;

		$quiz_count = $request['quiz_count'];
		$quiz_type = $request['quiz_type'];
		$verbs_count = $request['verbs_count'];
		$verbs_ids = $request['verbs_ids'];

		$verbs_ids = explode(",", $verbs_ids);

		for($i=0;$i<$quiz_count;$i++)
		{
			$val[$i] = $request['radio'.$i];
			$answer[$i] = $request['hidden'.$i];

			if($val[$i]==$answer[$i])
			{
				$string = $string.($i+1). ". correct <i class='glyphicon glyphicon-ok text-primary'></i> </br>";
				$counter++;	
			}
			else
			{
				
				$verb = DB::table('verbs')
				->where('id', $verbs_ids[$i])
				->first();	
				
				$string = $string.($i+1). ". not correct <i class='glyphicon glyphicon-remove text-danger'></i></br>";
				
				if($quiz_type == 1)
					$string = $string."&nbsp;&nbsp;&nbsp;(".$verb->verb.") => ".$verb->verb_desc."</br>";
				else
					$string = $string."&nbsp;&nbsp;&nbsp;(".$verb->verb_desc.") => ".$verb->verb."</br>";				
			}
		}

		if (Auth::check()) {
			if($quiz_type == 1) $quiz_type = "Quiz by pharsal verbs";
			else $quiz_type = "Quiz by meaninigs";


			DB::table('users_score')
			->insert([
				'user_id' => Auth::user()->id,
				'quiz_type' => $quiz_type,
				'verb_numbers' => $verbs_count,
				'quiz_numbers' => $quiz_count,
				'correct_answer' => $counter,
				'percentage' => (string)($counter* 100 / $quiz_count),
				'created_at' => date('Y-m-d H:i:s')
				]);
		}
		else
		{
			if($quiz_type == 1) $quiz_type = "Quiz by pharsal verbs";
			else $quiz_type = "Quiz by meaninigs";


			DB::table('users_score')
			->insert([
				'user_id' => 9999,
				'quiz_type' => $quiz_type,
				'verb_numbers' => $verbs_count,
				'quiz_numbers' => $quiz_count,
				'correct_answer' => $counter,
				'percentage' => (string)($counter* 100 / $quiz_count),
				'created_at' => date('Y-m-d H:i:s')
				]);
		}

		return view('result',[
			'string' => $string,
			'counter' => $counter,
			'quiz_count' => $quiz_count,
			'quiz_type' => $quiz_type,
			'verbs_count' => $verbs_count
			]);
	}

}

