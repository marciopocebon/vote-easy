<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

use App\Candidate;

use Auth;

class FetchController extends Controller
{
    public function fetchCourseView(){
        $admin = Auth::guard('admin')->user()->name;  
        $halls = ["Samuel Akande", "Queen Esther", "Nelson Mandela", "Bethel Splendor", "Kings Delight Hall", "Winslow", "Gideon Troopers", "Welch", "Crystal", "Platinum", "Marigold", "FAD", "Queen Esther", "Off-Campus", "All"];
        return view('fetch-view-course', [
            'admin'=>$admin,
            'halls'=>$halls
        ]);
    }

    public function fetchHall(Request $request){
        $hall = $request->hall == null ? '' : $request->hall;
        $students = Student::hall($request->hall)->get();
        $count = count($students);

        $data = $hall == '' ? 'All Halls' : $hall;

        $response = [
            'message' => "There are $count students from $data",
            'students'=>$students
        ];
        return response()->json($response);
    }

    public function fetchStudentView(){
        $admin = Auth::guard('admin')->user()->name;
        return view('fetch-view-student',[
            'admin'=>$admin
        ]);
    }

    public function fetchStudent(Request $request){
    	$student = Student::where('matric_no', $request->matricNumber)->first();
    	return response()->json($student);
    }

    /* Fetch Candidate */

    public function fetchCandidateView(){
        $admin = Auth::guard('admin')->user()->name;
        return view('fetch-candidates', [
            'admin'=>$admin
        ]);
    }

    public function fetchCandidate(Request $request){
        if($request->position == '' || $request->position=='All'){
            $position = null;
        }
        else{
            $position= $request->position;
        }

        if($request->course == '' || $request->course=='All'){
            $course = null;
        }
        else{
            $course = $request->course;
        }

        if($request->level == '' || $request->level=='All'){
            $level = null;
        }
        else{
           $level=$request->level;
        }

        if($request->hall == '' || $request->hall=='All'){
            $hall = null;
        }
        else{
           $hall=$request->hall;
        }

        if($request->floor == '' || $request->floor=='All'){
            $floor = null;
        }
        else{
           $floor=$request->floor;
        }

        return response()->json(Candidate::position($position)->course($course)->level($level)->hall($hall)->floor($floor)->get());
    }

}
