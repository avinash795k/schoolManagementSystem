<?php

		
	//function to check for sql injectiion

	function InjectionCheck($value){
	    $value = htmlspecialchars($value);
	    $value = trim($value);

	    return $value;
	}
  
	  
	// function to get user firstname and lastname
	function findUser($rollno){

	  	$query = "select FirstName, LastName from studentDetails where RollNo = '$rollno'";
	  	$runQuery = mysql_query($query);

	  	$row = mysql_fetch_array($runQuery);

	  	return $row['FirstName']." ".$row['LastName'];
	}

	//function to get user batch and branch
	function findBatch($rollno){

		$query = "select yearOfJoining, Branch from studentDetails where RollNo = '$rollno'";
	  	$runQuery = mysql_query($query);

	  	$row = mysql_fetch_array($runQuery);

	  	return "Batch: ". $row['yearOfJoining'].", Branch: ".$row['Branch'];

	}

	// function to retrive the image for a particular user
	function findPic($rollno){

		$query = "select image, Branch from studentDetails where RollNo = '$rollno'";
	  	$runQuery = mysql_query($query);

	  	$row = mysql_fetch_array($runQuery);

	  	return "../images/". $row['image'];

	}

	//function to get name of the user
	function getName($rollno){

		$query = "select FirstName, LastName from studentDetails where RollNo = '$rollno'";
	  	$runQuery = mysql_query($query);

	  	$row = mysql_fetch_array($runQuery);

	  	return $row['FirstName']." ".$row['LastName'];

	}

	//function  to get Email
	function getEmail($rollno){

		$query = "select Email from studentDetails where RollNo = '$rollno'";
	  	$runQuery = mysql_query($query);

	  	$row = mysql_fetch_array($runQuery);

	  	return $row['Email'];

	}

	//function to get Branch
	function getBranch($rollno){

		$query = "select Branch from studentDetails where RollNo = '$rollno'";
	  	$runQuery = mysql_query($query);

	  	$row = mysql_fetch_array($runQuery);

	  	return $row['Branch'];

	}
	//function to get rollno
	function getSemester($rollno){
		$query = "select Semester from studentDetails where RollNo = '$rollno'";
	  	$runQuery = mysql_query($query);

	  	$row = mysql_fetch_array($runQuery);

	  	return $row['Semester'];
	}

	//function to get Batch
	function getBatch($rollno){

		$query = "select yearOfJoining from studentDetails where RollNo = '$rollno'";
	  	$runQuery = mysql_query($query);

	  	$row = mysql_fetch_array($runQuery);

	  	$batchExp = $row['yearOfJoining']+4;

	  	return $row['yearOfJoining']."-".$batchExp;

	}

	//function to get address
	function getAddress($rollno){

		$query = "select address from studentDetails where RollNo = '$rollno'";
	  	$runQuery = mysql_query($query);

	  	$row = mysql_fetch_array($runQuery);

	  	return $row['address'];

	}

	//function  to get contact
	function getContact($rollno){

		$query = "select contactNum from studentDetails where RollNo = '$rollno'";
	  	$runQuery = mysql_query($query);

	  	$row = mysql_fetch_array($runQuery);

	  	return $row['contactNum'];

	}

	//functio to update password

	function updatePassword($current, $new, $rollno){
		$current = md5($current);
		$new 	 = md5($new);

		$query = "select Password from studentDetails where RollNo = '$rollno'";
	  	$runQuery = mysql_query($query);
		$row = mysql_fetch_array($runQuery);

		if($current != $row['Password']){
			return "noMatch";
		}else{
			$query = "UPDATE studentDetails set Password = '$new' where RollNo = '$rollno'";
	  		$runQuery = mysql_query($query);
	  		if($runQuery){
	  			return "ohk";
	  		}
		}
		
	}

	//function to update profile picture

	function updatePicutre($image, $rollno){
		$imageTarget= 	"../images/".basename($image);

		$query = "update studentDetails set image='$image' where RollNo = '$rollno'";
	  	$runQuery = mysql_query($query);
		if($runQuery){
			$x=move_uploaded_file($image, $imageTarget);
			if($x){
				echo "<script>alert('ohk')</script>";
			}
		}

	}

	//function to update phone number
	function updatePhone($current, $rollno){
		
			$query = "UPDATE studentDetails set contactNum = '$current' where RollNo = '$rollno'";
	  		$runQuery = mysql_query($query);
	  		if($runQuery){
	  			return "ohk";
	  		}
		
	}

	//function to find user
	function findSearchedUser($user, $rollno){

		$query = "select * from studentDetails where RollNo Like '%$user%' OR FirstName Like '%$user%' OR Email Like '%$user%'";
		$runQuery = mysql_query($query);
		$row = mysql_fetch_array($runQuery);
		$numOfRow = mysql_num_rows($row);

		return  $numOfRow;
	}


	/* Admin Function starts here */

	function findAdmin($user){
		$query = "select * from admin where email='$user'";
		$runQuery = mysql_query($query);
		$row = mysql_fetch_array($runQuery);

		return $row['fname']." ".$row['lname'] ;
	}

	function getBranchDetails(){
		$query = "select * from branch";
        $runQuery = mysql_query($query);
		return $runQuery;
	}



 ?>
