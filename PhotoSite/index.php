<?php
require_once 'database.php';

?>

<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>
		Fotografie
	</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="chart.css">
	<script src="jquery/jquery.min.js"></script>
</head>
<body>
	<header id="header" class="">
		<div id="menu">
			<nav id="primaryMenu">
				<ul class="horizontal">
				  <li><a id="homeBtn" href="index.php" title="">Home</a></li>
					<li><a href="" id="chatButton">Chat</a></li>

				  <li id="onClickEventHandler2"><a href="javascript:;" onclick="document.getElementById('uploadPhoto').style.display='block';">
				  Upload</a></li>
				  <li id="onClickEventHandler"><a href="javascript:;" onclick="document.getElementById('loginForm').style.display='block';">
				  Login</a></li>
					<li id="onClickEventHandler3"><a href="javascript:;" onclick="document.getElementById('signupForm').style.display='block';">
				  Sign Up</a></li>
				  <li><a href="logout.php" id="logoutBtn">Logout</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<div id="credentials">
		<?php
            if (!isset($_SESSION['username']))
            	echo "Not logged in! <br />";
            else
                echo "Logged in as, " . $_SESSION['username'] . "!";

        ?>
	</div>

	<div id="loginForm" class="loginF">
        <form class="loginF-content animate" method="POST">
            <div class="loginFContainer">
                <label><b>Username</b></label>
                <input id="usernameField" type="text" placeholder="Username" name="username" required><br>
                <label><b>Password</b></label>
                <input id="passwordField" type="password" placeholder="Password" name="password" required><br>
                <button id="loginBtn" type="submit">Login</button>
            </div>

            <div class="loginFContainer">
                <button type="button" onclick="document.getElementById('loginForm').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>

		<div id="signupForm" class="loginF">
	        <form class="loginF-content animate" action="signup.php" method="POST">
	            <div class="loginFContainer">
	                <label><b>Username</b></label>
	                <input type="text" placeholder="Username" name="username" required/><br>
	                <label><b>Password</b></label>
	                <input type="password" placeholder="Password" name="password" required/><br>
	                <button type="submit">Sign up</button>
	            </div>

	            <div class="loginFContainer">
	                <button type="button" onclick="document.getElementById('signupForm').style.display='none'" class="cancelbtn">Cancel</button>
	            </div>
	        </form>
	    </div>


    <div id="uploadPhoto" class="uploadClass">
        <div class="uploadClass-content animate">
                <div>
                	<form enctype="multipart/form-data" action="upload.php" method="POST">

	                    <div class="row">
	                        <label><b>Name</b></label>
	                        <input id="nameField" type="text" placeholder="Photo name" name="newName" required/>
	                        <br />
	                    </div>


	                    <div class="row">
	                        <label><b>Image</b></label>
	                        <input id="uploadedFileField" type="file" name="uploadedFile" required/>
	                        <br />
	                    </div>

	                    <button id="addPhotoBtn" type="submit" name="add_btn">Add</button>
	                    <br />
										</form>
	                </div>

                <div class="uploadPhotoClass">
                    <button type="button" onclick="document.getElementById('uploadPhoto').style.display='none'" class="cancelbtn">Cancel</button>
                </div>
        </div>
    </div>


	<div class="bodyContent">
		<div class="chatDiv">
			<div>
				<div>
					<span id="chatUser" style="display:none;">
							<?php
								if (!isset($_SESSION['username']))
									echo "You have to be logged in to chat!";
								else
									echo $_SESSION['username'];
							?>
					</span>
						<input id="messageInput" type="text" placeholder="Type here" name="message" required>
						<button id="chatBtn">Send</button>
				</div>

				<ul id="chatList">
					 <?php
							$chatMsg = ORM::for_table('chat')->find_many();
							for ($i = 0; $i < sizeof($chatMsg); $i++)
							{
							?>
									<li> <?php echo $chatMsg[$i]->username . " : " . $chatMsg[$i]->message; ?> </li>
							<?php } ?>
			</ul>
			</div>
		</div>

		<div class="leftContent">
			<?php
				$textResult = ORM::for_table('text')->find_many();
				?>
			<p>
				<?php echo $textResult[0]->text; ?>
			</p>

			<div class="chartClass">
				<dl>
				  <dt>
				    Users per day
				  </dt>
					<?php
						$dayResult = ORM::for_table('days')->find_many();
						$monday = "percentage percentage-" . $dayResult[0]->count;
						$tuesday = "percentage percentage-" . $dayResult[1]->count;
						$wednesday = "percentage percentage-" . $dayResult[2]->count;
						$thursday = "percentage percentage-" . $dayResult[3]->count;
						$friday = "percentage percentage-" . $dayResult[4]->count;
						?>
				  <dd class="<?php echo $monday ?>" ><span class="chart" id="mondayChart">Monday</span></dd>
				  <dd class="<?php echo $tuesday ?>"><span class="chart" id="tuesdayChart">Tuesday</span></dd>
				  <dd class="<?php echo $wednesday ?>"><span class="chart" id="wednesdayChart">Wednesday</span></dd>
				  <dd class="<?php echo $thursday ?>"><span class="chart" id="thursdayChart">Thursday</span></dd>
				  <dd class="<?php echo $friday ?>"><span class="chart" id="fridayChart">Friday</span></dd>
				</dl>
			</div>
			</div>


		<div class="rightContent">
			<p>
				<?php echo  $textResult[1]->text; ?>
			</p>
			<div id="slideShow" class="sShow slide" data-ride="sShow">
				<?php
					$photoList = ORM::for_table('photos')->find_many();
                    for ($i = 0; $i < sizeof($photoList); $i++)
                    {
                    ?>
                            <div class="mySlides fade">
                                <img src="<?php echo $photoList[$i]->path; ?>" alt="">
                            </div>
                            <?php }

				?>

				</div>
				<br>

				<div id="slideButtons">
					<a id="nextBtn" class="next">&#10095;</a>

				</div>

		</div>
	</div>


	<script src="script.js"></script>

	<footer>
		<div class="footer-left">
			<div class="social-icons">
			   <a href="http://www.linkedin.com/in/ionut-oprea-01237"><img alt="linkedin" src="images/linkedin.png"></a>
			   <a href="https://github.com/ioprea"><img alt="git" src="images/git2.png"></a>
			   <span>@Copyright</span>
		   </div>

	  </div>
	</footer>

</body>
</html>
