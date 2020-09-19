
        <tr>
            @if($visits['has_history_of_high_bp?']=="Yes")
                <td class="inverseRow">Has History of High Blood Pressue</td>
                <td class="dangerDoctor">{{$visits['has_history_of_high_bp?']}}</td>
            @endif
            @if($visits['has_history_of_high_bp?']=="No")
            <td>Has History of High Blood Pressue</td>
            <td>{{$visits['has_history_of_high_bp?']}}</td>
            @endif
        
        </tr>
        <tr>
                @if($visits['has_history_of_diabetes?']=="Yes")
                <td class="inverseRow">Has History of Diabetes</td>
                <td class="dangerDoctor">{{$visits['has_history_of_diabetes?']}}</td>
                @endif
                @if($visits['has_history_of_diabetes?']=="No")
                <td>Has History of Diabetes</td>
                <td>{{$visits['has_history_of_diabetes?']}}</td>
            @endif
          </tr>
          <tr>
                @if($visits['has_heart_disease?']=="Yes")
                <td class="inverseRow">Has History of Heart Disease</td>
                <td class="dangerDoctor">{{$visits['has_heart_disease?']}}</td>
                @endif
                @if($visits['has_heart_disease?']=="No")
                <td>Has History of Heart Disease</td>
                <td>{{$visits['has_heart_disease?']}}</td>
     
            @endif
              </tr>
              <tr>
                    @if($visits['has_history_of_stroke?']=="Yes")
                    <td class="inverseRow">Has History of Stroke</td>
                    <td class="dangerDoctor">{{$visits['has_history_of_stroke?']}}</td>
                    @endif
                    @if($visits['has_history_of_stroke?']=="No")
                    <td>Has History of Stroke</td>
                    <td>{{$visits['has_history_of_stroke?']}}</td>
                @endif
              </tr>
              <tr>
                    @if($visits['smokes?']=="Yes")
                    <td class="inverseRow">Smokes</td>
                    <td class="dangerDoctor">{{$visits['smokes?']}}</td>
                    @endif
                    @if($visits['smokes?']=="No")
                    <td>Smokes</td>
                    <td>{{$visits['smokes?']}}</td>
                @endif   
                 
              </tr>
              <tr>
                    @if($visits['takes_BB?']=="Yes")
                    <td class="inverseRow">Takes BB</td>
                    <td class="dangerDoctor">{{$visits['takes_BB?']}}</td>
                    @endif
                    @if($visits['takes_BB?']=="No")
                    <td>Takes BB</td>
                    <td>{{$visits['takes_BB?']}}</td>
      
                @endif   
            
              
            </tr>
        
              <tr>
                    @if($visits['takes_CCB?']=="Yes")
                    <td class="inverseRow">Takes CCB</td>
                    <td class="dangerDoctor">{{$visits['takes_CCB?']}}</td>
                    @endif
                    @if($visits['takes_CCB?']=="No")
                    <td>Takes CCB</td>
                    <td>{{$visits['takes_CCB?']}}</td>
    
                @endif   
            
              </tr>
              <tr>
                    @if($visits['takes_Diuretic?']=="Yes")
                    <td class="inverseRow">Takes Diuretic</td>
                    <td class="dangerDoctor">{{$visits['takes_Diuretic?']}}</td>
                    @endif
                    @if($visits['takes_Diuretic?']=="No")
                    <td>Takes Diuretic</td>
                    <td>{{$visits['takes_Diuretic?']}}</td>
    
                @endif   
            
                          
              </tr>
              <tr>
                    @if($visits['takes_ARB?']=="Yes")
                    <td class="inverseRow">Takes ARB</td>
                    <td class="dangerDoctor">{{$visits['takes_ARB?']}}</td>
                    @endif
                    @if($visits['takes_ARB?']=="No")
                    <td>Takes ARB</td>
                    <td>{{$visits['takes_ARB?']}}</td>
        
                @endif   
              </tr>
              <tr>
                    @if($visits['takes_ARB?']=="Yes")
                    <td class="inverseRow">Takes ARB</td>
                    <td class="dangerDoctor">{{$visits['takes_ARB?']}}</td>
                    @endif
                    @if($visits['takes_ARB?']=="No")
                    <td>Takes ARB</td>
                    <td>{{$visits['takes_ARB?']}}</td>
           
                @endif   
              </tr>
              <tr>
                    @if($visits['takes_ACE_I?']=="Yes")
                    <td class="inverseRow">Takes ACE I</td>
                    <td class="dangerDoctor">{{$visits['takes_ACE_I?']}}</td>
                    @endif
                    @if($visits['takes_ACE_I?']=="No")
                    <td>Takes ACE I</td>
                    <td>{{$visits['takes_ACE_I?']}}</td>
                    @endif   
              </tr>
              <tr>
                    @if($visits['takes_ASA?']=="Yes")
                    <td class="inverseRow">Takes ASA</td>
                    <td class="dangerDoctor">{{$visits['takes_ASA?']}}</td>
                    @endif
                    @if($visits['takes_ASA?']=="No")
                    <td>Takes ASA</td>
                    <td>{{$visits['takes_ASA?']}}</td>
                @endif   
              </tr>
              <tr>
                    @if($visits['takes_insulin/OHA?']=="Yes")
                    <td class="inverseRow">Takes Insulin/OHA</td>
                    <td class="dangerDoctor">{{$visits['takes_insulin/OHA?']}}</td>
                    @endif 
                    @if($visits['takes_insulin/OHA?']=="No")
                    <td>Takes Insulin/OHA</td>
                    <td>{{$visits['takes_insulin/OHA?']}}</td>
                    @endif   
              </tr>
              <tr>
                <td>Recorded By </td>
                <td>{{$visits['seen_by']}}</td>
              </tr>