<div class="modal fade" id="searchModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Search</h4>
      </div>
      <div class="modal-body">
        <form action="/search" method="GET">
          <span>Search By</span>
          <select name="option" id="search_option_selected" style="margin-bottom: 10px;">
            <option value="name_id">Name or ID</option>
            <option value="pin">Pin</option>
            <option value="address">Address</option>
            <option value="phone">Phone</option>
            <option value="po">P.O</option>
            <option value="creation_month">Creation Month</option>
          </select>
          <input type="text" class="form-control" autocomplete="off" name="search" placeholder="Type Here to Search..." id="search_text">
          <div id="search_by_month" style="display: none;">
          {{ Form::selectMonth('start_month',null, array() )}}{{ Form::selectRange('start_year', 2017, 2019, 2017, array())}}
          </div>
          <br/>
          <input type="submit" class="btn btn-primary" value="Submit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>