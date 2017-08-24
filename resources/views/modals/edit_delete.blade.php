<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter password to delete</h4>
      </div>
      <div class="modal-body">
        <form action="/address/delete" method="POST">
          {{csrf_field()}}
          <input type="password" name="password" placeholder="password">
          <input type="submit" class="btn btn-primary" value="Submit">
          <input type="hidden" name="delete_id" value="" id="deleteValue">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_title">Edit Address</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="/address/edit" id="edit_form">
          {{ csrf_field() }}
          {{ method_field('patch') }}
          <div class="form-group">
            Name*: <input type="text" class="form-control" name="name" value=""  onkeyup='selectDistrict()'>
            Address*: <textarea name="address" rows=6 class = "form-control" placeholder="Enter the address"></textarea>
            Pin*: <input type="number" class="form-control" name="pin" min=100000 max=999999>
            P.O:<input type="text" class="form-control" name="city" placeholder="Enter Post Office">
            Phone:<input type="text" class="form-control" name="phone" placeholder="Enter Phone number">
            <br/>
            <input type="hidden" name="id" value="">
            *Mandatory<br/>
            State: {{ Form::select('state_id',$states,null,['id' => 'select_state_edit','onChange' => 'selectDistrict()']) }}
            &nbsp;&nbsp;&nbsp;&nbsp;
            District: {{Form::select('district_id',['0' => 'None'],null,array('id' => 'select_district_edit'))}}
            <input type="hidden" value="{{$districts}}" id="district_list">
            <br/><br/>
            Subscription Starts : {{ Form::selectMonth('start_month',$currentMonth, array('onChange' => 'dateRangeSelectModal()', 'id' => 'month_modal1')) }} {{ Form::selectRange('start_year', $currentYear-1, $currentYear+6, $currentYear, array('onChange' => 'dateRangeSelectModal()', 'id' => 'year_modal1')) }}&nbsp;&nbsp;&nbsp;&nbsp;
            Subscription Ends : {{ Form::selectMonth('end_month',$endMonth, array('id' => 'month_modal2')) }} {{ Form::selectRange('end_year', $currentYear, $currentYear+5, $currentYear+1, array('id' => 'year_modal2')) }}
          </div>
          <div class="form-group">
            <button type="submit" class = "btn btn-primary" id="modal_submit">Update</submit>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
</div>