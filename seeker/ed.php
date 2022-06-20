	<br/>
<script>
$(document).ready(function(){
    $("#added").click(function(){
        $("#edd").html("<div class='loader'></div>");   
        
        $("#edd").load("modal_add_ed.php");
        
    });

});
</script>
	<?php
require_once("../db/db.php");// جلب بيانات الأتصال بقاعدة البيانات
require_once("session.php");
	$rs= $mysqli->query("SELECT start_date,ed_id,edt_name,domain_name,univ,specialty,avg,end_date,user_id
							FROM job_ed,job_domain,job_ed_type
							WHERE job_ed_type.edt_id = job_ed.edt_id
							AND job_ed.domain_id = job_domain.domain_id
							AND user_id ='$txt_user_id' 
							ORDER BY end_date DESC ")or die($mysqli->error());
			if($rs->num_rows==0){
			echo "<span class='texts' >هذا الجزء مخصص لذكر المؤهلات العلمية الخاصة بك ، إذا كنت تملك شهادة البكالوريس أو شهادة أعلي منها يفضل عدم ذكرك لشهادتك الثانوية، إذاكان معدلك جيد أو اكثر فيفضل ذكر معدلك</span>";
			echo "<br/>";
			echo "<br/>";
			}										
	$resultcount = $rs->num_rows;
	while($row=$rs->fetch_object()){
	$id=$row->ed_id;
	
	
	echo "<span class='textb textlineb'>".$row->univ."</span>";
	echo "<span class='texts textlines'><br/>".$row->edt_name;
	if(!empty($row->specialty)){
	echo "، ";}
	echo $row->specialty;
	if(!empty($row->avg)){
	echo "، ";}
	echo $row->avg;
	echo "<br>".$row->start_date." - ".$row->end_date."";
	echo "<br/>"."المجال "."</span><span class='texts textlines'>".$row->domain_name."</span>";
	echo "<br/>";
	echo "<br/>";
	echo '<a class="facebox" href="modal_edit_ed.php?id='.$id.'"><img src="../images/edit.png" alt="تعديل"/> تعديل</a>';
	echo '<a class="facebox" href="modal_delete_ed.php?id='.$id.'"><img src="../images/remove.png"/> حذف</a>';
		echo "<br/>";
			echo "<br/>";	echo "<br/>";
	}
	$rs->free_result();
    
		if ($resultcount <=10){
		echo "<button id='added'> +أضافة</button> ";
		}
		else{
		echo "<span class='t'>وصلت للحد الأعلي من المؤهلات</span>"; 
		}
		?> 