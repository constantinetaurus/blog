<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // added manualy

use App\Http\Requests;		// added manualy 

use App\Post;

use Mail;					// added manualy

use Session;				

class PagesController extends Controller {

	public function getIndex() 
	{
		$posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
		return view('pages.welcome')->withPosts($posts);

	}

	public function getAbout() 
	{
		$first = 'Kostiantyn';
		$last  = 'Levchenko';
		$fullname  = $first . " " . $last;
		$email	   = 'constantinetaurus@gmail.com';

		$data['fullname'] = $fullname;
		$data['email'] 	  = $email;

		return view('pages.about')->withData($data);
	}

	public function getContact() 
	{
		return view('pages.contact');
	}

	public function postContact(Request $request) // we push (Request $request) into our function manualy so we can use Laravel buuilt in validation for a user postContact method ()
	{
		$this->validate($request, [
			'email' => 'required|email',
			'subject' => 'min:3',
			'message' => 'min:10'
		]);

		$data = array(
			'email'  => $request->email,
			'subject'  => $request->subject,
			'body_message'  => $request->message
		);

		// Mail::send('view', $data, function($message) use ($data){
		// 	to   .........
		// 	from .........
		//  subject ......
		//  reply_to .....
		//  ..............
		//  etc ..........
		// });

		Mail::send('emails.contact', $data, function($message)  use ($data){
			$message->from($data['email']);				 // users email
			$message->to('constantinetaurus@gmail.com'); // example
			$message->subject($data['subject']);
		});

		Session::flash('success', 'Your email was sent!');

		return redirect('/');
	}
}