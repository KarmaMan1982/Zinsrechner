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

        require_once("../lib/gdgraph.php");

        $gdg = new GDGraph(445,470,"Kapitalerträge");

        $arr = Array(
            'Anlagekapital' => $Anlagekapital,
            'Kapitalsteigerung' => $EndkapitalJahr
        );

        $colors = Array(
            'Anlagekapital' => Array(50,50,50),
            'Kapitalsteigerung' => Array(250,100,100)
        );

        $x_labels = $Jahre;

        $thicknesses = Array(
            'Anlagekapital' => 10,
            'Kapitalsteigerung' => 10
        );

        $gdg->line_graph($arr, $colors, $x_labels);
?>