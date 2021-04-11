<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{User,Membre,Photo,Departement};

use Illuminate\Validation\Rule;

use App\Http\Requests\MembreRequest;

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
        //
    $userconnecte=Auth::id();

    $gpusersid = User::select('gpusers_id')->where('id', '=',$userconnecte)->get()->toArray()[0];


    foreach ($gpusersid as $gpusersids) {


        if ($gpusersids=="3") {
           
           $comp = Membre::where('groupe_id', "5")->get()->count();

          $comp_h = Membre::where('civilite', 'M.')->where('groupe_id', "5")->get()->count();
    
          $comp_f=$comp-$comp_h;

       if ($comp==0) {
        
              $pourh=0;

              $pourf=0;

          } else {
    
             $pourh=round((($comp_h/$comp)*100));

             $pourf=round((($comp_f/$comp)*100));
          }


     //dd($membre);  

        $data =[

            'title'=>$description='Accueil',
            'accueil'=>$accueil='Sécretariat de l\'église',
            'description'=>$description,
            'comp'=>$comp,
            'comp_h'=>$comp_h,
            'comp_f'=>$comp_f,
            'pourh'=>$pourh,
            'pourf'=>$pourf,
            //'departement'=>$departement,
         
            
        ];

        return view('membre.index',$data);

      
           

        } else {
            $deptid=Departement::join('groupes', 'departement_id','=','departements.id')
              ->join('users', 'users.departement_id', '=', 'groupes.departement_id')
              ->select('groupes.id')
              ->where('users.id', '=',$userconnecte)
              ->get()->toArray()[0];
    
    //dd($deptid);
    
    
   foreach ($deptid as $deptids) {

    $comp = Membre::where('groupe_id', $deptids)->get()->count();

    $comp_h = Membre::where('civilite', 'M.')->where('groupe_id', $deptids)->get()->count();
    
    $comp_f=$comp-$comp_h;

    if ($comp==0) {
        
              $pourh=0;

              $pourf=0;

          } else {
    
             $pourh=round((($comp_h/$comp)*100));

             $pourf=round((($comp_f/$comp)*100));
          }


     //dd($membre);  

        $data =[

            'title'=>$description='Accueil',
            'accueil'=>$accueil='Sécretariat de l\'église',
            'description'=>$description,
            'comp'=>$comp,
            'comp_h'=>$comp_h,
            'comp_f'=>$comp_f,
            'pourh'=>$pourh,
            'pourf'=>$pourf,
            //'departement'=>$departement,
         
            
        ];

         }
           return view('membre.index',$data);
        }
        

      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Membre $membre)
    {
        //
        $data =[

            'title'=>$description='Ajouter un membre',
            'accueil'=>$accueil='Enregistrer un Membre',
            'description'=>$description,
            'membre'=>$membre,
            //'departement'=>$departement,
            
            
        ];
           return view('membre.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MembreRequest $request, Membre $membre)
    {
        //
     //dd(request()->all());
    $userconnecte=Auth::id();

    $gpusersid = User::select('gpusers_id')->where('id', '=',$userconnecte)->get()->toArray()[0];

    //dd($user);
    
    foreach ($gpusersid as $gpusersids) {
            

           if ($gpusersids=="3") {

                

                  DB::beginTransaction();

     try {
        
        $validateData = $request->validated();

        $validateData['groupe_id'] = "5";

        
       $membre=$membre->updateOrCreate(['id'=>$membre->id],$validateData);

           //max : valeur , pour la taille maximum du fichier image

        if (request()->hasFile('photo') && request()->file('photo')->isValid()) {

            // verifier l'existence de l'avatar

            if (Storage::exists('photos/'.$membre->id)) {
                
               Storage::deleteDirectory('photos/'.$membre->id);
            }
            

            //renommer l'image du membre
            $ext = request()->file('photo')->extension();
            $filename = Str::slug($membre->nom).'-'.$membre->id.'.'.$ext;
            
            //stockage de l'image de base
            $path = request()->file('photo')->storeAs('photos/'.$membre->id,$filename);
            // redimensionnement de l'image redimensionner
       $thumbnailImage = Image::make(request()->file('photo'))->fit(200, 200, function($constraint){
                    $constraint->upsize();
                })->encode($ext, 50);

             // stockage de l'image redimensionner
                $thumbnailPath = 'photos/'.$membre->id.'/thumbnail/'.$filename;

                Storage::put($thumbnailPath, $thumbnailImage);

            // insertion ds la BD
                
          $membre->photo()->updateOrCreate(['id'=>$membre->id],
            [
              'filename'=>$filename,
              'url'=>Storage::url($path),
              'path'=>$path,
              'thumb_url'=>Storage::url($thumbnailPath),
              'thumb_path'=>$thumbnailPath,

            ]);

           }

         }
         
         catch(ValidationException $e){
         DB::rollBack();
        
        dd($e->getErrors());
      }

     

      DB::commit();

         $success = 'un membre vient d\'être ajouté avec succes';

        return redirect()->route('membre.show')->withSuccess($success);

       
           } else {
       
           

            $deptid=Departement::join('groupes', 'departement_id','=','departements.id')
              ->join('users', 'users.departement_id', '=', 'groupes.departement_id')
              ->select('groupes.id')
              ->where('users.id', '=',$userconnecte)
              ->get()->toArray()[0];
    
    //dd($deptid);
    
    
   foreach ($deptid as $deptids) {


    DB::beginTransaction();

     try {
        
        $validateData = $request->validated();

        $validateData['groupe_id'] = $deptids;

        
       $membre=$membre->updateOrCreate(['id'=>$membre->id],$validateData);

           //max : valeur , pour la taille maximum du fichier image

        if (request()->hasFile('photo') && request()->file('photo')->isValid()) {

            // verifier l'existence de l'avatar

            if (Storage::exists('photos/'.$membre->id)) {
                
               Storage::deleteDirectory('photos/'.$membre->id);
            }
            

            //renommer l'image du membre
            $ext = request()->file('photo')->extension();
            $filename = Str::slug($membre->nom).'-'.$membre->id.'.'.$ext;
            
            //stockage de l'image de base
            $path = request()->file('photo')->storeAs('photos/'.$membre->id,$filename);
            // redimensionnement de l'image redimensionner
       $thumbnailImage = Image::make(request()->file('photo'))->fit(200, 200, function($constraint){
                    $constraint->upsize();
                })->encode($ext, 50);

             // stockage de l'image redimensionner
                $thumbnailPath = 'photos/'.$membre->id.'/thumbnail/'.$filename;

                Storage::put($thumbnailPath, $thumbnailImage);

            // insertion ds la BD
                
          $membre->photo()->updateOrCreate(['id'=>$membre->id],
            [
              'filename'=>$filename,
              'url'=>Storage::url($path),
              'path'=>$path,
              'thumb_url'=>Storage::url($thumbnailPath),
              'thumb_path'=>$thumbnailPath,

            ]);

           }

         }
         
         catch(ValidationException $e){
         DB::rollBack();
        
        dd($e->getErrors());
      }

     }

      DB::commit();

         $success = 'un membre vient d\'être ajouté avec succes';

        return redirect()->route('membre.show')->withSuccess($success);

           }

       }
   
    
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        //$membre=Membre::orderByDesc('id')->get();

     $userconnecte=Auth::id();

    $gpusersid = User::select('gpusers_id')->where('id', '=',$userconnecte)->get()->toArray()[0];


  foreach ($gpusersid as $gpusersids) {

       if ($gpusersids=="3") {

          $membre = Membre::where('groupe_id',"5")->get();
        

        $data =[

            'title'=>$description='Afficher les membres',
            'description'=>$description,
            'membre'=>$membre,
           
            
           ];
          
       } else {
           
       
       

    $deptid=Departement::join('groupes', 'departement_id','=','departements.id')
              ->join('users', 'users.departement_id', '=', 'groupes.departement_id')
              ->select('groupes.id')
              ->where('users.id', '=',$userconnecte)
              ->get()->toArray()[0];
    
    //dd($deptid);
    
    
   foreach ($deptid as $deptids) {


        $membre = Membre::where('groupe_id', $deptids)->get();
        

        $data =[

            'title'=>$description='Afficher les membres',
            'description'=>$description,
            'membre'=>$membre,
           
            
           ];

         }

       }

     }

           return view('membre.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Membre $membre)
    {
        //

        $data =[

            'title'=>$description='Editer un membre',
            'description'=>$description,
            'membre'=>$membre,
            //'statut'=>$statut,
            //'gpuser'=>$gpuser,
            //'departement'=>$departement,
            
        ];
           return view('membre.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Membre $membre)
    {
        //

          DB::beginTransaction();

        try {


        //$user=auth()->user();
        
        $validateData=request()->validate([
        'civilite'=>'required|max:4',
        'nom'=>'required|between:2,30',
        'prenoms'=>'required|between:2,30',
        'date_naissance'=>'required',
        'email'=>['required','email',Rule::unique('membres')->ignore($membre)],
        //'email'=>'required|unique:membres',
        'photo'=>['sometimes','nullable','file','image','mimes:jpeg,png,jpg','dimensions:min_width=200,min_height=200'],
        'profession'=>'required|max:30',
        'contact'=>'required|max:10', 

        ]);

        
        // mise à jour 
        $membre=$membre->updateOrCreate(['id'=>$membre->id],$validateData);
        
          //max : valeur , pour la taille maximum du fichier image

        if (request()->hasFile('photo') && request()->file('photo')->isValid()) {

            // verifier l'existence de l'avatar

            if (Storage::exists('photos/'.$membre->id)) {
                
               Storage::deleteDirectory('photos/'.$membre->id);
            }
            

            //renommer l'image du membre
            $ext = request()->file('photo')->extension();
            $filename = Str::slug($membre->nom).'-'.$membre->id.'.'.$ext;
            
            //stockage de l'image de base
            $path = request()->file('photo')->storeAs('photos/'.$membre->id,$filename);
            // redimensionnement de l'image redimensionner
       $thumbnailImage = Image::make(request()->file('photo'))->fit(200, 200, function($constraint){
                    $constraint->upsize();
                })->encode($ext, 50);

             // stockage de l'image redimensionner
                $thumbnailPath = 'photos/'.$membre->id.'/thumbnail/'.$filename;

                Storage::put($thumbnailPath, $thumbnailImage);

            // insertion ds la BD
                
          $membre->photo()->updateOrCreate(['id'=>$membre->id],
            [
              'filename'=>$filename,
              'url'=>Storage::url($path),
              'path'=>$path,
              'thumb_url'=>Storage::url($thumbnailPath),
              'thumb_path'=>$thumbnailPath,

            ]);

           }

         }
         
         catch(ValidationException $e){
         DB::rollBack();
        
        dd($e->getErrors());
      }

      DB::commit();

     $success = 'Information mises à jour.';

     return redirect()->route('membre.show')->withSuccess($success);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membre $membre)
    {
        //
         $membre->delete();

         $success='membre supprimé';
         return back()->withSuccess($success);
    }

         public function password() //formulaire d'update de password
    {
        $data = [
            'title' => $description = 'Modifier mon mot de passe',
            'description'=>$description,
            'user'=>auth()->user(),
        ];
        return view('membre.password', $data);
    }


    public function updatePassword() //mise à jour du mot de passe
    {
        request()->validate([
            'current'=>'required|password',
            'password'=>'required|between:9,20|confirmed',
        ]);

        $user = auth()->user();

        $user->password = bcrypt(request('password'));

        $user->save();

        $success = 'Mot de passe mis à jour.';
        return back()->withSuccess($success);
    }



    // DEUXIEME PARTIE DE MEMBRECONTROLLER




    public function index2()
    {
        //
        //
    $userconnecte=Auth::id();
    //dd($userconnecte);

     $dept=Departement::join('users', 'departement_id','=','departements.id')
              ->select('libelle')
              ->where('users.id', '=',$userconnecte)
              ->get()->toArray()[0];

     $deptid=Departement::join('groupes', 'departement_id','=','departements.id')
              ->join('users', 'users.departement_id', '=', 'groupes.departement_id')
              ->select('groupes.id')
              ->where('users.id', '=',$userconnecte)
              ->get()->toArray()[0];
    
    //dd($deptid);
    
    
   foreach ($deptid as $deptids) {
    
    //dd($deptids);

    $comp = Membre::where('groupe_id', $deptids)->get()->count();

    $comp_h = Membre::where('civilite', 'M.')->where('groupe_id', $deptids)->get()->count();
    
    $comp_f=$comp-$comp_h;

          if ($comp==0) {
        
              $pourh=0;

              $pourf=0;

          } else {
    
             $pourh=round((($comp_h/$comp)*100));

             $pourf=round((($comp_f/$comp)*100));
          }
    


   

        $data =[

            'title'=>$description='Accueil',
            'accueil'=>$accueil='Sécretariat de l\'église',
            'description'=>$description,
            'comp'=>$comp,
            'comp_h'=>$comp_h,
            'comp_f'=>$comp_f,
            'pourh'=>$pourh,
            'pourf'=>$pourf,
            'dept'=>$dept,
            //'departement'=>$departement,
         
            
        ];
           return view('mem.index',$data);
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create2(Membre $membre)
    {
        //
        $data =[

            'title'=>$description='Ajouter un membre',
            'accueil'=>$accueil='Enregistrer un Membre',
            'description'=>$description,
            'membre'=>$membre,
            //'departement'=>$departement,
            
            
        ];
           return view('mem.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store2(MembreRequest $request, Membre $membre)
    {
        //
     //dd(request()->all());

     $userconnecte=Auth::id();

        $deptid=Departement::join('groupes', 'departement_id','=','departements.id')
              ->join('users', 'users.departement_id', '=', 'groupes.departement_id')
              ->select('groupes.id')
              ->where('users.id', '=',$userconnecte)
              ->get()->toArray()[0];
    
    
   foreach ($deptid as $deptids) {


    DB::beginTransaction();

     try {
        
        $validateData = $request->validated();

        $validateData['groupe_id'] = $deptids;

        
       $membre=$membre->updateOrCreate(['id'=>$membre->id],$validateData);

           //max : valeur , pour la taille maximum du fichier image

        if (request()->hasFile('photo') && request()->file('photo')->isValid()) {

            // verifier l'existence de l'avatar

            if (Storage::exists('photos/'.$membre->id)) {
                
               Storage::deleteDirectory('photos/'.$membre->id);
            }
            

            //renommer l'image du membre
            $ext = request()->file('photo')->extension();
            $filename = Str::slug($membre->nom).'-'.$membre->id.'.'.$ext;
            
            //stockage de l'image de base
            $path = request()->file('photo')->storeAs('photos/'.$membre->id,$filename);
            // redimensionnement de l'image redimensionner
       $thumbnailImage = Image::make(request()->file('photo'))->fit(200, 200, function($constraint){
                    $constraint->upsize();
                })->encode($ext, 50);

             // stockage de l'image redimensionner
                $thumbnailPath = 'photos/'.$membre->id.'/thumbnail/'.$filename;

                Storage::put($thumbnailPath, $thumbnailImage);

            // insertion ds la BD
                
          $membre->photo()->updateOrCreate(['id'=>$membre->id],
            [
              'filename'=>$filename,
              'url'=>Storage::url($path),
              'path'=>$path,
              'thumb_url'=>Storage::url($thumbnailPath),
              'thumb_path'=>$thumbnailPath,

            ]);

           }

         }
         
         catch(ValidationException $e){
         DB::rollBack();
        
        dd($e->getErrors());
      }

      DB::commit();

     }

         $success = 'un membre vient d\'être ajouté avec succes';

        return redirect()->route('mem.show')->withSuccess($success);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show2()
    {
        //
        //$membre=Membre::orderByDesc('id')->get();
        $userconnecte=Auth::id();

        $deptid=Departement::join('groupes', 'departement_id','=','departements.id')
              ->join('users', 'users.departement_id', '=', 'groupes.departement_id')
              ->select('groupes.id')
              ->where('users.id', '=',$userconnecte)
              ->get()->toArray()[0];
    
     
    
    
   foreach ($deptid as $deptids) {
      
      //dd($deptids);

        $membre = Membre::where('groupe_id', $deptids)->get();
        

        $data =[

            'title'=>$description='Afficher les membres',
            'description'=>$description,
            'membre'=>$membre,
           
            
        ];
           return view('mem.show',$data);

      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit2(Membre $membre)
    {
        

        $data =[

            'title'=>$description='Editer un membre',
            'description'=>$description,
            'membre'=>$membre,
            
            
        ];
           return view('mem.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update2(Membre $membre)
    {
        //

          DB::beginTransaction();

     try {


        //$user=auth()->user();
        
        $validateData=request()->validate([
        'civilite'=>'required|max:4',
        'nom'=>'required|between:2,30',
        'prenoms'=>'required|between:2,30',
        'date_naissance'=>'required',
        'email'=>['required','email',Rule::unique('membres')->ignore($membre)],
        //'email'=>'required|unique:membres',
        'photo'=>['sometimes','nullable','file','image','mimes:jpeg,png,jpg','dimensions:min_width=200,min_height=200'],
        'profession'=>'required|max:30',
        'contact'=>'required|max:10', 

        ]);

        
        // mise à jour 
        $membre=$membre->updateOrCreate(['id'=>$membre->id],$validateData);
        
          //max : valeur , pour la taille maximum du fichier image

        if (request()->hasFile('photo') && request()->file('photo')->isValid()) {

            // verifier l'existence de l'avatar

            if (Storage::exists('photos/'.$membre->id)) {
                
               Storage::deleteDirectory('photos/'.$membre->id);
            }
            

            //renommer l'image du membre
            $ext = request()->file('photo')->extension();
            $filename = Str::slug($membre->nom).'-'.$membre->id.'.'.$ext;
            
            //stockage de l'image de base
            $path = request()->file('photo')->storeAs('photos/'.$membre->id,$filename);
            // redimensionnement de l'image redimensionner
       $thumbnailImage = Image::make(request()->file('photo'))->fit(200, 200, function($constraint){
                    $constraint->upsize();
                })->encode($ext, 50);

             // stockage de l'image redimensionner
                $thumbnailPath = 'photos/'.$membre->id.'/thumbnail/'.$filename;

                Storage::put($thumbnailPath, $thumbnailImage);

            // insertion ds la BD
                
          $membre->photo()->updateOrCreate(['id'=>$membre->id],
            [
              'filename'=>$filename,
              'url'=>Storage::url($path),
              'path'=>$path,
              'thumb_url'=>Storage::url($thumbnailPath),
              'thumb_path'=>$thumbnailPath,

            ]);

           }

         }
         
         catch(ValidationException $e){
         DB::rollBack();
        
        dd($e->getErrors());
      }

      DB::commit();

     $success = 'Information mises à jour.';

     return redirect()->route('mem.show')->withSuccess($success);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy2(Membre $membre)
    {
        //
         $membre->delete();

         $success='membre supprimé';
         return back()->withSuccess($success);
    }

         public function password2() //formulaire d'update de password
    {
        $data = [
            'title' => $description = 'Modifier mon mot de passe',
            'description'=>$description,
            'user'=>auth()->user(),
        ];
        return view('mem.password', $data);
    }


    public function updatePassword2() //mise à jour du mot de passe
    {
        request()->validate([
            'current'=>'required|password',
            'password'=>'required|between:9,20|confirmed',
        ]);

        $user = auth()->user();

        $user->password = bcrypt(request('password'));

        $user->save();

        $success = 'Mot de passe mis à jour.';
        return back()->withSuccess($success);
    }

}
