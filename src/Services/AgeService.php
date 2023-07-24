<?php

namespace App\Services;

class AgeService {

    public function calculateAge($date){
        /** */
        return date('Y') - $date;
    }
}