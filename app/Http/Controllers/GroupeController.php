<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\GroupeRequest;

use App\Models\{User,Gpuser,Groupe,Fichier,Departement,Doc};

use Auth,Str,Storage,Image,DB;

class GroupeController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $data =[

            'title'=>$description='Ajouter un programme d\'activité',
            'description'=>$description,
            //'gpuser'=>$gpuser,
            //'departement'=>$departement,
            
            
        ];
           return view('groupes.create',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupeRequest $request,Doc $doc)
    {
        //
    DB::beginTransaction();

     try {

        $userconnecte=Auth::id();
    //dd($userconnecte);

     $dept=Departement::join('users', 'departement_id','=','departements.id')
              ->select('libelle')
              ->where('users.id', '=',$userconnecte)
              ->get()->toArray()[0];

     $groupeid=Departement::join('groupes', 'departement_id','=','departements.id')
              ->join('users', 'users.departement_id', '=', 'groupes.departement_id')
              ->select('groupes.id')
              ->where('users.id', '=',$userconnecte)
              ->get()->toArray()[0];

       //dd($groupeid);

       foreach ($groupeid as $groupeids) {

         foreach ($dept as $depts) {
       
          //dd($groupeids);

           $validateData = $request->validated();

           $doc = new Doc ;
           $doc->save();
     
        
         //max : valeur , pour la taille maximum du fichier image

        if (request()->hasFile('fichier') && request()->file('fichier')->isValid()) {

            // verifier l'existence de l'avatar

            if (Storage::exists('fichiers/'.$doc->id)) {
                
               Storage::deleteDirectory('fichiers/'.$doc->id);
            }
            

            //renommer l'avatar
            $ext = request()->file('fichier')->extension();
            $filename = $depts.'-'.$doc->id.'.'.$ext;
            
            //stockage de l'image de base
            $path = request()->file('fichier')->storeAs('fichiers/'.$doc->id,$filename);
            // redimensionnement de l'image redimensionner
       //$thumbnailImage = Image::make(request()->file('avatar'))->fit(200, 200, function($constraint){
                    //$constraint->upsize();
                //})->encode($ext, 50);

             // stockage de l'image redimensionner
                //$thumbnailPath = 'avatars/'.$user->id.'/thumbnail/'.$filename;

                //Storage::put($thumbnailPath, $thumbnailImage);

            // insertion ds la BD
                
          $doc->fichier()->updateOrCreate(['id'=>$doc->id],
            [
              'filename'=>$filename,
              'url'=>Storage::url($path),
              'path'=>$path,
              'groupe_id'=>$groupeids,
              'date_activite'=>request('date_activite'),
              'description'=>request('description'),
              'doc_id'=>$doc->id,
              //'thumb_url'=>Storage::url($thumbnailPath),
              //'thumb_path'=>$thumbnailPath,

            ]);
          }

         }

        }

      }
    catch(ValidationException $e){
        DB::rollBack();
        dd($e->getErrors());
    }

   DB::commit();

      $success = 'Document ajouté avec succes';

        return redirect()->route('groupe.show')->withSuccess($success);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fichier $fichier)
    {
        //
        $fichiers=Fichier::orderByDesc('id')->get();

        $data =[

            'title'=>$description='Afficher les programmes d\'activités',
            'description'=>$description,
            'fichiers'=>$fichiers,
            
        ];
           return view('groupes.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fichier $fichier)
    {
        //

        $data =[

            'title'=>$description='Editer un programme',
            'description'=>$description,
            'fichier'=>$fichier,
            
            
        ];
           return view('groupes.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Fichier $fichier)
    {
        //
        DB::beginTransaction();

     try {

        $userconnecte=Auth::id();
    //dd($userconnecte);

     $dept=Departement::join('users', 'departement_id','=','departements.id')
              ->select('libelle')
              ->where('users.id', '=',$userconnecte)
              ->get()->toArray()[0];

     $groupeid=Departement::join('groupes', 'departement_id','=','departements.id')
              ->join('users', 'users.departement_id', '=', 'groupes.departement_id')
              ->select('groupes.id')
              ->where('users.id', '=',$userconnecte)
              ->get()->toArray()[0];

       //dd($groupeid);

       foreach ($groupeid as $groupeids) {

         foreach ($dept as $depts) {
       
          //dd($groupeids);

           $validateData = $request->validated();

           $doc = new Doc ;
           $doc->save();
     
        
         //max : valeur , pour la taille maximum du fichier image

        if (request()->hasFile('fichier') && request()->file('fichier')->isValid()) {

            // verifier l'existence de l'avatar

            if (Storage::exists('fichiers/'.$doc->id)) {
                
               Storage::deleteDirectory('fichiers/'.$doc->id);
            }
            

            //renommer l'avatar
            $ext = request()->file('fichier')->extension();
            $filename = $depts.'-'.$doc->id.'.'.$ext;
            
            //stockage de l'image de base
            $path = request()->file('fichier')->storeAs('fichiers/'.$doc->id,$filename);
            // redimensionnement de l'image redimensionner
       //$thumbnailImage = Image::make(request()->file('avatar'))->fit(200, 200, function($constraint){
                    //$constraint->upsize();
                //})->encode($ext, 50);

             // stockage de l'image redimensionner
                //$thumbnailPath = 'avatars/'.$user->id.'/thumbnail/'.$filename;

                //Storage::put($thumbnailPath, $thumbnailImage);

            // insertion ds la BD
                
          $doc->fichier()->updateOrCreate(['id'=>$doc->id],
            [
              'filename'=>$filename,
              'url'=>Storage::url($path),
              'path'=>$path,
              'groupe_id'=>$groupeids,
              'date_activite'=>request('date_activite'),
              'description'=>request('description'),
              'doc_id'=>$doc->id,
              //'thumb_url'=>Storage::url($thumbnailPath),
              //'thumb_path'=>$thumbnailPath,

            ]);
          }

         }

        }

      }
    catch(ValidationException $e){
        DB::rollBack();
        dd($e->getErrors());
    }

   DB::commit();

      $success = 'Document ajouté avec succes';

        return redirect()->route('groupe.show')->withSuccess($success);
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
