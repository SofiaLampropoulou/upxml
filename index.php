<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Upload your XML</h2>
  <p>Use an XML that can convert to XLSX (EXCEL)</p>
  <form id=frm1>
    <div class="form-group">
      <label for="usr">File:</label>
      <input type="file" class="form-control" name='file1' id='file1'><br>
    
    </div>
    <div class="form-group">
    <button type="submit">Upload File</button>
    </div>
  </form>
  <div id=msg></div>
</div>

<script>
  $("#frm1").submit(()=>{
    event.preventDefault();
    const form = document.getElementById("frm1");
    var formData = new FormData(form);
    $.ajax({
        type: "POST",
        url: "api.php?q=1",
       
        success: function (res) {
          if(res!="0"){
            $("#msg").html(`<div class="alert alert-success">
  <strong>Success!</strong> To download your XLSX File press <a href='${res}'>DOWNLOAD XLSX</a>.
</div>`);
          }
          else
          {
            $("#msg").html(`<div class="alert alert-danger">
  <strong>Error!</strong> Your file has error format or there was upload problem.
</div>`);
          }
        },
        error: function (error) {
          $("#msg").html(`<div class="alert alert-danger">
  <strong>Error!</strong> Your file has error format or there was upload problem.
</div>`);
        },
        async: true,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        timeout: 60000
    });

  });
</script>

</body>
</html>
