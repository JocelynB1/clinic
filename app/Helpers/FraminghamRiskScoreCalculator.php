<?php

namespace App\Helpers;

class FraminghamRiskScoreCalculator
{
   // private $patient;
    private $workingOut;
    private $gender;
    private $age;
    private $score;
    private $cholesterol;
    private $hdl_cholesterol;
    private $medication;
    private $smokes;
    private $systolic_bp;
    public function __construct($input)
    {
        $this->gender=$input['gender'];
        $this->patient = "";
        $this->workingOut = [];
        $this->age = $input['age'];
        $this->total_cholesterol=$input['total_cholesterol'];
        $this->hdl_cholesterol=$input['hdl_cholesterol'];
        $this->medication=$input['medication'];
        $this->smokes=$input['smokes'];
        $this->systolic_bp=$input['systolic_bp'];
        //$this->labs = $patient->labs->last();
        //$this->visits=$patient->visits->last();
        //$this->vitals=$patient->vitals->last();
        $this->score = 0;
    
       
    }
    function calculateFRS()
    {
        $this->workingOut[] = ["Gender" => [$this->gender,null]];

        if ($this->gender == "Female") {
            $this->workingOut[] = $this->calculateFemaleAgeScore();
            $this->workingOut[] = $this->calculateFemaleCholesterolScore();
            $this->workingOut[] = $this->calculateFemaleCigaretteScore();
            $this->workingOut[] = $this->calculateFemaleHdlScore();
            $this->workingOut[] = $this->calculateFemaleSystolicScore();
         //   $this->workingOut[] = ["Score"=>$this->score,null];
            $this->workingOut[] = $this->calculateFemaleRiskPercentangeScore();
        
        }
        if ($this->gender == "Male") {
            $this->workingOut[] = $this->calculateMaleAgeScore();
            $this->workingOut[] = $this->calculateMaleCholesterolScore();
            $this->workingOut[] = $this->calculateMaleCigaretteScore();
            $this->workingOut[] = $this->calculateMaleHdlScore();
            $this->workingOut[] = $this->calculateMaleSystolicScore();
           // $this->workingOut[] = ["Score"=>$this->score,null];
            $this->workingOut[] = $this->calculateMaleRiskPercentangeScore();
        
        }
     
        return $this->workingOut;
    }
    private function calculateFemaleAgeScore()
    {

        if ($this->age > 20 && $this->age <= 34) {
            $this->score -= 7;
            return ["Age 20-34 years: -7 points" => [$this->age,$this->score]];
        }
        if ($this->age >= 35 && $this->age <= 39) {
            $this->score -= 3;
            return ["Age 35-39 years: -3 points" => [$this->age,$this->score]];
        }
        if ($this->age >= 40 && $this->age <= 44) {
            return ["Age 40-44 years: 0 points" => [$this->age,$this->score]];
        }
        if ($this->age >= 45 && $this->age <= 49) {
            $this->score += 3;
            return ["Age 45-49 years: 3 points" => [$this->age,$this->score]];
        }
        if ($this->age >= 50 && $this->age <= 54) {
            $this->score += 6;
            return ["Age 50-54 years: 6 points" => [$this->age,$this->score]];
        }
        if ($this->age >= 55 && $this->age <= 59) {
            $this->score += 8;
            return ["Age 55-59 years: 8 points" => [$this->age,$this->score]];
        }
        if ($this->age >= 60 && $this->age <= 64) {
            $this->score += 10;
            return ["Age 60-64 years: 10 points" => [$this->age,$this->score]];
        }
        if ($this->age >= 65 && $this->age <= 69) {
            $this->score += 12;
            return ["Age 65-69 years: 12 points" => [$this->age,$this->score]];
        }
        if ($this->age >= 70 && $this->age <= 74) {
            $this->score += 14;
            return ["Age 70-74 years: 14 points" => [$this->age,$this->score]];
        }
        if ($this->age >= 75 && $this->age <= 79) {
            $this->score += 16;
            return ["Age 75-79 years: 16 points" => [$this->age,$this->score]];
        }
        return ["Unaccounted for age: 0 points" => [$this->age,$this->score]];

    }
    private function calculateFemaleCholesterolScore()
    {
        
        if ($this->age >= 20 && $this->age <= 39) {
            if ($this->total_cholesterol < 160) {
                return ["Total Cholesterol Age 20-39 years: Under 160: 0 points" => $this->total_cholesterol];
            }
            if ($this->total_cholesterol >= 160 && $this->total_cholesterol<=199) {
                $this->score+=4;
                return ["Total Cholesterol Age 20-39 years: 160-199: 4 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 200 && $this->total_cholesterol<=239) {
                $this->score+=8;
                return ["Total Cholesterol Age 20-39 years: 200-239: 8 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 240 && $this->total_cholesterol<=279) {
                $this->score+=11;
                return ["Total Cholesterol Age 20-39 years: 240-279: 11 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 280) {
                $this->score+=13;
                return ["Total Cholesterol Age 20-39 years: 280 or higher: 13 points" => [$this->total_cholesterol,$this->score]];
            }
        }
        if ($this->age >= 40 && $this->age <= 49) {
            if ($this->total_cholesterol < 160) {
                return ["Age 40-49 years: Under 160: 0 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 160 && $this->total_cholesterol<=199) {
                $this->score+=3;
                return ["Age 40-49 years: 160-199: 3 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 200 && $this->total_cholesterol<=239) {
                $this->score+=6;
                return ["Age 40-49 years: 200-239: 6 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 240 && $this->total_cholesterol<=279) {
                $this->score+=8;
                return ["Age 40-49 years: 240-279: 8 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 280) {
                $this->score+=10;
                return ["Age 40-49 years: 280 or higher: 10 points" => [$this->total_cholesterol,$this->score]];
            }
        }
        if ($this->age >= 50 && $this->age <= 59) {
            if ($this->total_cholesterol < 160) {
                return ["Age 50-59 years: Under 160: 0 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 160 && $this->total_cholesterol<=199) {
                $this->score+=2;
                return ["Age 50-59 years: 160-199: 2 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 200 && $this->total_cholesterol<=239) {
                $this->score+=4;
                return ["Age 50-59 years: 200-239: 4 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 240 && $this->total_cholesterol<=279) {
                $this->score+=5;
                return ["Age 50-59 years: 240-279: 5 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 280) {
                $this->score+=7;
                return ["Age 50-59 years: 280 or higher: 7 points" => [$this->total_cholesterol,$this->score]];
            }
        }
        if ($this->age >= 60 && $this->age <= 69) {
            if ($this->total_cholesterol < 160) {
                return ["Age 60-69 years: Under 160: 0 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 160 && $this->total_cholesterol<=199) {
                $this->score+=1;
                return ["Age 60-69 years: 160-199: 1 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 200 && $this->total_cholesterol<=239) {
                $this->score+=2;
                return ["Age 60-69 years: 200-239: 2 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 240 && $this->total_cholesterol<=279) {
                $this->score+=3;
                return ["Age 60-69 years: 240-279: 3 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 280) {
                $this->score+=4;
                return ["Age 60-69 years: 280 or higher: 4 points" => [$this->total_cholesterol,$this->score]];
            }
        }

        if ($this->age >= 70 && $this->age <= 79) {
            if ($this->total_cholesterol < 160) {
                return ["Age 70-79 years: Under 160: 0 points" =>[$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 160 && $this->total_cholesterol<=199) {
                $this->score+=1;
                return ["Age 70-79 years: 160-199: 1 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 200 && $this->total_cholesterol<=239) {
                $this->score+=1;
                return ["Age 70-79 years: 200-239: 1 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 240 && $this->total_cholesterol<=279) {
                $this->score+=2;
                return ["Age 70-79 years: 240-279: 2 points" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 280) {
                $this->score+=2;
                return ["Age 70-79 years: 280 or higher: 3 points" => [$this->total_cholesterol,$this->score]];
            }
            
        }
        return ["Unaccounted Cholesterol :0 points" =>  [$this->total_cholesterol,$this->score]];

    }
    private function calculateFemaleCigaretteScore()
    {
        if($this->smokes=="Yes"){
            if($this->age>=20&&$this->age<=39){
                $this->score+=9;
                return ["Is a Cigarette Smoker: Age 20-39: 9 points"=> [$this->smokes,$this->score]];
            }
            if($this->age>=40&&$this->age<=49){
                $this->score+=7;
                return ["Is a Cigarette Smoker: Age 40-49: 7 points"=>[$this->smokes,$this->score]];
            }
            if($this->age>=50&&$this->age<=59){
                $this->score+=4;
                return ["Is a Cigarette Smoker: Age 50-59: 4 points"=>[$this->smokes,$this->score]];
            }
            if($this->age>=60&&$this->age<=69){
                $this->score+=2;
                return ["Is a Cigarette Smoker: Age 20-39: 2 points"=>[$this->smokes,$this->score]];
            }
            if($this->age>=70&&$this->age<=79){
                $this->score+=1;
                return ["Is a Cigarette Smoker: Age 70-79: 1 points"=>[$this->smokes,$this->score]];
            }
        }
        if($this->smokes=="No"){
            return ["Is a Cigarette Smoker: Non-smoker: 0 points"=>[$this->smokes,$this->score]];
        
        }
        return ["Is a Cigarette Smoker: Non-smoker: 0 points"=>[$this->smokes,$this->score]];

    }
    private function calculateFemaleHdlScore(){
        if($this->hdl_cholesterol>=60){
            $this->score-=1;
            return ["HDL cholesterol, mg/dL: 60 or higher: -1 points" => [$this->hdl_cholesterol,$this->score]];
        }
        if($this->hdl_cholesterol>=50&&$this->hdl_cholesterol<=59){
            return ["HDL cholesterol, mg/dL: 50-59: 0 points" =>  [$this->hdl_cholesterol,$this->score]];
        }
        if($this->hdl_cholesterol>=40&&$this->hdl_cholesterol<=49){
            $this->score+=1;                        
            return ["HDL cholesterol, mg/dL: 40-49: 1 points" =>  [$this->hdl_cholesterol,$this->score]];
        }
        if($this->hdl_cholesterol<40){
            $this->score+=2;
            return ["HDL cholesterol, mg/dL: Under 40: 2 points" =>  [$this->hdl_cholesterol,$this->score]];
        }
        return ["Unaccounted for HDL value :0 points" =>  [$this->hdl_cholesterol,$this->score]];

    }
    
    private function calculateFemaleSystolicScore(){
        if($this->medication!="Yes"){
            if($this->systolic_bp<120){
                return ["Systolic blood pressure, mm Hg: Untreated: Under 120: 0" => [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp<=120&&$this->systolic_bp<=129){
                $this->score+=1;
                return ["Systolic blood pressure, mm Hg: Untreated: 120-129: 1" =>  [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp<=130&&$this->systolic_bp<=139){
                $this->score+=2;
                return ["Systolic blood pressure, mm Hg: Untreated: 130-139: 2" =>  [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp<=140&&$this->systolic_bp<=159){
                $this->score+=3;
                return ["Systolic blood pressure, mm Hg: Untreated: 140-159: 3" =>  [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp>=160){
                $this->score+=4;
                return ["Systolic blood pressure, mm Hg: Untreated: 160 or Higher: 4" =>  [$this->systolic_bp,$this->score]];
            }
        }
        if($this->medication=="Yes"){
            if($this->systolic_bp<120){
                return ["Systolic blood pressure, mm Hg: Treated: Under 120: 0" =>  [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp<=120&&$this->systolic_bp<=129){
                $this->score+=3;
                return ["Systolic blood pressure, mm Hg: Treated: 120-129: 3" =>  [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp<=130&&$this->systolic_bp<=139){
                $this->score+=4;
                return ["Systolic blood pressure, mm Hg: Treated: 130-139: 4" =>  [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp<=140&&$this->systolic_bp<=159){
                $this->score+=5;
                return ["Systolic blood pressure, mm Hg: Treated: 140-159: 5" =>  [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp>=160){
                $this->score+=6;
                return ["Systolic blood pressure, mm Hg: Treated: 160 or Higher: 6" =>  [$this->systolic_bp,$this->score]];
            }
        }
        return ["Unaccounted for Systolic value: 0" =>  [$this->systolic_bp,$this->score]];
       
    }
    private function calculateFemaleRiskPercentangeScore(){
        if($this->score<9){
            return ["Points total: Under 9 points <1%" => [1,$this->score]];
        }
        if($this->score>=9&&$this->score<=12){
            return ["9-12 points: 1%" => [1,$this->score]];

        }
        if($this->score>=13&&$this->score<=14){
            return ["13-14 points: 2%" => [2,$this->score]];

        }
        if($this->score==15){
            return ["15 points: 3%" => [3,$this->score]];

        }
        if($this->score==16){
            return ["16 points: 4%" => [4,$this->score]];
            
        }
        if($this->score==17){
            return ["17 points: 5%" => [5,$this->score]];
            
        }
        if($this->score==18){
            return ["18 points: 6%" => [6,$this->score]];
            
        }
        if($this->score==19){
            return ["19 points: 8%" => [8,$this->score]];
            
        }
        if($this->score==20){
            return ["20 points: 11%" => [11,$this->score]];
            
        }
        if($this->score==21){
            return ["21 points: 14%" => [14,$this->score]];
            
        }
        if($this->score==22){
            return ["22 points: 17%" => [17,$this->score]];
            
        }
        if($this->score==23){
            return ["23 points: 22%" => [22,$this->score]];
            
        }
        if($this->score==24){
            return ["24 points: 27%" => [27,$this->score]];
            
        }
        if($this->score>=25){
            return [">25: Over 30%" => [30,$this->score]];
            
        }
        return ["Unaccounted for value" => "ERROR"];

    }
    private function calculateMaleAgeScore()
    {

        if ($this->age > 20 && $this->age <= 34) {
            $this->score -= 9;
            return ["Age 20-34 years: -9" => [$this->age,$this->score]];
        }
        if ($this->age >= 35 && $this->age <= 39) {
            $this->score -= 4;
            return ["Age 35-39 years: -4" => [$this->age,$this->score]];
        }
        if ($this->age >= 40 && $this->age <= 44) {
            return ["Age 40-44 years: 0" => [$this->age,$this->score]];
        }
        if ($this->age >= 45 && $this->age <= 49) {
            $this->score += 3;
            return ["Age 45-49 years: 3" => [$this->age,$this->score]];
        }
        if ($this->age >= 50 && $this->age <= 54) {
            $this->score += 6;
            return ["Age 50-54 years: 6" => [$this->age,$this->score]];
        }
        if ($this->age >= 55 && $this->age <= 59) {
            $this->score += 8;
            return ["Age 55-59 years: 8" => [$this->age,$this->score]];
        }
        if ($this->age >= 60 && $this->age <= 64) {
            $this->score += 10;
            return ["Age 60-64 years: 10" => [$this->age,$this->score]];
        }
        if ($this->age >= 65 && $this->age <= 69) {
            $this->score += 11;
            return ["Age 65-69 years: 11" => [$this->age,$this->score]];
        }
        if ($this->age >= 70 && $this->age <= 74) {
            $this->score += 12;
            return ["Age 70-74 years: 12" => [$this->age,$this->score]];
        }
        if ($this->age >= 75 && $this->age <= 79) {
            $this->score += 13;
            return ["Age 75-79 years: 13" => [$this->age,$this->score]];
        }
        return ["Unaccounted for age:0" => [$this->age,$this->score]];

    }
    private function calculateMaleCholesterolScore()
    {
        
        if ($this->age >= 20 && $this->age <= 39) {
            if ($this->total_cholesterol < 160) {
                return ["Total Cholesterol Age 20-39 years: Under 160: 0" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 160 && $this->total_cholesterol<=199) {
                $this->score+=4;
                return ["Total Cholesterol Age 20-39 years: 160-199: 4" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 200 && $this->total_cholesterol<=239) {
                $this->score+=7;
                return ["Total Cholesterol Age 20-39 years: 200-239: 7" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 240 && $this->total_cholesterol<=279) {
                $this->score+=9;
                return ["Total Cholesterol Age 20-39 years: 240-279: 9" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 280) {
                $this->score+=11;
                return ["Total Cholesterol Age 20-39 years: 280 or higher: 13" => [$this->total_cholesterol,$this->score]];
            }
        }
        if ($this->age >= 40 && $this->age <= 49) {
            if ($this->total_cholesterol < 160) {
                return ["Age 40-49 years: Under 160: 0" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 160 && $this->total_cholesterol<=199) {
                $this->score+=3;
                return ["Age 40-49 years: 160-199: 3" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 200 && $this->total_cholesterol<=239) {
                $this->score+=5;
                return ["Age 40-49 years: 200-239: 5" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 240 && $this->total_cholesterol<=279) {
                $this->score+=6;
                return ["Age 40-49 years: 240-279: 6" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 280) {
                $this->score+=8;
                return ["Age 40-49 years: 280 or higher: 10" => [$this->total_cholesterol,$this->score]];
            }
        }
        if ($this->age >= 50 && $this->age <= 59) {
            if ($this->total_cholesterol < 160) {
                return ["Age 50-59 years: Under 160: 0" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 160 && $this->total_cholesterol<=199) {
                $this->score+=2;
                return ["Age 50-59 years: 160-199: 2" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 200 && $this->total_cholesterol<=239) {
                $this->score+=3;
                return ["Age 50-59 years: 200-239: 3" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 240 && $this->total_cholesterol<=279) {
                $this->score+=4;
                return ["Age 50-59 years: 240-279: 4" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 280) {
                $this->score+=5;
                return ["Age 50-59 years: 280 or higher: 5" => [$this->total_cholesterol,$this->score]];
            }
        }
        if ($this->age >= 60 && $this->age <= 69) {
            if ($this->total_cholesterol < 160) {
                return ["Age 60-69 years: Under 160: 0" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 160 && $this->total_cholesterol<=199) {
                $this->score+=1;
                return ["Age 60-69 years: 160-199: 1" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 200 && $this->total_cholesterol<=239) {
                $this->score+=1;
                return ["Age 60-69 years: 200-239: 1" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 240 && $this->total_cholesterol<=279) {
                $this->score+=2;
                return ["Age 60-69 years: 240-279: 2" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 280) {
                $this->score+=3;
                return ["Age 60-69 years: 280 or higher: 3" => [$this->total_cholesterol,$this->score]];
            }
        }

        if ($this->age >= 70 && $this->age <= 79) {
            if ($this->total_cholesterol < 160) {
                return ["Age 70-79 years: Under 160: 0" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 160 && $this->total_cholesterol<=199) {
                return ["Age 70-79 years: 160-199: 0" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 200 && $this->total_cholesterol<=239) {
                return ["Age 70-79 years: 200-239: 0" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 240 && $this->total_cholesterol<=279) {
                $this->score+=1;
                return ["Age 70-79 years: 240-279: 1" => [$this->total_cholesterol,$this->score]];
            }
            if ($this->total_cholesterol >= 280) {
                $this->score+=1;
                return ["Age 70-79 years: 280 or higher: 1" => [$this->total_cholesterol,$this->score]];
            }
        }    
        return ["Unaccounted for cholesterol: 0 " => [$this->total_cholesterol,$this->score]];

    }
    private function calculateMaleCigaretteScore()
    {
        if($this->smokes=="Yes"){
            if($this->age>=20&&$this->age<=39){
                $this->score+=8;
                return ["Is a Cigarette Smoker: Age 20-39: 8"=>[$this->smokes,$this->score]];
            }
            if($this->age>=40&&$this->age<=49){
                $this->score+=5;
                return ["Is a Cigarette Smoker: Age 40-49: 5"=>[$this->smokes,$this->score]];
            }
            if($this->age>=50&&$this->age<=59){
                $this->score+=3;
                return ["Is a Cigarette Smoker: Age 50-59: 3"=>[$this->smokes,$this->score]];
            }
            if($this->age>=60&&$this->age<=69){
                $this->score+=1;
                return ["Is a Cigarette Smoker: Age 20-39: 1"=>[$this->smokes,$this->score]];
            }
            if($this->age>=70&&$this->age<=79){
                $this->score+=1;
                return ["Is a Cigarette Smoker: Age 70-79: 1"=>[$this->smokes,$this->score]];
            }
        }
        if($this->smokes=="No"){
            return ["Is a Cigarette Smoker: Non-smoker: 0"=>[$this->smokes,$this->score]];
        
        }
        return ["Is a Cigarette Smoker: Non-smoker: 0"=>[$this->smokes,$this->score]];

    }
    private function calculateMaleHdlScore(){
        if($this->hdl_cholesterol>=60){
            $this->score-=1;
            return ["HDL cholesterol, mg/dL: 60 or higher: -1" => [$this->hdl_cholesterol,$this->score]];
        }
        if($this->hdl_cholesterol>=50&&$this->hdl_cholesterol<=59){
            return ["HDL cholesterol, mg/dL: 50-59: 0" => [$this->hdl_cholesterol,$this->score]];
        }
        if($this->hdl_cholesterol>=40&&$this->hdl_cholesterol<=49){
            $this->score+=1;                        
            return ["HDL cholesterol, mg/dL: 40-49: 1" => [$this->hdl_cholesterol,$this->score]];
        }
        if($this->hdl_cholesterol<40){
            $this->score+=2;
            return ["HDL cholesterol, mg/dL: Under 40: 2" => [$this->hdl_cholesterol,$this->score]];
        }
        return ["Unaccounted for HDL cholesterol" => [$this->hdl_cholesterol,$this->score]];

    }
    
    private function calculateMaleSystolicScore(){
        if($this->medication!="Yes"){
            if($this->systolic_bp<120){
                return ["Systolic blood pressure, mm Hg: Untreated: Under 120: 0 ({$this->score} points)" => [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp<=120&&$this->systolic_bp<=129){
                return ["Systolic blood pressure, mm Hg: Untreated: 120-129: 0 ({$this->score} points)" => [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp<=130&&$this->systolic_bp<=139){
                $this->score+=1;
                return ["Systolic blood pressure, mm Hg: Untreated: 130-139: 1 ({$this->score} points)" => [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp<=140&&$this->systolic_bp<=159){
                $this->score+=1;
                return ["Systolic blood pressure, mm Hg: Untreated: 140-159: 1 ({$this->score} points)" => [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp>=160){
                $this->score+=2;
                return ["Systolic blood pressure, mm Hg: Untreated: 160 or Higher: 2 ({$this->score} points)" => [$this->systolic_bp,$this->score]];
            }
            
        }
        if($this->medication=="Yes"){
            if($this->systolic_bp<120){
                return ["Systolic blood pressure, mm Hg: Treated: Under 120: 0 ({$this->score} points)" => [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp<=120&&$this->systolic_bp<=129){
                $this->score+=1;
                return ["Systolic blood pressure, mm Hg: Treated: 120-129: 1 ({$this->score} points)" => [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp<=130&&$this->systolic_bp<=139){
                $this->score+=2;
                return ["Systolic blood pressure, mm Hg: Treated: 130-139: 2 ({$this->score} points)" => [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp<=140&&$this->systolic_bp<=159){
                $this->score+=2;
                return ["Systolic blood pressure, mm Hg: Treated: 140-159: 2 ({$this->score} points)" => [$this->systolic_bp,$this->score]];
            }
            if($this->systolic_bp>=160){
                $this->score+=3;
                return ["Systolic blood pressure, mm Hg: Treated: 160 or Higher: 3 ({$this->score} points)" => [$this->systolic_bp,$this->score]];
            }
        }
        return ["Unaccounted for Systolic score" => [$this->systolic_bp,$this->score]];
       
    }
    private function calculateMaleRiskPercentangeScore(){
        if($this->score==0){
            return ["Points total: 0 point <1% ({$this->score} points)" => [1,$this->score]];
        }
   
        if($this->score>=1&&$this->score<=4){
            return ["1-4 points: 1% ({$this->score} points)" => [1,$this->score]];

        }
        if($this->score>=5&&$this->score<=6){
            return ["5-6 points: 2% ({$this->score} points)" => [2,$this->score]];

        }
        if($this->score==7){
            return ["7 points 3% ({$this->score} points)" => [3,$this->score]];
        }
        if($this->score==8){
            return ["8 points 4% ({$this->score} points)" => [4,$this->score]];
        }
        if($this->score==9){
            return ["9 points 5% ({$this->score} points)" => [5,$this->score]];
        }
        if($this->score==10){
            return ["10 points: 6% ({$this->score} points)" => [6,$this->score]];

        }
        if($this->score==11){
            return ["11 points: 8% ({$this->score} points)" => [8,$this->score]];

        }
        if($this->score==12){
            return ["12 points: 10% ({$this->score} points)" => [10,$this->score]];

        }
        if($this->score==13){
            return ["13 points: 12% ({$this->score} points)" => [12,$this->score]];
            
        }
        if($this->score==14){
            return ["14 points: 16% ({$this->score} points)" => [16,$this->score]];
            
        }
        if($this->score==15){
            return ["15 points: 20% ({$this->score} points)" => [20,$this->score]];
            
        }
        if($this->score==16){
            return ["16 points: 25% ({$this->score} points)" => [25,$this->score]];
            
        }
        if($this->score>=17){
            return ["17 points: 30% ({$this->score} points)" => [30,$this->score]];
            
        }
        // if($this->score==21){
        //     return ["21 points: 14% ({$this->score} points)" => 14];
            
        // }
        // if($this->score==22){
        //     return ["22 points: 17% ({$this->score} points)" => 17];
            
        // }
        // if($this->score==23){
        //     return ["23 points: 22% ({$this->score} points)" => 22];
            
        // }
        // if($this->score==24){
        //     return ["24 points: 27% ({$this->score} points)" => 27];
            
        // }
        // if($this->score>=25){
        //     return [">25: Over 30% ({$this->score} points)" => 30];
            
        // }
        return ["Unaccounted for Score: 0 ({$this->score} points)" =>["ERROR",$this->score]];

    }
}
