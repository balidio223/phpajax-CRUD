
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ajax Crud</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">

  <script src="js/jquery-1.12.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <style type="text/css">
  .panel
  {
    margin-top: 10px;
  }
  .teal-dark
  {
    background-color: #004d40 !important;
    color: white !important;
  }
  .teal-darken-3
  {
    background-color: #00796b !important;
    color: white !important;
  }
  .success-add, .success-delete, .success-update
  {
    display: none;
  }
  </style>
</head>
<body>

<div class="container">
  <div class = "row">
    <div class = "col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading teal-dark"><h4>AJAX Crud</h4></div>
        <div class="panel-body">
            <div class = "row">
              <div class = "col-sm-3">
                <button class = "btn teal-darken-3 add-btn">Add new record</button>
              </div>
              <div class = "col-sm-6 add-form">
                <form role="form" id="reg-form" autocomplete="off">
                  <div class="form-group">
                    
                    <input type="text" class="form-control" id="fname" name = "fname" placeholder = "First Name" required>
                  </div>
                  <div class="form-group">
                    
                    <input type="text" class="form-control" id="mname" name = "mname" placeholder = "Middle Name" required>
                  </div>
                  <div class="form-group">
                    
                    <input type="text" class="form-control" id="lname" name = "lname" placeholder = "Last Name" required>
                  </div>
                    <input type = "hidden" name = "action" value = "addData">
                  
                  <button type="submit" class="btn btn-default teal-darken-3">Add</button>
                </form>
              </div>
              <div class = "col-sm-3"></div>
            </div>
            <br>
            <div class="alert alert-success text-center success-add">
              <a href="tryit_599.htm#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Successfully Added!</strong> 
            </div>
            <div class="alert alert-success text-center success-delete">
              <a href="tryit_599.htm#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Successfully Deleted!</strong> 
            </div>
            <div class="alert alert-success text-center success-update">
              <a href="tryit_599.htm#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Successfully Updated!</strong> 
            </div>
            <table class = "table table-bordered table-hover table-striped">
                <thead>
                  <tr class = "teal-darken-3">
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id = "showData">
                 
                </tbody>
            </table>
              <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Delete Record</h4>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to delete this record?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger yes" >Yes</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    </div>
                  </div>

                </div>
              </div>
              <div id="myModalUpdate" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Update Record</h4>
                    </div>
                    <div class="modal-body">
                      <form role="form" id="update-form" autocomplete="off">
                        <div class="form-group">
                          
                          <input type="text" class="form-control" id="u_fname" name = "u_fname" placeholder = "First Name" required>
                        </div>
                        <div class="form-group">
                          
                          <input type="text" class="form-control" id="u_mname" name = "u_mname" placeholder = "Middle Name" required>
                        </div>
                        <div class="form-group">
                          
                          <input type="text" class="form-control" id="u_lname" name = "u_lname" placeholder = "Last Name" required>
                        </div>
                          <input type = "hidden" id = "u_id" name = "u_id" >
                          <input type = "hidden" name = "action" value = "updateData">
                        
                      
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger btn-update" >Update</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                      
                      </form>
                    </div>
                  </div>

                </div>
              </div> 
        </div>
      </div>
      
      
    </div>

  </div>    
</div>

<script>
    
    $('#reg-form').submit(function(e){

        e.preventDefault();

        $.ajax({

            url: 'functions.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'html',
            success: function(result)
            {
              $('#showData').html(result);
              $('#reg-form')[0].reset();
              $('.add-form').hide('slow');
              $('.add-btn').show('slow');
              $('.success-add').fadeIn(1000).delay(2000).fadeOut(1000);

            },
            error: function()
            {
              alert('failed!');
            }
        })
        

    });

    $(document).ready(function(){
        $('.success-add').hide();
        $('.success-delete').hide();
        $('.add-form').hide();
        $('.add-btn').click(function(){
            $('.add-form').show('slow');
            $('.add-btn').hide('slow');
        });
        function showData()
        { 
          $.ajax({

              url: 'functions.php',
              type: 'POST',
              data: {action : 'showProduct'},
              dataType: 'html',
              success: function(result)
              {
                $('#showData').html(result);
              },
              error: function()
              {
                alert('failed!');
              }
          })
          
          
        }
        
        showData();
 
      
    });

    function deleteData(id)
    {
      //if (confirm('Are you sure you want to delete this?')) {
        $("#myModal").modal("show");
        $('.yes').click(function(e){

          $.ajax({

              url : 'functions.php',
              type : 'POST',
              data : {action : 'deleteData', id : id},
              dataType: 'html',
             
              success: function(result)
              {
                $('#showData').html(result);
                $("#myModal").modal("hide");
                $('.success-delete').filter(":not(:animated)").fadeIn(1000).delay(2000).fadeOut(1000);
              }
          })

        })
     // }
    }  
    function updateData(id)
    {
      //if (confirm('Are you sure you want to delete this?')) {
        $("#myModalUpdate").modal("show");
        
        $.ajax({

            url : 'functions.php',
            type : 'POST',
            data : {id : id, action : 'showUpdateData'},
            dataType: 'json',
            success : function(result)
            {
              $('#u_fname').val(result.fname);
              $('#u_mname').val(result.mname);
              $('#u_lname').val(result.lname);
              $('#u_id').val(id);
            }
        })

        $('#update-form').submit(function(e){

        e.preventDefault();

        $.ajax({

            url: 'functions.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'html',
            success: function(result)
            {
              $('#showData').html(result);
              $("#myModalUpdate").modal("hide");
              $('.success-update').filter(":not(:animated)").fadeIn(1000).delay(2000).fadeOut(1000);
            },
            error: function()
            {
              alert('failed!');
            }
        })
        

    }); 
     // }
    } 

    
</script>

</body>
</html>
