<?php

namespace App\Http\Controllers\admin;

use App\TCategoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $category = TCategoria::paginate(10);
        return view('admin.category', compact('category'));
    }

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

    public function edit($id)
    {
        $categoria = TCategoria::where('id', $id)->get();
        return view('admin.category-edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {

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

        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;

        Storage::disk('s3')->put('category/banner/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageName = Storage::disk('s3')->url('category/banner/'.$filenametostore);

        $imageUpload = TCategoria::FindOrFail($id_category);
        $imageUpload->imagen_banner = $imageName;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    }

    public function image_category_slider_delete(Request $request)
    {
        $id_category_file = $request->get('id_category_file');
        $category = TCategoria::find($id_category_file);

        $filename = explode('category/banner/', $category->imagen_banner);
        $filename = $filename[1];
        Storage::disk('s3')->delete('category/banner/'.$filename);

        TCategoria::where('id', $id_category_file)->update(['imagen_banner' => NULL]);

        return $filename;

    }

    public function image_category_slider_form_delete(Request $request)
    {
        $id_category_file = $request->get('id_category');
        $category = TCategoria::find($id_category_file);

        $filename = explode('category/banner/', $category->imagen_banner);
        $filename = $filename[1];
        Storage::disk('s3')->delete('category/banner/'.$filename);

        TCategoria::where('id', $id_category_file)->update(['imagen_banner' => NULL]);

        return redirect(route('admin_category_edit_path', $id_category_file))->with('status', 'Successfully updated video');
    }



    public function image_category_image_store(Request $request)
    {

        $id_category = $request->get('id_category_file');

        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;

        Storage::disk('s3')->put('category/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageName = Storage::disk('s3')->url('category/'.$filenametostore);

        $imageUpload = TCategoria::FindOrFail($id_category);
        $imageUpload->imagen = $imageName;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);

    }

    public function image_category_image_delete(Request $request)
    {

        $id_category_file = $request->get('id_category_file');
        $category = TCategoria::find($id_category_file);

        $filename = explode('category/', $category->imagen);
        $filename = $filename[1];
        Storage::disk('s3')->delete('category/'.$filename);

        TCategoria::where('id', $id_category_file)->update(['imagen' => NULL]);

        return $filename;

    }

    public function image_category_image_form_delete(Request $request)
    {

        $id_category_file = $request->get('id_category');
        $category = TCategoria::find($id_category_file);

        $filename = explode('category/', $category->imagen);
        $filename = $filename[1];
        Storage::disk('s3')->delete('category/'.$filename);

        TCategoria::where('id', $id_category_file)->update(['imagen' => NULL]);


        return redirect(route('admin_category_edit_path', $id_category_file))->with('status', 'Successfully updated video');
    }


}
