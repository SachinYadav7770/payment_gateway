<!DOCTYPE html>
<html>
<head>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <title></title>
  <style type="text/css">
    .jumbotron {
    width: 60%;
    margin-left: 20%;
  }
  </style>
</head>
<body><?php 
$order_id = mt_rand(100000,999999);
?>
  <div class="jumbotron">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter Name">
      </div>
      <div class="form-group">
        <label for="amount">Amount</label>
        <input type="text" class="form-control" id="amount" placeholder="Amount">
      </div>
      <button type="submit" class="btn btn-primary" onclick="pay_now();">Pay Now</button>
  </div>
</body>
<script type="text/javascript">
  function pay_now(){
    var name = $('#name').val();
    var amount = $('#amount').val();
    var order_id = <?php echo $order_id; ?>;

    $.ajax({
            type:'post',
            url:'payment_process.php',
            data:"amt="+amount+"&name="+name+"&order_id="+order_id,
            success:function(result){
                  var options = {
                    "key": "rzp_test_ltuWnwK3cF0A8h", // Enter the Key ID generated from the Dashboard
                    "amount": amount*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": "Yadav Test",
                    "description": "Test Transaction",
                    "image": "Apple-Logo-PNG-Picture.png",
                    "handler": function (response){
                        $.ajax({
                          type:'post',
                          url:'payment_process.php',
                          data:"payment_id="+response.razorpay_payment_id+"&razorpay_signature="+response.razorpay_signature,
                          success:function(result){
                            window.location.href="thank_you.php";
                          }
                        });
                    }
                  };
                  var rzp1 = new Razorpay(options);
                  rzp1.open();
            }
          });
  }
</script>
</html>