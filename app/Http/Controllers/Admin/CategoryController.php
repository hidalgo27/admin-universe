<?php

namespace App\Http\Controllers\admin;

use App\TCategoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = TCategoria::all()->sortBy('dia');
        return view('admin.category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('admin.included-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = $_POST["txt_category"];
        $descripcion = $_POST["txta_descripcion"];

        if ($request->filled(['txt_category'])){

            $category2 = new TCategoria();
            $category2->nombre = $category;
            $category2->descripcion = $descripcion;
            $category2->save();

            return redirect(route('admin_category_index_path'))->with('status', 'Category created successfully');

        }else{
            return "false";
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
        $categoria = TCategoria::where('id', $id)->get();
        return view('admin.category-edit', compact('categoria'));
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
//        $category = $_POST["txt_category"];
//        $descripcion = $_POST["txta_descripcion"];
//        $group = $_POST["slc_group"];
//        $order = $_POST["chk_order"];

        if ($request->filled(['txt_category'])){

            $category2 = TCategoria::FindOrFail($id);
            $category2->nombre = $request->input('txt_category');
            $category2->descripcion = $request->input('txta_descripcion');
            if ($request->has('chk_order')){
                $category2->estado = $request->input('chk_order');
            }else{
                $category2->estado = 0;
            }

            if ($request->has('chk_order_block')){
                $category2->orden_block = $request->input('chk_order_block');
            }else{
                $category2->orden_block = 0;
            }

            $category2->grupo = $request->input('slc_group');
            $category2->save();

            return redirect(route('admin_category_edit_path', $category2->id))->with('status', 'Successfully updated category');

        }else{
            return "false";
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
        $category2=TCategoria::find($id);
        $category2->delete();
        return redirect(route('admin_category_index_path'))->with('delete', 'Category successfully removed');
    }


    public function image_category_slider_store(Request $request)
    {
        $image = $request->file('file');
        $id_category = $request->get('id_category_file');

        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/banners/category'), $imageName);

        $imageUpload = TCategoria::FindOrFail($id_category);
        $imageUpload->imagen_banner = $imageName;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    }

    public function image_category_slider_delete(Request $request)
    {
        $filename = $request->get('filename');
        $id_category = TCategoria::where('imagen_banner', $filename)->first();

        $category = TCategoria::FindOrFail($id_category->id);
        $category->imagen_banner = NULL;
        $category->save();

        $path = public_path() . '/images/banners/category/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function image_category_slider_form_delete(Request $request)
    {
        $id_category = $request->get('id_category');

        $category = TCategoria::FindOrFail($id_category);

        $path = public_path() . '/images/banners/category/' . $category->imagen_banner;
        if (file_exists($path) and $category->imagen_banner <> NULL) {
            unlink($path);
        }
        $category->imagen_banner = NULL;
        $category->save();

        return redirect(route('admin_category_edit_path', $id_category))->with('status', 'Successfully updated video');
    }



    public function image_category_image_store(Request $request)
    {
        $image = $request->file('file');
        $id_category = $request->get('id_category_file');

        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/category'), $imageName);

        $imageUpload = TCategoria::FindOrFail($id_category);
        $imageUpload->imagen = $imageName;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    }

    public function image_category_image_delete(Request $request)
    {
        $filename = $request->get('filename');
        $id_category = TCategoria::where('imagen', $filename)->first();

        $category = TCategoria::FindOrFail($id_category->id);
        $category->imagen = NULL;
        $category->save();

        $path = public_path() . '/images/category/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function image_category_image_form_delete(Request $request)
    {
        $id_category = $request->get('id_category');

        $category = TCategoria::FindOrFail($id_category);

        $path = public_path() . '/images/category/' . $category->imagen;
        if (file_exists($path) and $category->imagen <> NULL) {
            unlink($path);
        }
        $category->imagen = NULL;
        $category->save();

        return redirect(route('admin_category_edit_path', $id_category))->with('status', 'Successfully updated video');
    }


}
