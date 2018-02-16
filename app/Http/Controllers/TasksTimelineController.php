<?php

namespace App\Http\Controllers;

use App\TaskEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class TasksTimelineController extends Controller
{


    public function index(){

        $tasks_events = TaskEvent::all();

            return view('timeline', ['task_events'=> $tasks_events]);

    }
}
