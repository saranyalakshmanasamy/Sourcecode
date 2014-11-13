<html>
<head>
<title>Production Order</title>
<style type ="text/css">
table {
	border: 2px solid red;
     background-color: #FFC;
	}
   th {
   border-bottom: 5px solid #000;
				 }
	td {
	border-bottom: 2px solid #666;
	}
	</style>
	</head>
	<body>


<?php
require_once('include/config.php');
require_once('include/functions.php');

/* Check to see if the form was submitted from installed domain */

$domain=$_SERVER['HTTP_HOST'];
$uri = parse_url($_SERVER['HTTP_REFERER']);
$r_domain = substr($uri['host'],strpos($uri['host'],"."),strlen($uri['host']));
$output ='';
if ($domain == $r_domain){

              /* open the connection to database */
             $link = f_sqlConnect(DB_USER,DB_PASSWORD,DB_NAME);
            
			  /* Prevent SQL injection attacks */
             $_POST =f_clean($_POST);
               if(isset($_POST['Submit'])){
                  $searchq =$_POST['search'];
	              $query = mysql_query ("SELECT id_order_detail,id_order, product_id, product_name, product_quantity, product_quantity_in_stock FROM ws_order_detail WHERE id_order = {$searchq}")or die(mysql_error()) ;
				  
				  //$query = mysql_query ("SELECT distinct a.id_order,i.id_customer,concat(i.firstname," ",i.lastname)as Customer_Name,b.product_id,b.product_name,b.product_quantity,b.product_price,b.product_quantity_in_stock,a.current_state,j.name as order_status,a.ID_ADDRESS_DELIVERY,concat(i.address1," ",i.address2," ",i.city," ",i.postcode) as ADDRESS from ws_orders a join ws_order_detail b on a.id_order = b.id_order join  `ws_address` i on a.id_address_delivery = i.id_address join ws_order_state_lang j on a.current_state = j.id_order_state where a.id_order = {$searchq}")or die(mysql_error()) ;

				  echo "<table>";
				 echo "<tr><th>id_order_detail</th><th>id_order</th><th>product_id</th><th>product_name</th><th>product_quantity</th><th>product_quantity_in_stock</th></tr>";
	              $count =mysql_num_rows ($query);
	                if ($count == 0){
	                     $output = 'There was no search results';
	                   } else {
	                        while ($row =mysql_fetch_array ($query)){
							     echo "<tr><td>";
								 echo $row['id_order_detail'];
								 echo "</td><td>";
								 echo $row['id_order'];
								 echo "</td><td>";
								 echo $row['product_id'];
								 echo "</td><td>";
								 echo $row['product_name'];
								 echo "</td><td>";
								 echo $row['product_quantity'];
								 echo "</td><td>";
								 echo $row['product_quantity_in_stock'];
								 echo "</td></tr>";
								 }
		 echo $output;
}
}	
}
mysql_close();

?>
</body>
</html>