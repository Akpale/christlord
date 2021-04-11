<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{User,Gpuser,Groupe,Statut,Avatar,Departement,Membre,Fichier};

use Illuminate\Validation\Rule;

//use App\Http\Requests\UserRequest;

use Auth,Str,Storage,Image,DB;

class UserController extends Controller
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
    $comp = Membre::orderByDesc('id')->get()->count();

    $comp_h = Membre::where('civilite', 'M.')->get()->count();
    
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
        
            //'departement'=>$departement,
         
            
        ];
           return view('user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        //$gpuser=Gpuser::orderByDesc('id')->get();

        $departement=Departement::where('id','!=','1')->where('id','!=','5')->get();

        $data =[

            'title'=>$description='Créer un utilisateur',
            'description'=>$description,
            //'gpuser'=>$gpuser,
            'departement'=>$departement,
            
            
        ];
           return view('user.create',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user)
    {
        //


     
     DB::beginTransaction();

     try {

      //$validateData = $request->validated();

       request()->validate([
        
        'name'=>['required','min:3','max:20'],
        'pseudo'=>['required','min:3','max:20',Rule::unique('users')->ignore($user)],
        'email'=>['required','email',Rule::unique('users')->ignore($user)],
        'avatar'=>['sometimes','nullable','file','image','mimes:jpeg,png,jpg','dimensions:min_width=200,min_height=200'], 
        'departement_id'=>['sometimes','nullable','exists:departements,id'],
        'gpusers_id'=>['sometimes','nullable','exists:gpusers,id'],
        'statut_id'=>['sometimes','nullable','exists:statuts,id'],
        'password'=>'required|between:9,20',
           ]);

        
        $user = new User;
        $user->gpusers_id = request('gpusers_id');
        $user->departement_id = request('departement_id');
        $user->statut_id ='2';
        $user->pseudo = request('pseudo');
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));

        $user->save();
     


        
         //max : valeur , pour la taille maximum du fichier image

        if (request()->hasFile('avatar') && request()->file('avatar')->isValid()) {

            // verifier l'existence de l'avatar

            if (Storage::exists('avatars/'.$user->id)) {
                
               Storage::deleteDirectory('avatars/'.$user->id);
            }
            

            //renommer l'avatar
            $ext = request()->file('avatar')->extension();
            $filename = Str::slug($user->name).'-'.$user->id.'.'.$ext;
            
            //stockage de l'image de base
            $path = request()->file('avatar')->storeAs('avatars/'.$user->id,$filename);
            // redimensionnement de l'image redimensionner
       $thumbnailImage = Image::make(request()->file('avatar'))->fit(200, 200, function($constraint){
                    $constraint->upsize();
                })->encode($ext, 50);

             // stockage de l'image redimensionner
                $thumbnailPath = 'avatars/'.$user->id.'/thumbnail/'.$filename;

                Storage::put($thumbnailPath, $thumbnailImage);

            // insertion ds la BD
                
          $user->avatar()->updateOrCreate(['id'=>$user->id],
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

        
         
        $success = 'utilisateur crée avec succes';

        return redirect()->route('user.show')->withSuccess($success);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $users=User::orderByDesc('id')->get();
        

        $data =[

            'title'=>$description='Afficher les utilisateurs',
            'description'=>$description,
            'users'=>$users,
           
            
        ];
           return view('user.show',$data);
           //dd($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        
        //$user=auth()->user();

        $gpuser=Gpuser::where('id','!=','1')->get();

        $departement=Departement::where('id','!=','1')->where('id','!=','5')->get();

        $statut=Statut::orderByDesc('id')->get();

        //$utilisateur=User::select('statut')->groupBy('id')->distinct()->get();

        /*$profils=Gpuser::join('users', 'gpusers_id', '=', 'gpusers.id')
              ->select('profil')
              ->where('users.pseudo', '=', $pseudo)
              ->get()->toArray()[0];*/

        $data =[

            'title'=>$description='Editer un utilisateur',
            'description'=>$description,
            'user'=>$user,
            'statut'=>$statut,
            'gpuser'=>$gpuser,
            'departement'=>$departement,
            
        ];
           return view('user.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        //
        // empecher la modification de l'utilisateur "Admin"

         abort_if($user->id == "1",403);

         DB::beginTransaction();

     try {


        //$user=auth()->user();
        
        $validateData=request()->validate([
        'name'=>['required','min:3','max:20'],

        'pseudo'=>['required','min:3','max:20',Rule::unique('users')->ignore($user)],

        'email'=>['required','email',Rule::unique('users')->ignore($user)],

        'avatar'=>['sometimes','nullable','file','image','mimes:jpeg,png,jpg','dimensions:min_width=200,min_height=200'], 

        'departement_id'=>['sometimes','nullable','exists:departements,id'],

        'gpusers_id'=>['sometimes','nullable','exists:gpusers,id'],

        'statut_id'=>['sometimes','nullable','exists:statuts,id'],

        ]);

        
        // mise à jour 
        $user=$user->updateOrCreate(['id'=>$user->id],$validateData);
        
         //max : valeur , pour la taille maximum du fichier image

        if (request()->hasFile('avatar') && request()->file('avatar')->isValid()) {

            // verifier l'existence de l'avatar

            if (Storage::exists('avatars/'.$user->id)) {
                
               Storage::deleteDirectory('avatars/'.$user->id);
            }
            

            //renommer l'avatar
            $ext = request()->file('avatar')->extension();
            $filename = Str::slug($user->name).'-'.$user->id.'.'.$ext;
            
            //stockage de l'image de base
            $path = request()->file('avatar')->storeAs('avatars/'.$user->id,$filename);
            // redimensionnement de l'image redimensionner
       $thumbnailImage = Image::make(request()->file('avatar'))->fit(200, 200, function($constraint){
                    $constraint->upsize();
                })->encode($ext, 50);

             // stockage de l'image redimensionner
                $thumbnailPath = 'avatars/'.$user->id.'/thumbnail/'.$filename;

                Storage::put($thumbnailPath, $thumbnailImage);

            // insertion ds la BD
                
          $user->avatar()->updateOrCreate(['id'=>$user->id],
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

     return redirect()->route('user.show')->withSuccess($success);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        // // empecher la suppression de l'utilisateur "Admin"

         abort_if($user->id == "1",403);
        // supprime le contenu du dossier avatar correspondant à l'user

         Storage::deleteDirectory('avatars/'.$user->id);

         // supprime l'user , ses infos et son contenu

         $user->delete();

         $success='utilisateur supprimé';
         return back()->withSuccess($success);
    }

     public function password() //formulaire d'update de password
    {
        $data = [
            'title' => $description = 'Modifier mon mot de passe',
            'description'=>$description,
            'user'=>auth()->user(),
        ];
        return view('user.password', $data);
    }


    public function updatePassword() //mise à jour du mot de passe
    {  
        // empecher la modification du password de l'utilisateur "Admin"

        abort_if(Auth::id() == "1",403);

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



     public function touslesmembres() //mise à jour du mot de passe
    {
        
          //$membre=Membre::orderByDesc('id')->get();

    //dd($deptid);        


        $membre = Membre::orderByDesc('id')->get();
        

        $data =[

            'title'=>$description='Afficher les membres',
            'description'=>$description,
            'membre'=>$membre,
           
            
        ];

      
           return view('user.membre',$data);


    }
   

      public function recherche(Request $request) //mise à jour du mot de passe
    {
        

          //$membre=Membre::orderByDesc('id')->get();


        $dept = $request->departement_id;

        if ($request->departement_id=="") {
            # code...
            //$dept="5";

            $departement=Departement::where('departements.id', '!=','1')->where('departements.id', '!=','5')->get();

            $membre = Membre::orderByDesc('id')->get();

             $data =[

            'title'=>$description='Afficher les membres',
            'description'=>$description,
            'membre'=>$membre,
            'departement'=>$departement,
            
        ];

      
      
           return view('user.recherche',$data);

        } else {
            # code...
        
           $dept = $request->departement_id;
        }
        //dd($dept);

        $deptid=Departement::join('groupes', 'departement_id','=','departements.id')
              //->join('users', 'users.departement_id', '=', 'groupes.departement_id')
              ->select('groupes.id')
              ->where('departements.id', '=',$dept)
              ->get()->toArray();
         
        
       foreach ($deptid as $deptids) {

       //dd($deptids);



        $departement=Departement::where('departements.id', '!=','1')->where('departements.id', '!=','5')->get();      


        $membre = Membre::where('groupe_id', $deptid)->get();
        

        $data =[

            'title'=>$description='Afficher les membres',
            'description'=>$description,
            'membre'=>$membre,
            'departement'=>$departement,
            
        ];

         //$nome = $request->nome;
    //$uf = $request->uf;
    //$pesquisa = Client::where('nome', 'like', '%'.$nome.'%')
    //->orderBy('nome')
    //->paginate(5);

    //return view('clients.index')
        //->with('pesquisa', $pesquisa)
        //->with('clients', $clients);
      
           return view('user.recherche',$data);
      

      
      }
      
    }


      public function programme(Request $request) //mise à jour du mot de passe
    {
        
          $date1= $request->dateactivite1;
          $date2= $request->dateactivite2;
          $dept = $request->departement_id;

        if ($request->departement_id=="") {
            # code...
            //$dept="5";

            $departement=Departement::where('departements.id', '!=','1')->where('departements.id', '!=','5')->get();
            $fichiers = Fichier::orderByDesc('id')->get();

            $data =[

            'title'=>$description='Afficher les membres',
            'description'=>$description,
            'fichiers'=>$fichiers,
            'departement'=>$departement,
            
            ];

      
           return view('user.programme',$data);

        } else {
            # code...
        
           $dept = $request->departement_id;
        }
        //dd($dept);

        $deptid=Departement::join('groupes', 'departement_id','=','departements.id')
              //->join('users', 'users.departement_id', '=', 'groupes.departement_id')
              ->select('groupes.id')
              ->where('departements.id', '=',$dept)
              ->get()->toArray();
         
        //dd($deptid);

        //if ($deptid=='') {
            //$deptid="1";
        //} else {
            # code...
        
       foreach ($deptid as $deptids) {

       //dd($deptids);

        $departement=Departement::where('departements.id', '!=','1')->get();      


        $fichiers = Fichier::where('groupe_id', $deptid)->whereBetween('date_activite', [$date1, $date2])
        ->orwhereBetween('date_activite', [$date1, $date2])->orWhere('groupe_id', $deptid)->get();
        

        $data =[

            'title'=>$description='Afficher les membres',
            'description'=>$description,
            'fichiers'=>$fichiers,
            'departement'=>$departement,
            
        ];

      
           return view('user.programme',$data);
      

      
       }
      
    }


  

}
