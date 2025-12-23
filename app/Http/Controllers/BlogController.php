<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Storage;
use App\Jobs\SendBlogNotifications;
use Illuminate\Support\Str; // Make sure to include this at the top of your file

use Illuminate\Http\Request;

class BlogController extends Controller
{
     public function IndexOfBlogs(){

      $blogs=Blog::orderBy('created_at', 'desc')->get();

      return view('backoffice.blog.index_blog')->with('blogs', $blogs);
    }//endmethod


      public function AddBlog(){


        $blog_cats = Category::all();


        return view('backoffice.blog.add_blog', compact('blog_cats'));

    }//endmethod




    public function StoreBlog(Request $request){

     $validateData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        
        // Create directory if it doesn't exist
        $upload_path = public_path('upload/blog_image');
        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        // Move the uploaded file
        $image->move($upload_path, $name_gen);
        $save_url = 'upload/blog_image/' . $name_gen;

        $blog = new Blog();
        $blog->name = $request->name;
        $blog->description = $request->description;
        $blog->author = $request->author;
        $blog->blog_category_id = $request->category;
        $blog->image = $save_url;
        $blog->slug = Str::slug($request->name);
        $blog->save();

        // Dispatch the job to send notifications
        SendBlogNotifications::dispatch($blog);

        $notification = [
            'message' => 'Blog with Image has been Created Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('index.blog')->with($notification);
    } else {
        $blog = new Blog();
        $blog->name = $request->name;
        $blog->description = $request->description;
        $blog->author = $request->author;
        $blog->blog_category_id = $request->category;
        $blog->slug = Str::slug($request->name);
        $blog->save();

        // Dispatch the job to send notifications
        SendBlogNotifications::dispatch($blog);

        $notification = [
            'message' => 'Blog without Image has been Created Successfully',
            'alert-type' => 'warning'
        ];

        return redirect()->route('index.blog')->with($notification);
    }


    }//endmethod

     public function EditBlog($id){
     $blog_cats = Category::all();

     $blog=Blog::findOrfail($id);

     return view('backoffice.blog.edit_blog', compact('blog', 'blog_cats'));

    }//endmethod


    public function UpdateBlog(Request $request){

       $blog_id = $request->id;

       $validateData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($request->hasFile('image')) {
        // Delete old image if exists
        $blog = Blog::findOrFail($blog_id);
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        
        // Create directory if it doesn't exist
        $upload_path = public_path('upload/blog_image');
        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        // Move the uploaded file
        $image->move($upload_path, $name_gen);
        $save_url = 'upload/blog_image/' . $name_gen;

        Blog::findOrFail($blog_id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $save_url,
            'author' => $request->author,
            'blog_category_id' => $request->category,
        ]);

        $notification = [
            'message' => 'Blog Post With Image has been Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('index.blog')->with($notification);
    } else {
        Blog::findOrFail($blog_id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'author' => $request->author,
            'blog_category_id' => $request->category,
        ]);

        $notification = [
            'message' => 'Blog Post without an Image has been Updated Successfully',
            'alert-type' => 'warning'
        ];

        return redirect()->route('index.blog')->with($notification);
    }


    }//endmethod


    public function DeleteBlog($id){

        Blog::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);

}//endmethod



//frontend


 public function ShowBlog($slug){

        $blog=blog::where('slug', $slug)->firstOrFail();
        $blog_posts=blog::get();
        $blogcats = Category::get();
    // $blogcategory=blogCategory::where('slug', $slug)->firstOrFail();

     // $post = Post::find($id);
        $previous = blog::where('slug', '<', $blog->slug)->max('slug');
        $next = blog::where('slug', '>', $blog->slug)->min('slug');
    // return view( 'post', compact( 'post', 'next', 'previous' ));



        return view('frontend.blog.blog_details')->with('blog', $blog)->with('blog_posts', $blog_posts)->with('blogcats', $blogcats)->with('previous', $previous)->with('next', $next);

    }//endmethod

    public function IndexOfClientBlogs(){

        $blogs=blog::get();
        $blogs = Blog::latest()->paginate(9); // Show 9 blogs per page
    return view('frontend.blog.blogs', compact('blogs'));
        

    }//endmethod

    public function getRelatedBlogs($id)
{
    try {
        $currentBlog = Blog::findOrFail($id);
        
        // Get blogs with similar tags or in the same category
        // Adjust this query based on your blog structure
        $relatedBlogs = Blog::where('id', '!=', $id)
            ->latest()
            ->take(2)
            ->get();

        return response()->json([
            'status' => 200,
            'blogs' => $relatedBlogs
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 500,
            'error' => 'Error fetching related blogs'
        ]);
    }//endmethod

}

    public function getLatestBlogs()
{
    try {
        $latestBlogs = Blog::latest()
                          ->take(4)  // Get latest 4 blogs
                          ->get();

        return response()->json([
            'status' => 200,
            'blogs' => $latestBlogs
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 500,
            'error' => 'Error fetching latest blogs'
        ]);
    }
}//endmethod



}
