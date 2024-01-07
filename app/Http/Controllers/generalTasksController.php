<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\individuals;
use App\Models\passwords;
use App\Models\caregiver;
use App\Models\doctor;
use App\Models\patients;
use App\Models\emergencyContact;
use App\Models\payments;
use App\Models\supervisors;

class generalTasksController extends Controller
{
    public function login(Request $request)
    {
        if (!empty(session('roleID'))) {
            $request->session()->flush();
            return redirect('/login');
        }
        return view('login');
    }

    public function validateLogin(Request $request)
    {
        $data = $request->all();

        $individual = Individuals::where('email', $data['email'])->first();

        if ($individual) {
            $savedPassword = Passwords::where('individualID', $individual->individualID)->first();

            if ($savedPassword) {
                $passwordMatch = $savedPassword->password === $data['password'];

                $userID = $individual->individualID;
                $roleID = $individual->roleID;
                session(['userID' => $userID]);
                session(['roleID' => $roleID]);

                if ($passwordMatch) {
                    // Redirect based on roleID
                    switch ($individual->roleID) {
                        case 1: // Patient
                            return redirect()->route('patientlogin');
                            break;
                        case 2: // Caregiver
                            return redirect()->route('caregiverlogin');
                            break;
                        case 3: // Doctor
                            return redirect()->route('newRoster');
                            break;
                        case 4: // Family Member
                            return redirect()->route('familymemberlogin');
                            break;
                        case 5: // Supervisor
                            return redirect()->route('supervisorlogin');
                            break;
                        case 6: // admin
                            return redirect()->route('adminNavigation');
                            break;
                        default:
                            return 'Unknown role';
                            break;
                    }
                } else {
                    return 'Incorrect password';
                }
            } else {
                return 'Password not found';
            }
        } else {
            return 'Email not registered';
        }
    }

    public function register()
    {
        return view(('register'));
    }

    public function registerUser(Request $request)
    {
        $data = $request->all();

        $individual =individuals::create([
            'roleID' =>$data['roleID'],
            'fName' => $data['fName'],
            'lName' => $data['lName'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'dob' => $data['dob']
        ]);
        // dd($individual);

        $individualID = $individual->individualID;

        passwords::create([
            'individualID'=>$individualID,
            'password'=>$data['password']
        ]);

        if($data['roleID'] == 1){

            $patients = patients::create([
                'individualID'=>$individualID,
                'careGroupID'=>null,
                'familyCode'=>$data['familyCode'],
                'admissionDate'=>today()
            ]);

            $patientID = $patients->patientID;

            emergencyContact::create([
                'patientID'=>$patientID,
                'familyCode'=>$data['familyCode'],
                'emergencyContact'=>$data['emergencyContact'],
                'relation'=>$data['ecRelationship']
            ]);

            payments::create([
                'patientID'=>$patientID,
            ]);

        }

        if($data['roleID'] == 2){

            caregiver::create([
                'individualID' => $individualID,
                'careGroupID' => null,
            ]);
        }

        if($data['roleID'] == 3){
            doctor::create([
                'individualID' => $individualID,
            ]);
        }

        if($data['roleID'] == 5){
            supervisors::create([
                'individualID' => $individualID,
            ]);
        }

    return redirect()->route('login');
    }
}
