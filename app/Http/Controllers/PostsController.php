<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use App\Tag;
use Session;
use Purifier;

use Image;
use Storage;

class PostsController extends Controller
{
    /**
     * lock down the PostsController. For authorized users only.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //create a variable and store all the blog posts in it from the database
        $posts = Post::orderBy('id', 'desc')->paginate(3);

        //return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // grab all categories
        $categories = Category::all();
        // grab all tags
        $tags = Tag::all();

        // return view with the form
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request); // laravel function does the same as var_dump($request)

        // validate the data
        $this->validate($request, array(
                'title' => 'required|max:255',
                'slug'  => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id' => 'required|integer',
                'body' => 'required',
                'featured_image' => 'sometimes|image'
            ));

        // store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body); // clean the malicious code

        // by the way: $request->body OR $request->input('body') ARE THE SAME FUNCTIONS BUT JUST A LONGER/SHORTER WAY {USE WHATEVER YOU LIKE MORE}

        // save the image
        if($request->hasFile('featured_image')) {
            //grab the file out of the request
            $image = $request->file('featured_image');
            //rename file to make it unique (timestamp + extension)
            $filename = time() . '.' . $image->getClientOriginalExtension();
            //set up a location to store the file
            $location = public_path('images/' . $filename);
            //save file with Image helper 'Intervention Image' plugin is used here
            Image::make($image)->resize(800, 400)->save($location);
            //save the filename to the database column ()
            //filename in database column will prob look like ~ 1234543456.jpg 
            $post->image = $filename;
        }

        $post->save();

        // goes after save() function. insert rows to the post_tag table
        $post->tags()->sync($request->tags, false);


        //push the flash message to a user
        Session::flash('success', 'The blog post was successfully saved!');

        // redirect to another page
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post in the database and save as a variable
        $post = Post::find($id);

        //grab all categories
        $categories = Category::all();
        $cats = array();

        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        //grab all tags
        $tags = Tag::all();
        $tgs = array();

        foreach ($tags as $tag) {
            $tgs[$tag->id] = $tag->name;
        }

        //return the view and pass in the variables we previously created
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tgs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the data before we use it
        $post = Post::find($id);
            
        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug'  => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'category_id' => 'required|integer',
            'body'  => 'required',
            'featured_image' => 'image'
        ));      

        // Save the data to the database
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->input('body')); // clean the malicious code the might be pasted by user (like <script>...</script>)

        if ($request->hasFile('featured_image')) {
            
            // Add the new image
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            //grab the old filename to delete it
            $oldFilename = $post->image;

            // Update the database
            $post->image = $filename;

            // Delete the old image
            Storage::delete($oldFilename);
        }

        $post->save();

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags, true); // true - override relationsips (delete the old ones and push the new ones from the request)
        } else {
            $post->tags()->sync(array(), true);
        }

        // Set flash data with 'success' message
        Session::flash('success', 'This post was successfully updated!');

        // Redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->tags()->detach(); // detach() function deletes all the rows with the currect $post related to the post_tag table

        Storage::delete($post->image);

        $post->delete();

        Session::flash('success', 'The post was successfully deleted!');

        return redirect()->route('posts.index');
    }
}
