<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{User,Gpuser,Groupe,Statut,Departement};

use Auth;

class LoginController extends Controller
{
     public function __construct()
    {
        $this->middleware('guest');
        
    }
    // si l'ulisateur est non connecté(invité)
	//public function __construct()
   //{
   // $this->middleware('guest');
   //}


    public function index()// formulaire de connexion
    { 
    	//dd(Auth::check()); // pour savoir si l'ulisateur est bien connecté

    	//Auth::logout();

        $data =[

        	'title'=>'Login - '.config('app.name'),
        	'description'=>'Connexion à votre compte '.config('app.name'),

        ];
           return view('auth.login',$data);
    }

    public function login()// traitement du login
    { 
        
        request()->validate([
           	
           	'pseudo'=>'required',
           	'password'=>'required',
           ]);
        
         $pseudo=request('pseudo');

         $password = bcrypt(request('password'));


        // recherche sur le departement de l'utilisateur
             //$dept = User::where('departement_id')->get()->toArray();

             $dept =User::select('departement_id')->get()->toArray();

             //dd($dept);

           // Ajout d'une clause where 'auteur' = 'brouette'
             $users = User::where('pseudo', 'Admin')->get()->toArray();

                
                if (empty($users)) {
                   
              Statut::create(['statut' => 'activé']); 
              Statut::create(['statut' => 'desactivé']); 
      
              Gpuser::create(['profil' => 'Admin']);
              Gpuser::create(['profil' => 'Administrateur']); 
              Gpuser::create(['profil' => 'Sécretariat']);
              Gpuser::create(['profil' => 'Utilisateur']); 

         
              Departement::create(['libelle' => 'Admin']); 
              Departement::create(['libelle' => 'Néhémie']); 
              Departement::create(['libelle' => 'AOC']); 
              Departement::create(['libelle' => 'Jeunesse']);
              Departement::create(['libelle' => 'Sécretariat']); 
              
              Groupe::create(['departement_id' => '1','activite' => 'Admin']); 
              Groupe::create(['departement_id' => '2','activite' => 'Néhémie']); 
              Groupe::create(['departement_id' => '3','activite' => 'AOC']); 
              Groupe::create(['departement_id' => '4','activite' => 'Jeunesse']); 
              Groupe::create(['departement_id' => '5','activite' => 'Sécretariat']); 
                   /*$gpuser= new Gpuser;
                   $gpuser->profil = 'Admin';
                   $gpuser->save();

                   $groupe= new Groupe;
                   $groupe->activite = 'Admin';
                   $groupe->save();*/

                   $user = new User;
                   $user->departement_id = '1';
                   $user->gpusers_id = '1';
                   $user->statut_id = '1';
                   $user->name = 'Admin';
                   $user->email = 'admin@admin.com';
                   $user->pseudo = $pseudo;
                   $user->password = $password;
                   $user->save();
                 }

               

             

              // se souvenir

             //dd(request()->has('remember'));

              $remember=request()->has('remember');

      

           if (Auth::attempt(['pseudo' => $pseudo, 'password' => request('password')], $remember)) {

           	   //dd(Auth::user());
           	   //dd($profil);

           	  $profils=Gpuser::join('users', 'gpusers_id', '=', 'gpusers.id')
              ->select('profil')
              ->where('users.pseudo', '=', $pseudo)
              ->get()->toArray()[0];

              $statuts=Gpuser::join('users', 'gpusers_id', '=', 'gpusers.id')
              ->select('statut_id')
              ->where('users.pseudo', '=', $pseudo)
              ->get()->toArray()[0];
            
              //dd($statuts);

           	 foreach ($profils as $profil) {

                 foreach ($statuts as $statut) {

           	    if ((($profil=="Administrateur")||($profil=="Admin"))&&($statut=="1")){
           	    	
           	    	return redirect('users');
               

             }elseif(($profil=="Sécretariat")&&($statut=="1")){
               
                   return redirect('membres');

             }elseif(($dept!="1")||($profil!="Administrateur")||($profil!="Admin")&&($statut=="1")){
               
                   return redirect('membre2');

             }elseif((($profil=="Sécretariat")||($profil=="Utilisateur"))&&($statut=="2")){
               
                   return redirect('logout');
                   
                   
             } 

           } 
   
          }
           
        }   


           return back()->withError('Mauvais identifiants.')->withInput();
    }

            
}
