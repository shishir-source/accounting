@extends('layouts.dashboard')
@section('page_heading','General Ledger List')
@section('section')

<style type="text/css">
    .table{
            margin-bottom: 5px;
    }
</style>

<div class="col-sm-12" id="demo">
    <div class="row">
        <div class="col-sm-12 input_table_specific">
            @if(count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        @foreach($errors->all() as $error)
                          <li><span>{{ $error }}</span></li>
                        @endforeach
                    </div>
            @endif

           {{--  @if(Session::has('purchase_table'))
                @include('widgets.alert', array('class'=>'success', 'message'=> Session::get('purchase_table') ))
            @endif --}}

            <form class="form-horizontal" method="post" id="generalLedgerForm">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="col-md-3">
                    <select name="ledger_chart_of_acc" class="myselect" >
                        <option value="">Select Account</option>
                        @foreach($chart_of_accounts as $chart_of_account)
                            <option value="{{ $chart_of_account->chart_o_acc_head_id }}" {{ ((Session::get('ledger_chart_of_acc_for_select_field')) == $chart_of_account->chart_o_acc_head_id)? "selected":"" }}>{{ $chart_of_account->acc_final_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-7 row">
                    <div class="col-md-6 row">
                        <div class="col-md-3">
                            Form:
                        </div>
                        <div class="col-md-9">
                            <input type="date" class="form-control" placeholder="Search date...." name="ledgerDateSearchFldFrom" id="ledgerDateSearchFldFrom" value="{{ Session::get('ledger_fromDate')}}" >
                            <p id="search"></p>
                        </div>
                    </div>

                    <div class="col-md-6 row">
                        <div class="col-md-3">
                            To:
                        </div>
                        <div class="col-md-9">
                            <input type="date" class="form-control" placeholder="Search date...." name="ledgerDateSearchFldTo" id="ledgerDateSearchFldTo" value="{{ Session::get('ledger_toDate') }}" >
                            <p id="search"></p>
                        </div>
                    </div>
                </div>

                {{ Session::forget('ledger_chart_of_acc_for_select_field') }}
                {{ Session::forget('ledger_fromDate') }}
                {{ Session::forget('ledger_toDate') }}

                <div class="col-md-2">
                    <input class="form-control btn btn-primary btn-outline" type="submit" value="search" id="generalLedgerSearchBtn">
                </div>
            </form>
        </div>

        <div class="preLoadImageView" style="display: none;">
            <center>
                <img src="{{ asset("assets/images/preLoader_2.gif") }}">
            </center>
        </div>
        <div class="ledgerDetailsView"></div>
        <div class="dataNotFoundMessage" style="margin-top: 10%; margin-left: 9%;"></div>
        
        <div class="ledgerDataView" style="display: none;">
            <p class="ledgerDetails"></p>
            <p class="dateFrom"></p> 
            <p class="dateTo"></p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Date</th>
                        <th>Particular</th>
                        <th>Credit/Withdraw</th>
                        <th>Debit/Deposit</th>
                        <th>Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="LdgrTableBody">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset("js/ledger.js") }}"></script>
<script type="text/javascript">
    $(".myselect").select2();
</script>
@stop
