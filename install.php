<?php
$t=array(
"de"=>array(

),
"ro"=>array(
'TinyCMS Installer'=>'Instalatorul TinyCMS',
'Please fill in the url multi-level separator'=>'Completați separatorul pentru pagini multi-nivel',
'Please fill in the site root'=>'Completați baza site-ului',
'Please select at least one theme'=>'Selectați cel puțin o temă',
'There seems to already be an installation atempt here, please delete all folders and files in the current directory except this file'=>'Se pare că ați mai încercat să instalați acest pachet, stergeți toate directoarele și fișierele în afară de acesta și încercați din nou',
'Let\'s check if your server can support TinyCMS'=>'Să verificăm dacă serverul dumneavoastră este compatibil cu TinyCMS',
'Fill in your TinyCMS settings'=>'Să ne pregătim',
'Installing files'=>'Instalez fișierele',
'Let\'s finish this'=>'Să terminăm',
'<p>STEP 1</p>Requirements Check'=>'<p>Pasul 1</p>Verficare compatibilitate',
'<p>STEP 2</p>Your Settings'=>'<p>Pasul 2</p>Setările dumneavoastră',
'<p>STEP 3</p>Installing ...'=>'<p>Pasul 3</p>Instalare ...',
'<p>STEP 4</p>Self Destruct'=>'<p>Pasul 4</p>Auto-distrugere',
'SUCCESS'=>'REUȘIT',
'FAILED'=>'NEREUȘIT',
'Checking create folder permissions'=>'Verific permisiuni de creare directoare',
'Checking create file permissions'=>'Verific permisiuni de creare fișiere',
'Checking read file permissions'=>'Verific permisiuni de citire fișiere',
'Checking delete file permissions'=>'Verific permisiuni de ștergere fișiere',
'Checking delete folder permissions'=>'Verific permisiuni de ștergere directoare',
'Checking if mod_rewrite is enabled'=>'Verific daca mod_rewrite este pornit',
'Checking if server has unzip enabled'=>'Verific daca serverul poate despacheta fișiere',
'Checking TinyCMS version'=>'Verific versiunea TinyCMS',
'Version'=>'Versiune',
'Next step'=>'Pasul următor',
'Error(s) detected, the TinyCMS installer cannot continue'=>'Am detectat erori, instalatorul nu poate continua',
'Your urls multi-level separator'=>'Separatorul din URL pentru pagini multi-nivel',
'Example: http://www.example.com/about<strong>/</strong>company.html - cannot be blank'=>'Exemplu: http://www.exemplu.ro/despre<strong>/</strong>compania.html - nu poate fi gol',
'Your urls ending'=>'Terminația adreselor URL',
'Example: http://www.example.com/about/company<strong>.html</strong> - can be blank'=>'Exemplu: http://www.exemplu.ro/despre/compania<strong>.html</strong> - poate fi gol',
'Your site root'=>'Baza site-ului',
'Example: <strong>/</strong> or <strong>/testing/</strong> - cannot be blank'=>'Exemplu <strong>/</strong> sau <strong>/teste/</strong> - nu poate fi gol',
'Language to install'=>'Limba pe care dorți să o instalăm' ,
'Theme(s) to install'=>'Tema(temele) pe care doriți sa o(le) instalăm',
'by'=>'de',
'Plugin(s) to install'=>'Plugin(-uri) pe care doriți sa le instalăm',
'Your admin password'=>'Parola de administrare',
'Leaving this empty will generate a password for you'=>'Daca lăsați acest câmp gol, vă vom genera noi o parolă',
'Install TinyCMS'=>'Instalează TinyCMS',
'Getting files'=>'Preiau fișierele',
'Unpacking files'=>'Despachetez fișierele',
'Removing unnecessary files'=>'Șterg fișierele inutile',
'Generating password, <strong>please copy this password to be able to log in your admin zone</strong>'=>'Generez parola, <strong>copiați această parolă pentru a vă putea loga in zona de administrare</strong>',
'Writing config file'=>'Scriu fișierul de configurare',
'Delete this file and go to my new TinyCMS'=>'Șterge acest fișier și mergi la noul meu site',
),
);
$ilang=isset($_GET['lang'])?$_GET['lang']:'en';
if (!isset($t[$ilang])) $ilang='en';
function _e($s,$ret=true){
	global $t,$ilang;
	$r=(isset($t[$ilang][$s]))?($t[$ilang][$s]?$t[$ilang][$s]:$s):$s;
	if ($ret) return $r;
	else echo $r;
	
}
$sr=str_replace("\\","/",dirname($_SERVER['REQUEST_URI']));
$sr=(strlen($sr)>1?$sr.'/':$sr);

