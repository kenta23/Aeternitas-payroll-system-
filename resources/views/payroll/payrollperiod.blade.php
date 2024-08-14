@extends('layouts.master')

@section('title')
   <title>Payroll Period</title>
@endsection


@section('content')

    <div class="row">
        @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="rounded card">
          <div class="bg-white card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Payroll Period List</h4>
                <a href="{{ url('aeternitas/payrollperiod/create') }}" class="text-white btn btn-danger">Add Payroll Period</a>
            </div>
          </div>
          <div class="card-body">
            <table  id="dataTable" class="table table-bordered table-stripped table-hover removeShowEntry">
                <thead>
                    <tr>
                        <th>Payroll Period ID</th>
                        <th>Payroll Period</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payrollperiod as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->startpayrollperiod)->format('F d, Y') }} - {{ \Carbon\Carbon::parse($p->endpayrollperiod)->format('F d, Y') }}</td>
                        <td>
                            <a href="{{ route('payrollperiod.edit', $p->id) }}" class="text-white btn btn-success">Edit</a>
                            <form action="{{ route('payrollperiod.destroy', $p->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this data? There is no way back!')" class="text-white btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">No payroll period Available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
          </div>
        </div>
    </div>
@endsection
