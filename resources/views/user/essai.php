<main>

    <div class="container-fluid" >

      <h3 class="text-muted">Espace Administrateur</h3>
    
       <button onclick="location.href='{{route('user.create')}}'" class="btn btn-success">Ajouter</button>

       <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm" >Pseudo
      </th>
      <th class="th-sm">Nom
      </th>
      <th class="th-sm">Email
      </th>
      <th class="th-sm">Profil
      </th>
      <th class="th-sm">Département
      </th>
      <th class="th-sm">Statut
      </th>
      <th class="th-sm">Action
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <td>{{$user->pseudo}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->gpuser->profil}}</td>
      <td>{{$user->groupe->activite}}</td>
      <td></td>
      <td>
        <a href=""><button class="btn btn-primary">Editer</button></a>
        <a href=""><button class="btn btn-warning">Supprimer</button></a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
      <br>
    </div>
  </main >