<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payslip {{ $employee->last_name }}</title>
</head>
<body>
    <h1>Hello {{ $employee->first_name }} {{ $employee->last_name }}</h1>
    <p>This is your payslip for the month of {{ \Carbon\Carbon::parse($employee->start_date_payroll)->format('F') }} {{ \Carbon\Carbon::parse($employee->start_date_payroll)->year }}.</p>
    <p>Below is the file to download your payslip file. Please click the file below to view or download your payslip.</p>
</body>
</html>
