@php
    use Carbon\Carbon;

    $startDate = Carbon::parse($employee->start_date_payroll);
    $endDate = Carbon::parse($employee->end_date_payroll);
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Payslip</title>
    {{-- <style>
        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }
            body {
                margin: 0;
                padding: 0;
                width: 210mm; /* A4 width */
                height: 297mm; /* A4 height */
                overflow: hidden;
                font-size: 10pt;
            }
            .container {
                width: 100%;
                height: 100%;
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                border: none;
                page-break-after: always;
            }
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10mm;
                padding-top: 10mm;
                font-size: 12pt;
            }
            .header img {
                width: 100px;
            }
            .no-print {
                display: none;
            }
            .breakdown {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                gap: 10mm;
                margin-bottom: 10mm;
            }
            .breakdown .section {
                width: 48%;
                box-sizing: border-box;
            }
            .details, .footer {
                margin-bottom: 10mm;
            }
            .details table, .breakdown table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 5mm;
            }
            .details th, .breakdown th, .details td, .breakdown td {
                border: 1px solid #000000;
                padding: 6px;
                text-align: left;
                font-size: 10pt;
            }
            .details th, .breakdown th {
                background-color: #0F6296; /* Consistent header color */
                color: white; /* Consistent text color */
            }
            .total {
                font-weight: bold;
                font-size: 10pt;
            }
            .footer {
                text-align: center;
                font-size: 10pt;
            }
        }

        /* Default Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10pt;
        }
        .container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
            padding: 10mm;
            border: 1px dashed #000;
            box-sizing: border-box;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10mm;
            padding-top: 10mm;
            font-size: 12pt;
        }
        .header h1 {
            margin: 0;
            line-height: 1.2;
            color: #32AFF6; /* Set color to hex #32AFF6 */
        }
        .header p {
            margin: 0;
            line-height: 1.2;
        }
        .details, .breakdown, .footer {
            margin-bottom: 10mm;
        }
        .details table, .breakdown table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10mm;
        }
        .details th, .breakdown th, .details td, .breakdown td {
            border: 1px solid #000000;
            padding: 6px;
            text-align: left;
            font-size: 10pt;
        }
        .details th, .breakdown th {
            background-color: #0F6296; /* Consistent header color */
            color: white; /* Consistent text color */
        }
        .breakdown {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10mm;
        }
        .breakdown .section {
            width: 48%;
            box-sizing: border-box;
        }
        .total {
            font-weight: bold;
            font-size: 10pt;
        }
        .footer {
            text-align: center;
            font-size: 10pt;
        }
    </style> --}}

    <style>/* Default Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10pt;
        }
        .container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
            padding: 10mm;
            border: none; /* Removed the dashed border */
            box-sizing: border-box;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10mm;
            padding-top: 10mm;
            font-size: 12pt;
        }
        .header h1 {
            margin: 0;
            line-height: 1.2;
            color: #32AFF6; /* Set color to hex #32AFF6 */
        }
        .header p {
            margin: 0;
            line-height: 1.2;
        }
        .details, .breakdown, .footer {
            margin-bottom: 10mm;
        }
        .details table, .breakdown table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10mm;
        }
        .details th, .breakdown th, .details td, .breakdown td {
            border: 1px solid #000000;
            padding: 6px;
            text-align: left;
            font-size: 10pt;
        }
        .details th, .breakdown th {
            background-color: #0F6296; /* Consistent header color */
            color: white; /* Consistent text color */
        }
        .breakdown {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10mm;
        }
        .breakdown .section {
            width: 48%;
            box-sizing: border-box;
        }
        .total {
            font-weight: bold;
            font-size: 10pt;
        }
        .footer {
            text-align: center;
            font-size: 10pt;
        }

        /* Print Styles */
        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }
            body {
                margin: 0;
                padding: 0;
                width: 210mm; /* A4 width */
                height: 297mm; /* A4 height */
                overflow: hidden;
                font-size: 10pt;
            }
            .container {
                width: 100%;
                height: 100%;
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                border: none;
                page-break-after: always;
            }
            .header img {
                width: 100px;
            }
            .no-print {
                display: none;
            }
            .breakdown {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                gap: 10mm;
                margin-bottom: 10mm;
            }
            .breakdown .section {
                width: 48%;
                box-sizing: border-box;
            }
        }
        </style>
