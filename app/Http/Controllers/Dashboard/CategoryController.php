<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
//    $query = Category::query(); // Return Query Builder for category model

//     if($name = $request->query('name')){
//         $query->where('name','LIKE',"%{$name}%");
//     }if($status = $request->query('status')){
//         $query->where('status','=',$status);
//     }


    $query = Category::query();
    if($name = $request->query('name')){
        $query->where('name','LIKE',"%{$name}%");
    }if($status = $request->query('status')){
        $query->where('status','=',$status);
    }


    // Select  [categories.*(All categories = $categories)  parents.name(catrgory no.(2))]
    //From categories($categories) leftjoin (categories as parents) ON(=) parents.id = categories.parent_id

    $categories = Category::leftJoin('categories as parents','parents.id','=','categories.parent_id')
    ->select([
        'categories.*',
        'parents.name as parent_name'
    ])->withCount('products')
    ->paginate();

    //    $categories = $query->paginate( 2); // Return Collection object
        return view( 'dashboard.categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::all();
        $categories = Category::all();
        return view('dashboard.categories.create',compact('parents','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Category::rules());
        //Request Merge --> This data the user Not insert it
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        // Storage::putFile('uploads',$request->image,'public');

        $data = $request->except('image');

        // if($request->hasFile('image')){
        //     $file = $request->file('image'); //I/P
        //     $file->getClientOriginalName();
        //     $path = $file->store('uploads','public') ;// store the file with random name in Folder its name uploads
        //     // The Disk Now is Public the Browser can see it
        //     // i need the path to store it in database
        // }

        $data['image'] = $this->uploads($request);

        // Math Assignment
        $category = Category::create($data);

        // PRG
        // redirect -- >take the route
        return redirect()->route('dashboard.categories.index')->with('success','Category Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.show',['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        // SELECT * FROM Categories Where id != $id
        // AND (parent_id IS NULL OR parent_id != $id)
        $parents = Category::where('id','!=',$id) // انت بتعرض الهدوم متحطهاش في الاختيارات بقي
        ->where(function($query) use ($id){
            $query->whereNull('parent_id') // اي حد ملوش أب اعرضهولي
            ->orWhere('parent_id','!=',$id) ;// انت بتعرض الهدوم متحطش هدوم رجاله وهدوم ستات مهما تابعين ليا اصلا اكيد مش هختار حاجه منهم ابقي تابع ليها
        }) ->get();


        return view('dashboard.categories.edit',compact(['category','parents']));
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
        $category = Category::find($id);
        $request->validate(Category::rules($id));
        $old_image = $category->image;
        $data = $request->except('image');

        // if($request->hasFile('image')){
        //     $file = $request->file('image'); //I/P
        //     $file->getClientOriginalName();
        //     $path = $file->store('uploads','public') ;// store the file with random name in Folder its name uploads
            // The Disk Now is Public the Browser can see it
            // i need the path to store it in database
            $data['image'] = $this->uploads($request) ;

        $category->update ($data);

        if($old_image && isset($data['image'])){
            Storage::disk('public')->delete($old_image);
        }

        // Math Assignment
        return redirect()->route('dashboard.categories.index')->with('success','Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('dashboard.categories.index')->with('delete','Deleted Category!');
    }

    public function uploads(Request $request){
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = $file->store('uploads',['disk' => 'public']);
            return $path;
        }
    }

    public function trash(){
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash',compact('categories'));
    }
    public function restore(Request $request , $id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')
        ->with('success','Category Restored!');
    }
    public function forceDelete($id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if($category->image){
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.trash')
        ->with('success','Category Deleted!');
    }
}
