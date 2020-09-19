            @if($visits['has_history_of_high_bp?'])
            <tr>
                <td>Has History of High Blood Pressue</td>
                <td>{{$visits['has_history_of_high_bp?']}}</td>
            </tr>
            @endif

            @if($visits['has_history_of_diabetes?'])
            <tr>
                <td>Has History of Diabetes</td>
                <td>{{$visits['has_history_of_diabetes?']}}</td>
            </tr>
            @endif

            @if($visits['has_heart_disease?'])
            <tr>
                <td>Has History of Heart Disease</td>
                <td>{{$visits['has_heart_disease?']}}</td>
            </tr>
            @endif

            @if($visits['has_history_of_stroke?'])
            <tr>
                <td>Has History of Stroke</td>
                <td>{{$visits['has_history_of_stroke?']}}</td>
            </tr>
            @endif

            @if($visits['smokes?'])
             <tr>
                <td>Smokes</td>
                <td>{{$visits['smokes?']}}</td>
            </tr>
            @endif

            @if($visits['takes_BB?'])
            <tr>
                <td>Takes BB</td>
                <td>{{$visits['takes_BB?']}}</td>
            </tr>
            @endif

            @if($visits['takes_CCB?'])
            <tr>
                <td>Takes CCB</td>
                <td>{{$visits['takes_CCB?']}}</td>
            </tr>
            @endif

            @if($visits['takes_Diuretic?'])
            <tr>
                <td>Takes Diuretic</td>
                <td>{{$visits['takes_Diuretic?']}}</td>
            </tr>
            @endif

            @if($visits['takes_ARB?'])
            <tr>
                <td>Takes ARB</td>
                <td>{{$visits['takes_ARB?']}}</td>
            </tr>
            @endif
           
            @if($visits['takes_ACE_I?'])            
            <tr>
                <td>Takes ACE I</td>
                <td>{{$visits['takes_ACE_I?']}}</td>
            </tr>
            @endif

            @if($visits['takes_ASA?'])            
            <tr>
                <td>Takes ASA</td>
                <td>{{$visits['takes_ASA?']}}</td>
            </tr>
            @endif

            @if($visits['takes_insulin/OHA?'])            
            <tr>
                <td>Takes Insulin/OHA</td>
                <td>{{$visits['takes_insulin/OHA?']}}</td>
            </tr>
            @endif

            @if($visits['seen_by'])            
            <tr>
                <td>Recorded By </td>
                <td>{{$visits['seen_by']}}</td>
            </tr>
            @endif