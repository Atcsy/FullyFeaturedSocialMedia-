<?php
include("../../config/config.php");
include("../classes/User.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$names = explode(" ", $query); //$names array           $query string

// check the prediction what we are searching for
if(strpos($query, "_") !== false) { // if we have _ in the query search in the usernames
$param = "{$query}%";
$stmt = $conn->prepare("SELECT * FROM users WHERE username LIKE ? AND user_closed='no' LIMIT 8");

$stmt->bind_param("s", $param);
$stmt->execute();
$usersReturned = $stmt->get_result();
$stmt->close();
}
else if(count($names) == 2) { //if 2 elements in the names array
    $param1 = "%{$names[0]}%";
    $param2 = "%{$names[1]}%";
    $stmt = $conn->prepare("SELECT * FROM users WHERE (first_name LIKE ? AND last_name LIKE ?) AND user_closed='no' LIMIT 8");

    $stmt->bind_param("ss", $param1, $param2);
    $stmt->execute();
    $usersReturned = $stmt->get_result();
    $stmt->close();
}
else {
    $param1 = "%{$names[0]}%";
    $stmt = $conn->prepare("SELECT * FROM users WHERE (first_name LIKE ? OR last_name LIKE ?) AND user_closed='no' LIMIT 8");

    $stmt->bind_param("ss", $param1, $param1);
    $stmt->execute();
    $usersReturned = $stmt->get_result();
    $stmt->close();
}
if($query != "" ) {

	while($row = mysqli_fetch_array($usersReturned)) {

		$user = new User($con, $userLoggedIn);

		if($row['username'] != $userLoggedIn) {
			$mutual_friends = $user->getMutualFriends($row['username']) . " friends in common";
		}
		else {
			$mutual_friends = "";
		}

		if($user->isFriend($row['username'])) {
			echo "<div class='resultDisplay'>
					<a href='messages.php?u=" . $row['username'] . "' style='color: #000'>
						<div class='liveSearchProfilePic'>
							<img src='". $row['profile_pic'] . "'>
						</div>

						<div class='liveSearchText'>
							".$row['first_name'] . " " . $row['last_name']. "
							<p style='margin: 0;'>". $row['username'] . "</p>
							<p id='grey'>".$mutual_friends . "</p>
						</div>
					</a>
				</div>";


		}


	}
}

?>