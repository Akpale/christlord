<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Departement,User,Groupe};

use Illuminate\Validation\Rule;

use Auth,Str,Storage,Image,DB;

class DepartementController extends Controller
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

            'title'=>$description='Ajouter un nouveau Département',
            'description'=>$description,
            //'gpuser'=>$gpuser,
            
        ];
           return view('departement.create',$data);
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

            'libelle'=>'required|between:2,30|unique:departements',
        ]);

        $departement = new Departement;
        $departement->libelle = request('libelle');
        $departement->save();

        $groupe = new Groupe;
        $groupe->departement_id=$departement->id;
        $groupe->activite=request('libelle');
        $groupe->save();

        $success = 'Un nouveau département vient dêtre ajouté avec Succès.';
        return redirect()->route('departement.show')->withSuccess($success);
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
         $departement=Departement::where('id','!=','1')->where('id','!=','5')->get();
        

        $data =[

            'title'=>$description='Lister les Départements',
            'description'=>$description,
            'departement'=>$departement,
           
        ];
           return view('departement.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Departement $departement)
    {
        //
        //$departement=Departement::orderByDesc('id')->get();

        //$user=User::orderByDesc('id')->get();

        $data =[

            'title'=>$description='Editer un Département',
            'description'=>$description,
            'departement'=>$departement,
            //'user'=>$user,
            
        ];
           return view('departement.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Departement $departement,Groupe $groupe)
    {
        //
         // empecher la modification de departement "Admin" de l'utilisateur "Admin"

        abort_if(Auth::id() == "1",403);


        $validateData=request()->validate([
        
        'libelle'=>['required','min:3','max:20',Rule::unique('departements')->ignore($departement)],
        ]);

        
        // mise à jour 
        $departement=$departement->updateOrCreate(['id'=>$departement->id],$validateData);
        
        $groupe=Departement::join('groupes', 'departement_id','=','departements.id')
              ->select('groupes.id')
              ->where('departements.id', '=',$departement->id)
              ->get()->toArray()[0];

        //dd($groupe_id);
       foreach ($groupe as $groupe_id) {

        $groupe= Groupe::find($groupe_id);
        $groupe->departement_id = $departement->id;
        $groupe->activite = request('libelle');
        $groupe->save();

        }

        $success = 'mise à jour éffectuée avec Succès.';
        return redirect()->route('departement.show')->withSuccess($success);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement,Groupe $groupe)
    {
        //
        // empecher la modification de departement "Admin" de l'utilisateur "Admin"
        $deptidd = Departement::where('id', $departement)->get();

        abort_if($deptidd == "1",403);

        $groupe->delete();
        $departement->delete();

         $success='Departement supprimé';
         return back()->withSuccess($success);
    }
}
