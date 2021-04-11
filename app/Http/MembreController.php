<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Membre};

use Illuminate\Validation\Rule;

//use App\Http\Requests\UserRequest;

use Auth,Str,Storage,Image,DB;

class MembreController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data =[

            'title'=>$description='Accueil',
            'accueil'=>$accueil='Sécretariat de l\'église',
            'description'=>$description,
            //'gpuser'=>$gpuser,
            //'departement'=>$departement,
            
            
        ];
           return view('membre.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Membre $membre)
    {
        //
       //abort_if($user->id !== auth()->id(),403);


        //$utilisateur=auth()->id();

        //dd($utilisateur);

        $data =[

            'title'=>$description='Ajouter un membre',
            'accueil'=>$accueil='Enregistrer un Membre',
            'description'=>$description,
            'membre'=>$membre,
            //'departement'=>$departement,
            
            
        ];
           return view('membre.creer',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
        request()->validate([
        
        'civilité'=>['required','min:1','max:3'],
        'nom'=>['required','min:3','max:20'],
        'prenoms'=>['required','min:3','max:20'],
        //'email'=>['required','email',Rule::unique('membres')->ignore($membre)],
        'email'=>'required|unique:membres',
        'membre'=>['sometimes','nullable','file','image','mimes:jpeg,png,jpg','dimensions:min_width=200,min_height=200'],
        'profession'=>['required','min:3','max:20'],
        'contact'=>['required','min:10','max:10'],  
        
           ]);

        
        $membre = new Membre;
        $membre->groupe_id = "1";
        $membre->civilite = request('civilite');
        $membre->nom = request('nom');
        $membre->prenoms = request('prenoms');
        $membre->email =request('email');
        $membre->profession = request('profession');
        $membre->contact = request('contact');
        
        $membre->save();
       
          //max : valeur , pour la taille maximum du fichier image

        if (request()->hasFile('membre') && request()->file('membre')->isValid()) {

            // verifier l'existence de l'avatar

            if (Storage::exists('membres/'.$membre->id)) {
                
               Storage::deleteDirectory('membres/'.$membre->id);
            }
            

            //renommer l'image du membre
            $ext = request()->file('membre')->extension();
            $filename = Str::slug($membre->nom).'-'.$membre->id.'.'.$ext;
            
            //stockage de l'image de base
            $path = request()->file('membre')->storeAs('membres/'.$membre->id,$filename);
            // redimensionnement de l'image redimensionner
       $thumbnailImage = Image::make(request()->file('membre'))->fit(200, 200, function($constraint){
                    $constraint->upsize();
                })->encode($ext, 50);

             // stockage de l'image redimensionner
                $thumbnailPath = 'membres/'.$user->id.'/thumbnail/'.$filename;

                Storage::put($thumbnailPath, $thumbnailImage);

            // insertion ds la BD
                
          $membre->membre()->updateOrCreate(['id'=>$membre->id],
            [
              'filename'=>$filename,
              'url'=>Storage::url($path),
              'path'=>$path,
              'thumb_url'=>Storage::url($thumbnailPath),
              'thumb_path'=>$thumbnailPath,

            ]);
         }

         $success = 'un membre vient d\'être ajouté avec succes';

        return redirect()->withSuccess($success);

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
