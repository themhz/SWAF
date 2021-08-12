
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
<h1>ADMIN page</h1>
  <div class="container">
    <h1 class="display-3"> </h1>
    <br><br><br><br>
    <form action="main" method="post" enctype="multipart/form-data">
      Select image to upload:&nbsp;
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload Image" name="submit">
    </form>

    <br>
    ------------------------------------------------------------------------------------------------------------------------
    <br><br>

    <form action='main' method='post' enctype='multipart/form-data'>
      Select images to upload:
      <input type="file" name="file[]" id="file" multiple>
      <input type='submit' name='submit' value='Upload'>

    </form>
  </div>
</div>