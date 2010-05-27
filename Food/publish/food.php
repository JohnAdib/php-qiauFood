<?php																									// Pass form Variables as method = POST
$time = explode(' ', microtime());
$start = $time[1] + $time[0];

define('AUTHOR','Javad Evazzadeh');
include( 'simple_html_dom.php' );
echo '<title>Qiau Food</title>';

$username= $_POST['username'];
$password= $_POST['password'];
$department= $_POST['department'];
$secondpassword= $_POST['secondpassword'];
$days= array("‘‰»Â","Ìﬂ‘‰»Â","”Â ‘‰»Â","Å‰Ã‘‰»Â");
$reffer = "http://cyber5.qiau.ac.ir/iau/";

$url = "http://cyber5.qiau.ac.ir/iau/login.do"; 														// URL to POST FORM. (Action of Form)
$post_fields = 'command=Login&dispatch=&userName='.$username.'&password='.$password.'&department='.$department; 			// form Fields.
$cookie_file_path = "cookie.txt";
$ch = curl_init();																						// Initialize a CURL session.
set_time_limit(0);
$che = curl_init($url);

ob_start();  
curl_exec($che);
ob_end_clean();

$info = curl_getinfo($che);
if(curl_errno($che))
 {
	echo '<h1 align=center style="color:red">'.curl_error($che).'</h1>';
 }
else
 { 
	echo '<h5 align=center>'."Step1: "
		.'Took '.$info['total_time'].' seconds to send a request to '.$info['url'].'</h5>';				//Show Current Step
	
	
	echo '<hr noshade size=2 width="30%"><h4 align=center style="color:purple">'."Step2".'</h4>';		//login To mainPage
		curl_setopt($ch, CURLOPT_URL, $url);  															// Pass URL as parameter.
		curl_setopt($ch, CURLOPT_REFERER, $reffer);
		curl_setopt($ch, CURLOPT_POST, 1); 																// use this option to Post a form
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 											// Pass form Fields.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  													// Return Page contents.
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		$result = curl_exec($ch);  																		// grab URL and pass it to the variable.
		echo $result; 																					// Print page contents.
	
	
	echo '<hr noshade size=3 width="40%"><h4 align=center style="color:purple">Step3</h4>';				//login To FoodLoginPage
		$url = "http://cyber5.qiau.ac.ir/iau/home.do"; 													// URL to POST FORM. (Action of Form)
		$post_fields = 'changeMenuHiddenName=studentship%2FonlineFood'; 								// form Fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 											// Pass form Fields.
		$result = curl_exec($ch);  																		// grab URL and pass it to the variable.
		echo $result; 																					// Print page contents.

	echo '<hr noshade size=4 width="50%"><h4 align=center style="color:purple">Step4</h4>';				//login To mainPage
	$url = "http://cyber5.qiau.ac.ir/iau/onlineFoods.do"; 												// URL to POST FORM. (Action of Form)
	$post_fields = 'command=checkSecondPassword&dispatch=&wfMenuName=studentship%2FonlineFood&wfStartDate='
				  .'1306334478718'.'&wfCurrentState=-2147483648&wfPageVersion='.'1306335463296'
				  .'&gridRowNumber=&departmentId='.($department-1).'&selectedDepartmentId=0&secondPassword='.$secondpassword.'&confirmDelete=0';

		curl_setopt($ch, CURLOPT_URL, $url);  															// Pass URL as parameter.
		curl_setopt($ch, CURLOPT_REFERER, $reffer);
		curl_setopt($ch, CURLOPT_POST, 1); 																// use this option to Post a form
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 											// Pass form Fields.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  													// Return Page contents.
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		$result = curl_exec($ch);  																		// grab URL and pass it to the variable.
		echo $result; 																					// Print page conte

		

	$html = str_get_html($result);

	$res = $html->find( 'table[class=table-body]' , 0 );
	$array = array();
	$n = $n2 = 0;
echo '<hr noshade size=5 width="50%">';
	foreach( $res->find( 'tr[style=cursor:pointer]' ) as $element )
	{ 
		$array[$n] = array();
		foreach( $element->find('td') as $td )
		{
				$array[$n][$n2] = $td->plaintext ;
				$n2++;
		}
		$n++;
		$n2 = 0;
	}	
	$row=array();
	echo count($array);
	foreach ($array as $i => $value)
    {
		foreach ($days as $j => $value) 
		{
			$fnd = strpos( $array[$i][2],$days[$j] );
			if ($fnd == true && $fnd==52) 
			{
				if (strpos( $array[$i][5],'Œ—Ìœ«—Ì ‰‘œÂ' ))
				{
					echo "kharid";
					$row[] = $i;
				}
				elseif (strpos( $array[$i][5],'Õ–› ‘œÂ' )) echo "hazf shode";
				elseif (strpos( $array[$i][5],'”ﬁ› ›—Ê‘  ﬂ„Ì· «” ' )) echo "takmile";
				elseif (strpos( $array[$i][5],'Œ—Ìœ«—Ì ‘œÂ')) echo "kharidari shode";
				else echo "Unknown";
				break 1;
			} 
			else print "Not Found!";
		}
	echo "<br />";
	}

echo '<hr noshade size=5 width="50%">';
print_r ($row);




	$url = "http://cyber5.qiau.ac.ir/iau/onlineFoods.do"; 												// URL to POST FORM. (Action of Form)	
	foreach ($row as $i => $value)
	{	
		echo '<hr noshade size=5 width="50%"><h2 align=center style="color:purple">Step'.($i+5).'</h2>';	//kharid ghaza
		$post_fields = 'command=purchase&dispatch=&wfMenuName=studentship%2FonlineFood&wfStartDate='
					  .'1306334478718'.'&wfCurrentState=-2147483648&wfPageVersion='.'1306335463296'
					  .'&gridRowNumber='.$value.'&departmentId='.($department-1).'&selectedDepartmentId=4&secondPassword='.$secondpassword.'&confirmDelete=2';
		curl_setopt($ch, CURLOPT_URL, $url);  															// Pass URL as parameter.
		curl_setopt($ch, CURLOPT_REFERER, $reffer);
		curl_setopt($ch, CURLOPT_POST, 1); 																// use this option to Post a form
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 											// Pass form Fields.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  													// Return Page contents.
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		$result = curl_exec($ch);  																		// grab URL and pass it to the variable.
		echo $result; 																					// Print page conte
			
	}


		//logout
	$info = curl_getinfo($ch);
	echo '<title>Food:LogOut</title>';
	echo '<hr noshade size=7 width="75%"><h1 align=center style="color:olive">LogOut Successful </h1>';
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 													// TRUE to follow any "Location: " 
		$url = "http://cyber5.qiau.ac.ir/iau/logOut.do"; 												// URL to POST FORM. (Action of Form)
		curl_setopt($ch, CURLOPT_URL, $url);  															// Pass URL as parameter.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  													// Return Page contents.
		$result = curl_exec($ch);  																		// grab URL and pass it to the variable.
 }
curl_close($ch);																						// close curl resource, and free up system resources.

$time = explode(' ', microtime());
$finish = $time[1] + $time[0];
echo '<h3 align=center style="color:olive">Page generated in '.round(($finish - $start), 4).' seconds</h3>';

?>