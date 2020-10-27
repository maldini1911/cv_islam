<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LanguageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::select('id', 'abbr', 'name', 'diraction', 'active')->paginate(PAGINATION_COUNT);
        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {

        try{
            Language::create($request->except(['_token']));
            return redirect()->route('admin.languages')->with(['success' => 'تم حفظ اللغة بنجاح']);
        }catch(\Exception $ex)
        {
           return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ سيتم مراجعته']);
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
        $lang = Language::find($id);
        if($lang)
        {
            return view('admin.languages.edit', compact("lang"));
        }else{
            return redirect()->route('admin.languages')->with(["error" => 'هذه اللغة غير موجودة']);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, $id)
    {
        try{
                
                $lang = Language::find($id);
                if(!$lang)
                
                    return redirect()->route('admin.languages.edit', $id)->with('error', 'هذه اللغة غير موجودة');
                

                if(!$request->has('active'))
                {
                    $request->request->add(['active' => '0']);
                }

                Language::find($id)->update($request->except('_token'));
                return redirect()->route('admin.languages.edit', $id)->with('success', 'تم تحديث اللغة بنجاح');
        }catch(\Exception $ex){
                return redirect()->route('admin.languages')->with('error', 'هناك خطأ حاليا يرجع المحاولة فيما بعد');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $lang = Language::find($id);
            if(!$lang)
            {
                return redirect()->route('admin.languages.edit', $id)->with('error', 'هذه اللغة غير موجودة');
            }

            $lang->delete();
            return redirect()->route('admin.languages')->with('success', 'تم حذف اللغة بنجاح');
    }catch(\Exception $ex){
            return redirect()->route('admin.languages')->with('error', 'هناك خطأ حاليا يرجع المحاولة فيما بعد');
    }
    }
}