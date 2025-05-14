<?php
class Zinsrechner{
    private string $Suchwert;
    private float $Anlagekapital;
    private float $Zinssatz;
    private float $Laufzeit;		
    private float $Endkapital;
    
    public function __construct(string $Suchwert, float $Anlagekapital, float $Zinssatz, float $Laufzeit, float $Endkapital){
        $this->Suchwert = $Suchwert;
        $this->Anlagekapital = $Anlagekapital;
        $this->Zinssatz = $Zinssatz;
        $this->Laufzeit = $Laufzeit;
        $this->Endkapital = $Endkapital;
        $this->berechnen();
    }
    private function berechnen(){
        switch($this->Suchwert){
                case 'Endkapital':
                        $this->Endkapital = $this->Anlagekapital * pow(($this->Zinssatz / 100) + 1, $this->Laufzeit);	
                break;
                case 'Anlagekapital':
                        $this->Anlagekapital = $this->Endkapital / pow(($this->Zinssatz / 100) + 1, $this->Laufzeit);
                break;
                case 'Laufzeit':
                        $this->Laufzeit = round(log($this->Endkapital / $this->Anlagekapital) / log(($this->Zinssatz / 100) + 1));		
                break;
                case 'Zinssatz':
                        $this->Zinssatz = round(100 * (pow($this->Endkapital/$this->Anlagekapital,1/$this->Laufzeit) - 1));		
                break;
        }        
    }
    public function getResponseSingle(): array{
        $response = array(
                'Suchwert' => $this->Suchwert,
                'Anlagekapital' => $this->Anlagekapital,
                'Zinssatz' => $this->Zinssatz,
                'Laufzeit' => $this->Laufzeit,
                'Endkapital' => $this->Endkapital
        );
        return $response;
    }
    public function getResponseTable(): array{
        $Jahr = 1;
        $Ergebnisse = array();
        $StartkapitalJahr = $this->Anlagekapital;
        $ZinsertragJahrKumuliert = 0;  
        for($Jahr=1;$Jahr<=$this->Laufzeit;$Jahr++){
                $EndkapitalJahr = $this->Anlagekapital * pow(($this->Zinssatz / 100) + 1, $Jahr);
                $ZinsertragJahr = $EndkapitalJahr - $StartkapitalJahr;
                $ZinsertragJahrKumuliert += $ZinsertragJahr;
                $ErgebnisJahr = array(
                        'Jahr' => $Jahr,
                        'StartkapitalJahr' => $StartkapitalJahr,
                        'ZinsertragJahr' => $ZinsertragJahr,
                        'ZinsertragJahrKumuliert' => $ZinsertragJahrKumuliert,
                        'EndkapitalJahr' => $EndkapitalJahr
                );
                $StartkapitalJahr = $EndkapitalJahr;
                $Ergebnisse[]=$ErgebnisJahr;
        }
        return $Ergebnisse;
    }
}
?>