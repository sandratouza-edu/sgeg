<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AttachRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Attach;
use App\Models\Setting;
 
class AttachController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $attachs = Attach::all()->where('type','doc');
        
        return view('attach.index', compact('attachs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        return view('attach.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
   
        $data = $request->all();        
       
        $uri = ucwords(time()."-".str_replace(' ', '_', $request['name'])).'.pdf';
        $data['uri'] =(env('ASSETS_PATH').$uri);

        $pdf = Pdf::setPaper(Setting::where('key','paper')->first()->value, Setting::where('key','orientation')->first()->value)->loadView('pdf.letter', $data);
        $pdf->save(public_path($data['uri']));
      
        Attach::create($data);

        return redirect()->route('attach.index')->with('success', 'Document Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Attach $attach): View
    {
        return view('attach.show', compact('attach'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attach $attach): View
    {
        return view('attach.edit', compact('attach'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attach $attach): RedirectResponse
    {
        $data = $request->all();
        if(Storage::exists(public_path($attach->uri))) {
            Storage::delete(public_path($attach->uri));
        }
        $uri = ucwords(time()."-".str_replace(' ', '_', $request['name'])).'.pdf';
        $data['uri'] = (env('ASSETS_PATH').$uri);
        
        $pdf = Pdf::setPaper(Setting::where('key','paper')->first()->value, Setting::where('key','orientation')->first()->value)->loadView('pdf.letter', $data);
        $pdf->save(public_path($data['uri']));
        
        $attach->update($data); 
     
        return redirect()->route('attach.index', $attach)->with('message', __('Doc Updated'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Attach $attach): RedirectResponse
    {
        if(Storage::disk('local')->exists(public_path($attach->uri))) {
            $res = Storage::delete(public_path($attach->uri));
            dd($res);
        }
        $attach->delete();

        if($attach->type == 'image') {
            return redirect()->route('image.index')->with('danger', 'Image Deleted');
        } else {
            return redirect()->route('attach.index')->with('danger', 'attach Deleted');
        }
    
    }

    public function images(): View
    {
        $attachs = Attach::with('user')->where('type','image')->get();
        return view('attach.image-index', compact('attachs'));
    }

    public function upload(): View
    {
     
        return view('attach.image-upload');
    }

    public function imageSave(Request $request): RedirectResponse
    {
        
        $image = new Attach;
        $uri = ucwords(time()."-".str_replace(' ', '_', $request->name).'.'.$request->image->extension());
        $request->image->move(public_path(env('ASSETS_IMAGES')), $uri);
        $image->uri = env('ASSETS_IMAGES').$uri;
        $image->name = $request->name;
        $image->keywords = $request->keywords;
        $image->description = $request->description;
        $image->user_id = Auth::user()->id;
        $image->type = "image";
      
        $image->save();

        return redirect()->route('image.index')->with('success', 'Document Created');

    }

    /*
    Ejemplo generación desde una vista
    public function invite()
    {
        //$pdf = Pdf::loadView('pdf.attach');
        $data = ['name' => "Sandra"];
        $pdf = Pdf::setPaper('letter', 'landscape')->loadView('pdf.letter', $data);
       // $pdf->save('myAttahc.pdf');
       
        return $pdf->download('myinvite.pdf');
    }

    public function generatePdf() {
        $pdf = Pdf::loadView('pdf.attach'); //Param la vista que lo genera
        
        $pdf->save('/myAttahc.pdf'); //ruta para guardarlo desde public
        //ver public_path()
        
        return $pdf->download('nombrefichero.pdf'); //Param nombre del fichero
    }
*/
}
