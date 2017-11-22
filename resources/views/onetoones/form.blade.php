<div class="form-group">
             {!! Form::label('Date', __('Date'), ['class' => 'control-label']) !!}
            {!! Form::date('onetoone_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        
    </div>
    <div class="form-inline">
        <div class="form-group col-sm-6 removeleft ">
            {!! Form::label('first_member_id', __('First member'), ['class' => 'control-label']) !!}
            {!! Form::select('first_member_id', $members, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-6 removeleft ">
            {!! Form::label('second_member_id', __('Second member'), ['class' => 'control-label']) !!}
            {!! Form::select('second_member_id', $members, null, ['class' => 'form-control']) !!}
        </div>
        
     </div>


    <div class="form-group">
        {!! Form::label('description', __('Description'), ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>


     {{ Form::hidden('group_id', '1') }}
    
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}