if (isset($_POST['tostep5'])){
	@unlink("install.php");
	header("Location: ".$sr);
	exit;
}
$step=1;
if (isset($_POST['tostep4'])){
	$step=4;
}
if ($step<>4&&file_exists("__d4ta")&&file_exists("a55ets")&&file_exists("themes")&&file_exists("index.php")) $step=0;
if (isset($_POST['tostep2'])){
	$step=2;
}
if (isset($_POST['step2sent'])) {
	$p2=$_POST;
	$step=2;
	$s2er="";
	if (!$p2['urlSep']) $s2er=_e("Please fill in the url multi-level separator");
	if (!$p2['sr']) $s2er=_e("Please fill in the site root");
	if (!isset($p2['siteTheme'])||!is_array($p2['siteTheme'])&&empty($p2['siteTheme'])) $s2er=_e("Please select at least one theme");
	if (!$s2er) {
		$step=3;
	}
}
if ($step==2) {	
	if (!isset($p2)) $p2=array("urlSep"=>"/","urlEnd"=>".html","sr"=>$sr,"lang"=>$ilang,"siteTheme"=>array("mad"),'pass'=>'',"sitePlugins"=>array("forms","sliders"));
	$langs=json_decode(@file_get_contents("http://www.tinycms.ro/get/languages"));
	$ls='<option value="en"'.($p2['lang']=="en"?' selected="selected"':'').'>English</option>';
	if ($langs) foreach ($langs as $k=>$v) if ($k<>'en') $ls.='<option value="'.$k.'"'.($p2['lang']==$k?' selected="selected"':'').'>'.$v.'</option>';
	$themes=json_decode(file_get_contents("http://www.tinycms.ro/get/themes"));
	$plugins=json_decode(file_get_contents("http://www.tinycms.ro/get/plugins"));
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo _e('TinyCMS Installer'); ?></title>
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<style>body { padding:0px; margin:0px; font-family:'Alegreya Sans SC', sans-serif; font-size:14px; background:#ebebeb; }a{color:#f00;text-decoration:none; }#wrapper{width:988px;margin:10px auto; border:solid 1px #ccc; background:#fff;border-radius:5px;box-shadow:0px 0px 3px 3px #DADADA;}#header {padding:10px;border-bottom:solid 1px #ccc; font-size:32px;}#main{padding:10px;font-size:16px;}#copy{text-align:center; }#header div { font-size:20px; }#steps{ text-align:center; padding:10px 0 10px 0; margin:0 0 10px 0; border-bottom:solid 1px #ccc;}p{margin:0 0 4px 0; padding:0;border-bottom:solid 1px #ccc;}#steps div {display:inline-block; padding:8px 10px 10px 10px; margin:10px; width:200px;border:solid 1px #ccc;border-radius:5px;box-shadow:0px 0px 3px 3px #DADADA;background:#ebebeb; color:#CCC; font-size:16px;}#steps div.a { box-shadow:0px 0px 3px 3px #999; color:#000; }#steps div p { font-size:26px; }p.r span { float:right; font-weight:bold; } p.r .suc { color:#090; }p.r .fai { color:#900; }input, select { border:solid 1px #999; border-radius:4px; padding:4px 8px; font-family:Arial, Helvetica, sans-serif;  font-size:16px;  box-shadow:0px 0px 3px #aaa inset;}input[type="submit"] { cursor:pointer;background:#666; color:#fff;font-family:'Alegreya Sans SC', sans-serif; }input[type="button"]::-moz-focus-inner,input[type="submit"]::-moz-focus-inner{padding:0;border:0;}#fsb { float:right; }small { font-family:Arial, Helvetica, sans-serif; font-size:14px; margin:0 0 0 20px; }small strong { color:#f00; }div.r { border-bottom:solid 1px #ccc; padding:4px 0 4px 0; } div.r label, div.r .rinput { display:inline-block; vertical-align:middle; }  div.r label { width:320px;}.set_theme { display:inline-block; vertical-align:top;width:120px; background:#fff; padding:8px; border: 1px solid #999;border-radius:5px; margin:0 8px 8px 0; font-size:14px;}div.r .set_theme label { display:static; vertical-align:top; width:auto;  height:auto; line-height:inherit; padding:0;}</style>
</head>

<body>
<div id="wrapper">
	<div id="header"><?php echo _e('TinyCMS Installer').($step==1||$step==0?' - <a href="?lang="en">In english</a> - <a href="?lang=de">Deutsch</a> - <a href="?lang=ro">În română</a>':''); ?> <div><?php switch($step){ case 0:  echo _e('There seems to already be an installation atempt here, please delete all folders and files in the current directory except this file'); break; case 1: echo _e("Let's check if your server can support TinyCMS"); break; case 2: echo _e("Fill in your TinyCMS settings"); break ;case 3: echo _e("Installing files"); break;case 4: echo _e("Let's finish this"); break;} ?></div></div>
    <div id="steps">
    <?php echo '<div'.($step==1?' class="a"':'').'>'._e('<p>STEP 1</p>Requirements Check').'</div><div'.($step==2?' class="a"':'').'>'._e('<p>STEP 2</p>Your Settings').'</div><div'.($step==3?' class="a"':'').'>'._e('<p>STEP 3</p>Installing ...').'</div><div'.($step==4?' class="a"':'').'>'._e('<p>STEP 4</p>Self Destruct').'</div>';
	?>
    </div>
    <div id="main">    
    <?php if ($step==1) { $oktostep2=true; ?>
    	<div id="step1">
            <p class="r"><?php echo _e('Checking create folder permissions'); $mkdir=@mkdir("_testFolder"); echo ($mkdir?'<span class="suc">'._e('SUCCESS').'</span>':'<span class="fai">'._e('FAILED').'</span>'); if (!$mkdir) $oktostep2=false; ?></p>
            <p class="r"><?php echo _e('Checking create file permissions'); $fpc=@file_put_contents("_testFolder/_testFile.madd","TestConnT3nt"); echo ($fpc?'<span class="suc">'._e('SUCCESS').'</span>':'<span class="fai">'._e('FAILED').'</span>'); if (!$fpc) $oktostep2=false; ?></p>
            <p class="r"><?php echo _e('Checking read file permissions'); $fgc=@file_get_contents("_testFolder/_testFile.madd"); echo ($fgc&&$fgc=="TestConnT3nt"?'<span class="suc">'._e('SUCCESS').'</span>':'<span class="fai">'._e('FAILED').'</span>'); if (!$fgc||$fgc<>"TestConnT3nt") $oktostep2=false; ?></p>
            <p class="r"><?php echo _e('Checking delete file permissions'); $unlink=@unlink("_testFolder/_testFile.madd"); echo ($unlink?'<span class="suc">'._e('SUCCESS').'</span>':'<span class="fai">'._e('FAILED').'</span>'); if (!$unlink||$fgc<>"TestConnT3nt") $oktostep2=false; ?></p>
            <p class="r"><?php echo _e('Checking delete folder permissions'); $rmdir=@rmdir("_testFolder"); echo ($rmdir?'<span class="suc">'._e('SUCCESS').'</span>':'<span class="fai">'._e('FAILED').'</span>'); if (!$rmdir) $oktostep2=false; ?></p>
            <?php if (!isset($_GET['skipmod_rewrite'])) { ?>
            <p class="r"><?php echo _e('Checking if mod_rewrite is enabled'); 
			if (function_exists("apache_get_modulesx")) $mre=in_array('mod_rewrite', apache_get_modules()); else {ob_start();phpinfo(INFO_MODULES);$contents = ob_get_contents();ob_end_clean();$mre=strpos($contents, 'mod_rewrite');} echo ($mre?'<span class="suc">'._e('SUCCESS').'</span>':'<span class="fai">'._e('FAILED').'</span>'); if (!$mre) $oktostep2=false; ?></p>
            <?php } ?>
            <p class="r"><?php echo _e('Checking if server has unzip enabled'); $unz=class_exists("ZipArchive");  echo ($unz?'<span class="suc">'._e('SUCCESS').'</span>':'<span class="fai">'._e('FAILED').'</span>'); if (!$unz) $oktostep2=false; ?></p>
            <p class="r"><?php echo _e('Checking TinyCMS version'); $tcmver=@file_get_contents("http://www.tinycms.ro/get/version");  echo ($tcmver?'<span class="suc">'._e('Version').': '.$tcmver.'</span>':'<span class="fai">'._e('FAILED').'</span>'); if (!$tcmver) $oktostep2=false; ?></p>
            <?php
			if ($oktostep2) echo '<form action="" method="post"><input type="submit" name="tostep2" value="'._e('Next step').'" id="fsb"/></form><br><br>';
			else echo '<p class="r">&nbsp;<span class="fai">'._e('Error(s) detected, the TinyCMS installer cannot continue').'</span></p>';
			?>
        </div>
    <?php } ?>
    <?php if ($step==2) { $oktostep3=true; ?>
        <div id="step2">
        	<?php if (isset($s2er)&&$s2er) echo '<p class="r">&nbsp;<span class="fai">'.$s2er.'</span></p>'; ?>
            <form action="" method="post"><input type="hidden" name="step2sent" value="yEs"/>
            <div class="r"><label for="urlSep"><?php echo _e('Your urls multi-level separator'); ?>:</label> <div class="rinput"><input type="text" name="urlSep" id="urlSep" value="<?php echo $p2['urlSep'] ?>" style="width:10px"/> <small><?php echo _e('Example: http://www.example.com/about<strong>/</strong>company.html - cannot be blank'); ?></small></div></div>
            <div class="r"><label for="urlEnd"><?php echo _e('Your urls ending'); ?>:</label> <div class="rinput"><input type="text" name="urlEnd" id="urlEnd" value="<?php echo $p2['urlEnd'] ?>" style="width:36px;"/> <small><?php echo _e('Example: http://www.example.com/about/company<strong>.html</strong> - can be blank'); ?></small></div></div>
            <div class="r"><label for="sr"><?php echo _e('Your site root');?>:</label> <div class="rinput"><input type="text" name="sr" id="sr" value="<?php echo $p2['sr'] ?>" style="width:50px;" readonly/> <small><?php echo _e('Example: <strong>/</strong> or <strong>/testing/</strong> - cannot be blank');?></small></div></div>
            <div class="r"><label for="lang"><?php echo _e('Language to install');?>:</label> <div class="rinput"><select name="lang" id="lang"><?php echo $ls; ?></select></div></div>
            <div class="r"><label for="siteTheme"><?php echo _e('Theme(s) to install');?></label> <div class="rinput">
            <?php if (!empty($themes)) foreach ($themes as $theme) {
				echo '<div class="set_theme"><label for="siteTheme_'.$theme[0].'">'.(isset($theme[6])?'<img src="data:image/jpg;base64,'.$theme[6].'"/>':'').'</label> <input type="checkbox" name="siteTheme[]" id="siteTheme_'.$theme[0].'" value="'.$theme[0].'"'.(isset($p2['siteTheme'])&&in_array($theme[0],$p2['siteTheme'])?' checked="checked"':'').' /> '.(isset($theme[4])?'<a href="'.$theme[4].'" target="_blank">':'').(isset($theme[1])?$theme[1]:'').(isset($theme[4])?'</a>':'').'<br />'._e('by').': '.(isset($theme[3])?'<a href="mailto:'.$theme[3].'">':'').(isset($theme[2])?$theme[2]:'').(isset($theme[3])?'</a>':'').'</div>';			
			}			
			?>
            </div></div>
            <div class="r"><label for="sitePlugins"><?php echo _e('Plugin(s) to install');?></label> <div class="rinput">
            <?php if (!empty($plugins)) foreach ($plugins as $plugin) {
				echo '<div class="set_theme"><label for="plugins_'.$plugin[0].'">'.$plugin[1].'</label> <input type="checkbox" name="sitePlugins[]" id="plugins_'.$plugin[0].'" value="'.$plugin[0].'"'.(isset($p2['sitePlugins'])&&in_array($plugin[0],$p2['sitePlugins'])?' checked="checked"':'').' /> '.(isset($plugin[4])?'<a href="'.$plugin[4].'" target="_blank">':'').(isset($plugin[1])?$plugin[1]:'').(isset($plugin[4])?'</a>':'').'<br />'._e('by').': '.(isset($plugin[3])?'<a href="mailto:'.$plugin[3].'">':'').(isset($plugin[2])?$plugin[2]:'').(isset($plugin[3])?'</a>':'').'</div>';			
			}			
			?>
            </div></div>
            <div class="r"><label for="pass"><?php echo _e('Your admin password');?>:</label> <div class="rinput"><input type="password" name="pass" id="pass" value="<?php echo $p2['pass'] ?>" style="width:80px;"/></div> <small><?php echo _e('Leaving this empty will generate a password for you');?></small></div>
            <div class="r"> <div class="rinput"><label for="tostep3"></label> <input type="submit" name="tostep3" value="<?php echo _e('Install TinyCMS');?>"/></div></div>            
            </form>
        </div>
    <?php } ?>
    <?php if ($step==3) { $oktostep4=true; ?>
    	<div id="step3">
        <p class="r"><?php echo _e("Getting files");?>: <?php $fgczip=file_get_contents("http://www.tinycms.ro/get/custom?lang=".$p2['lang'].'&themes='.implode(",",$p2['siteTheme']).'&plugins='.(isset($p2['sitePlugins'])?implode(",",$p2['sitePlugins']):'').'sr='.$p2['sr'].'&from='.$_SERVER['SCRIPT_FILENAME']); if ($fgczip) file_put_contents("_deleteF1les.zip",$fgczip);  echo ($fgczip?'<span class="suc">'._e('SUCCESS').'</span>':'<span class="fai">'._e('FAILED').'</span>'); if (!$fgczip) $oktostep4=false; flush(); ?></p>
        <p class="r"><?php echo _e("Unpacking files");?>: <?php $zip = new ZipArchive; $res = $zip->open('_deleteF1les.zip'); if ($res === TRUE) { $zip->extractTo(getcwd()); $zip->close(); echo '<span class="suc">'._e('SUCCESS').'</span>'; } else { echo '<span class="fai">'._e('FAILED').'</span>';  $oktostep4=false;  flush();} ?></p>
        <p class="r"><?php echo _e("Removing unnecessary files");?>: <?php $unli =unlink('_deleteF1les.zip'); echo ($unli?'<span class="suc">'._e('SUCCESS').'</span>':'<span class="fai">'._e('FAILED').'</span>'); if (!$unli) $oktostep4=false; flush(); ?></p>
        <?php if (!isset($p2['pass'])||!$p2['pass']) { ?>
        <p class="r"><?php echo _e("Generating password, <strong>please copy this password to be able to log in your admin zone</strong>");?>: <?php $p2['pass']=substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,6); echo '<span class="suc" style="font-family:arial;">'.$p2['pass'].'</span>'; flush(); ?></p>
        <?php } ?>
        <p class="r"><?php echo _e("Writing config file");?>: <?php $fpcf=file_put_contents("a55ets/s3tt1nGs.php",'<?php'."\n".'/*private constants*/'."\n".'define("DATA_FOLDER","__d4ta/");'."\n".'define("ADMIN","4dm1n");'."\n".'define("INSTALLED",true);'."\n".'/*public constants*/'."\n".'define("URL_SEPARATOR","'.$p2['urlSep'].'");'."\n".'define("URL_ENDING","'.$p2['urlEnd'].'");'."\n".'define("SR","'.$p2['sr'].'");'."\n".'/*DO NOT PUT this to true on a live site, it will reveal important information to your visitors*/'."\n".'define("DEBUG",false);'."\n".''."\n".'/*editable constants*/'."\n".''."\n".'/*this is a MD5 Hash of the actual password, use online tools like http://www.md5hashgenerator.com to find it out.*/'."\n".'define("PASS","'.md5($p2['pass']).'");'."\n".'define("LANG","'.$p2['lang'].'");'."\n".'define("THEME_FOLDER","'.$p2['siteTheme'][0].'");'."\n".''."\n".'$plugins = array('.(isset($p2['sitePlugins'])?'"'.implode('","',$p2['sitePlugins']).'"':'').');'."\n".'require "a55ets/tcClas5.php"; '."\n".'?>'); echo ($fpcf?'<span class="suc">'._e('SUCCESS').'</span>':'<span class="fai">'._e('FAILED').'</span>'); if (!$fpcf) $oktostep4=false; flush();?></p>
        <?php
			if ($oktostep4) echo '<form action="" method="post"><input type="submit" name="tostep4" value="'._e("Next step").'" id="fsb"/></form><br><br>';
			else echo '<p class="r">&nbsp;<span class="fai">'._e('Error(s) detected, the TinyCMS installer cannot continue').'</span></p>';
			?>
        </div>
    <?php } ?>
    <?php if ($step==4) { ?>
    	<div id="step4">
        <?php echo '<form action="" method="post"><input type="submit" name="tostep5" value="'._e('Delete this file and go to my new TinyCMS').'" id="fsb"/></form><br><br>'; ?>
        </div>
    <?php } ?>    
    </div>
</div>
<div id="copy">TinyCMS &copy; <?php echo date("Y"); ?><br><a href="http://www.tinycms.eu" target="_blank">www.TinyCMS.eu</a> - <a href="http://www.tinycms.eu" target="_blank">www.TinyCMS.ro</a></div>
</body>
</html>
