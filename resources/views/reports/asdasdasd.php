<th>Employee ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Pay Type</th>
                    <th>Monthly Basic</th>
                    <th>Monthly Allowance</th>
                    <th>Total Monthly</th>
                    <th>Bi-Monthly Rate</th>
                    <th>Equivalent Daily Rate</th>
                    <th>Month Rate Paid days</th>

                    <th>RWD Rate</th>
                    <th>RWD No. of Days</th>
                    <th>RWD Amount</th>

                    <th>LWD Rate</th>
                    <th>LWD No. of Days</th>
                    <th>LWD Amount</th>

                    <th>SNH rate</th>
                    <th>SNH No. of Days</th>
                    <th>SNH Amount</th>

                    <th>Total Worked Days</th>

                    <th>Basic Pay</th>

                    <th>OT Rate 25%</th>
                    <th>OT Hours 25% </th>
                    <th>OT Amount 25%</th>

                    <th>OT Rate 30%</th>
                    <th>OT Hours 30% </th>
                    <th>OT Amount 30%</th>

                    <th>OT Rate 100%</th>
                    <th>OT Hours 100% </th>
                    <th>OT Amount 100%</th>

                    <th>OT Total Amount</th>

                    <th>Total Basic Pay + OT</th>

                    <th>Night Differential Rate</th>
                    <th>ND Hours</th>
                    <th>ND Amount</th>

                    <th>Leave Rate</th>
                    <th>Leave Total Credits</th>
                    <th>Used</th>
                    <th>Balance</th>
                    <th>Leave Amount</th>

                    <th>Late deduction rate</th>
                    <th>Late No. of minutes</th>
                    <th>Late amount</th>

                    <th>Total Charge</th>

                    <th>Allowance</th>
                    <th>Meal</th>

                    <th>Gross Pay</th>

                    <th>Loan Employee Purchase</th>
                    <th>Cash Advance</th>
                    <th>Uniforms</th>
                    <th>SSS Loan</th>
                    <th>Pagibig Loan</th>
                    <th>Missing charges</th>

                    <th>SSS YEE</th>
                    <th>SSS YER</th>

                    <th>Philhealth YEE</th>
                    <th>Philhealth YER</th>

                    <th>HDMF YEE</th>
                    <th>HDMF YER</th>

                    <th>Tax</th>
                    <th>Total Deductions</th>
                    <th>Net Pay</th>

                    <td>{{ $employee->employee_id }}</td>
                    <td>{{ $employee->last_name }}, {{ $employee->first_name }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>Monthly</td>


                    <td>{{ $employee->per_month }}</td>
                    <td>{{ $employee->allowance }}</td>
                    <td>{{ $employee->monthly_pay }}</td>
                    <td>{{ $employee->bi_monthly }}</td>
                    <td>{{ $employee->per_day }}</td>
                    <td>{{ $employee->actual_days_worked }}</td>


                    <td>{{ $employee->per_day }}</td>
                    <td>13</td>
                    <td>{{ $employee->rwd_amount }}</td>



                    <td>{{ $employee->lhd_amount }}</td>
                    <td>{{ $employee->per_day }}</td>
                    <td>{{ $employee->legal_worked_days }}</td>
                    <td>{{ $employee->lhd_amount }}</td>
                    <td>{{ $employee->special_rate }}</td>
                    <td>{{ $employee->special_worked_days }}</td>
                    <td>{{ $employee->special_amount }}</td>
                    <td>{{ $employee->total_worked_days }}</td>
                    <td>{{ $employee->basic_pay }}</td>
                    <td>{{ $employee->ot_rate25 }}</td>
                    <td>{{ $employee->ot_hours25 }}</td>
                    <td>{{ $employee->ot_amount25 }}</td>
                    <td>{{ $employee->ot_rate30 }}</td>
                    <td>{{ $employee->ot_hours30 }}</td>
                    <td>{{ $employee->ot_amount30 }}</td>
                    <td>{{ $employee->ot_rate100 }}</td>
                    <td>{{ $employee->ot_hours100 }}</td>
                    <td>{{ $employee->ot_amount100 }}</td>
                    <td>{{ $employee->total_ot }}</td>
                    <td>{{ $employee->total_basic_pay_plus_ot }}</td>
                    <td>{{ $employee->nd_rate }}</td>
                    <td>{{ $employee->nd_hours }}</td>
                    <td>{{ $employee->nd_amount }}</td>
                    <td>{{ $employee->per_day }}</td>
                    <td>{{ $employee->leave->total_credit_points}}</td>
                    <td>{{ $employee->leave->total_used_vlsl }}</td>
                    <td>{{ $employee->leave->balance_vl + $employee->leave->balance_sl }}</td>
                    <td>{{ $employee->leave_amount }}</td>
                    <td>{{ $employee->late_rate }}</td>
                    <td>{{ $employee->number_of_minutes_late }}</td>
                    <td>{{ $employee->late_amount }}</td>

                    <td>{{ $employee->allowance }}</td>
                    <td>{{ $employee->meal_allowance }}</td>
                    <td>{{ $employee->gross_pay }}</td>
                    <td>{{ $employee->employee_purchase }}</td>
                    <td>{{ $employee->cash_advance }}</td>
                    <td>{{ $employee->uniform }}</td>
                    <td>{{ $employee->sss_loan }}</td>
                    <td>{{ $employee->hdmf_loan }}</td>
                    <td>{{ $employee->missing_charges }}</td>
                    <td>{{ $employee->tax_sss_premcontribution }}</td>
                    <td>{{ $employee->employer_sss_premcontribution + ($employee->employer->sss_wisp ?? 0) }}</td>
                    <td>{{ $employee->tax_phic }}</td>
                    <td>{{ $employee->employer_phic }}</td>
                    <td>{{ $employee->tax_hdmf }}</td>
                    <td>{{ $employee->employer_hdmf }}</td>
                    <td>{{ $employee->tax_cutoff }}</td>
                    <td>{{ $employee->total_deduction }}</td>
                    <td class="total">₱{{ number_format($employee->netpay, 2) }}</td>
