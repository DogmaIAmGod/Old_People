<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {

        //individuals
        Schema::table('individuals', function (Blueprint $table) {
            $table->foreign('roleID')->references('roleID')->on('roles');
        });

        //passwords
        Schema::table('passwords', function (Blueprint $table) {
            $table->foreign('individualID')->references('individualID')->on('individuals');
        });

        //supervisors
        Schema::table('supervisors', function (Blueprint $table) {
            $table->foreign('individualID')->references('individualID')->on('individuals');
        });

        //doctors
        Schema::table('doctors', function (Blueprint $table) {
            $table->foreign('individualID')->references('individualID')->on('individuals');
        });

        //care_groups
        Schema::table('care_groups', function (Blueprint $table) {
            $table->foreign('caregiverID')->references('caregiverID')->on('caregivers');
        });

        //patients
        Schema::table('patients', function (Blueprint $table) {
            $table->foreign('individualID')->references('individualID')->on('individuals');
            $table->foreign('careGroupID')->references('careGroupID')->on('care_groups');
        });

        //cares
        Schema::table('cares', function (Blueprint $table) {
            $table->foreign('patientID')->references('patientID')->on('patients');
            $table->foreign('caregiverID')->references('caregiverID')->on('caregivers');
        });

        //patient_meds
        Schema::table('patient_meds', function (Blueprint $table) {
            $table->foreign('patientID')->references('patientID')->on('patients');
        });

        //emergency_contacts
        Schema::table('emergency_contacts', function (Blueprint $table) {
            $table->foreign('patientID')->references('patientID')->on('patients');
        });

        //payments
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('patientID')->references('patientID')->on('patients');
        });

        //appointments
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('patientID')->references('patientID')->on('patients');
            $table->foreign('doctorID')->references('doctorID')->on('doctors');
        });

        //comment
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('appointmentID')->references('appointmentID')->on('appointments');
        });

        //salaries
        Schema::table('salaries', function (Blueprint $table) {
            $table->foreign('individualID')->references('individualID')->on('individuals');
        });

    }


    public function down()
{

    //salaries
    Schema::table('salaries', function (Blueprint $table) {
        $table->dropForeign(['individualID']);
    });

    //comments
    Schema::table('comments', function (Blueprint $table) {
        $table->dropForeign(['appointmentID']);
    });

    //appointments
    Schema::table('appointments', function (Blueprint $table) {
        $table->dropForeign(['patientID']);
        $table->dropForeign(['doctorID']);
    });

    //payments
    Schema::table('payments', function (Blueprint $table) {
        $table->dropForeign(['patientID']);
    });

    //emergency_contacts
    Schema::table('emergency_contacts', function (Blueprint $table) {
        $table->dropForeign(['patientID']);
    });

    //patient_meds
    Schema::table('patient_meds', function (Blueprint $table) {
        $table->dropForeign(['patientID']);
    });

    //cares
    Schema::table('cares', function (Blueprint $table) {
        $table->dropForeign(['caregiverID']);
        $table->dropForeign(['individualID']);
    });

    //patients
    Schema::table('patients', function (Blueprint $table) {
        $table->dropForeign(['careGroupID']);
        $table->dropForeign(['individualID']);
    });

     //care_groups
     Schema::table('care_groups', function (Blueprint $table) {
        $table->dropForeign(['caregiverID']);
    });

    //caregivers
    Schema::table('caregivers', function (Blueprint $table) {
        $table->dropForeign(['individualID']);
    });

    //doctors
    Schema::table('doctors', function (Blueprint $table) {
        $table->dropForeign(['individualID']);
    });

    //supervisors
    Schema::table('supervisors', function (Blueprint $table) {
        $table->dropForeign(['individualID']);
    });

    //passwords
    Schema::table('passwords', function (Blueprint $table) {
        $table->dropForeign(['individualID']);
    });

    //individuals
    Schema::table('individuals', function (Blueprint $table) {
        $table->dropForeign(['roleID']);
    });

}};

