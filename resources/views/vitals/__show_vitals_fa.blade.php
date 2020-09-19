
    <tr>
        <td>Weight</td>
        <td>{{$vitals->weight}}</td>
    </tr>
    <tr>
          <td>Height</td>
          <td>{{$vitals->height}}</td>
      </tr>
      <tr>
              <td>Abdominal Girth</td>
              <td>{{$vitals->abdominal_girth}}</td>
          </tr>
          <tr>
              <td>BMI</td>
              <td>{{$vitals->bmi}}</td>
          </tr>
          <tr>
              @if($vitals->bmi_level=="OW")
              <td class="inverseRow">BMI Level</td>
              <td class="warnDoctor">{{$vitals->bmi_level}}</td>
                
              @else
                  @if ($vitals->bmi_level=="OB")
                  <td class="inverseRow">BMI Level</td>
                  <td class="dangerDoctor">{{$vitals->bmi_level}}</td>
                    
                  @endif
            @endif
            @if($vitals->bmi_level=="Normal")
              <td>BMI Level</td>
              <td>{{$vitals->bmi_level}}</td>
              @endif
          </tr>
          <tr>
            @if($vitals->systolic_bp>=120&& $vitals->systolic_bp<=129)
                <td class="inverseRow">Systolic</td>
                <td class="warnDoctor">{{$vitals->systolic_bp}} <i class="fas fa-heart"></i></td>
            @else
                @if($vitals->systolic_bp>=130)
                <td class="inverseRow">Systolic</td>
                <td class="dangerDoctor">{{$vitals->systolic_bp}} <i class="fas fa-heart"></i></td>
                @endif
            @endif
                @if($vitals->systolic_bp<120)
                <td> Systolic</td>
                <td>{{$vitals->systolic_bp}} <i class="fas fa-heart"></i></td>          
            @endif
            
        </tr>
    
          <tr>
              @if ($vitals->diastolic_bp>=80)
              <td class="inverseRow" >Diastolic</td>
              <td class="dangerDoctor">{{$vitals->diastolic_bp}} <i class="fas fa-heart"></i></td>        
              @else
              <td>Diastolic</td>
              <td >{{$vitals->diastolic_bp}} <i class="fas fa-heart"></i></td>        
              @endif

          </tr>
          <tr>
           
            @if($vitals->bp_category=="Normal")
            <td>BP Category</td>
              <td>{{$vitals->bp_category}}</td>
              @else 
                @if ($vitals->bp_category=="Elevated")
                <td class="inverseRow">BP Category</td>
                    <td class="warnDoctor">{{$vitals->bp_category}} <i class="fas fa-heart"></i></td>
                @endif
                @if ($vitals->bp_category=="Stage 1")
                <td class="inverseRow">BP Category</td>
                    <td class="dangerDoctor">{{$vitals->bp_category}} <i class="fas fa-heart"></i></td>
                @endif               
                @if ($vitals->bp_category=="Stage 2")
                <td class="inverseRow">BP Category</td>
                    <td class="dangerDoctor">{{$vitals->bp_category}} <i class="fas fa-heart"></i></td>
                @endif               
            @endif
                      
          </tr>
          <tr>
              <td>Heart Rate</td>
              <td>{{$vitals->heart_rate}} <i class="fas fa-heart"></i></td>
          </tr>
          
          <tr>
            <td>Vitals Recorded By</td>
            <td>{{$vitals->seen_by}}</td>
        </tr>
        
