<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Vital;
use App\PatientVital;
use App\Patient;
use Carbon\Carbon;
use App\Consultation;
use App\ConsultationPatient;
use App\Helpers\FraminghamRiskScoreCalculator;
use PDO;
use Session;


class ReportController extends Controller
{
    public function getPatientsWhoHaveNotAttendedForSixMonths(){
       $sixMonthsAgo =now()->subMonths(6);
    

    $startDate = Consultation::all()->first()->created_at;
    

        $request=request()->all();
        $endDate = $sixMonthsAgo ;
        if (request()->has('dateQuery')) {
            $startDate =$request['dateQuery'];
        }
        if (request()->has('dateQueryEnd')) {
            $endDate = $request['dateQueryEnd'];
          
        }
        

        if (request()->has('sort')) {
            $sort=$request['sort'];
            $patients = Consultation::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', $sort)->paginate(25);
        } else {
            $patients =Consultation::whereBetween('created_at', [$startDate, $endDate])->paginate(25);
        }

        $dates = Consultation::whereBetween('created_at', [$startDate, $endDate])->distinct('date')->get();
        $range =  Consultation::whereBetween('created_at', [$startDate, $endDate])->get();
        $total =  Consultation::whereBetween('created_at', [$startDate, $endDate])->count();
      
        $dateFrequency = [];
        $colors=[];
        $barColors=[];
        $backgroundColors=[];
        $barBackgroundColors=[];
        foreach ($dates as $key => $value) {
            $count = 0;
            foreach ($range as $rkey => $rvalue) {
                if ($rvalue->date == $value->date) { 
                    $count++;
                }
            }
            $dateFrequency[$value->date] =  $count;
            $colors[]=$this->getRandomColors();
            $barColors[]=$this->getRandomColors();
            $backgroundColors[]=$this->getRandomColors();
            $barBackgroundColors[]=$this->getRandomColors();
        }
 
        $pieChartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($dateFrequency))
            ->datasets([
                [
                    'backgroundColor' => $backgroundColors,
                    'hoverBackgroundColor' => $colors,
                    'data' => array_values($dateFrequency)
                ]
            ])
            ->options([]);
      