</head>
<body>
    <div class="container">
        <div class="header">
            {{-- <img src="{{ asset('assets/images/aeternitas.png') }}" alt="Company Logo"> --}}
            <div>
                <h1>ETERNAL BRIGHT SANCTUARY, INC.</h1>
                <p>Blk. 44 Lot 5 & 6, Commonwealth Ave.,</p>
                <p>Brgy. Batasan Hills, Quezon City, Metro Manila, Philippines</p>
            </div>
        </div>

        <div class="details">
            <h2>Employee Details</h2>
            <table>
                <tr>
                    <th>Employee ID</th>
                    <td>{{ $employee->custom_id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td>{{ $employee->position_name }}</td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td>{{ $employee->department_name }}</td>
                </tr>
                <tr>
                    <th>Payroll Period</th>
                    <td>{{ $startDate->format('F d, Y') }} - {{ $endDate->format('F d, Y') }}</td>
                </tr>
            </table>
        </div>

        <div class="breakdown">
            <div class="section">
                <h2>BASIC PAY</h2>
                <table>
                    <tr>
                        <th>Description</th>
                        <th></th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td>Days of Work</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Reg. days worked</td>
                        <td>{{ number_format($employee->regular_worked_days, 2) }}</td>
                        <td>&#8369;{{ number_format($employee->rwd_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Legal Hol.</td>
                        <td>{{ number_format($employee->legal_worked_days, 2) }}</td>
                        <td>&#8369;{{ number_format($employee->lhd_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Spcl. Hol.</td>
                        <td>{{ number_format($employee->special_worked_days, 2) }}</td>
                        <td>&#8369;{{ number_format($employee->special_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Total Basic Pay</td>
                        <td></td>
                        <td> &#8369; {{ number_format($employee->total_basic_pay, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Less: Late (mins.):</td>
                        <td>{{ number_format($employee->number_of_minutes_late, 2) }}</td>
                        <td>&#8369;{{ number_format($employee->late_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="total">Net Basic Pay:</td>
                        <td></td>
                        <td class="total">&#8369;{{ number_format($employee->total_basic_pay - $employee->late_amount, 2) }}</td>
                    </tr>
                </table>
            </div>
            <div class="section">
                <h2>DEDUCTION</h2>
                <table>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td>SSS</td>
                        <td>&#8369;{{ number_format($employee->sss_premcontribution + $employee->sss_wisp, 2) }}</td>
                    </tr>
                    <tr>
                        <td>PHIC</td>
                        <td>&#8369;{{ number_format($employee->phic, 2) }}</td>
                    </tr>
                    <tr>
                        <td>HDMF</td>
                        <td>&#8369;{{ number_format($employee->hdmf, 2) }}</td>
                    </tr>
                    <tr>
                        <td>WHTax</td>
                        <td>&#8369;{{ number_format($employee->tax_cutoff, 2) }}</td>
                    </tr>
                    <tr>
                        <td>SSS Loans</td>
                        <td>&#8369;{{ number_format($employee->sss_loan, 2) }}</td>
                    </tr>
                    <tr>
                        <td>HDMF Loans</td>
                        <td>&#8369;{{ number_format($employee->hdmf_loan, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Company Loans</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Cash Advances</td>
                        <td>&#8369;{{ number_format($employee->cash_advance, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Absences</td>
                        <td>&#8369;{{ number_format($employee->absences, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Other Charges</td>
                        <td>&#8369;{{ number_format($employee->employee_purchase, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="total">Total Deductions:</td>
                        <td class="total">&#8369;{{ number_format($employee->sss_premcontribution + $employee->sss_wisp + $employee->phic + $employee->hdmf + $employee->tax_cutoff + $employee->sss_loan + $employee->hdmf_loan + $employee->cash_advance + $employee->absences + $employee->employee_purchase, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="breakdown">
            <div class="section">
                <h2>OTHER PAY</h2>
                <table>
                    <tr>
                        <th>Description</th>
                        <th></th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td>Reg. OT (hrs):</td>
                        <td>{{ number_format($employee->ot_hours25, 2) }}</td>
                        <td>&#8369;{{ number_format($employee->ot_amount25, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Night Diff. (hrs):</td>
                        <td>{{ number_format($employee->nd_hours, 2) }}</td>
                        <td>&#8369;{{ number_format($employee->nd_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Meal Allowance</td>
                        <td></td>
                        <td>&#8369;{{ number_format($employee->meal_allowance, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Transpo Allowance</td>
                        <td></td>
                        <td>&#8369;{{ number_format($employee->half_allowance, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Incentive Leave:</td>
                        <td>{{ number_format($employee->vlsl, 2) }}</td>
                        <td>&#8369;{{ number_format($employee->leave_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Adjustments:</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="total">Total Other Pay:</td>
                        <td></td>
                        <td class="total">&#8369;{{ number_format(($employee->ot_amount25 + $employee->nd_amount + $employee->meal_allowance + $employee->half_allowance + $employee->leave_amount), 2) }}</td>
                    </tr>
                </table>
            </div>
            <div class="section">
                <h2>TOTAL PAY</h2>
                <table>
                    <tr>
                        <td>GROSS PAY:</td>
                        <td>&#8369;{{ number_format($employee->grosspay , 2) }}</td>
                    </tr>
                    <tr>
                        <td class="total">NET PAY:</td>
                        <td class="total">&#8369;{{ number_format($employee->netpay , 2) }}</td>
                    </tr>
                    <tr>
                        <td class="total">RECEIVED BY:</td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="footer">
            <p>AETERNITAS ETERNAL BRIGHT SANCTUARY, INC.</p>
        </div>
    </div>
</body>
</html>
