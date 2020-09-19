<h3>Results for "{{$record->pid}}"</h3>
<table class="table table-borded table-striped table-responsive">
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>

        </thead>
        <tbody>
        <tr>
            <td>Name</td>
            <td>{{$record->name}}</td>
        </tr>
        <tr>
              <td>ID</td>
              <td>{{$record->pid}}</td>
          </tr>
          <tr>
                  <td>Gender</td>
                  <td>{{$record->gender}}</td>
              </tr>
              <tr>
                  <td>Birth Date</td>
                  <td>{{$record->birth_date}}</td>
              </tr>
              <tr>
                  <td>Area of Residence</td>
                  <td>{{$record->area_of_residence}}</td>
              </tr>
              <tr>
                  <td>Mobile Number</td>
                  <td>{{$record->mobile_phone_number}}</td>
              </tr>
              @if($record->alternative_phone_number)
              <tr>
                  <td>Alternative Phone number</td>
                  <td>{{$record->alternative_phone_number}}</td>
              </tr>
              @endif
              <tr>
                  <td>Date of First Visit</td>
                  <td>{{$record->created_at}}</td>
              </tr>
              
          </tbody>
    </table>