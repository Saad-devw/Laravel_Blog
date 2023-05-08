<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //order by || where condition
        /**
         * $posts = Post::orderBy('title')->get();
         * $posts = Post::where('title', 'Hello world')->get();
         */

        // using sql command
         /**
          * $posts = DB::select('SELECT * FROM posts');
          */
        
        // Limit 
        /**
         * $posts = Post::orderBy('title')-> take()-> get();  
         */  

        $posts = Post::orderBy('created_at', 'desc')-> paginate(9);
        //$posts = Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'Required',
            'file' => 'file|nullable|max:100000'
        ]);

        if($request->hasFile('file'))
        {
            //get file name
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            //get just file name*
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get extention
            $fileNameExtension = $request->file('file')->getClientOriginalExtension();
            //get file to store
            $fileToStore = $fileName. time() .'.'. $fileNameExtension;
            //upload image
            $path = $request->file('file')->storeAs('public/files', $fileToStore);
        }
        else{
            $fileToStore = 'noImage.jpg';
        }

        //Create post
        $post = new Post;
        $post -> title = $request->input('title');
        $post -> body ='';
        $post->user_id = auth()->user()->id;
        $post -> file =  $fileToStore;
        $post -> save();

        return redirect('/posts')->with('success', 'Fichier Créer avec Succès');
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
        return view('posts.post')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id == $post -> user_id){
            return view('posts.edit')->with('post', $post);
        }
        else{
            return redirect('/posts')->with('error', "Vous n'avez pas L'authorisation d'accédez a cette page!");
        }
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
        $this->validate($request, [
            'title' => 'Required',
        ]);

        if($request->hasFile('file'))
        {
            //get file name
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            //get just file name*
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get extention
            $fileNameExtension = $request->file('file')->getClientOriginalExtension();
            //get file to store
            $fileToStore = $fileName. time() .'.'. $fileNameExtension;
            //upload image
            $path = $request->file('file')->storeAs('public/files', $fileToStore);
        }

        //Create post
        $post = Post::find($id);
        $post -> title = $request->input('title');
        $post -> body = '';
        if($request->hasFile('file'))
        {
            $post -> file = $fileToStore;
        }
        $post -> save();

        return redirect('/posts')->with('success', 'Fichier Modifié avec Succès');
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
        if(auth()->user()->id !== $post -> user_id){
            return redirect('/posts')->with('error', "Vous n'avez pas L'authorisation d'accédez a cette page!");
        }
          
        $post->delete();
        if($post -> cover_image != 'noimage.jpg'){
            Storage::delete('public/storage/files/'.$post->cover_image);
        }
        return redirect('/posts')->with('success', 'Fichier Supprimé avec succès');
    }

    public function search(Request $request){
        if($request->ajax()){
            $query = $request->get('query');
            if($query != ''){
                $data = DB::table('posts')
                        ->where('title', 'like', '%'.$query.'%')
                        ->orderBy('id','asc')->get();
            }
            else{
                $data = DB::table('posts')->orderBy('id','asc')->get();
            }

            $total_row = $data->count();
            $output='';
            if($total_row > 0){
                foreach($data as $row){
                    $output .= '
                        <a href="/storage/files/'. $row->file . '" download="'. $row->file . '" class="col-sm-3 m-2 border shadow-sm">
                            <div class="col-sm-12">
                                <img src="./assets/images/download.jpg" alt="'.$row-> title.'" width="100%">
                            </div>
                            <div class="col-sm-12">
                                <div class="text-center">
                                    <h3>'.$row -> title .'</h3>
                                    <small class="text-right">Créé Le: '. $row -> created_at .' Par '. $row->user->name .' </small>
                                </div>
                            </div>
                        </a>
                    ';
                }
            } else{
                $output = '
                    <tr></tr>
                    <tr>
                        <td align="center" colspan="6"> 
                            <div class="container empty-box" >
                                <h3 class="text-center me-3">Aucune résultat</h3>
                            </div>
                        </td>
                    </tr>
                ';
            }

            $data = array(
                'table_data'   =>    $output,
                'total_data'   =>    $total_row
            );

            echo json_encode($data);
        }
    }
}
