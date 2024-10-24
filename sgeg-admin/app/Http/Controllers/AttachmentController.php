<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AttachRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Attachment;
use App\Models\Setting;
 
class AttachmentController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $attachments = Attachment::all()->where('type','doc');
        
        return view('attachment.index', compact('attachments'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        return view('attachment.create');
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
      
        Attachment::create($data);

        return redirect()->route('attachment.index')->with('success', 'Document Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Attachment $attachment): View
    {
        return view('attachment.show', compact('attachment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attachment $attachment): View
    {
        return view('attachment.edit', compact('attachment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attachment $attachment): RedirectResponse
    {
        $data = $request->all();
        if(Storage::exists(public_path($attachment->uri))) {
            Storage::delete(public_path($attachment->uri));
        }
        $uri = ucwords(time()."-".str_replace(' ', '_', $request['name'])).'.pdf';
        $data['uri'] = (env('ASSETS_PATH').$uri);
        
        $pdf = Pdf::setPaper(Setting::where('key','paper')->first()->value, Setting::where('key','orientation')->first()->value)->loadView('pdf.letter', $data);
        $pdf->save(public_path($data['uri']));
        
        $attachment->update($data); 
     
        return redirect()->route('attachment.index', parameters: $attachment)->with('message', __('Doc Updated'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Attachment $attachment): RedirectResponse
    {
        if(Storage::disk('local')->exists(public_path($attachment->uri))) {
            $res = Storage::delete(public_path($attachment->uri));
            
        }
        $attachment->delete();

        if($attachment->type == 'image') {
            return redirect()->route('image.index')->with('danger', 'Image Deleted');
        } else {
            return redirect()->route('attachment.index')->with('danger', 'attachment Deleted');
        }
    
    }

    public function images(): View
    {
        $attachments = Attachment::with('user')->where('type','image')->get();
        return view('attachment.image-index', compact('attachments'));
    }

    public function upload(): View
    {
     
        return view('attachment.image-upload');
    }

    public function imageSave(Request $request): RedirectResponse
    {
        
        $image = new Attachment;
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
        //$pdf = Pdf::loadView('pdf.attachment');
        $data = ['name' => "Sandra"];
        $pdf = Pdf::setPaper('letter', 'landscape')->loadView('pdf.letter', $data);
       // $pdf->save('myAttahc.pdf');
       
        return $pdf->download('myinvite.pdf');
    }

    public function generatePdf() {
        $pdf = Pdf::loadView('pdf.attachment'); //Param la vista que lo genera
        
        $pdf->save('/myAttahc.pdf'); //ruta para guardarlo desde public
        //ver public_path()
        
        return $pdf->download('nombrefichero.pdf'); //Param nombre del fichero
    }
*/
}
