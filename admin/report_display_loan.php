<?php 
if(isset($_POST['sub']))
{
    $search=$_POST['seachLoan'];
//echo $search;	
$q=mysqli_query($conn,"select * from loan  where group_id='$search'");
}
else
{
$q=mysqli_query($conn,"select * from loan");
}
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red'>No any Loan Records exists !!!</h2>";
//echo '<a title="Add New Loan Records" class="col-md-3 btn btn-primary" href="index.php?page=add_loan"><span class="fa fa-plus">		</span> Allot New Loan ?</a>';
}
else
{
?>
<div class="col-12">
    		<div class="card mt-5">
                <h2 class="card-header">All Loan Details</h2>
		        <div class="card-body">
		        	<form class="needs-validation row"  action="index.php?page=report_display_loan" novalidate method="post">
		<select name="seachLoan" class="form-control col-md-4" required>
			<option value="">Select Group</option>
			<?php 
$q1=mysqli_query($conn,"select * from groups");
while($r1=mysqli_fetch_assoc($q1))
{
echo "<option value='".$r1['group_id']."'>".$r1['group_name']."</option>";
}
			?>
		</select>
		<input type="submit" value="Search Loan" name="sub" class="col-md-2 btn btn-success" />
	</form>

</div>
</div>
</div>
<div class="col-12">
            <div class="card mt-5">
            	<div class="card-header row">
            	 
		<a title="Print all Loan Records" class="col-md-1 btn btn-info" href="print_loan_record.php"><span class="fa fa-print">
		</span></a>
			</div>
			<table id="dom-jqry" class="table table-striped text-center">
	<tr class="active">
		<th>Sr.No</th>
		<th>Group Name</th>
		<th>Loan Source</th>
		<th>Amount</th>
		<th>Interest</th>
		<th>Payment Schedule</th>
		<th>Due Date</th>
	</tr>
		<?php 


$i=1;
while($row=mysqli_fetch_assoc($q))
{

echo "<tr>";
echo "<td>".$i."</td>";


$q1=mysqli_query($conn,"select * from groups where group_id='".$row['group_id']."'");
$r1=mysqli_fetch_assoc($q1);

echo "<td>".$r1['group_name']."</td>";
echo "<td>".$row['loan_come_from']."</td>";
echo "<td>".$row['loan_amount']."</td>";
echo "<td>".$row['loan_interest']."</td>";
echo "<td>".$row['payment_schedule']."</td>";
echo "<td>".$row['due_date']."</td>";

?>
<?php 

echo "</tr>";
$i++;
}
		?>
		
</table>

</div>
</div>
	
<?php }?>