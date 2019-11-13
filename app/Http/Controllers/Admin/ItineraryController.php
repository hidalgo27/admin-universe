<?php

namespace App\Http\Controllers\Admin;

use App\TItinerario;
use App\TItinerarioImagen;
use App\TPaqueteImagen;
use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ItineraryController extends Controller
{

    public function index()
    {
        $itinerary = TItinerario::paginate(10);
        return view('admin.itinerary', compact('itinerary'));
    }

    public function store(Request $request)
    {
//        $codigo = $_POST["txt_codigo"];
        $title = $_POST["txt_title"];
        $short = $_POST["txta_short"];
        $extended = $_POST["txta_extended"];

        if ($request->filled(['txt_title'])){

            $itinerary = new TItinerario();
//            $itinerary->codigo = $codigo;
            $itinerary->titulo = $title;
            $itinerary->resumen = $short;
            $itinerary->descripcion = $extended;
            $itinerary->save();

            return redirect(route('admin_itinerary_edit_path', $itinerary->id))->with('status', 'Itinerary created successfully');

        }else{
            return "false";
        }
    }

    public function create()
    {
        return view('admin.itinerary-create');
    }

    public function edit($id)
    {
        $itinerary = TItinerario::with('itinerario_imagen')->where('id', $id)->get();

        return view('admin.itinerary-edit', ['itinerary'=>$itinerary]);
    }

    public function update(Request $request, $id)
    {
        $codigo = $_POST["txt_codigo"];
        $title = $_POST["txt_title"];
        $short = $_POST["txta_short"];
        $extended = $_POST["txta_extended"];

        if ($request->filled(['txt_title'])){

            $itinerary = TItinerario::FindOrFail($id);
            $itinerary->codigo = $codigo;
            $itinerary->titulo = $title;
            $itinerary->resumen = $short;
            $itinerary->descripcion = $extended;
            $itinerary->save();

            return redirect(route('admin_itinerary_edit_path', $id))->with('status', 'Successfully updated itinerary');

        }else{
            return "false";
        }
    }

    public function destroy($id)
    {
        $itinerary=TItinerario::find($id);
        $itinerary->delete();
        return redirect(route('admin_itinerary_index_path'))->with('delete', 'Itinerary successfully removed');
    }

    public function image_store(Request $request)
    {

        if($request->hasFile('file')) {

            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File to s3
            Storage::disk('s3')->put('itinerary/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');

            //Store $filenametostore in the database

            $imageName = Storage::disk('s3')->url('itinerary/'.$filenametostore);

        }

        $imageUpload = new TItinerarioImagen();
        $imageUpload->nombre = $imageName;
        $imageUpload->iditinerario = $request->input('id_itinerary_file');
        $imageUpload->save();
        return response()->json(['success' => $imageName]);
    }

    public function image_delete(Request $request)
    {
        $filename = $request->get('name_file');
        $id_itinerary = $request->get('id_itinerary_file');

        $filename = explode('.', $filename);
        $filename=$filename[0];

        $itinerario_imagen = TItinerarioImagen::where('iditinerario', $id_itinerary)->where('nombre', 'like', '%'.$filename.'%')->first();

        $filename = explode('itinerary/', $itinerario_imagen->nombre);
        $filename = $filename[1];
        Storage::disk('s3')->delete('itinerary/'.$filename);

        TItinerarioImagen::where('id', $itinerario_imagen->id)->delete();

        return $filename;
    }

    public function image_delete_form(Request $request)
    {
        $filename = $request->get('filename');
        $id_itinerario = $request->get('id_itinerario');
        TItinerarioImagen::where('nombre', $filename)->delete();

        $filename = explode('itinerary/', $filename);
        $filename = $filename[1];
        Storage::disk('s3')->delete('itinerary/'.$filename);

        return redirect(route('admin_itinerary_edit_path', $id_itinerario))->with('delete', 'Image successfully removed');
    }

    public function image_list(Request $request)
    {
//        $filename = $request->get('filename');
//        TItinerarioImagen::where('id', 41)->get();

//        $images = Image::get(['original_name', 'filename']);

        $images = TItinerarioImagen::where('id', 41)->get();

        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->nombre,
                'server' => $image->nombre,
                'size' => \File::size(public_path('/images/itinerario/' . $image->nombre))
            ];
        }

        return response()->json([
            'images' => $imageAnswer
        ]);

    }
}
