<div id="course-panel" class="panel panel-default">
  <div class="panel-heading">Add New Courses</div>
  <div class="panel-body">
    <p>Number of classes:
      <input type="button" value="+" onClick="addRow('dataTable')" class="btn btn-success btn-sm "/>
      <input type="button" value="-" onClick="deleteRow('dataTable')" class="btn btn-danger btn-sm "/>
    </p>
    <form class="form-horizontal course_selection" action="/course" method="POST">
      {{csrf_field()}}
      <fieldset class="row2">
        <table id="dataTable" class="form" border="0px">
          <tbody>
          <tr>
            <p>
            <td>
              <div class="form-group">
                <label for="course_name" class="col-md-4 control-label">Course Name: </label>
                <div class="col-md-6">
                  <input id="course_name" type="text" placeholder="i.e SOEN341" class="form-control" name="add_course_ids[0]" value="{{ old('course_name') }}">
                </div>
                <input type="button" value="Remove" onClick="deleteRow('dataTable')" class="btn btn-primary btn-xs"  />
              </div>
            </td>
            </p>
          </tr>
          </tbody>
        </table>
      </fieldset>
      <div class="form-group">
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary ">
            Add Courses
          </button>
        </div>
      </div>
    </form>
  </div>
</div>