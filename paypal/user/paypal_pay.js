$(document).ready(function(){
        paypal.Buttons({
        	style: {
                color:  'blue',
                shape:  'pill',
                label:  'pay',
                height: 40
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '2.44'
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                	$.ajax({
                		type: 'POST',
                		url: 'pay.php',
                		data: {
                			tid: details.id,
                			status: details.status,
                			value: details.purchase_units[0].amount.value
                		},
                		success: function(response){
                			if(response == "success"){
                				$('#paypal-button-container').slideUp();
                				$('#success_payment_div').html("Payment done please wait...");
	                			setTimeout(function(){
	                				window.location.href = "dashboard.php";
	                			}, 2500);
                			}
                		}
                	});
                	// console.log(JSON.stringify(details));
                    // alert(' Transaction completed by ' + details.payer.name.given_name + '!');
                });
            }


        }).render('#paypal-button-container');
    });