<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Template;
use App\Http\Requests\TemplateRequest;

class Templates extends Controller{
  public function index(Request $request){
    $templates = new Template;
    $links = '';
    $sort = $request->input('sort', '###');
    $search = $request->input('search', '###');

    if($sort != '###' && $search == '###'){
      $templates = $templates->orderBy($request->input('sort'), 'desc');
      $templates = $templates->paginate(10);
      $links = $templates->appends(['sort' => $request->input('sort')])->links();
    }else if($sort == '###' && $search != '###'){
      $templates = $templates->where('title', 'LIKE', "%$search%");
      $templates = $templates->paginate(10);
      $links = $templates->appends(['sort' => $request->input('sort')])->links();
    }else if($sort != '###' && $search != '###'){
      $templates = $templates->where('title', 'LIKE', "%$search%");
      $templates = $templates->orderBy($request->input('sort'), 'desc');
      $templates = $templates->paginate(10);
      $links = $templates->appends(['sort' => $request->input('sort')])->links();
    }else{
      $templates = $templates->paginate(10);
    }
    return view('admin.templates.index', [
      'templates'   => $templates,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => $search,
    ]);
  }
  public function show(Template $template){
    return view('admin.templates.show', ['template' => $template]);
  }
  public function create(){
    return view('admin.templates.create');
  }
  public function store(TemplateRequest $request){
    $inputs = $request->all();
    $template = Template::create($inputs);
    return redirect()->route('templates.show', ['template' => $template]);
  }
  public function edit(Template $template){
    return view('admin.templates.edit', ['template' => $template]);
  }
  public function update(TemplateRequest $request, Template $template){
    $inputs = $request->all();
    $template->fill($inputs)->save();
    return redirect()->route('templates.show', ['template' => $template]);
  }
  public function destroy(Template $template){
    $template->delete();
    if(URL::route('templates.show', ['template' => $template]) == URL::previous())
      return redirect()->route('templates.index');
    else
      return redirect()->back();
  }
}
