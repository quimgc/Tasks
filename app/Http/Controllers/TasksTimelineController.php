<?php

namespace App\Http\Controllers;

use App\TaskEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksTimelineController extends Controller
{


    public function index(){

        $tasks_events = TaskEvent::all()->reverse();
                return view('timeline', ['task_events'=> $tasks_events]);
    }
}
