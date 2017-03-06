<?php

namespace App\Http\Controllers;

use App\AudioMessage;
use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class AudioMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => [
            'getCategories', 'postCategories', 'getEditCategory', 'uploadAudioMessage'
        ]]);
    }

    public function getIndex()
    {
        //get all audio messages from the database and pass them to the view
        $audio_messages = AudioMessage::all();
        return view('store.index', ['audio_messages' => $audio_messages]);
    }

    public function getCategories()
    {
        //get all categories from the database and pass them to the view
        $categories = Category::all();
        return view('admin.categories', ['categories' => $categories]);
    }

    public function postCategories(Request $request)
    {
        $this->validate($request, [
           'category_name' => 'required|unique:categories|max:255'
        ]);

        //create category in the database
        $category = new Category();
        $category->create([
            'category_name' => $request->category_name
        ]);
        flash('Category has been created successfully', 'success');
        return back();
    }

    public function getEditCategory(Category $category)
    {
        return view('admin.edit_category_modal', ['category' => $category]);
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        flash('Category Deleted successfully', 'success');
        return back();
    }


    public function uploadAudioMessage(Request $request)
    {
//            dd($request->file('image_file'));
//            dd($request);
        //validate request variables
        $this->validate($request,
            [
                'title' => 'required|unique:audio_messages|max:255',
                'category_name' => 'required|max:255',
                'minister' => 'required|max:255',
                'price' => 'required|max:255',
                'audio_file' => 'required'
            ]);

        //get the post request for the files
        if($request->hasFile('audio_file'))
        {
            global $image_file;
            global $image_name;
            global $image_path;
            if($request->hasFile('image_file'))
            {
                $image_file = $request->image_file;
                $image_name = uniqid().$image_file->getClientOriginalName();
                $image_file->move('images', $image_name);
                //
                $image_path = 'images/'.$image_name;
                $image_size = $image_file->getClientSize();
            }
            else
            {
                $image_path = null;
                $image_size = null;
            }

            $audio_file = $request->audio_file;
            $audio_name = uniqid().$audio_file->getClientOriginalName();
            $audio_path = 'audio/'.$audio_name;
            $audio_size = $audio_file->getClientSize();

            //set the file variables



            //move files to their correct location

            $audio_file->move('audio', $audio_name);

            //save file in database
            $audio_msg = new AudioMessage(
                [
                    'title' => $request->title,
                    'image_path' => $image_path,
                    'image_size' => $image_size,
                    'image_name' => $image_name,
                    'audio_path' => $audio_path,
                    'audio_size' => $audio_size,
                    'audio_name' => $audio_name,
                    'minister' => $request->minister,
                    'price' => $request->price,
                    'category_name' => $request->category_name
                ]
            );
            if($audio_msg->save())
                flash('Audio File Uploaded Successfully', 'success');
            else
                flash('Audio File Upload Failed', 'danger');
        }
        return back();
    }

    public function deleteAudioMessage(AudioMessage $audio_message)
    {
        $audio_message->delete();
        flash('Audio File Deleted Successfully', 'success');
        return back();
    }
}