            $barChartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($dateFrequency))
            ->datasets([
                [
                    "label" => "Patients by Date",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($dateFrequency),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);

            if($total==0){
        Session::flash('flash_message', 'No Patients found for the given period!');

            }
        return view('reports.getPatientsWhoHaveNotAttendedForSixMonths', compact('pieChartjs'),compact('barChartjs'))->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'total'=>$total,
                'records' => $patients

            ]
        );

    }
    public function setPatientsPerPeriod()
    {

        $startDate = PatientVital::all()->first();
        $endDate = PatientVital::all()->last();
        $startDate = $startDate->created_at;
        $endDate = $endDate->created_at->addDays(1);

        return view('reports.setPatientsPerPeriod')->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        );
    }
    public function getPatientsByRiskFactor()
    {
        $startDate = now();
        $endDate = now();
        if (request()->has('dateQuery')) {
            $startDate = request('dateQuery');
        }
        if (request()->has('dateQueryEnd')) {
            $endDate = request('dateQueryEnd');
        }
        
        if (request()->has('sort')) {
            $patients = ConsultationPatient::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', request('sort'))->paginate(25);
        } else {
            $patients = ConsultationPatient::whereBetween('created_at', [$startDate, $endDate])->paginate(25);
        }

        $dates = ConsultationPatient::whereBetween('created_at', [$startDate, $endDate])->distinct('date')->get();
        $range =  ConsultationPatient::whereBetween('created_at', [$startDate, $endDate])->get();
        
      
        $allPatients=Patient::all();
        $allPatientData=[];
        $score=[];

        foreach ($allPatients as $key => $value) {
            $temp=[];
            $temp=array_merge($temp,$value->toArray());
            if($value->vitals->first()){
            $temp=array_merge($temp,$value->vitals->first()->toArray());
            }else{
                continue;
            }
            if($value->visits->first()){
            $temp=array_merge($temp,$value->visits->first()->toArray());
            }else{
                continue;
            }
            if($value->labs->first()){                        
            $temp=array_merge($temp,$value->labs->first()->toArray());
            }else{
                continue;
            }
            
            $allPatientData[]=$temp;
            $temp["smokes"]="No";
          if(isset($temp["smokes?"])){
              $temp["smokes"]=$temp["smokes?"];
          }
        $temp["medication"]="No";
          if(isset($temp["takes_BB?"])&&$temp["takes_BB?"]=="Yes"){
              $temp["medication"]="Yes";
          }
          if(isset($temp["takes_CCB?"])&&$temp["takes_CCB?"]=="Yes"){
            $temp["medication"]="Yes";
        }
        if(isset($temp["takes_Diuretic?"])&&$temp["takes_Diuretic?"]=="Yes"){
            $temp["medication"]="Yes";
        }
        if(isset($temp["takes_ARB?"])&&$temp["takes_ARB?"]=="Yes"){
            $temp["medication"]="Yes";
        }
        if(isset($temp["takes_ACE_I?"])&&$temp["takes_ACE_I?"]=="Yes"){
            $temp["medication"]="Yes";
        }
        if(isset($temp["takes_ASA?"])&&$temp["takes_ASA?"]=="Yes"){
            $temp["medication"]="Yes";
        }
        if(isset($temp["takes_insulin/OHA?"])&&$temp["takes_insulin/OHA?"]=="Yes"){
            $temp["medication"]="Yes";
        }
        
        $frs=new FraminghamRiskScoreCalculator($temp);
        $frs=$frs->calculateFRS();
        $lastkey=array_key_last(end($frs));
       
        $percentage=end($frs)[$lastkey];
      
        $score[]=$lastkey;
       // $score[]=$percentage;

        }
        $scoreTally=[];
        $scoreSize=count($score);
        for ($i=0; $i <$scoreSize ; $i++) {
                 if(isset($scoreTally[$score[$i]])){
                $scoreTally[$score[$i]]++;
            } else{
                $scoreTally[$score[$i]]=1;

            }
        }
        
        
        $colors=[];
        $barColors=[];
        $backgroundColors=[];
        $barBackgroundColors=[];
        foreach ($scoreTally as $key => $value) {
            $colors[]=$this->getRandomColors();
            $barColors[]=$this->getRandomColors();
            $backgroundColors[]=$this->getRandomColors();
            $barBackgroundColors[]=$this->getRandomColors();
        }
    
        $pieChartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($scoreTally))
            ->datasets([
                [
                    'backgroundColor' => $backgroundColors,
                    'hoverBackgroundColor' => $colors,
                    'data' => array_values($scoreTally)
                ]
            ])
            ->options([]);
    
            $barChartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($scoreTally))
            ->datasets([
                [
                    "label" => "FRS score Tally",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($scoreTally),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);
            $lineGraphChartjs = app()->chartjs
            ->name('LineGraphChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($scoreTally))
            ->datasets([
                [
                    "label" => "Frs score Tally",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($scoreTally),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);
            $records=[];
            foreach ($scoreTally as $key => $value) {
                $records[]=array($key => $value);
            }
        return view('reports.getPatientsByRiskFactor'
         )->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'pieChartjs'=>$pieChartjs,
                'barChartjs'=>$barChartjs,
                'lineGraphChartjs'=>$lineGraphChartjs,
                'records' => $records

            ]
        );
    }

    public function getPatientsByRiskLevel()
    {
        $startDate = now();
        $endDate = now();
        if (request()->has('dateQuery')) {
            $startDate = request('dateQuery');
        }
        if (request()->has('dateQueryEnd')) {
            $endDate = request('dateQueryEnd');
        }
        
        if (request()->has('sort')) {
            $patients = ConsultationPatient::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', request('sort'))->paginate(25);
        } else {
            $patients = ConsultationPatient::whereBetween('created_at', [$startDate, $endDate])->paginate(25);
        }

        $dates = ConsultationPatient::whereBetween('created_at', [$startDate, $endDate])->distinct('date')->get();
        $range =  ConsultationPatient::whereBetween('created_at', [$startDate, $endDate])->get();
       
        $riskLevels=[];
        $riskLevels=Consultation::select('risk_level')->distinct()->get();
        $total=Consultation::whereBetween('created_at', [$startDate, $endDate])->count();
        $riskLevelCount=[];
        foreach ($riskLevels as $key => $value) {
            $riskLevelCount[$value->risk_level]=Consultation::whereBetween('created_at', [$startDate, $endDate])
            ->where('risk_level',$value->risk_level)->count();
        }
      
        $colors=[];
        $barColors=[];
        $backgroundColors=[];
        $barBackgroundColors=[];
        foreach ($riskLevelCount as $key => $value) {
            $colors[]=$this->getRandomColors();
            $barColors[]=$this->getRandomColors();
            $backgroundColors[]=$this->getRandomColors();
            $barBackgroundColors[]=$this->getRandomColors();
        }
    
        $pieChartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($riskLevelCount))
            ->datasets([
                [
                    'backgroundColor' => $backgroundColors,
                    'hoverBackgroundColor' => $colors,
                    'data' => array_values($riskLevelCount)
                ]
            ])
            ->options([]);
     
            $barChartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($riskLevelCount))
            ->datasets([
                [
                    "label" => "Total Number Of Patients By Risk Level",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($riskLevelCount),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);
            $lineGraphChartjs = app()->chartjs
            ->name('LineGraphChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($riskLevelCount))
            ->datasets([
                [
                    "label" => "Total Number Of Patients By Risk Level",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($riskLevelCount),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);
            $records=[];
            foreach ($riskLevelCount as $key => $value) {
                $records[]=array($key => $value);
            }
        return view('reports.getPatientsByRiskLevel'
         )->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'pieChartjs'=>$pieChartjs,
                'barChartjs'=>$barChartjs,
                'lineGraphChartjs'=>$lineGraphChartjs,
                'total'=>$total,
                'records' => $records

            ]
        );
    }
    public function getPatientsByAgePerPeriod()
    {
        $startDate = now();
        $endDate = now();
        if (request()->has('dateQuery')) {
            $startDate = request('dateQuery');
        }
        if (request()->has('dateQueryEnd')) {
            $endDate = request('dateQueryEnd');
        }

        if (request()->has('sort')) {
            $patients = PatientVital::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', request('sort'))->paginate(25);
        } else {
            $patients = PatientVital::whereBetween('created_at', [$startDate, $endDate])->paginate(25);
        }

        $dates = PatientVital::whereBetween('created_at', [$startDate, $endDate])->distinct('date')->get();
        $range =  PatientVital::whereBetween('created_at', [$startDate, $endDate])->get();
        $ageByRange=[];
        $ageByRange['less than 20']=Patient::where('birth_date','>',today()->subYears(20)->format('Y-m-d'))->count();
        $ageByRange['21-50']=Patient::where('birth_date','<=',today()->subYears(21))->Where('birth_date','>=',today()->subYears(50))->count();
        $ageByRange['51-70']=Patient::where('birth_date','<=',today()->subYears(51))->where('birth_date','>=',today()->subYears(70))->count();
        $ageByRange['>70']=Patient::where('birth_date','<=',today()->subYears(71))->count();
        $total=0;
        foreach ($ageByRange as $key => $value) {
            $total+=$value;
        }
        $colors=[];
        $barColors=[];
        $backgroundColors=[];
        $barBackgroundColors=[];
        foreach ($ageByRange as $key => $value) {
            $colors[]=$this->getRandomColors();
            $barColors[]=$this->getRandomColors();
            $backgroundColors[]=$this->getRandomColors();
            $barBackgroundColors[]=$this->getRandomColors();
        }
    
        $pieChartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($ageByRange))
            ->datasets([
                [
                    'backgroundColor' => $backgroundColors,
                    'hoverBackgroundColor' => $colors,
                    'data' => array_values($ageByRange)
                ]
            ])
            ->options([]);
     
            $barChartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($ageByRange))
            ->datasets([
                [
                    "label" => "Patients By Age",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($ageByRange),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);
            $lineGraphChartjs = app()->chartjs
            ->name('LineGraphChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($ageByRange))
            ->datasets([
                [
                    "label" => "Patients By Age",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($ageByRange),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);
            $records=[];
            foreach ($ageByRange as $key => $value) {
                $records[]=array($key => $value);
            }
        return view('reports.getPatientsByAgePerPeriod'
         )->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'pieChartjs'=>$pieChartjs,
                'barChartjs'=>$barChartjs,
                'lineGraphChartjs'=>$lineGraphChartjs,
                'total'=>$total,
                'records' => $records

            ]
        );
    }
  
    public function getGenderPerPeriod()
    {
        $startDate = now();
        $endDate = now();
        if (request()->has('dateQuery')) {
            $startDate = request('dateQuery');
        }
        if (request()->has('dateQueryEnd')) {
            $endDate = request('dateQueryEnd');
        }

        if (request()->has('sort')) {
            $patients = PatientVital::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', request('sort'))->paginate(25);
        } else {
            $patients = PatientVital::whereBetween('created_at', [$startDate, $endDate])->paginate(25);
        }

        $dates = PatientVital::whereBetween('created_at', [$startDate, $endDate])->distinct('date')->get();
        $range =  PatientVital::whereBetween('created_at', [$startDate, $endDate])->get();
        $gender=[];
        $gender["Male"]=0;
        $gender["Female"]=0;
        $total=0;
        foreach ($range as $key => $value) {
            $gender[Patient::find($value->patient_id)->gender]++;
            $total++;
          
        }
      
     
        $colors=[];
        $barColors=[];
        $backgroundColors=[];
        $barBackgroundColors=[];
        foreach ($gender as $key => $value) {
            $colors[]=$this->getRandomColors();
            $barColors[]=$this->getRandomColors();
            $backgroundColors[]=$this->getRandomColors();
            $barBackgroundColors[]=$this->getRandomColors();
        }
        
        $pieChartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($gender))
            ->datasets([
                [
                    'backgroundColor' => $backgroundColors,
                    'hoverBackgroundColor' => $colors,
                    'data' => array_values($gender)
                ]
            ])
            ->options([]);
     
            $barChartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($gender))
            ->datasets([
                [
                    "label" => "Gender Of Patients By Date",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($gender),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);
            $lineGraphChartjs = app()->chartjs
            ->name('LineGraphChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($gender))
            ->datasets([
                [
                    "label" => "Gender Of Patients By Date",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($gender),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);
            $records=[];
            foreach ($gender as $key => $value) {
                $records[]=array($key => $value);
            }
        return view('reports.getGenderPerPeriod'
         )->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'pieChartjs'=>$pieChartjs,
                'barChartjs'=>$barChartjs,
                'lineGraphChartjs'=>$lineGraphChartjs,
                'total'=>$total,
                'records' => $records

            ]
        );
    }
    public function getBpCategoryPerPeriod()
    {
        $startDate = now();
        $endDate = now();
        if (request()->has('dateQuery')) {
            $startDate = request('dateQuery');
        }
        if (request()->has('dateQueryEnd')) {
            $endDate = request('dateQueryEnd');
        }

        if (request()->has('sort')) {
            $patients = PatientVital::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', request('sort'))->paginate(25);
        } else {
            $patients = PatientVital::whereBetween('created_at', [$startDate, $endDate])->paginate(25);
        }

        $dates = PatientVital::whereBetween('created_at', [$startDate, $endDate])->distinct('date')->get();
        $range =  PatientVital::whereBetween('created_at', [$startDate, $endDate])->get();
        $bpCategoryFrequency=[];
        $bpCategoryFrequency['Unclassified']=Vital::whereBetween('created_at', [$startDate, $endDate])
                                                    ->where('bp_category','Unclassified')->count();
        //$bpCategoryBreakdown['Unclassified']=Vital::where('bp_category','Unclassified')->count();
        $bpCategoryFrequency['Normal']=Vital::whereBetween('created_at', [$startDate, $endDate])
                                                ->where('bp_category','Normal')->count();
        $bpCategoryFrequency['Elevated']=Vital::whereBetween('created_at', [$startDate, $endDate])
                                                ->where('bp_category','Elevated')->count();
        $bpCategoryFrequency['Stage 1']=Vital::whereBetween('created_at', [$startDate, $endDate])
                                                ->where('bp_category','Stage 1')->count();
        $bpCategoryFrequency['Stage 2']=Vital::whereBetween('created_at', [$startDate, $endDate])
                                                ->where('bp_category','Stage 2')->count();
     
        $total=Vital::whereBetween('created_at', [$startDate, $endDate])->count();

        $colors=[];
        $barColors=[];
        $backgroundColors=[];
        $barBackgroundColors=[];
        foreach ($bpCategoryFrequency as $key => $value) {
            $colors[]=$this->getRandomColors();
            $barColors[]=$this->getRandomColors();
            $backgroundColors[]=$this->getRandomColors();
            $barBackgroundColors[]=$this->getRandomColors();
        }
        
        $pieChartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($bpCategoryFrequency))
            ->datasets([
                [
                    'backgroundColor' => $backgroundColors,
                    'hoverBackgroundColor' => $colors,
                    'data' => array_values($bpCategoryFrequency)
                ]
            ])
            ->options([]);
      

            $barChartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($bpCategoryFrequency))
            ->datasets([
                [
                    "label" => "Totals",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($bpCategoryFrequency),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);
            $lineGraphChartjs = app()->chartjs
            ->name('LineGraphChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($bpCategoryFrequency))
            ->datasets([
                [
                    "label" => "Totals",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($bpCategoryFrequency),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);
            $records=[];
            foreach ($bpCategoryFrequency as $key => $value) {
                $records[]=array($key => $value);
            }
        return view('reports.getBpCategoryPerPeriod',
         compact('pieChartjs'),
         compact('barChartjs')
         )->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'lineGraphChartjs'=>$lineGraphChartjs,
                'total'=>$total,
                'records' => $records

            ]
        );
    } 
    public function getPatientsPerPeriod()
    {

        $startDate = now();
        $endDate = now();
        if (request()->has('dateQuery')) {
            $startDate = request('dateQuery');
        }
        if (request()->has('dateQueryEnd')) {
            $endDate = request('dateQueryEnd');
        }

        if (request()->has('sort')) {
            $patients = PatientVital::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', request('sort'))->paginate(25);
        } else {
            $patients = PatientVital::whereBetween('created_at', [$startDate, $endDate])->paginate(25);
        }

        $dates = PatientVital::whereBetween('created_at', [$startDate, $endDate])->distinct('date')->get();
        $datesAttented = PatientVital::whereBetween('created_at', [$startDate, $endDate])->get();
        $total = PatientVital::whereBetween('created_at', [$startDate, $endDate])->count();
        $genderTally["Male"]=0;
        $genderTally["Female"]=0;
        foreach ($datesAttented as $key => $value) {
            switch($value->gender){
                case "Male":
                $genderTally['Male']++;
                break;
                case "Female":
                $genderTally['Female']++;
                break;
                default:
                break;                 
            }
         
                    
        }
        $genderTotal=$genderTally["Male"]+$genderTally["Female"];
        if($genderTotal==0){
            $genderTotal=1;
        }
        $genderTallyPercentage["Male %"]=($genderTally["Male"]/$genderTotal)*100;
        $genderTallyPercentage["Female %"]=($genderTally["Female"]/$genderTotal)*100;
        $range =  PatientVital::whereBetween('created_at', [$startDate, $endDate])->get();
        $dateFrequency = [];
        $colors=[];
        $barColors=[];
        $backgroundColors=[];
        $barBackgroundColors=[];

        $genderPieChartjs = app()->chartjs
        ->name('genderPieChart')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(array_keys($genderTallyPercentage))
        ->datasets([
            [
                'backgroundColor' => $this->getRandomColors(),
                'hoverBackgroundColor' => $colors,
                'data' => array_values($genderTallyPercentage)
            ]
        ])
        ->options([]);
  
        $genderBarChartjs = app()->chartjs
        ->name('genderBarChartTest')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(array_keys($genderTally))
        ->datasets([
            [
                "label" => "Number Of Patients By Gender",
                'backgroundColor' => $this->getRandomColors(),
                'data' =>  array_values($genderTally),
                'borderColor'=>$barColors,
                "borderWidth"=> 1
            ]
          
        ])
        ->options([]);

        foreach ($dates as $key => $value) {
            $count = 0;
            foreach ($range as $rkey => $rvalue) {
                if ($rvalue->date == $value->date) { 
                    $count++;
                }
            }
            $dateFrequency[$value->date] =  $count;
            $colors[]=$this->getRandomColors();
            $barColors[]=$this->getRandomColors();
            $backgroundColors[]=$this->getRandomColors();
            $barBackgroundColors[]=$this->getRandomColors();
        }
        
        $pieChartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($dateFrequency))
            ->datasets([
                [
                    'backgroundColor' => $backgroundColors,
                    'hoverBackgroundColor' => $colors,
                    'data' => array_values($dateFrequency)
                ]
            ])
            ->options([]);
      

            $barChartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($dateFrequency))
            ->datasets([
                [
                    "label" => "Patients by Date",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($dateFrequency),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);
        return view(
            'reports.getPatientsPerPeriod'
            
             )->with(
                [
                    'pieChartjs'=>$pieChartjs,
                    'genderPieChartjs'=>$genderPieChartjs,
                    'barChartjs'=>$barChartjs,
                    'genderBarChartjs'=>$genderBarChartjs,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'total' => $total,
                    'records' => $patients
                ]
            );
        

    }
    public function showPatientDetails()
    {

        $patient = null;
        if (request()->has('id')) {
            $patient = Patient::find(request('id'));
        }

        return view('reports.__show_patient_details')->with(
            [
                'patient' => $patient,
                'record' => $patient
            ]
        );

    }
    public function setPatientsByRiskFactor()
    {
        
        $startDate = ConsultationPatient::all()->first();
        $endDate = ConsultationPatient::all()->last();
        $startDate = $startDate->created_at;
        $endDate = $endDate->created_at->addDays(1);

        return view('reports.setPatientsByRiskFactor')->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        );
    }
    public function setPatientsByRiskLevel()
    {
        
        $startDate = ConsultationPatient::all()->first();
        $endDate = ConsultationPatient::all()->last();
        $startDate = $startDate->created_at;
        $endDate = $endDate->created_at->addDays(1);

        return view('reports.setPatientsByRiskLevel')->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        );
    }
    public function setGenderPerPeriod()
    {

        $startDate = PatientVital::all()->first();
        $endDate = PatientVital::all()->last();
        $startDate = $startDate->created_at;
        $endDate = $endDate->created_at->addDays(1);

        return view('reports.setGenderPerPeriod')->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        );
    }
    public function setBpCategoryPerPeriod()
    {

        $startDate = PatientVital::all()->first();
        $endDate = PatientVital::all()->last();
        $startDate = $startDate->created_at;
        $endDate = $endDate->created_at->addDays(1);

        return view('reports.setBpCategoryPerPeriod')->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        );
    }
    public function setPatientsByAgePerPeriod()
    {

        $startDate = PatientVital::all()->first();
        $endDate = PatientVital::all()->last();
        $startDate = $startDate->created_at;
        $endDate = $endDate->created_at->addDays(1);

        return view('reports.setPatientsByAgePerPeriod')->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        );
    }
    public function setDisposalsPerPeriod()
    {

        $startDate = PatientVital::all()->first();
        $endDate = PatientVital::all()->last();
        $startDate = $startDate->created_at;
        $endDate = $endDate->created_at->addDays(1);

        return view('reports.setDisposalsPerPeriod')->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        );
    }
    public function getDisposalsPerPeriod()
    {

        $startDate = now();
        $endDate = now();
        if (request()->has('dateQuery')) {
            $startDate = request('dateQuery');
        }
        if (request()->has('dateQueryEnd')) {
            $endDate = request('dateQueryEnd');
        }

        if (request()->has('sort')) {
            $patients = Consultation::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', request('sort'))->paginate(25);
        } else {
            $patients = Consultation::whereBetween('created_at', [$startDate, $endDate])->paginate(25);
        }

        $disposals = Consultation::whereBetween('created_at', [$startDate, $endDate])->distinct('disposal')->get('disposal');
        $range =  Consultation::whereBetween('created_at', [$startDate, $endDate])->get();
        $total =  Consultation::whereBetween('created_at', [$startDate, $endDate])->count();
        $disposalFrequency = [];
        $colors=[];
        $barColors=[];
        $backgroundColors=[];
        $barBackgroundColors=[];
      
        foreach ($disposals as $key => $value) {
            $disposalFrequency[$value->disposal] =   Consultation::whereBetween('created_at', [$startDate, $endDate])
                                                    ->where('disposal',$value->disposal)->count(); 
            $disposalBreakdown[$value->disposal] =   Consultation::whereBetween('created_at', [$startDate, $endDate])
                                                    ->where('disposal',$value->disposal)->get(); 
            $colors[]=$this->getRandomColors();
            $barColors[]=$this->getRandomColors();
            $backgroundColors[]=$this->getRandomColors();
            $barBackgroundColors[]=$this->getRandomColors();
        }
        $pieChartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($disposalFrequency))
            ->datasets([
                [
                    'backgroundColor' => $backgroundColors,
                    'hoverBackgroundColor' => $colors,
                    'data' => array_values($disposalFrequency)
                ]
            ])
            ->options([]);
      

            $barChartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($disposalFrequency))
            ->datasets([
                [
                    "label" => "Patients by Date",
                    'backgroundColor' => $barBackgroundColors,
                    'data' =>  array_values($disposalFrequency),
                    'borderColor'=>$barColors,
                    "borderWidth"=> 1
                ]
              
            ])
            ->options([]);

            $records=[];
        foreach ($disposalFrequency as $key => $value) {
            $records[]=[ $key => $value];
        }
            
            return view('reports.getDisposalsPerPeriod', compact('pieChartjs'),compact('barChartjs'))->with(
            [
                'startDate' => $startDate,
                'endDate' => $endDate,
                'records' => $patients,
                'records'=>$records,
                'total'=>$total,
                'breakdowns'=>$disposalBreakdown

            ]
        );
    }
    private function getRandomColors()
    {
        $hash = '#';
        $head = array("9", "A", "B", "C", "D", "E", "F");
        for ($i = 0; $i < 6; $i++) {
            $hash .= $head[array_rand($head, 1)];
        }

        return substr($hash, 0, 7);
    }

}
