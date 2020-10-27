<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MainCateogries;
use App\Models\MainCategory;
use DB;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $default_language = get_default_language();
        $rows = MainCategory::where('translation_lang', $default_language)->get();
        return view('admin.maincategories.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('admin.maincategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCateogries $request)
    {

        try{


                $main_cateogires = collect($request->category);

                $filter = $main_cateogires->filter(function($value, $key) {
                  return $value['abbr'] == get_default_language();
                });


                if($request->has('photo'))
                {
                  $photo_path = uploadImage('maincateogries', $request->photo);
                }

                $defualt_cateogry = array_values($filter->all()) [0];

                DB::beginTransaction();
                $default_category_id = MainCategory::insertGetId([
                  'translation_lang' => $defualt_cateogry['abbr'],
                  'translation_of'   => 0,
                  'name'             => $defualt_cateogry['name'],
                  'slug'             => $defualt_cateogry['name'],
                  'active'           => $defualt_cateogry['active'],
                  'photo'            => $photo_path
                ]);

                $categories = $main_cateogires->filter(function($value, $key) {
                  return $value['abbr'] != get_default_language();
                });

                if(isset($categories) && $categories->count() > 0)
                {
                    $categories_array = [];

                    foreach($categories as $category)
                    {
                      $categories_array[] = [
                          'translation_lang' => $category['abbr'],
                          'translation_of'   => $default_category_id,
                          'name'             => $category['name'],
                          'slug'             => $category['name'],
                          'active'           => $category['active'],
                          'photo'            => $photo_path
                      ];

                    }

                    MainCategory::insert($categories_array);
                }
                DB::commit();

                return redirect()->route('admin.maincategories')->with(['success' => 'تم حفظ القسم بنجاح']);
          }catch(\Exception $ex){

              DB::rollback();
              return redirect()->route('admin.maincategories')->with(['error' => 'هناك خطأ سيتم مراجعته']);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
