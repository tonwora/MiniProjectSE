<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\Course;
use App\Models\post;
use App\Models\Student;
use App\Models\TA;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function create(Request $request){
        $course = new course;
        $course->course_code = $request->id;
        $course->course_name = $request->name;
        $course->course_term = $request->term;
        $course->course_info = $request->info;
        $course->course_year = $request->year;
        $course->teacher_id = $request->user_id;
        $course->save();

        return redirect()->route('dashboard');
    }

    public function delete($id){
        // ลบข้อมูลที่เกี่ยวข้องก่อนจากตารางอื่น ๆ
        Student::where('course_id', $id)->delete();
        TA::where('course_id', $id)->delete();
        Post::where('course_id', $id)->delete();

        // ลบข้อมูลจากตาราง course
        Course::find($id)->delete();

        return redirect()->back();
    }


    public function editform($id){
        $course = course::where("id",$id)->get();
        return redirect()->route('dashboard');
    }

    public function courseDetail($id){
        $course = course::where("id",$id)->get();
        $students = Student::all();
        $allCourse = Course::all();
        $ta = TA::all();
        $users = User::all();
        $posts = post::where('course_id',$id)->get();
        $comments = comment::all();
        return view('CourseDetail',compact('course','students','allCourse','ta','posts','users','comments'));
    }

    public function courseclasswork($id){
        $course = course::where("id",$id)->get();
        $students = Student::all();
        $allCourse = Course::all();
        $ta = TA::all();
        return view('CourseClasswork',compact('course','students','allCourse','ta'));
    }

    public function coursePeople($id){
        $course = course::where("id",$id)->get();
        $students = Student::all();
        $allCourse = Course::all();
        $ta = TA::all();
        return view('CoursePeople',compact('course','students','allCourse','ta'));
    }

    public function courseEdit(Request $request){
        course::where('id', $request->id)->update([
            'course_code' => $request->code,
            'course_name' => $request->name,
            'course_info' => $request->info,
            'course_term' => $request->term,
            'course_year' => $request->year,
        ]);
        return redirect()->back();
    }

    public function Addstd(Request $request){
        $std = new Student;
        $std->stdcode = $request->id;
        $std->name = $request->name;
        $std->email = $request->email;
        $std->course_id = $request->course_id;
        $std->save();

        return redirect()->back();
    }

    public function EditStd(Request $request){
        Student::where('stdcode', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->back();
    }

    public function DelStd($id){
        $std = Student::where('id',$id);
        $std->delete();
        return redirect()->back();
    }

    public function AddTA(Request $request){
        $ta = new TA;
        $ta->name = $request->name;
        $ta->email = $request->email;
        $ta->course_id = $request->course_id;
        $ta->save();

        return redirect()->back();
    }

    public function EditTA(Request $request){
        TA::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->back();
    }

    public function DelTA($id){
        $ta = TA::where('id',$id);
        $ta->delete();
        return redirect()->back();
    }

    public function AddPost(Request $request){
        $new_post = new post;
        $new_post->course_id = $request->course;
        $new_post->user_id = $request->user;
        $new_post->post_info = $request->info;
        $new_post->save();
        return redirect()->back();
    }

    public function EditPost(Request $request){
        post::where('id', $request->id)->update([
            'post_info' => $request->info,
        ]);
        return redirect()->back();
    }
    public function DelPost($id){
        $post = post::where('id', $id);
        comment::where('post_id',$id)->forcedelete();
        $post->delete();
        return redirect()->back();
    }

    public function AddComment(Request $request){
        $new_comment = new comment;
        $new_comment->post_id = $request->post;
        $new_comment->user_id = $request->user;
        $new_comment->comment_info = $request->info;
        $new_comment->save();
        return redirect()->back();
    }

    public function EditComment(Request $request){
        comment::where('id', $request->id)->update([
            'comment_info' => $request->info,
        ]);
        return redirect()->back();
    }
    public function DelComment($id){
        $comment = comment::where('id', $id);
        $comment->delete();
        return redirect()->back();
    }
}
