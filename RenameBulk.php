<?php
/*
This PHP script helps rename all files in a folder in bulk
Became needed when we had to upload multiple
files, which the name of the file represents the userID
and some IDs have extra 0 that we want removed
*/

$failed = 0;
$succeed = 0;
$result = "";
$dir = 'C:\laragon\www\scripts\test_folder'; //folder should be in same place script is (for this scenario)
$title = "Official Document";
$desc = "Bulk Upload action";
$resultFile = time().".txt";
$path = new RecursiveDirectoryIterator($dir);

chdir($dir);
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $fileName)
{
	if(strlen(basename($fileName))>4) {
	$directory = pathinfo($fileName,PATHINFO_DIRNAME);
	$currentName = basename($fileName);
    
    if(strlen($currentName) > 13) {
        $newName = str_replace_first("0", "", $currentName);
    } else {
        continue;
    }
    if (!file_exists($newName)) { // Check If File Already Exists

                if (rename("$directory/$currentName", "$directory/$newName")) { // Check If rename Function Completed Successfully

                    $result .= "Successfully Renamed $currentName to $newName<br>";
                    $succeed++;
                } else {

                    $result .= "There Was Some Error While Renaming $currentName<br>";
                    $failed++;
                }

            } else {

                $result .= "A File With The New File Name Already Exists<br>";
                $failed++;
            }
			
}

//save results in txt file
$fp = fopen(F, 'a+');
fwrite($fp, $result.PHP_EOL);
fclose($fp);
}

function str_replace_first($search, $replace, $subject) {
    return implode($replace, explode($search, $subject, 2));
}
echo $result;