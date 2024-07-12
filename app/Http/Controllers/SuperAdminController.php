<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\models\users;
use app\Http\Requests\UserStoreRequest;
use App\Models\Galerie;
use App\Models\User;
use App\Models\Vehicules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SuperAdminController extends Controller
{
    public function index(){
        try {
            $users = User::all();
            return response()->json($users);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération des utilisateurs: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la récupération des utilisateurs', 'details' => $e->getMessage()], 500);
        }
    }
    public function store(UserStoreRequest $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            return response()->json([
                'message' => 'user successfully created'
            ],200);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'something went really wrong'
            ],500);
        }
    }


    public function show($id){
        $users = user::find($id);
        if(!$users){
         return response()->json(['message'=> 'user not found'],404);
        }
        return response()->json([
            'resultat' => $users
        ],200);

    }

    //affichage vehicules
    public function viewVehicule(){
        try {
            $vehicules = Vehicules::all();

        return response()->json([
            'vehicules'=>$vehicules
        ],200);
        } catch (\Exception $e) {
            return response()->json([
                'messageError' => $e->getMessage()
            ],500);
        }

    }

    //suppression vehicules
    public function delete($id){
        // recuperation id
        $getId= Vehicules::find($id);

        $getId->delete();

        return response()->json([
            'message' => 'suprrimer'
        ],200);
    }

    //Ajout des vehicules
    public function storeUpload(Request $req){


        $photo = $req->file('photo');
        $photoName = $photo->getClientOriginalName();
        $photoPath = $photo->storeAs('ImageVehicule',$photoName,'public');


        $InsertVehicul = new Vehicules();
        $InsertVehicul->marque = $req->marque;
        $InsertVehicul->matricule = $req->matricule;
        $InsertVehicul->photo = $photoName;
        $InsertVehicul->save();
        return response()->json([
            'message' => 'File upload',
            'file_path' => "/storage/$photoPath",
            'path' => Storage::url($photoPath)
        ],200);
       
    }
//affichage des vehicule par id
public function showVehicule($id){
    $car = Vehicules::find($id);
    $error = 'sucsesful';
    return response()->json([
        'car' => $car,
        'message' => $error
    ],200);
}
//modifier les vehicule
    public function updateCar(Request $req, $id)
    {

        try {
            $req->validate([
                "marque"=>"required",
                "matricule"=>"required",
                "photo"=>"required"
            ]);
            //recuperation de l'id
            $InsertVehicul = Vehicules::find($id);

            //modification du photo
            if ($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('ImageVehicule',$photoName,'public');
            $InsertVehicul->photo = $photoName;

            }

            //modifiation des donnes
            $InsertVehicul->marque = $req->marque;
            $InsertVehicul->matricule = $req->matricule;
            $InsertVehicul->update();

            return response()->json([
                'message' => 'modiifer!',
                'vehicule' => $InsertVehicul
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'messageError' => $e->getMessage()
            ],500);
        }
    }

    //insertion galeries des vehicules
    public function InsertGalerie(Request $req,$id){
        try {
            $galerie = new Galerie();
            $galerie->vehicules_id=$id;
            if ($req->hasFile('image')) {
                $photo = $req->file('image');
                $photoName = time() . '.' . $photo->getClientOriginalExtension();
                $photoPath = $photo->storeAs('GalerieVehicule',$photoName,'public');
                $galerie->image = $photoName;
            }
            $galerie->save();




            return response()->json([
                'message' => 'galerie ajoute',
                'galerie'=>$galerie
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'messageError' => $e->getMessage()
            ],500);
        }
    }

//affichage des photo dans les galerie
    public function ViewGalerie($id){

            $View = DB::table('galeries')
            ->select('image')
            ->where('vehicules_id',$id)
            ->get();

            return response()->json([
                'galerie'=>$View
            ],200);
    }

    //delete photo galerie
    public function deleteGalerie($id){
        // recuperation id
        $getId= Galerie::find($id);

        $getId->delete();

        return response()->json([
            'message' => 'suprrimer'
        ],200);
    }


    //reservation Vehicule

}
