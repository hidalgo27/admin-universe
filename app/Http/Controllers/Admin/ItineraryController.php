<?php

namespace App\Http\Controllers\Admin;

use App\TItinerario;
use App\TItinerarioImagen;
use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itinerary = TItinerario::all()->sortBy('id');
        return view('admin.itinerary', compact('itinerary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.itinerary-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $codigo = $_POST["txt_codigo"];
        $title = $_POST["txt_title"];
        $short = $_POST["txta_short"];
        $extended = $_POST["txta_extended"];

        if ($request->filled(['txt_codigo', 'txt_title'])){

            $itinerary = new TItinerario();
            $itinerary->codigo = $codigo;
            $itinerary->titulo = $title;
            $itinerary->resumen = $short;
            $itinerary->descripcion = $extended;
            $itinerary->save();

            return redirect(route('admin_itinerary_index_path'))->with('status', 'Itinerary created successfully');

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
        $itinerary = TItinerario::with('itinerario_imagen')->where('id', $id)->get();

        return view('admin.itinerary-edit', ['itinerary'=>$itinerary]);
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
        $codigo = $_POST["txt_codigo"];
        $title = $_POST["txt_title"];
        $short = $_POST["txta_short"];
        $extended = $_POST["txta_extended"];

        if ($request->filled(['txt_codigo', 'txt_title'])){

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itinerary=TItinerario::find($id);
        $itinerary->delete();
        return redirect(route('admin_itinerary_index_path'))->with('delete', 'Itinerary successfully removed');
    }

    public function image_store(Request $request)
    {
        $image = $request->file('file');
        $id_itinerary = $request->input('id_itinerary_file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/itinerario/'), $imageName);

        $imageUpload = new TItinerarioImagen();
        $imageUpload->nombre = $imageName;
        $imageUpload->iditinerario = $id_itinerary;
        $imageUpload->save();
        return response()->json(['success' => $imageName]);
    }

    public function image_delete(Request $request)
    {
        $filename = $request->get('filename');
        TItinerarioImagen::where('nombre', $filename)->delete();
        $path = public_path() . '/images/itinerario/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function image_delete_form(Request $request)
    {
        $filename = $request->get('filename');
        $id_itinerario = $request->get('id_itinerario');
        TItinerarioImagen::where('nombre', $filename)->delete();
        $path = public_path() . '/images/itinerario/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
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
