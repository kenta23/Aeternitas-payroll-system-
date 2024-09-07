@foreach ($employees as $emp )
<div class="col-md-4 mt-4 col-sm-6 col-12 col-lg-4 col-xl-3">
    <div class="profile-widget">
        <div class="profile-img">
           <a href="{{ url('employee/details/edit/'.$emp->id) }}" class="avatar">
             <img class="" src="{{ URL::to('/assets/img/employee_avatar.png') }}"  alt="Profile employee" >

         </a>

        </div>
        <div class="dropdown profile-action">
            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ url('all/employee/view/edit/'.$emp->employee_id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                <a class="dropdown-item" href="{{url('all/employee/delete/'.$emp->id)}}"onclick="return confirm('Are you sure to want to delete it?')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
            </div>
        </div>
        <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{url('employee/details/edit/'.$emp->id)}}">{{ $emp->first_name }} {{ $emp->last_name }}</a></h4>

        @php
           $currentDate = \Carbon\Carbon::now();
           $separationDate = $emp->separation_date ? \Carbon\Carbon::parse($emp->separation_date) : null;
        @endphp

        @if ($separationDate && $separationDate->lessThanOrEqualTo($currentDate))
          <div class="small text-danger font-bold bold"><strong>Resigned</strong></div>
        @else
          <div class="small text-muted">{{ $emp->position }}</div>
        @endif
    </div>
</div>
@endforeach
