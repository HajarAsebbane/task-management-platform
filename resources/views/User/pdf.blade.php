
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        #customers {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        #customers td, #customers th {
          border: 1px solid #ddd;
          padding: 8px;
        }
        
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #04AA6D;
          color: white;
        }
        </style>
        
</head>
<body>
      <h1 style="text-align: center;">Liste des taches</h1>

                <table id="customers">
                <tr>
                <th >name</th>
                <th >Date_Debut</th>
                <th >Date_Fin</th>
                <th >Description</th>
                <th >Projet</th>
                <th >Statu</th>
                </tr>
                @foreach ( $tacheUser as $item ) 
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->datedebut}}</td>
                    <td>{{$item->datefin}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->project}}</td> 
                    

                    <td>
                      @if($item->etat_tache=='0')  
                      <button class="btn btn  btn-secondary"> <div class="spinner-border spinner-border-sm" role="status">
                        
                      </div>
                      <div class="spinner-grow spinner-grow-sm" role="status">
                       
                      </div>en cours</button>
                      @elseif ($item->etat_tache=='1')
                      <button class="btn btn btn-success">Terminé</button>
                         @endif
                      
                        
                       
                      </td>
                    
                </tr>
                @endforeach
                </table>

</body>
</html>




