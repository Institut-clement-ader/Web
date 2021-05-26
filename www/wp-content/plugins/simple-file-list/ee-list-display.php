<?php // Simple File List - ee-list-display.php - v04.14.17 - mitchellbennis@gmail.com
	
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! wp_verify_nonce( $nonce1, 'ee_main_page_display' ) ) exit; // Exit if nonce fails

$eeUploadPath = ABSPATH . '/' . $eeSettings['eeUploadDir'] . '/'; // Assemble the full path

$eeFiles = array();
$eeFileCount = 0;
	
// If Delete Files...
if(@$_POST['eeListForm']) {

	foreach($_POST['eeDeleteFile'] as $eeKey => $eeFile){
		
		if(unlink($eeUploadPath . $eeFile)) {
			$eeMsg = 'Deleted the file &rarr; ' . $eeFile;
			$eeLog[] = $eeMsg;
			$eeMessages[] = $eeMsg;
		} else {
			$eeMsg = 'Could not delete the file: ' . $eeFile;
			$eeLog[] = $eeMsg;
			$eeMessages[] = $eeMsg;
		}
	}
}

if($eeMessages) { 
	$eeOutput .= '<div id="eeMessaging" class="updated">';
	$eeOutput .= eeMessageDisplay($eeMessages);
	$eeOutput .= '</div>';
} ?>

<?php if($eeErrors) { 
	$eeOutput .= '<div id="eeMessaging" class="error">';
	$eeOutput .= eeMessageDisplay($eeMessages);
	$eeOutput .= '</div>';
}

// List files in folder, add to array.
if ($eeHandle = @opendir($eeUploadPath)) {

	while(false !== ($eeFile = readdir($eeHandle))) {
		if(!@in_array($eeFile, $eeExcluded)) {
			if(@is_file($eeUploadPath . '/' . $eeFile)) { // Don't show directories.
				
				// Get file info...
				$eeFiles[] = $eeFile; // Add the file to the array
			}	
		}
	}
	@closedir($eeHandle);
	
	// $eeFileCount = count($eeFiles);
	
	if($eeFiles) {
		
		$eeUploadPath = ABSPATH . '/' . $eeSettings['eeUploadDir'] . '/';
		
		// Files by Name
		if($eeSettings['eeSortList'] == 'Date') { // Files by Date
			
			$eeFilesByDate = array();
			foreach($eeFiles as $eeFile){
				$eeFileDate = filemtime($eeUploadPath . $eeFile); // Get byte Date, yum.
				$eeFilesByDate[$eeFile] = $eeFileDate; // Associative Array
			}
			
			// Sort order
			if($eeSettings['eeSortOrder'] == 'Descending') {
				arsort($eeFilesByDate);
			} else {
				asort($eeFilesByDate); // Sort by Date, ascending
			}
			
			$eeFiles = array_flip($eeFilesByDate); // Swap keys & values	
			
		} elseif($eeSettings['eeSortList'] == 'Size') { // Files by Size
			
			$eeFilesBySize = array();
			foreach($eeFiles as $eeFile){
				$eeFileSize = filesize($eeUploadPath . $eeFile); // Get byte size, yum.
				$eeFilesBySize[$eeFile] = $eeFileSize; // Associative Array
			}
			
			// Sort order
			if($eeSettings['eeSortOrder'] == 'Descending') {
				arsort($eeFilesBySize);
			} else {
				asort($eeFilesBySize); // Sort by Date, ascending
			}
			
			$eeFiles = array_flip($eeFilesBySize); // Swap keys & values

		} elseif($eeSettings['eeSortList'] == 'Name') { // Alpha
			
			@natcasesort($eeFiles);
			
			// Sort order
			if($eeSettings['eeSortOrder'] == 'Descending') {
				arsort($eeFiles);
			}
		}
		
		if($eeAdmin) {
		
			$eeOutput .= '<form action="' . $_SERVER['PHP_SELF'] . '?page=ee-simple-file-list' . '" method="post">	
				<input type="submit" name="eeListForm" value="Supprimer les fichiers cochés" class="alignright" />';
		}
		
		if($eeSettings['eeAllowUploads'] != 'No') { $eeOutput .= '<h2 class="eeFileListTitle">Fichiers</h2>'; }
		
		$eeOutput .= '<table class="eeFiles tablesorter">
							<thead>
								<tr>
									<th>Fichier</th>
									<th class="sortless">Taille</th>
									<th>Date</th>';
									
		/*if($eeAdmin) { */$eeOutput .= "<th>Supprimer</th>"; //}
		
		$eeOutput .= '</tr>
						</thead>
							<tbody>';
								
		// Loop through array
    $fileslink = array();
		foreach($eeFiles as $eeKey => $eeFile) {
			
			if(strpos($eeFile, '.') !== 0) { // Don't display hidden files
			
				$eeFileCount++;
				
				$eeOutput .= '<tr>';
				
				// File Name
				$eeOutput .= '<td>';
				
				$eeFileURL = get_site_url() . '/' . $eeSettings['eeUploadDir'] . '/' . $eeFile;
				
				if(eeUrlExists($eeFileURL)) { // Show link only if file is within the public area.
				
					$eeOutput .= '<a href="' . $eeFileURL .  '" target="_blank">' . $eeFile . '</a>';
				
				} else {
					
					$eeOutput .= $eeFile; // No link if not accessible
					
					// $eeErrors[] = "File Not Found: " . $eeFileURL;
				}
				
				$eeOutput .= '</td>';
				
				
				
				// File Size
				$eeOutput .= '<td>' . eeBytesToSize(filesize($eeUploadPath . $eeFile)) . '</td>';
				
				
				// File Modification Date
				$eeOutput .= '<td>' .  date('d/m/Y' ,@filemtime($eeUploadPath . $eeFile)). '</td>';
				
				
				//if($eeAdmin) {
        $eeOutput .= '<td><a href="/suppr_doc.php?del='.$eeFileURL.'">Supprimer</a></td>';
					//$eeOutput .= '<td><input type="checkbox" name="eeDeleteFile[]" value="' . $eeFile . '" /></td>';
				//}
				
				$eeOutput .= '</tr>';
			
			}		
			
		} // END loop
		
		$eeMsg = "Il y a " . $eeFileCount . " fichiers dans la liste."; //Sorting by " . $eeSettings['eeSortList'];
	
		$eeOutput .= '</tbody></table>
		
		<p class="eeFileListInfo">' . $eeMsg . '</p>';
		
		$eeLog[] = $eeMsg;
	 
    
    
	 }
	
	if($eeAdmin) { $eeOutput .= "</form>"; }

} else {

	$eeErrors[] = "ERREUR: Les fichiers ne peuvent être lus.";
}

if (count($eeFiles) < 1) {
	$eeLog[] = 'Il n\'y a pas de fichier à lister';
	$eeOutput .= "<p>Il n'y a pas de fichier à lister.</p>";
}


?>