@extends('layouts.master')
@section('heading')
@stop
@section('content')
@push('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip(); //Tooltip on icons top
            $('.popoverOption').each(function () {
                var $this = $(this);
                $this.popover({
                    trigger: 'hover',
                    placement: 'left',
                    container: $this,
                    html: true,
                    content: $this.find('#popover_content_wrapper').html()
                });
            });
        });
    </script>
@endpush
    <div class="row">
        @include('partials.meetingheader')
    </div>
    <div class="col-lg-12">
        <el-tabs active-name="attendance" style="width:100%">
            <el-tab-pane label="Attendance ({{count($attendedMembers)}})" name="attendance">
                <table class="table table-hover" id="attendance-table">
                <h3>{{ __('Attended members') }}</h3>
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Company') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>
                        </tr>
                    </thead>
                    @foreach ($attendedMembers as $attendedMember)
                        <tr>
                            <td><a href="{{ route('members.show',$attendedMember->id)}}">{{$attendedMember->name}}</a></td>
                            <td>{{$attendedMember->company_name}}</td>
                            <td>{{$attendedMember->email}}</td>
                            <td>{{$attendedMember->primary_number}}</td>
                        </tr>
                    @endforeach
                </table>
                <a href="{{ url('/attendance/' . $meeting->id . '/edit') }}" class="btn btn-primary">Update Attendance</a> 

            </el-tab-pane>
            <el-tab-pane label="Guests ({{count($attendedGuests)}})" name="guests">
                <table class="table table-hover" id="guests-table">
                <h3>{{ __('Attended guests') }}</h3>
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Company') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>
                        </tr>
                    </thead>
                    @foreach ($attendedGuests as $attendedGuest)
                        <tr>
                            <td><a href="{{ route('guests.show',$attendedGuest->id)}}">{{$attendedGuest->name}}</a></td>
                            <td>{{$attendedGuest->company_name}}</td>
                            <td>{{$attendedGuest->email}}</td>
                            <td>{{$attendedGuest->primary_number}}</td>
                        </tr>
                    @endforeach
                </table>
                <a href="{{ url('/attendance/' . $meeting->id . '/edit') }}" class="btn btn-primary">Update Attendance</a>
                <a href="{{ route('guests.create', 'referrer=/meetings/'.$meeting->id) }}" class="btn btn-primary">Add New Guest</a>
            </el-tab-pane>
            <el-tab-pane label="Referrals ({{count($meetingReferrals)}})" name="referrals">
              <table class="table table-hover">
                <table class="table table-hover" id="referrals-table">
                        <h3>{{ __('Referrals made') }}</h3>
                        <thead>
                        <tr>
                            <th>{{ __('From') }}</th>
                            <th>{{ __('To') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Description') }}</th>
                        </tr>
                        </thead>
                        @foreach ($meetingReferrals as $meetingReferral)
                            <tr>
                                <td>{{Helper::getContactName($meetingReferral->from_contact_id)}}</td>
                                <td>{{Helper::getContactName($meetingReferral->to_contact_id)}}</td>
                                <td>{{Helper::formatDate($meetingReferral->referral_date)}}</td>
                                <td>{{$meetingReferral->description}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <a href="{{ route('referrals.create', 'referrer=/meetings/'.$meeting->id) }}" class="btn btn-primary">Add New Referral</a>
            </el-tab-pane>
            <el-tab-pane label="1-to-1s ({{count($onetoones)}})" name="onetoones">
                 <table class="table table-hover" id="onetoones-table">
                        <h3>{{ __('1-to-1s made') }}</h3>
                        <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Description') }}</th>
                        </tr>
                        </thead>
                        @foreach ($onetoones as $onetoone)
                            <tr>
                                <td>{{Helper::getContactName($onetoone->first_contact_id)}}</td>
                                <td>{{Helper::getContactName($onetoone->second_contact_id)}}</td>
                                <td>{{Helper::formatDate($onetoone->onetoone_date)}}</td>
                                <td>{{$onetoone->description}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <a href="{{ route('onetoones.create', 'referrer=/meetings/'.$meeting->id) }}" class="btn btn-primary">Add New 1-to-1</a>
            </el-tab-pane>
          </el-tabs>

    </div>
    
@stop