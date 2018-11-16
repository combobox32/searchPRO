<?php

  require_once('connection.php');

  session_start();

  $pom = $conn->prepare("SELECT 
  `id`, `product_name`, `price`,
   `category` FROM product 
   order by id desc");
  $pom->execute();

  $result = $pom->fetchAll();

  if(!empty($_POST["logout"])) {
    session_destroy();
    unset($_SESSION['id']);
    header("Location: log.php");
  }

?>

<!DOCTYPE html>
<html>
<head>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SearchPRO</title>
  
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  
  <script type="text/javascript" src="suggestion.js"></script>
  
  </head>

<style>

body {
  background-color: rgba(0, 20, 20, 0.2);
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}


.container{
  color: black;
  margin: 20px auto;
}
h2 {
  color: black;
  text-align: center;
  font-family: "Tahoma, Geneva, sans-serif";
  font-style: italic;
}
table {
    color: #4747d1;
    font-family: "Tahoma, Geneva, sans-serif";
    border-collapse: collapse;
    width: 100%;
}

td, th {
    color: black;
    border: 1px dotted rgba(120, 20, 20, 0.6);
    text-align: left;
    padding: 8px;
}


tr:nth-child(even) {
    background-color: rgba(100, 0, 20, 0.2);
}

.btn {
  color : #33001a;
}

body{
  color: #4747d1;
  font-family: Cambria, Georgia, serif;
  font-size:16px;
}

.member-dashboard {
  font-style: italic;
  text-align: center;
}

.success, .error{
  border: 1px solid;
  margin: 10px 0px;
  padding:15px 10px 15px 50px;
  background-repeat: no-repeat;
  background-position: 10px center;
}

.editbtn {
  font-style: italic;
  color: white;
}

.delbtn {
  font-style: italic;
  color: white;
}

.success {
  color: #4F8A10;
  background-color: #DFF2BF;
  background-image:url('success.png');
  display: none;
}
.error {
  display: none;
  color: #D8000C;
  background-color: #FFBABA;
  background-image: url('error.png');
}

#frmLogout {
  text-align: right;
}

#save {
  color: white;
	text-decoration: none;
	background: rgba(120, 20, 20, 0.3);
  border-radius: 12px;
	padding: 8px 20px;
	cursor: pointer;
}

#sacuvaj:hover {
  background-color: rgba(100, 50, 20, 0.2); 
  color: white;
}

.logout-button {
	color: white;
	text-decoration: none;
	background: rgba(120, 20, 20, 0.4);
  border-radius: 12px;
	padding: 8px 20px;
	cursor: pointer;
}

.logout-button:hover {
    background-color: rgba(100, 50, 20, 0.4); 
    color: white;
}

.member-dashboard {
    font-size: 30px;
}

.livesearch{ 
  color: black;
  width:220px;
  display: right;
}

#txt{
  font-family: "Tahoma, Geneva, sans-serif";
  border: solid #A5ACB2;
  margin:5px;
  text-align: center;
} 

form {
  text-align: center;
}

h3 {
  text-align: center;
  color: black;
}

body {
  padding-bottom: 100px;
}

#message {
  text-align: center;
  color: black;
}

#btn1 {
	color: white;
	text-decoration: none;
	background: rgba(120, 20, 20, 0.4);
  border-radius: 12px;
	padding: 8px 20px;
	cursor: pointer;
}

</style>
</head>
<body onload="document.getElementById('txt').focus()>
  

  <div class="container">
    <div class="success"></div>
    <div class="error"></div>

    <form action="" method="post" id="frmLogout">
    
    <input type="submit" name="logout" value="Sign out" class="logout-button" id = "myButton">

    </div>
    </form>


    <form>
      <div id="livesearch"></div> 
      <h3>Enter product name: </h3>
      <input type="text" id="txt" size="32" onkeyup="suggestion(this.value)"> 

    </form>
 

    <h2>Create/update product:</h2>
    
       <table>
        <tr>
          <td colspan="4" style="text-align: center">
            <input type="hidden" id ='id' value='' />
            <input type='text' id='product_name' placeholder='Product' required />&nbsp;&nbsp;
            <input type='text' id= 'price' placeholder='Price' required />&nbsp;&nbsp;
            <input type='text' id= 'category' placeholder='Category' required />&nbsp;&nbsp;
            <input type='button' id='save'  value ='Save' /></td>
        </tr>
      </table>
    </form>
    <h2>PRODUCTS</h2>

    <table>
      <tr>
        <th>#</th>
        <th>Product name</th>
        <th>Price(€) </th>
        <th>Category</th>
        <th>Operation</th>
      </tr>


  <?php
  
  if($pom->rowCount()):
   foreach($result as $row){ ?>
     <tr>
       <td><?php echo $row['id']; ?></td>
       <td><?php echo $row['product_name']; ?></td>
       <td><?php echo $row['price']; ?></td>
       <td><?php echo $row['category']; ?></td>
       <td><a data-pid = <?php echo $row['id']; ?> 
       class='editbtn' href= 'javascript:void(0)'>
       Update</a>&nbsp;|&nbsp;<a class='delbtn'
        data-pid=<?php echo $row['id']; ?>
         href='javascript:void(0)'>Delete</a></td>
     </tr>
   <?php }  ?>
  <?php endif;  ?>
  </table>
  </div>

  <script src="suggestion.js" type="text/javascript"></script> 
  <script type="text/javascript">
  function place(ele){
      document.getElementById('txt').value = ele.innerHTML;
    document.getElementById("livesearch").style.display = "none";
  }
  </script>


  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script>

    $(function(){
      
      $('.delbtn').on( 'click', function(){
        if(confirm('Delete record?')){
          var pid = $(this).data('pid');
          $.post( "delete_ajax.php", { pid: pid })
          .done(function( data ) {
            if(data > 0){
              $('.success').show(2000).html("Record deleted.").
              delay(2000).fadeOut(2000);
            }else{
              $('.error').show(2000).
              html("Record can't be deleted. Please try again!").
              delay(2000).fadeOut(2000);;
            }
            setTimeout(function(){
                window.location.reload(1);
            }, 3000);
          });
        }
      });

    
      $('.editbtn').on( 'click', function(){
          var pid = $(this).data('pid');
          $.get( "read_ajax.php", { id: pid })
            .done(function( product ) {
              data = $.parseJSON(product);

              if(data){
                $('#id').val(data.id);
                $('#product_name').val(data.product_name);
                $('#price').val(data.price);
                $('#category').val(data.category);
                $("#save").val('Save');
            }
          });
      });

  
       $('#save').on( 'click', function(){
           var id  = $('#id').val();
           var product_name = $('#product_name').val();
           var price = $('#price').val();
           var category = $('#category').val();
           if(!product_name || !price || !category){
             $('.error').show(3000).html("All fields are requred!").delay(3200).fadeOut(3000);
           }else{
                if(id){
                var url = 'update_ajax.php';
              }else{
                var url = 'create_ajax.php';
              }
                $.post( url, {id:id, product_name: product_name, category: category, price: price  })
               .done(function( data ) {
                 if(data > 0){
                   $('.success').show(2000).html("Product saved.").delay(2000).fadeOut(1000);
                 }else{
                   $('.error').show(2000).html("Product can'b saved! Please, try again!").delay(2000).fadeOut(1000);
                 }
                 $("#save").val('save');
                 setTimeout(function(){
                     window.location.reload(1);
                 }, 2000);
             });
          }
       });
    });

 </script>



</body>
</html>