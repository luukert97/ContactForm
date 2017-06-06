<?php

//begin met het hele gebeuren als je het bericht verstuurd.
if(isset($_POST['verstuurd'])) {
	
    //alle formulieren moeten ingevuld zijn, om te beginnen de naam
    if(trim($_POST['naam']) === '') {
		$naamError =  'Voer je naam in'; 
		$error = true;
	} else {
		$naam = trim($_POST['naam']);
	}
	
	//en een email adres
	if(trim($_POST['email']) === '')  {
		$emailError = 'Voer een emailadres in.';
		$error = true;
	} else {
		$email = trim($_POST['email']);
	}
		
	//en als laatste nog een bericht
	if(trim($_POST['bericht']) === '') {
		$berichtError = 'Voer een bericht in.';
		$error = true;
	} else {
		if(function_exists('stripslashes')) {
			$bericht = stripslashes(trim($_POST['bericht']));
		} else {
			$bericht = trim($_POST['bericht']);
		}
	}
		
	//en als er dan helemaal geen errors zijn, kan het bericht eindelijk verstuurd worden! :D
	if(!isset($error)) {
		
		$emailNaar = 'emailontvanger@email.com';
		$onderwerp = 'Mail van '.$name . ' via FHICT';
		$kopie = trim($_POST['kopie']);
		$body = "Naam: $naam \n\nEmail: $email \n\nBericht: $bericht";
		$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailNaar, $onderwerp, $body, $headers);
        
        //en op het einde is alles klaar en is het mailtje dus verstuurd
		$emailverstuurd = true;
	}
}
?>
<!--dan nog de html code om het formulier te maken-->
<html>
<head> 
<title>FHICT Contact Formulier</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <center>
	<div id="content">
		<div class="container">
		<!--en als dan de emailverstuurd variabele op true staat, wordt dit natuurlijk ook even aan de gebruiker gemeld.-->
	        <?php if(isset($emailverstuurd) && $emailverstuurd == true) { ?>
                <p class="info">Email is verstuurd!</p>
            <?php } else { ?>
            
					<h2>FHICT Contactformulier</h2>
					
				<div id="contact-formulier">
					
                  
				
					<form id="contact1" action="index.php" method="post">
                        
<!--eerste blok met het naamformulier-->                        
                        
						<div class="blok">
							<input type="text" name="naam" id="naam" value="<?php if(isset($_POST['naam'])) echo $_POST['naam'];?>" class="verplicht" placeholder="Naam:" />
							<?php if($naamError != '') { ?>
								<br /><span class="error"><?php echo $naamError;?></span> 
							<?php } ?>
						</div>
                        
 <!--tweede blok met het emailformulier-->
                        
						<div class="blok">
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="verplicht" placeholder="Email:" />
							<?php if($emailError != '') { ?>
								<br /><span class="error"><?php echo $emailError;?></span>
							<?php } ?>
						</div>
                        
<!--derde blok met het berichtenformulier-->                        
                        
						<div class="blok">
							 <textarea name="bericht" id="berichttekst" class="verplicht" placeholder="Bericht:"><?php if(isset($_POST['bericht'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['bericht']); } else { echo $_POST['bericht']; } } ?></textarea>
							<?php if($berichtError != '') { ?>
								<br /><span class="error"><?php echo $berichtError;?></span> 
							<?php } ?>
						</div>
                        
<!--en last but not least de verstuur button!-->                         
                        
							<button name="submit" type="submit" class="knop">Verstuur</button>
							<input type="hidden" name="verstuurd" id="verstuurd" value="true" />
					</form>			
				</div>
<!--en we sluiten de php weer-->				
			<?php } ?>
		</div>
    </div>
	

</center>
</body>
</html>