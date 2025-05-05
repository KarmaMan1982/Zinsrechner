<?php
	session_id($_REQUEST['Session']);
	session_start();

        $Anlagekapital = array();
        $EndkapitalJahr = array();
        $Jahre = array();
		
		foreach($_SESSION['Ergebnisse'] AS $Ergebnis){
				$Anlagekapital[] = round($_SESSION['Rechner']['Anlagekapital'],2);
				$EndkapitalJahr[] = round($Ergebnis['EndkapitalJahr'],2);
				$Jahre[] = $Ergebnis['Jahr'];
		}

		// must set $url first. Duh...
		#$http = curl_init('../lib/jpgraph-3.5.0b1/src/jpgraph.php');
		// do your curl thing here
		#$result = curl_exec($http);
		#$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
		#curl_close($http);
		#echo $http_status;
		#exit;
		
		/*
		try {
			require_once ('../lib/jpgraph-3.5.0b1/src/jpgraph.php');
			require_once ('../lib/jpgraph-3.5.0b1/src/jpgraph_line.php');		
		} catch (Exception $e) {
			require_once ('../lib/jpgraph-1.27.1/src/jpgraph.php');
			require_once ('../lib/jpgraph-1.27.1/src/jpgraph_line.php');		
		}
		*/
		
		#require_once ('../lib/jpgraph-1.27.1/src/jpgraph.php');
		#require_once ('../lib/jpgraph-1.27.1/src/jpgraph_line.php');
		
		#require_once ('../lib/jpgraph-4.1.0/src/jpgraph.php');
		#require_once ('../lib/jpgraph-4.1.0/src/jpgraph_line.php');				
        
		require_once ('../lib/jpgraph-4.4.2/src/jpgraph.php');
		require_once ('../lib/jpgraph-4.4.2/src/jpgraph_line.php');				        
        
		// Setup the graph
        $graph = new Graph(445,470);
        $graph->SetScale("textlin");

        #$theme_class=new UniversalTheme;

        #$graph->SetTheme($theme_class);
        $graph->img->SetAntiAliasing(false);
        $graph->title->Set('Kapitalerträge');
        $graph->SetBox(false);

        $graph->img->SetAntiAliasing();

        $graph->yaxis->HideZeroLabel();
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);

        $graph->xgrid->Show();
        $graph->xgrid->SetLineStyle("solid");
        $graph->xaxis->SetTickLabels($Jahre);
        $graph->xgrid->SetColor('#E3E3E3');

        // Create the first line
        $p1 = new LinePlot($Anlagekapital);
        $graph->Add($p1);
        $p1->SetColor("#6495ED");
        $p1->SetLegend('Anlagekapital');

        // Create the second line
        $p2 = new LinePlot($EndkapitalJahr);
        $graph->Add($p2);
        $p2->SetColor("#B22222");
        $p2->SetLegend('Endkapital');

        $graph->legend->SetFrameWeight(1);

        // Output line
        $graph->Stroke();
?>
