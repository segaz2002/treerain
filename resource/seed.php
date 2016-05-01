<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 4/28/16
 * Time: 12:37 PM
 */

class Seeder {
    private function patient(){
        $patients = [
            [
                'pn' => '020323283482342',
                'first'=>'Gabriel',
                'last'=>'Kolawole',
                'dob'=>'1988-01-01'
            ],
            [
                'pn' => '0203234693482342',
                'first'=>'Marko',
                'last'=>'West',
                'dob'=>'1982-02-18'
            ],
            [
                'pn' => '02090234693482342',
                'first'=>'samuel',
                'last'=>'fox',
                'dob'=>'1995-04-03'
            ],
            [
                'pn' => '02090034693482342',
                'first'=>'Mark',
                'last'=>'Laane',
                'dob'=>'1992-01-03'
            ],
            [
                'pn' => '02090134693482342',
                'first'=>'Jamie',
                'last'=>'Femi',
                'dob'=>'1998-03-04'
            ],

        ];
        return $patients;
    }

    private function insurance(){
        $policies = [
            [
                [
                    'patient_id' => 1,
                    'iname' => 'Swisscare',
                    'from_date' => '2016-01-04',
                    'to_date' => '2016-03-03'
                ],
                [
                    'patient_id' => 1,
                    'iname' => 'Swisscare',
                    'from_date' => '2016-02-04',
                    'to_date' => '2016-02-18'
                ]
            ],
            [
                [
                    'patient_id' => 2,
                    'iname' => 'Ergo premium',
                    'from_date' => '2016-01-04',
                    'to_date' => '2016-03-03'
                ],
                [
                    'patient_id' => 2,
                    'iname' => 'Ergo premium',
                    'from_date' => '2016-02-04',
                    'to_date' => '2016-02-18'
                ]
            ],
            [
                [
                    'patient_id' => 3,
                    'iname' => 'Ergo Gold',
                    'from_date' => '2016-02-04',
                    'to_date' => '2016-03-04'
                ],
                [
                    'patient_id' => 3,
                    'iname' => 'Ergo Gold',
                    'from_date' => '2016-01-04',
                    'to_date' => '2016-01-18'
                ]
            ],
            [
                [
                    'patient_id' => 4,
                    'iname' => 'Ergo Basic',
                    'from_date' => '2016-02-04',
                    'to_date' => '2016-03-04'
                ],
                [
                    'patient_id' => 4,
                    'iname' => 'Ergo Basic',
                    'from_date' => '2016-01-04',
                    'to_date' => '2016-01-18'
                ]
            ],
            [
                [
                    'patient_id' => 5,
                    'iname' => 'Ergo Basic',
                    'from_date' => '2016-02-04',
                    'to_date' => '2016-03-04'
                ],
                [
                    'patient_id' => 5,
                    'iname' => 'Ergo Basic',
                    'from_date' => '2016-01-04',
                    'to_date' => '2016-01-18'
                ]
            ]
        ];
        return $policies;
    }

    public function run($resource){
        //Patients
        $record_count = 0;
        foreach($this->patient() as $patient){
            $query = "INSERT into patient (pn,first,last,dob) values(";
            $query .= $patient['pn'].",' ".$patient['first']." ','".$patient['last']." ',' ".$patient['dob']." ')";
            echo $query;
            $resource->run($query);
            $record_count++;
        }
        echo 'LOG -info:: '.$record_count. " rows was successfully seeded for [TABLE] Patients";


        //Insurance
        $record_count = 0;
        foreach($this->insurance() as $policies){
            foreach($policies as $policy ){
                $query = 'INSERT into insurance (patient_id,iname,from_date,to_date) values(';
                $query .= $policy['patient_id'].','.$policy['iname'].','.$policy['from_date'].','.$policy['to_date'].')';
                $resource->run($query);
                $record_count++;
            }
        }
        echo "LOG -info:: ".$record_count. " rows was successfully seeded for [TABLE] Patients";
        echo "\n";
        echo "LOG -info:: Seeding is completed";
    }
}